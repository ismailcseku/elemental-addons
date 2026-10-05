<?php
/**
 * Plugin Name:       Elemental Addons for Elementor
 * Plugin URI:        https://wordpress.org/plugins/elemental-addons/
 * Description:       Extra Elementor widgets for teams, services, pricing, galleries, testimonials, counters, and section titles.
 * Version:           1.0.0
 * Requires at least: 6.2
 * Requires PHP:      7.4
 * Author:            KodeSolution
 * Author URI:        https://kodesolution.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       elemental-addons
 * Domain Path:       /languages
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ELEMENTAL_ADDONS_VERSION', '1.0.0' );
define( 'ELEMENTAL_ADDONS_FILE', __FILE__ );
define( 'ELEMENTAL_ADDONS_ABS_PATH', plugin_dir_path( __FILE__ ) );
define( 'ELEMENTAL_ADDONS_URI', plugin_dir_url( __FILE__ ) );
define( 'ELEMENTAL_ADDONS_ASSETS_URI', ELEMENTAL_ADDONS_URI . 'assets' );

/**
 * Show an admin notice when Elementor is not active.
 */
function elemental_addons_missing_elementor_notice() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	echo '<div class="notice notice-warning"><p>';
	echo esc_html__( 'Elemental Addons for Elementor requires Elementor to be installed and active.', 'elemental-addons' );
	echo '</p></div>';
}

/**
 * Bootstrap after Elementor is available.
 */
function elemental_addons_init() {
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/compat.php';
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/security.php';
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/template-loader.php';
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/helpers.php';
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/controls.php';
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/blog-compat.php';
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/class-plugin.php';

	Elemental_Addons_Plugin::instance();
}
add_action( 'elementor/loaded', 'elemental_addons_init' );

/**
 * Always load the widgets manager (needed for Elementor registration).
 * Admin UI pages load only in wp-admin.
 */
function elemental_addons_admin_init() {
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/security.php';
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/widgets-manager/class-widgets-manager.php';
	elemental_addons_widgets_manager();

	if ( ! is_admin() ) {
		return;
	}

	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/admin/class-admin.php';
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/class-layout-converter.php';
	require_once ELEMENTAL_ADDONS_ABS_PATH . 'includes/admin/class-converter-page.php';

	Elemental_Addons_Admin::instance();
	Elemental_Addons_Converter_Page::init();
}
add_action( 'plugins_loaded', 'elemental_addons_admin_init' );

/**
 * Notice only when Elementor never loaded.
 */
function elemental_addons_maybe_missing_elementor_notice() {
	if ( did_action( 'elementor/loaded' ) ) {
		return;
	}
	elemental_addons_missing_elementor_notice();
}
add_action( 'admin_notices', 'elemental_addons_maybe_missing_elementor_notice' );
