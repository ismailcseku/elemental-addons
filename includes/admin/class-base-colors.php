<?php
/**
 * Admin: Base default theme colors (--theme-color1…4).
 * Each color can use a custom hex or an Elementor Global Color.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Elemental_Addons_Base_Colors' ) ) {

	class Elemental_Addons_Base_Colors {

		const SLUG         = 'elemental-addons-base-colors';
		const OPTION_KEY   = 'elemental_addons_base_colors';
		const NONCE_ACTION = 'elemental_addons_save_base_colors';

		/**
		 * @return array<string,string>
		 */
		public static function defaults() {
			return array(
				'color1' => '#1b6bff',
				'color2' => '#111827',
				'color3' => '#0f766e',
				'color4' => '#f59e0b',
			);
		}

		/**
		 * Default per-slot settings (custom hex).
		 *
		 * @return array<string,array{source:string,global_id:string,hex:string}>
		 */
		public static function default_settings() {
			$out = array();
			foreach ( self::defaults() as $key => $hex ) {
				$out[ $key ] = array(
					'source'    => 'custom',
					'global_id' => '',
					'hex'       => $hex,
				);
			}
			return $out;
		}

		/**
		 * @param mixed  $raw          Saved value (legacy string or array).
		 * @param string $fallback_hex Default hex.
		 * @return array{source:string,global_id:string,hex:string}
		 */
		public static function normalize_entry( $raw, $fallback_hex ) {
			$fallback_hex = self::sanitize_hex( $fallback_hex, '#000000' );

			if ( is_string( $raw ) ) {
				return array(
					'source'    => 'custom',
					'global_id' => '',
					'hex'       => self::sanitize_hex( $raw, $fallback_hex ),
				);
			}

			if ( ! is_array( $raw ) ) {
				return array(
					'source'    => 'custom',
					'global_id' => '',
					'hex'       => $fallback_hex,
				);
			}

			$source = isset( $raw['source'] ) ? sanitize_key( $raw['source'] ) : 'custom';
			if ( ! in_array( $source, array( 'custom', 'global' ), true ) ) {
				$source = 'custom';
			}

			$global_id = isset( $raw['global_id'] ) ? self::sanitize_global_id( $raw['global_id'] ) : '';
			$hex       = self::sanitize_hex( isset( $raw['hex'] ) ? $raw['hex'] : $fallback_hex, $fallback_hex );

			// Legacy keys: color1 stored as plain hex under same option shape.
			if ( empty( $raw['source'] ) && empty( $raw['hex'] ) && isset( $raw[0] ) ) {
				$hex = self::sanitize_hex( $raw[0], $fallback_hex );
			}

			return array(
				'source'    => $source,
				'global_id' => $global_id,
				'hex'       => $hex,
			);
		}

		/**
		 * @param string $id Global color _id.
		 * @return string
		 */
		public static function sanitize_global_id( $id ) {
			$id = is_string( $id ) ? trim( $id ) : '';
			if ( '' === $id ) {
				return '';
			}
			$id = preg_replace( '/[^A-Za-z0-9_-]/', '', $id );
			return is_string( $id ) ? $id : '';
		}

		/**
		 * Full settings for all four slots.
		 *
		 * @return array<string,array{source:string,global_id:string,hex:string}>
		 */
		public static function get_settings() {
			$saved    = get_option( self::OPTION_KEY, array() );
			$defaults = self::default_settings();
			$out      = array();

			if ( ! is_array( $saved ) ) {
				$saved = array();
			}

			foreach ( $defaults as $key => $default_entry ) {
				$raw = array_key_exists( $key, $saved ) ? $saved[ $key ] : $default_entry;
				$out[ $key ] = self::normalize_entry( $raw, $default_entry['hex'] );
			}

			return $out;
		}

		/**
		 * Resolved hex map (for code that only needs colors).
		 *
		 * @return array<string,string>
		 */
		public static function get_colors() {
			$settings = self::get_settings();
			$out      = array();
			foreach ( $settings as $key => $entry ) {
				$out[ $key ] = self::resolve_hex( $entry );
			}
			return $out;
		}

		/**
		 * @param array{source:string,global_id:string,hex:string} $entry Slot settings.
		 * @return string
		 */
		public static function resolve_hex( $entry ) {
			$entry = self::normalize_entry( $entry, '#000000' );
			if ( 'global' === $entry['source'] && $entry['global_id'] ) {
				$globals = self::get_elementor_global_colors();
				if ( isset( $globals[ $entry['global_id'] ]['color'] ) ) {
					return self::sanitize_hex( $globals[ $entry['global_id'] ]['color'], $entry['hex'] );
				}
			}
			return $entry['hex'];
		}

		/**
		 * Elementor kit system + custom colors, keyed by _id.
		 *
		 * @return array<string,array{id:string,title:string,color:string}>
		 */
		public static function get_elementor_global_colors() {
			static $cache = null;
			if ( null !== $cache ) {
				return $cache;
			}

			$cache = array();

			if ( ! did_action( 'elementor/loaded' ) && ! class_exists( '\Elementor\Plugin' ) ) {
				return $cache;
			}

			try {
				if ( ! isset( \Elementor\Plugin::$instance->kits_manager ) ) {
					return $cache;
				}
				$kits_manager = \Elementor\Plugin::$instance->kits_manager;
				$kit          = null;
				if ( method_exists( $kits_manager, 'get_active_kit' ) ) {
					$kit = $kits_manager->get_active_kit();
				}
				if ( ( ! $kit || ( method_exists( $kit, 'get_id' ) && ! $kit->get_id() ) ) && method_exists( $kits_manager, 'get_active_kit_for_frontend' ) ) {
					$kit = $kits_manager->get_active_kit_for_frontend();
				}
				if ( ! $kit ) {
					return $cache;
				}

				$system = method_exists( $kit, 'get_settings_for_display' )
					? $kit->get_settings_for_display( 'system_colors' )
					: $kit->get_settings( 'system_colors' );
				$custom = method_exists( $kit, 'get_settings_for_display' )
					? $kit->get_settings_for_display( 'custom_colors' )
					: $kit->get_settings( 'custom_colors' );

				foreach ( array( $system, $custom ) as $group ) {
					if ( ! is_array( $group ) ) {
						continue;
					}
					foreach ( $group as $item ) {
						if ( empty( $item['_id'] ) ) {
							continue;
						}
						$id = self::sanitize_global_id( $item['_id'] );
						if ( '' === $id ) {
							continue;
						}
						$cache[ $id ] = array(
							'id'    => $id,
							'title' => isset( $item['title'] ) ? (string) $item['title'] : $id,
							'color' => self::sanitize_hex( isset( $item['color'] ) ? $item['color'] : '#000000', '#000000' ),
						);
					}
				}
			} catch ( \Throwable $e ) { // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
				$cache = array();
			}

			return $cache;
		}

		/**
		 * @param string $hex     Color value.
		 * @param string $fallback Fallback hex.
		 * @return string
		 */
		public static function sanitize_hex( $hex, $fallback = '#000000' ) {
			$hex = is_string( $hex ) ? trim( $hex ) : '';
			if ( preg_match( '/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/', $hex ) ) {
				if ( 4 === strlen( $hex ) ) {
					$hex = '#' . $hex[1] . $hex[1] . $hex[2] . $hex[2] . $hex[3] . $hex[3];
				}
				return strtolower( $hex );
			}
			return strtolower( $fallback );
		}

		/**
		 * @param string $hex Hex color.
		 * @return string "r, g, b"
		 */
		public static function hex_to_rgb_channels( $hex ) {
			$hex = ltrim( self::sanitize_hex( $hex ), '#' );
			if ( 3 === strlen( $hex ) ) {
				$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
			}
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
			return $r . ', ' . $g . ', ' . $b;
		}

		/**
		 * @param string $hex Background hex.
		 * @return string
		 */
		public static function contrast_text( $hex ) {
			$hex = ltrim( self::sanitize_hex( $hex ), '#' );
			$r   = hexdec( substr( $hex, 0, 2 ) );
			$g   = hexdec( substr( $hex, 2, 2 ) );
			$b   = hexdec( substr( $hex, 4, 2 ) );
			$luma = ( 0.299 * $r + 0.587 * $g + 0.114 * $b );
			return ( $luma > 186 ) ? '#111827' : '#ffffff';
		}

		/**
		 * CSS custom properties block.
		 *
		 * @return string
		 */
		public static function css_variables() {
			$settings = self::get_settings();
			$lines    = array( ':root{' );

			foreach ( $settings as $key => $entry ) {
				$n          = substr( $key, -1 ); // 1..4
				$resolved   = self::resolve_hex( $entry );
				$css_value  = $resolved;

				if ( 'global' === $entry['source'] && $entry['global_id'] ) {
					// Stay linked to Elementor globals when present.
					$css_value = 'var(--e-global-color-' . $entry['global_id'] . ', ' . $resolved . ')';
				}

				$lines[] = '--theme-color' . $n . ':' . $css_value . ';';
				$lines[] = '--theme-color' . $n . '-rgb:' . self::hex_to_rgb_channels( $resolved ) . ';';
				$lines[] = '--theme-color' . $n . '-text-color:' . self::contrast_text( $resolved ) . ';';
				$lines[] = '--text-color-bg-theme-color' . $n . ':' . self::contrast_text( $resolved ) . ';';
			}

			$lines[] = '}';
			return implode( '', $lines );
		}

		public static function init() {
			add_action( 'admin_menu', array( __CLASS__, 'register_menu' ), 12 );
			add_action( 'admin_init', array( __CLASS__, 'handle_save' ) );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin' ) );
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_front_vars' ), 20 );
			add_action( 'elementor/editor/after_enqueue_styles', array( __CLASS__, 'enqueue_front_vars' ) );
			add_action( 'elementor/frontend/after_enqueue_styles', array( __CLASS__, 'enqueue_front_vars' ) );
			add_action( 'elementor/preview/enqueue_styles', array( __CLASS__, 'enqueue_front_vars' ) );
		}

		public static function register_menu() {
			if ( ! class_exists( 'Elemental_Addons_Admin' ) ) {
				return;
			}
			add_submenu_page(
				Elemental_Addons_Admin::MENU_SLUG,
				esc_html__( 'Base default colors', 'elemental-addons' ),
				esc_html__( 'Base default colors', 'elemental-addons' ),
				'manage_options',
				self::SLUG,
				array( __CLASS__, 'render_page' )
			);
		}

		/**
		 * @param string $hook_suffix Admin hook.
		 */
		public static function enqueue_admin( $hook_suffix ) {
			if ( empty( $_GET['page'] ) || self::SLUG !== $_GET['page'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				return;
			}
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style(
				'elemental-addons-base-colors-admin',
				ELEMENTAL_ADDONS_ASSETS_URI . '/css/admin-base-colors.css',
				array( 'wp-color-picker' ),
				ELEMENTAL_ADDONS_VERSION
			);
			wp_enqueue_script(
				'elemental-addons-base-colors-admin',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/admin-base-colors.js',
				array( 'jquery', 'wp-color-picker' ),
				ELEMENTAL_ADDONS_VERSION,
				true
			);
		}

		public static function enqueue_front_vars() {
			static $done = false;
			if ( $done ) {
				return;
			}
			$done = true;

			$handle = 'elemental-addons-base-colors-vars';
			if ( ! wp_style_is( $handle, 'registered' ) ) {
				wp_register_style( $handle, false, array(), ELEMENTAL_ADDONS_VERSION );
			}
			wp_enqueue_style( $handle );
			wp_add_inline_style( $handle, self::css_variables() );
		}

		public static function handle_save() {
			if ( empty( $_POST['elemental_addons_base_colors_submit'] ) ) {
				return;
			}
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
			check_admin_referer( self::NONCE_ACTION );

			$defaults = self::default_settings();
			$globals  = self::get_elementor_global_colors();
			$colors   = array();

			foreach ( $defaults as $key => $default_entry ) {
				$source    = isset( $_POST[ $key . '_source' ] ) ? sanitize_key( wp_unslash( $_POST[ $key . '_source' ] ) ) : 'custom'; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				$global_id = isset( $_POST[ $key . '_global_id' ] ) ? self::sanitize_global_id( wp_unslash( $_POST[ $key . '_global_id' ] ) ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				$hex_raw   = isset( $_POST[ $key . '_hex' ] ) ? wp_unslash( $_POST[ $key . '_hex' ] ) : $default_entry['hex']; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

				if ( ! in_array( $source, array( 'custom', 'global' ), true ) ) {
					$source = 'custom';
				}
				if ( 'global' === $source ) {
					if ( '' === $global_id || ! isset( $globals[ $global_id ] ) ) {
						// Fall back to custom if the chosen global is missing.
						$source    = 'custom';
						$global_id = '';
					}
				} else {
					$global_id = '';
				}

				$colors[ $key ] = array(
					'source'    => $source,
					'global_id' => $global_id,
					'hex'       => self::sanitize_hex( $hex_raw, $default_entry['hex'] ),
				);
			}

			update_option( self::OPTION_KEY, $colors, false );

			add_settings_error(
				'elemental_addons_base_colors',
				'elemental_addons_base_colors_saved',
				esc_html__( 'Base default colors saved.', 'elemental-addons' ),
				'success'
			);
		}

		public static function render_page() {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You are not allowed to access this page.', 'elemental-addons' ) );
			}

			$settings = self::get_settings();
			$globals  = self::get_elementor_global_colors();
			$labels   = array(
				'color1' => esc_html__( 'Theme Color 1', 'elemental-addons' ),
				'color2' => esc_html__( 'Theme Color 2', 'elemental-addons' ),
				'color3' => esc_html__( 'Theme Color 3', 'elemental-addons' ),
				'color4' => esc_html__( 'Theme Color 4', 'elemental-addons' ),
			);
			$hints    = array(
				'color1' => esc_html__( 'Primary accent (buttons, social backgrounds, highlights).', 'elemental-addons' ),
				'color2' => esc_html__( 'Secondary / dark accent.', 'elemental-addons' ),
				'color3' => esc_html__( 'Tertiary accent (icons, share, secondary highlights).', 'elemental-addons' ),
				'color4' => esc_html__( 'Quaternary accent.', 'elemental-addons' ),
			);
			?>
			<div class="wrap elemental-base-colors">
				<h1><?php esc_html_e( 'Base default colors', 'elemental-addons' ); ?></h1>
				<p class="elemental-base-colors__intro">
					<?php esc_html_e( 'These colors set the CSS variables used across Elemental Addons skins (--theme-color1 through --theme-color4). Choose an Elementor Global Color to stay in sync with Site Settings, or pick a custom hex.', 'elemental-addons' ); ?>
				</p>

				<?php if ( empty( $globals ) ) : ?>
					<div class="notice notice-warning inline">
						<p><?php esc_html_e( 'Elementor Global Colors were not found. You can still use custom colors. Open Elementor → Site Settings → Global Colors after Elementor is active to link them here.', 'elemental-addons' ); ?></p>
					</div>
				<?php endif; ?>

				<?php settings_errors( 'elemental_addons_base_colors' ); ?>

				<form method="post" action="">
					<?php wp_nonce_field( self::NONCE_ACTION ); ?>
					<div class="elemental-base-colors__grid">
						<?php foreach ( $labels as $key => $label ) : ?>
							<?php
							$entry      = $settings[ $key ];
							$resolved   = self::resolve_hex( $entry );
							$is_global  = ( 'global' === $entry['source'] && $entry['global_id'] );
							$source_val = $is_global ? 'global' : 'custom';
							?>
							<div class="elemental-base-colors__card" data-color-key="<?php echo esc_attr( $key ); ?>">
								<label class="elemental-base-colors__label" for="<?php echo esc_attr( $key ); ?>_source">
									<span class="elemental-base-colors__swatch" style="background:<?php echo esc_attr( $resolved ); ?>" data-swatch></span>
									<span><?php echo esc_html( $label ); ?></span>
								</label>

								<p class="elemental-base-colors__field-label"><?php esc_html_e( 'Color source', 'elemental-addons' ); ?></p>
								<select
									class="elemental-base-colors__source"
									id="<?php echo esc_attr( $key ); ?>_source"
									name="<?php echo esc_attr( $key ); ?>_source"
									data-source-select
								>
									<option value="custom" <?php selected( $source_val, 'custom' ); ?>><?php esc_html_e( 'Custom color', 'elemental-addons' ); ?></option>
									<option value="global" <?php selected( $source_val, 'global' ); ?> <?php disabled( empty( $globals ) ); ?>>
										<?php esc_html_e( 'Elementor Global Color', 'elemental-addons' ); ?>
									</option>
								</select>

								<div class="elemental-base-colors__global-wrap" data-global-wrap <?php echo $is_global ? '' : 'hidden'; ?>>
									<p class="elemental-base-colors__field-label"><?php esc_html_e( 'Global color', 'elemental-addons' ); ?></p>
									<select
										class="elemental-base-colors__global"
										id="<?php echo esc_attr( $key ); ?>_global_id"
										name="<?php echo esc_attr( $key ); ?>_global_id"
										data-global-select
									>
										<option value=""><?php esc_html_e( '— Select —', 'elemental-addons' ); ?></option>
										<?php foreach ( $globals as $g ) : ?>
											<option
												value="<?php echo esc_attr( $g['id'] ); ?>"
												data-color="<?php echo esc_attr( $g['color'] ); ?>"
												<?php selected( $entry['global_id'], $g['id'] ); ?>
											>
												<?php echo esc_html( $g['title'] . ' (' . $g['color'] . ')' ); ?>
											</option>
										<?php endforeach; ?>
									</select>
									<p class="description elemental-base-colors__global-hint">
										<code>--e-global-color-<?php echo $entry['global_id'] ? esc_html( $entry['global_id'] ) : '…'; ?></code>
									</p>
								</div>

								<div class="elemental-base-colors__custom-wrap" data-custom-wrap <?php echo $is_global ? 'hidden' : ''; ?>>
									<p class="elemental-base-colors__field-label"><?php esc_html_e( 'Custom hex', 'elemental-addons' ); ?></p>
									<input
										type="text"
										class="elemental-base-color-field"
										id="<?php echo esc_attr( $key ); ?>_hex"
										name="<?php echo esc_attr( $key ); ?>_hex"
										value="<?php echo esc_attr( $entry['hex'] ); ?>"
										data-default-color="<?php echo esc_attr( self::defaults()[ $key ] ); ?>"
										data-hex-input
									/>
								</div>

								<p class="description"><?php echo esc_html( $hints[ $key ] ); ?></p>
								<p class="elemental-base-colors__var"><code>--theme-<?php echo esc_html( $key ); ?></code></p>
							</div>
						<?php endforeach; ?>
					</div>

					<p class="submit">
						<button type="submit" name="elemental_addons_base_colors_submit" class="button button-primary" value="1">
							<?php esc_html_e( 'Save colors', 'elemental-addons' ); ?>
						</button>
					</p>
				</form>
			</div>
			<?php
		}
	}
}
