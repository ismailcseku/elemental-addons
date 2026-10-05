<?php
/**
 * Registers Elemental Addons widgets with Elementor.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Elemental_Addons_Plugin' ) ) {

	class Elemental_Addons_Plugin {

		/**
		 * @var self|null
		 */
		private static $instance = null;

		/**
		 * Widget folders and class names (respects Widgets Manager enable/disable).
		 *
		 * @return array
		 */
		private function widgets() {
			if ( function_exists( 'elemental_addons_widgets_manager' ) ) {
				return elemental_addons_widgets_manager()->get_enabled_widget_map();
			}

			// Fallback if manager is not loaded yet.
			$map = array();
			$registry = include ELEMENTAL_ADDONS_ABS_PATH . 'includes/widgets-manager/widgets-registry.php';
			if ( ! is_array( $registry ) ) {
				return $map;
			}
			foreach ( $registry as $group ) {
				if ( empty( $group['widgets'] ) || ! is_array( $group['widgets'] ) ) {
					continue;
				}
				foreach ( $group['widgets'] as $widget ) {
					if ( empty( $widget['folder'] ) || empty( $widget['class'] ) ) {
						continue;
					}
					$map[ $widget['folder'] ] = $widget['class'];
				}
			}
			return $map;
		}

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
			add_action( 'init', array( $this, 'load_textdomain' ) );
			add_action( 'elementor/elements/categories_registered', array( $this, 'register_category' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ), 5 );
			add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'register_assets' ) );
			add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'register_assets' ) );
			add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		}

		public function load_textdomain() {
			load_plugin_textdomain( 'elemental-addons', false, dirname( plugin_basename( ELEMENTAL_ADDONS_FILE ) ) . '/languages' );
		}

		/**
		 * @param \Elementor\Elements_Manager $elements_manager Element manager.
		 */
		public function register_category( $elements_manager ) {
			$elements_manager->add_category(
				'elemental-addons',
				array(
					'title' => esc_html__( 'Elemental Addons', 'elemental-addons' ),
					'icon'  => 'fa fa-plug',
				)
			);
		}

		/**
		 * Register shared styles and scripts. Do not enqueue them on every page.
		 */
		public function register_assets() {
			$ver = ELEMENTAL_ADDONS_VERSION;

			wp_register_style(
				'elemental-addons-base',
				ELEMENTAL_ADDONS_ASSETS_URI . '/css/base.css',
				array(),
				$ver
			);
			wp_register_style(
				'elemental-addons-isotope',
				ELEMENTAL_ADDONS_ASSETS_URI . '/css/isotope-layout.css',
				array(),
				$ver
			);
			wp_register_style(
				'elemental-addons',
				ELEMENTAL_ADDONS_ASSETS_URI . '/css/elementor-mascot.css',
				array( 'elemental-addons-base', 'elemental-addons-isotope' ),
				$ver
			);

			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_register_style(
				'elemental-addons-widgets',
				ELEMENTAL_ADDONS_ASSETS_URI . '/css/widgets-core/mascot-core-widgets-style' . $direction_suffix . '.css',
				array( 'elemental-addons' ),
				$ver
			);

			wp_register_script(
				'elemental-addons-js',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/elementor-mascot.js',
				array( 'jquery' ),
				$ver,
				true
			);
			elemental_addons_set_admin_ajax_url();

			if ( ! wp_script_is( 'swiper', 'registered' ) && file_exists( ELEMENTAL_ADDONS_ABS_PATH . 'assets/js/plugins/swiper/swiper.min.js' ) ) {
				wp_register_script( 'swiper', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/swiper/swiper.min.js', array( 'jquery' ), '8.4.7', true );
				wp_register_style( 'swiper', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/swiper/swiper.min.css', array(), '8.4.7' );
			}

			if ( ! wp_script_is( 'isotope', 'registered' ) ) {
				wp_register_script( 'isotope', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/isotope/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
			}
			wp_register_script(
				'elemental-addons-isotope',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/isotope-init.js',
				array( 'jquery', 'imagesloaded', 'isotope' ),
				$ver,
				true
			);

			wp_register_script( 'lightgallery', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/lightgallery/js/lightgallery.min.js', array( 'jquery' ), '1.6.10', true );
			wp_register_style( 'lightgallery', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/lightgallery/css/lightgallery.min.css', array(), '1.6.10' );
			wp_register_script( 'jquery-mousewheel', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.mousewheel.min.js', array( 'jquery' ), '3.1.13', true );
			wp_register_script( 'mediko-custom-lightgallery', ELEMENTAL_ADDONS_ASSETS_URI . '/js/custom-lightgallery.js', array( 'jquery', 'lightgallery' ), $ver, true );
			wp_register_script( 'matchHeight', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.matchHeight-min.js', array( 'jquery' ), '0.7.2', true );
			wp_register_script( 'jquery-parallax-scroll', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.parallax-scroll.js', array( 'jquery' ), $ver, true );

			wp_register_script(
				'jquery-appear',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.appear.js',
				array( 'jquery' ),
				'0.3.6',
				true
			);
			wp_register_script(
				'jquery-animatenumbers',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.animatenumbers.min.js',
				array( 'jquery' ),
				$ver,
				true
			);
			wp_register_script(
				'jquery-countto',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.countto.js',
				array( 'jquery' ),
				$ver,
				true
			);
			wp_register_script(
				'funfact-animate-number',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/funfact-animate-number.js',
				array( 'jquery', 'jquery-appear', 'jquery-animatenumbers' ),
				$ver,
				true
			);
			wp_register_script(
				'tm-progress-bar',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/progress-bar.js',
				array( 'jquery', 'jquery-countto' ),
				$ver,
				true
			);

			wp_register_script(
				'elemental-addons-swiper-init',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/swiper-init.js',
				array( 'jquery', 'swiper' ),
				$ver,
				true
			);

			wp_enqueue_style( 'elemental-addons-widgets' );
		}

		/**
		 * @param \Elementor\Widgets_Manager $widgets_manager Widgets manager.
		 */
		public function register_widgets( $widgets_manager ) {
			foreach ( $this->widgets() as $folder => $class_name ) {
				$widget_file = ELEMENTAL_ADDONS_ABS_PATH . $folder . '/widget.php';

				if ( ! file_exists( $widget_file ) ) {
					continue;
				}

				require_once $widget_file;

				foreach ( glob( ELEMENTAL_ADDONS_ABS_PATH . $folder . '/skins/*.php' ) as $skin_file ) {
					require_once $skin_file;
				}

				if ( class_exists( $class_name ) ) {
					$widgets_manager->register( new $class_name() );
				}
			}
		}
	}
}
