<?php
/**
 * Standalone shims. This plugin does not read theme options.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'elemental_addons_theme_installed' ) ) {
	/**
	 * Theme companion checks stay off. Widgets use their own controls.
	 *
	 * @return bool
	 */
	function elemental_addons_theme_installed() {
		return false;
	}
}

if ( ! function_exists( 'elemental_addons_theme_active' ) ) {
	/**
	 * @return bool
	 */
	function elemental_addons_theme_active() {
		return false;
	}
}
