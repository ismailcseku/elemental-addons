<?php
/**
 * Converts Evolta / mascot-core Elementor JSON for Elemental Addons.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Elemental_Addons_Layout_Converter' ) ) {

	class Elemental_Addons_Layout_Converter {

		/**
		 * Optional remaps when source used different widget type IDs.
		 *
		 * @return array<string,string>
		 */
		public static function type_map() {
			return array(
				// Keep identical Evolta IDs; add aliases only if needed later.
				'elemental-text-editor'            => 'tm-ele-text-editor',
				'elemental-text-editor-advanced'   => 'tm-ele-text-editor-advanced',
				'elemental-team-block'             => 'tm-ele-team-block',
				'elemental-testimonial-block'      => 'tm-ele-testimonial-block',
				'elemental-service-block'          => 'tm-ele-service-block',
				'elemental-pricing-block'          => 'tm-ele-pricing-block',
				'elemental-image-gallery'          => 'tm-ele-image-gallery2',
				'elemental-image-gallery2'         => 'tm-ele-image-gallery2',
				'elemental-features-block'         => 'tm-ele-features-block',
				'elemental-counter-block'          => 'tm-ele-counter-block',
				'elemental-accordion'              => 'tm-ele-accordion',
				'elemental-animated-layers'        => 'tm-ele-animated-layers',
				'elemental-clients-logo'           => 'tm-ele-clients-logo',
				'elemental-contact-form-7'         => 'tm-ele-contact-form-7',
				'elemental-floating-objects'       => 'tm-ele-floating-objects',
				'elemental-funfact-counter'        => 'tm-ele-funfact-counter',
				'elemental-progress-bar'           => 'tm-ele-progress-bar',
				'elemental-section-title'          => 'tm-ele-section-title',
			);
		}

		/**
		 * Widget types currently registered in Elementor (destination site).
		 *
		 * @return string[]
		 */
		public static function supported_widget_types() {
			$types = array();

			if ( class_exists( '\Elementor\Plugin' ) ) {
				foreach ( \Elementor\Plugin::$instance->widgets_manager->get_widget_types() as $name => $widget ) {
					$types[] = $name;
				}
			}

			return array_values( array_unique( $types ) );
		}

		/**
		 * Decode pasted/uploaded content into an Elementor document array.
		 *
		 * @param string $raw Raw JSON string.
		 * @return array|\WP_Error
		 */
		public static function decode( $raw ) {
			$raw = trim( (string) $raw );
			if ( '' === $raw ) {
				return new \WP_Error( 'empty', __( 'No JSON provided.', 'elemental-addons' ) );
			}

			$data = json_decode( $raw, true );
			if ( JSON_ERROR_NONE !== json_last_error() ) {
				return new \WP_Error( 'json', __( 'Invalid JSON.', 'elemental-addons' ) . ' ' . json_last_error_msg() );
			}

			// Elementor export sometimes wraps content.
			if ( isset( $data['content'] ) && is_array( $data['content'] ) ) {
				return $data;
			}

			// Bare elements array.
			if ( isset( $data[0] ) && is_array( $data[0] ) && isset( $data[0]['elType'] ) ) {
				return array(
					'content'       => $data,
					'page_settings' => array(),
					'version'       => '0.4',
					'type'          => 'page',
					'title'         => 'Converted Layout',
				);
			}

			return new \WP_Error( 'format', __( 'Unrecognized Elementor JSON format. Export a template or paste the content array.', 'elemental-addons' ) );
		}

		/**
		 * Convert a document. Unsupported widgets become HTML placeholders (or are removed).
		 *
		 * @param array  $document Decoded document.
		 * @param string $unsupported_mode keep|html|remove
		 * @return array{document:array,report:array}
		 */
		public static function convert( array $document, $unsupported_mode = 'html' ) {
			$supported = self::supported_widget_types();
			$map       = self::type_map();
			$report    = array(
				'kept'      => array(),
				'mapped'    => array(),
				'replaced'  => array(),
				'removed'   => array(),
				'containers'=> 0,
			);

			$document['content'] = self::convert_elements(
				isset( $document['content'] ) && is_array( $document['content'] ) ? $document['content'] : array(),
				$supported,
				$map,
				$unsupported_mode,
				$report
			);

			if ( empty( $document['title'] ) ) {
				$document['title'] = 'Converted Layout';
			}
			if ( empty( $document['type'] ) ) {
				$document['type'] = 'page';
			}
			if ( empty( $document['version'] ) ) {
				$document['version'] = '0.4';
			}

			return array(
				'document' => $document,
				'report'   => $report,
			);
		}

		/**
		 * @param array  $elements
		 * @param string[] $supported
		 * @param array  $map
		 * @param string $unsupported_mode
		 * @param array  $report
		 * @return array
		 */
		private static function convert_elements( array $elements, array $supported, array $map, $unsupported_mode, array &$report ) {
			$out = array();

			foreach ( $elements as $element ) {
				if ( ! is_array( $element ) ) {
					continue;
				}

				$el_type = isset( $element['elType'] ) ? $element['elType'] : '';

				if ( 'widget' === $el_type ) {
					$converted = self::convert_widget( $element, $supported, $map, $unsupported_mode, $report );
					if ( null !== $converted ) {
						$out[] = $converted;
					}
					continue;
				}

				// section / column / container / etc.
				$report['containers']++;
				if ( ! empty( $element['elements'] ) && is_array( $element['elements'] ) ) {
					$element['elements'] = self::convert_elements( $element['elements'], $supported, $map, $unsupported_mode, $report );
				}
				$out[] = $element;
			}

			return $out;
		}

		/**
		 * @param array  $element
		 * @param string[] $supported
		 * @param array  $map
		 * @param string $unsupported_mode
		 * @param array  $report
		 * @return array|null
		 */
		private static function convert_widget( array $element, array $supported, array $map, $unsupported_mode, array &$report ) {
			$type = isset( $element['widgetType'] ) ? (string) $element['widgetType'] : '';

			if ( isset( $map[ $type ] ) && $map[ $type ] !== $type ) {
				$report['mapped'][] = $type . ' → ' . $map[ $type ];
				$type               = $map[ $type ];
				$element['widgetType'] = $type;
			}

			if ( in_array( $type, $supported, true ) ) {
				$report['kept'][ $type ] = isset( $report['kept'][ $type ] ) ? $report['kept'][ $type ] + 1 : 1;
				return $element;
			}

			if ( 'remove' === $unsupported_mode ) {
				$report['removed'][] = $type;
				return null;
			}

			if ( 'keep' === $unsupported_mode ) {
				$report['kept'][ $type ] = isset( $report['kept'][ $type ] ) ? $report['kept'][ $type ] + 1 : 1;
				return $element;
			}

			// Default: replace with HTML placeholder so paste/import does not fail.
			$report['replaced'][] = $type;
			return self::to_html_placeholder( $element, $type );
		}

		/**
		 * Build an Elementor HTML widget from an unsupported widget.
		 *
		 * @param array  $element
		 * @param string $type
		 * @return array
		 */
		private static function to_html_placeholder( array $element, $type ) {
			$settings = isset( $element['settings'] ) && is_array( $element['settings'] ) ? $element['settings'] : array();
			$bits     = self::extract_text_bits( $settings );
			$title    = ! empty( $bits['title'] ) ? $bits['title'] : $type;
			$body     = ! empty( $bits['body'] ) ? $bits['body'] : '';

			$html  = '<!-- Converted from ' . esc_html( $type ) . ' by Elemental Addons -->';
			$html .= '<div class="elemental-converted-widget" data-source-widget="' . esc_attr( $type ) . '">';
			$html .= '<p><strong>' . esc_html( $title ) . '</strong></p>';
			if ( $body ) {
				$html .= wp_kses_post( $body );
			} else {
				$html .= '<p><em>' . esc_html__( 'Unsupported Evolta widget — replace with an Elemental Addons widget.', 'elemental-addons' ) . '</em></p>';
			}
			$html .= '</div>';

			return array(
				'id'         => isset( $element['id'] ) ? $element['id'] : self::generate_id(),
				'elType'     => 'widget',
				'widgetType' => 'html',
				'settings'   => array(
					'html' => $html,
				),
				'elements'   => array(),
			);
		}

		/**
		 * Pull common text fields out of widget settings.
		 *
		 * @param array $settings
		 * @return array{title:string,body:string}
		 */
		private static function extract_text_bits( array $settings ) {
			$title_keys = array( 'title', 'heading', 'name', 'section_title', 'widget_title' );
			$body_keys  = array( 'content', 'description', 'editor', 'text', 'subtitle', 'desc' );

			$title = '';
			$body  = '';

			foreach ( $title_keys as $key ) {
				if ( ! empty( $settings[ $key ] ) && is_string( $settings[ $key ] ) ) {
					$title = wp_strip_all_tags( $settings[ $key ] );
					break;
				}
			}

			foreach ( $body_keys as $key ) {
				if ( ! empty( $settings[ $key ] ) && is_string( $settings[ $key ] ) ) {
					$body = $settings[ $key ];
					break;
				}
			}

			// Repeater-ish: first item text.
			if ( '' === $body ) {
				foreach ( $settings as $value ) {
					if ( ! is_array( $value ) || empty( $value[0] ) || ! is_array( $value[0] ) ) {
						continue;
					}
					$first = $value[0];
					foreach ( $body_keys as $key ) {
						if ( ! empty( $first[ $key ] ) && is_string( $first[ $key ] ) ) {
							$body = $first[ $key ];
							break 2;
						}
					}
				}
			}

			return array(
				'title' => $title,
				'body'  => $body,
			);
		}

		/**
		 * @return string
		 */
		private static function generate_id() {
			return substr( md5( uniqid( (string) wp_rand(), true ) ), 0, 7 );
		}

		/**
		 * Save converted document as an Elementor library template.
		 *
		 * @param array  $document
		 * @param string $title
		 * @return int|\WP_Error Template post ID.
		 */
		public static function save_as_template( array $document, $title = '' ) {
			if ( ! class_exists( '\Elementor\Plugin' ) ) {
				return new \WP_Error( 'elementor', __( 'Elementor is not active.', 'elemental-addons' ) );
			}

			$title = $title ? $title : ( ! empty( $document['title'] ) ? $document['title'] : 'Converted Layout' );

			$post_id = wp_insert_post(
				array(
					'post_title'  => sanitize_text_field( $title ),
					'post_status' => 'publish',
					'post_type'   => 'elementor_library',
				),
				true
			);

			if ( is_wp_error( $post_id ) ) {
				return $post_id;
			}

			$content = isset( $document['content'] ) ? $document['content'] : array();
			update_post_meta( $post_id, '_elementor_data', wp_slash( wp_json_encode( $content ) ) );
			update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
			update_post_meta( $post_id, '_elementor_template_type', ! empty( $document['type'] ) ? $document['type'] : 'page' );
			update_post_meta( $post_id, '_elementor_version', defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : '3.0.0' );

			if ( ! empty( $document['page_settings'] ) && is_array( $document['page_settings'] ) ) {
				update_post_meta( $post_id, '_elementor_page_settings', $document['page_settings'] );
			}

			return (int) $post_id;
		}
	}
}
