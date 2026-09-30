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
		 * Widget folders and class names.
		 *
		 * @return array
		 */
		private function widgets() {
			return array(
				'widgets/team-block'             => '\ElementalAddons\Widgets\TeamBlock\TM_Elementor_TeamBlock',
				'widgets/testimonial-block'      => '\ElementalAddons\Widgets\TestimonialBlock\TM_Elementor_TestimonialBlock',
				'widgets/service-block'          => '\ElementalAddons\Widgets\ServiceBlock\TM_Elementor_ServiceBlock',
				'widgets/pricing-block'          => '\ElementalAddons\Widgets\PricingBlock\TM_Elementor_PricingBlock',
				'widgets/image-gallery'          => '\ElementalAddons\Widgets\ImageGallery\TM_Elementor_Image_Gallery',
				'widgets/features-block'         => '\ElementalAddons\Widgets\FeaturesBlock\TM_Elementor_FeaturesBlock',
				'widgets/counter-block'          => '\ElementalAddons\Widgets\CounterBlock\TM_Elementor_CounterBlock',
				'widgets-core/accordion'         => '\ElementalAddons\Widgets\Accordion\TM_Elementor_Accordion',
				'widgets-core/animated-layers'   => '\ElementalAddons\Widgets\TM_Elementor_Animated_Layers',
				'widgets-core/clients-logo'      => '\ElementalAddons\Widgets\TM_Elementor_Clients_logo',
				'widgets-core/contact-form-7'    => '\ElementalAddons\Widgets\TM_Elementor_Contact_Form_7',
				'widgets-core/floating-objects'  => '\ElementalAddons\Widgets\TM_Elementor_Floating_Objects',
				'widgets-core/funfact-counter'   => '\ElementalAddons\Widgets\TM_Elementor_Funfact_Counter',
				'widgets-core/progress-bar'      => '\ElementalAddons\Widgets\TM_Elementor_Progress_Bar',
				'widgets-core/section-title'     => '\ElementalAddons\Widgets\TM_Elementor_Section_Title',
			);
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
				'elemental-addons',
				ELEMENTAL_ADDONS_ASSETS_URI . '/css/elementor-mascot.css',
				array( 'elemental-addons-base' ),
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

			wp_register_script( 'lightgallery', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/lightgallery/js/lightgallery.min.js', array( 'jquery' ), '1.6.10', true );
			wp_register_style( 'lightgallery', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/lightgallery/css/lightgallery.min.css', array(), '1.6.10' );
			wp_register_script( 'jquery-mousewheel', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.mousewheel.min.js', array( 'jquery' ), '3.1.13', true );
			wp_register_script( 'mediko-custom-lightgallery', ELEMENTAL_ADDONS_ASSETS_URI . '/js/custom-lightgallery.js', array( 'jquery', 'lightgallery' ), $ver, true );
			wp_register_script( 'matchHeight', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.matchHeight-min.js', array( 'jquery' ), '0.7.2', true );
			wp_register_script( 'jquery-parallax-scroll', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.parallax-scroll.js', array( 'jquery' ), $ver, true );

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
