<?php
/**
 * Registers a curated Lucide icon subset as "Elemental Icons" in Elementor.
 *
 * License: Lucide icons are ISC — GPL-compatible for wordpress.org.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Elemental_Addons_Icons' ) ) {

	class Elemental_Addons_Icons {

		const LIBRARY = 'elemental-icons';
		const VER     = '1.1.0';

		public static function init() {
			add_filter( 'elementor/icons_manager/additional_tabs', array( __CLASS__, 'register_tab' ) );
		}

		/**
		 * @param array $tabs Existing icon tabs.
		 * @return array
		 */
		public static function register_tab( $tabs ) {
			$tabs[ self::LIBRARY ] = array(
				'name'          => self::LIBRARY,
				'label'         => esc_html__( 'Elemental Icons', 'elemental-addons' ),
				'url'           => ELEMENTAL_ADDONS_ASSETS_URI . '/css/elemental-icons.css',
				'enqueue'       => array( ELEMENTAL_ADDONS_ASSETS_URI . '/css/elemental-icons.css' ),
				'prefix'        => 'ei-',
				'displayPrefix' => 'ei',
				'labelIcon'     => 'ei ei-star',
				'ver'           => self::VER,
				'fetchJson'     => ELEMENTAL_ADDONS_ASSETS_URI . '/icons/elemental-icons.js',
				'native'        => true,
			);

			return $tabs;
		}
	}
}
