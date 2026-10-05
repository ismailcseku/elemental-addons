<?php
/**
 * Top-level admin menu, About page, and admin bootstrapping.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Elemental_Addons_Admin' ) ) {

	class Elemental_Addons_Admin {

		const MENU_SLUG = 'elemental-addons';

		/**
		 * @var self|null
		 */
		private static $instance = null;

		/**
		 * @return self
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		public function __construct() {
			add_action( 'admin_menu', array( $this, 'register_menu' ), 9 );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_about_assets' ) );
		}

		public function register_menu() {
			add_menu_page(
				esc_html__( 'Elemental Addons', 'elemental-addons' ),
				esc_html__( 'Elemental Addons', 'elemental-addons' ),
				'manage_options',
				self::MENU_SLUG,
				array( $this, 'render_about_page' ),
				'dashicons-screenoptions',
				58
			);

			add_submenu_page(
				self::MENU_SLUG,
				esc_html__( 'About', 'elemental-addons' ),
				esc_html__( 'About', 'elemental-addons' ),
				'manage_options',
				self::MENU_SLUG,
				array( $this, 'render_about_page' )
			);
		}

		/**
		 * @param string $hook_suffix Current admin page.
		 */
		public function enqueue_about_assets( $hook_suffix ) {
			if ( empty( $_GET['page'] ) || self::MENU_SLUG !== $_GET['page'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				return;
			}

			wp_enqueue_style(
				'elemental-addons-admin-about',
				ELEMENTAL_ADDONS_ASSETS_URI . '/css/admin-about.css',
				array(),
				ELEMENTAL_ADDONS_VERSION
			);
		}

		public function render_about_page() {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You are not allowed to access this page.', 'elemental-addons' ) );
			}

			$counts          = function_exists( 'elemental_addons_widgets_manager' ) ? elemental_addons_widgets_manager()->get_counts() : array( 'total' => 0, 'enabled' => 0 );
			$widgets_url     = admin_url( 'admin.php?page=' . Elemental_Addons_Widgets_Manager::PAGE_SLUG );
			$converter_url   = admin_url( 'admin.php?page=' . Elemental_Addons_Converter_Page::SLUG );
			$elementor_ok    = did_action( 'elementor/loaded' );
			?>
			<div class="wrap elemental-about">
				<div class="elemental-about__hero">
					<div>
						<p class="elemental-about__eyebrow"><?php esc_html_e( 'Elementor Addon', 'elemental-addons' ); ?></p>
						<h1><?php esc_html_e( 'Elemental Addons for Elementor', 'elemental-addons' ); ?></h1>
						<p class="elemental-about__lead">
							<?php esc_html_e( 'Extra Elementor widgets for teams, services, pricing, galleries, testimonials, counters, and more. Works with any theme, including Hello Elementor.', 'elemental-addons' ); ?>
						</p>
						<p class="elemental-about__meta">
							<span><?php echo esc_html( sprintf( __( 'Version %s', 'elemental-addons' ), ELEMENTAL_ADDONS_VERSION ) ); ?></span>
							<span><?php echo esc_html( sprintf( __( '%1$d of %2$d widgets enabled', 'elemental-addons' ), (int) $counts['enabled'], (int) $counts['total'] ) ); ?></span>
							<span><?php echo $elementor_ok ? esc_html__( 'Elementor: Active', 'elemental-addons' ) : esc_html__( 'Elementor: Not detected', 'elemental-addons' ); ?></span>
						</p>
					</div>
				</div>

				<div class="elemental-about__grid">
					<div class="elemental-about__card">
						<h2><?php esc_html_e( 'Widgets Manager', 'elemental-addons' ); ?></h2>
						<p><?php esc_html_e( 'Enable or disable individual widgets. Disabled widgets are not loaded in the Elementor editor.', 'elemental-addons' ); ?></p>
						<p><a class="button button-primary" href="<?php echo esc_url( $widgets_url ); ?>"><?php esc_html_e( 'Manage Widgets', 'elemental-addons' ); ?></a></p>
					</div>

					<div class="elemental-about__card">
						<h2><?php esc_html_e( 'Layout Converter', 'elemental-addons' ); ?></h2>
						<p><?php esc_html_e( 'Convert Elementor JSON layouts so unsupported widgets become placeholders and supported widgets stay intact.', 'elemental-addons' ); ?></p>
						<p><a class="button" href="<?php echo esc_url( $converter_url ); ?>"><?php esc_html_e( 'Open Converter', 'elemental-addons' ); ?></a></p>
					</div>

					<div class="elemental-about__card">
						<h2><?php esc_html_e( 'Getting Started', 'elemental-addons' ); ?></h2>
						<ol>
							<li><?php esc_html_e( 'Make sure Elementor is installed and active.', 'elemental-addons' ); ?></li>
							<li><?php esc_html_e( 'Edit a page with Elementor.', 'elemental-addons' ); ?></li>
							<li><?php esc_html_e( 'Open the “Elemental Addons” category in the widget panel.', 'elemental-addons' ); ?></li>
						</ol>
					</div>

					<div class="elemental-about__card">
						<h2><?php esc_html_e( 'Plugin Info', 'elemental-addons' ); ?></h2>
						<ul class="elemental-about__list">
							<li><strong><?php esc_html_e( 'Author:', 'elemental-addons' ); ?></strong> KodeSolution</li>
							<li><strong><?php esc_html_e( 'Requires:', 'elemental-addons' ); ?></strong> WordPress 6.2+, PHP 7.4+, Elementor</li>
							<li><strong><?php esc_html_e( 'License:', 'elemental-addons' ); ?></strong> GPL-2.0-or-later</li>
							<li><strong><?php esc_html_e( 'Text Domain:', 'elemental-addons' ); ?></strong> elemental-addons</li>
						</ul>
						<p>
							<a href="https://wordpress.org/plugins/elemental-addons/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'WordPress.org page', 'elemental-addons' ); ?></a>
							&nbsp;·&nbsp;
							<a href="https://kodesolution.com" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Author site', 'elemental-addons' ); ?></a>
						</p>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
