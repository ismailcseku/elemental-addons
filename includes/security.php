<?php
/**
 * Security helpers for escaped output and allowed HTML.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'elemental_addons_allowed_html' ) ) {
	/**
	 * Allowed HTML for widget markup (extends post context).
	 *
	 * @return array
	 */
	function elemental_addons_allowed_html() {
		$allowed = wp_kses_allowed_html( 'post' );

		$extra_tags = array(
			'iframe' => array(
				'src'             => true,
				'width'           => true,
				'height'          => true,
				'frameborder'     => true,
				'allow'           => true,
				'allowfullscreen' => true,
				'loading'         => true,
				'title'           => true,
				'class'           => true,
				'id'              => true,
				'style'           => true,
			),
			'svg'    => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true,
				'fill'            => true,
				'stroke'          => true,
				'style'           => true,
			),
			'path'   => array(
				'd'            => true,
				'fill'         => true,
				'stroke'       => true,
				'stroke-width' => true,
				'class'        => true,
			),
			'use'    => array(
				'href'       => true,
				'xlink:href' => true,
				'class'      => true,
			),
		);

		foreach ( $extra_tags as $tag => $attrs ) {
			if ( ! isset( $allowed[ $tag ] ) ) {
				$allowed[ $tag ] = array();
			}
			$allowed[ $tag ] = array_merge( $allowed[ $tag ], $attrs );
		}

		// Common interactive / layout attributes used by Elementor widgets.
		$global_attrs = array(
			'class'          => true,
			'id'             => true,
			'style'          => true,
			'role'           => true,
			'title'          => true,
			'aria-label'     => true,
			'aria-hidden'    => true,
			'aria-expanded'  => true,
			'aria-controls'  => true,
			'tabindex'       => true,
			'data-*'         => true,
			'target'         => true,
			'rel'            => true,
			'download'       => true,
			'type'           => true,
			'name'           => true,
			'value'          => true,
			'placeholder'    => true,
			'checked'        => true,
			'selected'       => true,
			'disabled'       => true,
			'readonly'       => true,
			'required'       => true,
			'autocomplete'   => true,
			'for'            => true,
			'action'         => true,
			'method'         => true,
			'enctype'        => true,
			'novalidate'     => true,
			'width'          => true,
			'height'         => true,
			'loading'        => true,
			'decoding'       => true,
			'sizes'          => true,
			'srcset'         => true,
			'alt'            => true,
			'src'            => true,
			'href'           => true,
			'datetime'       => true,
			'colspan'        => true,
			'rowspan'        => true,
		);

		foreach ( $allowed as $tag => $attrs ) {
			if ( ! is_array( $attrs ) ) {
				$attrs = array();
			}
			$allowed[ $tag ] = array_merge( $attrs, $global_attrs );
		}

		/**
		 * Filter allowed HTML tags/attributes for Elemental Addons widget output.
		 *
		 * @param array $allowed Allowed HTML.
		 */
		return apply_filters( 'elemental_addons_allowed_html', $allowed );
	}
}

if ( ! function_exists( 'elemental_addons_kses' ) ) {
	/**
	 * Sanitize HTML for safe echo.
	 *
	 * @param string $html Raw HTML.
	 * @return string
	 */
	function elemental_addons_kses( $html ) {
		if ( null === $html || false === $html ) {
			return '';
		}
		return wp_kses( (string) $html, elemental_addons_allowed_html() );
	}
}

if ( ! function_exists( 'elemental_addons_print_html' ) ) {
	/**
	 * Echo sanitized HTML.
	 *
	 * @param string $html Raw HTML.
	 */
	function elemental_addons_print_html( $html ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped via elemental_addons_kses().
		echo elemental_addons_kses( $html );
	}
}
