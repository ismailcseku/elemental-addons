<?php
/**
 * Central on/off switch for Elementor widgets shipped by this plugin.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Elemental_Addons_Widgets_Manager' ) ) {

	class Elemental_Addons_Widgets_Manager {

		/**
		 * Stores disabled widgets by group. New widgets stay enabled by default.
		 */
		const OPTION_KEY = 'elemental_addons_disabled_widgets';

		const SEEDED_KEY = 'elemental_addons_widgets_defaults_seeded';

		const PAGE_SLUG = 'elemental-addons-widgets';

		const NONCE_ACTION = 'elemental_addons_save_widgets';

		/**
		 * @var self|null
		 */
		private static $instance = null;

		/**
		 * @var array|null
		 */
		private $groups = null;

		/**
		 * @var array|null
		 */
		private $disabled = null;

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
			add_action( 'admin_init', array( $this, 'maybe_seed_defaults' ) );
			add_action( 'admin_menu', array( $this, 'register_admin_page' ), 20 );
			add_action( 'admin_post_' . self::NONCE_ACTION, array( $this, 'handle_save' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		}

		/**
		 * @return array
		 */
		public function get_groups() {
			if ( is_null( $this->groups ) ) {
				$groups = include __DIR__ . '/widgets-registry.php';
				if ( ! is_array( $groups ) ) {
					$groups = array();
				}
				$this->groups = apply_filters( 'elemental_addons_widgets_registry', $groups );
			}
			return $this->groups;
		}

		/**
		 * @param string $group Group key.
		 * @return array
		 */
		public function get_group_widgets( $group ) {
			$groups = $this->get_groups();
			if ( empty( $groups[ $group ]['widgets'] ) || ! is_array( $groups[ $group ]['widgets'] ) ) {
				return array();
			}
			return $groups[ $group ]['widgets'];
		}

		/**
		 * @param string $group Group key.
		 * @param string $slug  Widget slug.
		 * @return bool
		 */
		public function is_recommended( $group, $slug ) {
			$widgets = $this->get_group_widgets( $group );
			if ( ! isset( $widgets[ $slug ] ) ) {
				return false;
			}
			return ! isset( $widgets[ $slug ]['default'] ) || (bool) $widgets[ $slug ]['default'];
		}

		/**
		 * @return array
		 */
		public function get_default_disabled() {
			$disabled = array();
			foreach ( $this->get_groups() as $group => $data ) {
				foreach ( $this->get_group_widgets( $group ) as $slug => $widget ) {
					if ( ! $this->is_recommended( $group, $slug ) ) {
						$disabled[ $group ][] = $slug;
					}
				}
			}
			return $disabled;
		}

		public function maybe_seed_defaults() {
			if ( get_option( self::SEEDED_KEY ) ) {
				return;
			}

			update_option( self::SEEDED_KEY, 1 );

			if ( is_array( get_option( self::OPTION_KEY, null ) ) ) {
				return;
			}

			$disabled = $this->site_has_elementor_content() ? array() : $this->get_default_disabled();
			update_option( self::OPTION_KEY, $disabled );
			$this->disabled = null;
		}

		/**
		 * @return bool
		 */
		private function site_has_elementor_content() {
			global $wpdb;
			return (bool) $wpdb->get_var(
				"SELECT meta_id FROM {$wpdb->postmeta} WHERE meta_key = '_elementor_data' LIMIT 1"
			);
		}

		/**
		 * @return array
		 */
		public function get_disabled() {
			if ( is_null( $this->disabled ) ) {
				$stored = get_option( self::OPTION_KEY, array() );
				if ( ! is_array( $stored ) ) {
					$stored = array();
				}
				$disabled = array();
				foreach ( $stored as $group => $slugs ) {
					$disabled[ $group ] = is_array( $slugs ) ? array_map( 'strval', $slugs ) : array();
				}
				$this->disabled = $disabled;
			}
			return $this->disabled;
		}

		/**
		 * @param string $group Group key.
		 * @param string $slug  Widget slug.
		 * @return bool
		 */
		public function is_enabled( $group, $slug ) {
			$disabled = $this->get_disabled();
			$enabled  = empty( $disabled[ $group ] ) || ! in_array( $slug, $disabled[ $group ], true );
			return (bool) apply_filters( 'elemental_addons_is_widget_enabled', $enabled, $group, $slug );
		}

		/**
		 * Flat list of enabled widgets: folder => class.
		 *
		 * @return array<string,string>
		 */
		public function get_enabled_widget_map() {
			$map = array();
			foreach ( $this->get_groups() as $group => $data ) {
				foreach ( $this->get_group_widgets( $group ) as $slug => $widget ) {
					if ( ! $this->is_enabled( $group, $slug ) ) {
						continue;
					}
					if ( empty( $widget['folder'] ) || empty( $widget['class'] ) ) {
						continue;
					}
					$map[ $widget['folder'] ] = $widget['class'];
				}
			}
			return $map;
		}

		/**
		 * @return array{total:int,enabled:int}
		 */
		public function get_counts() {
			$total   = 0;
			$enabled = 0;
			foreach ( $this->get_groups() as $group => $data ) {
				foreach ( $this->get_group_widgets( $group ) as $slug => $widget ) {
					$total++;
					if ( $this->is_enabled( $group, $slug ) ) {
						$enabled++;
					}
				}
			}
			return array(
				'total'   => $total,
				'enabled' => $enabled,
			);
		}

		public function register_admin_page() {
			add_submenu_page(
				Elemental_Addons_Admin::MENU_SLUG,
				esc_html__( 'Widgets Manager', 'elemental-addons' ),
				esc_html__( 'Widgets Manager', 'elemental-addons' ),
				'manage_options',
				self::PAGE_SLUG,
				array( $this, 'render_admin_page' )
			);
		}

		public function render_admin_page() {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You are not allowed to access this page.', 'elemental-addons' ) );
			}
			$manager = $this;
			include __DIR__ . '/tpl/settings-page.php';
		}

		/**
		 * @param string $hook_suffix Current admin page.
		 */
		public function enqueue_assets( $hook_suffix ) {
			if ( empty( $_GET['page'] ) || self::PAGE_SLUG !== $_GET['page'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				return;
			}

			wp_enqueue_style(
				'elemental-addons-widgets-manager',
				ELEMENTAL_ADDONS_ASSETS_URI . '/css/widgets-manager.css',
				array(),
				ELEMENTAL_ADDONS_VERSION
			);
			wp_enqueue_script(
				'elemental-addons-widgets-manager',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets-manager.js',
				array( 'jquery' ),
				ELEMENTAL_ADDONS_VERSION,
				true
			);
		}

		/**
		 * @return string
		 */
		public function get_page_url() {
			return admin_url( 'admin.php?page=' . self::PAGE_SLUG );
		}

		public function handle_save() {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You are not allowed to change these settings.', 'elemental-addons' ) );
			}

			check_admin_referer( self::NONCE_ACTION );

			$submitted_raw = isset( $_POST['elemental_widgets'] ) ? wp_unslash( $_POST['elemental_widgets'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			$submitted     = array();
			if ( is_array( $submitted_raw ) ) {
				foreach ( $submitted_raw as $group_key => $items ) {
					$group_key = sanitize_key( $group_key );
					if ( ! is_array( $items ) ) {
						continue;
					}
					foreach ( $items as $slug_key => $value ) {
						$submitted[ $group_key ][ sanitize_key( $slug_key ) ] = (string) absint( $value );
					}
				}
			}

			$disabled = array();
			foreach ( $this->get_groups() as $group => $data ) {
				$checked = isset( $submitted[ $group ] ) && is_array( $submitted[ $group ] ) ? $submitted[ $group ] : array();
				foreach ( $this->get_group_widgets( $group ) as $slug => $widget ) {
					if ( empty( $checked[ $slug ] ) ) {
						$disabled[ $group ][] = $slug;
					}
				}
			}

			update_option( self::OPTION_KEY, $disabled );
			$this->disabled = null;
			$this->clear_elementor_cache();

			wp_safe_redirect( add_query_arg( 'elemental-widgets-updated', '1', $this->get_page_url() ) );
			exit;
		}

		private function clear_elementor_cache() {
			if ( ! class_exists( '\Elementor\Plugin' ) ) {
				return;
			}
			$elementor = \Elementor\Plugin::$instance;
			if ( isset( $elementor->files_manager ) && method_exists( $elementor->files_manager, 'clear_cache' ) ) {
				$elementor->files_manager->clear_cache();
			}
		}
	}
}

if ( ! function_exists( 'elemental_addons_widgets_manager' ) ) {
	/**
	 * @return Elemental_Addons_Widgets_Manager
	 */
	function elemental_addons_widgets_manager() {
		return Elemental_Addons_Widgets_Manager::instance();
	}
}
