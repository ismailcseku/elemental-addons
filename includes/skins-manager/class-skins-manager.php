<?php
/**
 * Visual on/off manager for Elementor widget skins.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Elemental_Addons_Skins_Manager' ) ) {

	class Elemental_Addons_Skins_Manager {

		const OPTION_KEY = 'elemental_addons_disabled_skins';

		const SEEDED_KEY = 'elemental_addons_skins_defaults_seeded';

		const PAGE_SLUG = 'elemental-addons-skins';

		const NONCE_ACTION = 'elemental_addons_save_skins';

		/**
		 * @var self|null
		 */
		private static $instance = null;

		/**
		 * @var array|null
		 */
		private $registry = null;

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
			add_action( 'admin_menu', array( $this, 'register_admin_page' ), 21 );
			add_action( 'admin_post_' . self::NONCE_ACTION, array( $this, 'handle_save' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		}

		/**
		 * @return array
		 */
		public function get_registry() {
			if ( is_null( $this->registry ) ) {
				$registry = include __DIR__ . '/skins-registry.php';
				if ( ! is_array( $registry ) ) {
					$registry = array();
				}
				$this->registry = apply_filters( 'elemental_addons_skins_registry', $registry );
			}
			return $this->registry;
		}

		/**
		 * @param string $widget_slug Widget slug.
		 * @return array
		 */
		public function get_widget_skins( $widget_slug ) {
			$registry = $this->get_registry();
			if ( empty( $registry[ $widget_slug ]['skins'] ) || ! is_array( $registry[ $widget_slug ]['skins'] ) ) {
				return array();
			}
			return $registry[ $widget_slug ]['skins'];
		}

		/**
		 * @param string $widget_slug Widget slug.
		 * @param string $skin_id     Skin id.
		 * @return bool
		 */
		public function is_recommended( $widget_slug, $skin_id ) {
			$skins = $this->get_widget_skins( $widget_slug );
			if ( ! isset( $skins[ $skin_id ] ) ) {
				return false;
			}
			return ! isset( $skins[ $skin_id ]['default'] ) || (bool) $skins[ $skin_id ]['default'];
		}

		/**
		 * @return array
		 */
		public function get_default_disabled() {
			$disabled = array();
			foreach ( $this->get_registry() as $widget_slug => $data ) {
				foreach ( $this->get_widget_skins( $widget_slug ) as $skin_id => $skin ) {
					if ( ! $this->is_recommended( $widget_slug, $skin_id ) ) {
						$disabled[ $widget_slug ][] = $skin_id;
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

			update_option( self::OPTION_KEY, $this->get_default_disabled() );
			$this->disabled = null;
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
				foreach ( $stored as $widget_slug => $skin_ids ) {
					$disabled[ sanitize_key( $widget_slug ) ] = is_array( $skin_ids )
						? array_map( 'sanitize_key', $skin_ids )
						: array();
				}
				$this->disabled = $disabled;
			}
			return $this->disabled;
		}

		/**
		 * @param string $widget_slug Widget slug.
		 * @param string $skin_id     Skin id.
		 * @return bool
		 */
		public function is_enabled( $widget_slug, $skin_id ) {
			$disabled = $this->get_disabled();
			$enabled  = empty( $disabled[ $widget_slug ] ) || ! in_array( $skin_id, $disabled[ $widget_slug ], true );
			return (bool) apply_filters( 'elemental_addons_is_skin_enabled', $enabled, $widget_slug, $skin_id );
		}

		/**
		 * @return array{total:int,enabled:int}
		 */
		public function get_counts() {
			$total   = 0;
			$enabled = 0;
			foreach ( $this->get_registry() as $widget_slug => $data ) {
				foreach ( $this->get_widget_skins( $widget_slug ) as $skin_id => $skin ) {
					$total++;
					if ( $this->is_enabled( $widget_slug, $skin_id ) ) {
						$enabled++;
					}
				}
			}
			return array(
				'total'   => $total,
				'enabled' => $enabled,
			);
		}

		/**
		 * Preview URL for a skin card.
		 *
		 * @param string $widget_slug Widget slug.
		 * @param array  $skin        Skin data.
		 * @return string
		 */
		public function get_preview_url( $widget_slug, array $skin ) {
			$candidates = array();
			if ( ! empty( $skin['preview'] ) ) {
				$candidates[] = ltrim( (string) $skin['preview'], '/' );
			}
			$skin_id = ! empty( $skin['id'] ) ? $skin['id'] : '';
			if ( $skin_id ) {
				$candidates[] = 'assets/images/skins/' . $widget_slug . '/' . $skin_id . '.png';
				$candidates[] = 'assets/images/skins/' . $widget_slug . '/' . $skin_id . '.jpg';
				$candidates[] = 'assets/images/skins/' . $widget_slug . '/' . $skin_id . '.svg';
			}

			foreach ( $candidates as $relative ) {
				$absolute = ELEMENTAL_ADDONS_ABS_PATH . $relative;
				if ( file_exists( $absolute ) ) {
					return ELEMENTAL_ADDONS_URI . $relative;
				}
			}

			return '';
		}

		/**
		 * Register enabled skins onto a widget instance.
		 *
		 * @param \Elementor\Widget_Base $widget      Widget.
		 * @param string                 $widget_slug Registry key.
		 */
		public function register_enabled_skins( $widget, $widget_slug ) {
			foreach ( $this->get_widget_skins( $widget_slug ) as $skin_id => $skin ) {
				if ( ! $this->is_enabled( $widget_slug, $skin_id ) ) {
					continue;
				}
				$class = isset( $skin['class'] ) ? $skin['class'] : '';
				if ( ! $class || ! class_exists( $class ) ) {
					continue;
				}
				$widget->add_skin( new $class( $widget ) );
			}
		}

		/**
		 * Require PHP files for enabled skins of a widget folder.
		 *
		 * @param string $folder      Relative folder (widgets/team-block).
		 * @param string $widget_slug Registry key.
		 */
		public function require_enabled_skin_files( $folder, $widget_slug ) {
			foreach ( $this->get_widget_skins( $widget_slug ) as $skin_id => $skin ) {
				if ( ! $this->is_enabled( $widget_slug, $skin_id ) ) {
					continue;
				}
				if ( empty( $skin['file'] ) ) {
					continue;
				}
				$file = ELEMENTAL_ADDONS_ABS_PATH . ltrim( $skin['file'], '/' );
				if ( file_exists( $file ) ) {
					require_once $file;
				}
			}
		}

		/**
		 * Map widget folder path to registry slug.
		 *
		 * @param string $folder Relative folder.
		 * @return string
		 */
		public function folder_to_slug( $folder ) {
			$folder = str_replace( '\\', '/', (string) $folder );
			$folder = trim( $folder, '/' );
			if ( 0 === strpos( $folder, 'widgets/' ) ) {
				return substr( $folder, strlen( 'widgets/' ) );
			}
			if ( 0 === strpos( $folder, 'cpt/' ) ) {
				$parts = explode( '/', $folder );
				return end( $parts );
			}
			return basename( $folder );
		}

		public function register_admin_page() {
			if ( ! class_exists( 'Elemental_Addons_Admin' ) ) {
				return;
			}
			add_submenu_page(
				Elemental_Addons_Admin::MENU_SLUG,
				esc_html__( 'Skins Manager', 'elemental-addons' ),
				esc_html__( 'Skins Manager', 'elemental-addons' ),
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
				'elemental-addons-skins-manager',
				ELEMENTAL_ADDONS_ASSETS_URI . '/css/skins-manager.css',
				array(),
				ELEMENTAL_ADDONS_VERSION
			);
			wp_enqueue_script(
				'elemental-addons-skins-manager',
				ELEMENTAL_ADDONS_ASSETS_URI . '/js/skins-manager.js',
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

			$submitted_raw = isset( $_POST['elemental_skins'] ) ? wp_unslash( $_POST['elemental_skins'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			$submitted     = array();
			if ( is_array( $submitted_raw ) ) {
				foreach ( $submitted_raw as $widget_key => $items ) {
					$widget_key = sanitize_key( $widget_key );
					if ( ! is_array( $items ) ) {
						continue;
					}
					foreach ( $items as $skin_key => $value ) {
						$submitted[ $widget_key ][ sanitize_key( $skin_key ) ] = (string) absint( $value );
					}
				}
			}

			$disabled = array();
			foreach ( $this->get_registry() as $widget_slug => $data ) {
				$checked = isset( $submitted[ $widget_slug ] ) && is_array( $submitted[ $widget_slug ] ) ? $submitted[ $widget_slug ] : array();
				foreach ( $this->get_widget_skins( $widget_slug ) as $skin_id => $skin ) {
					if ( empty( $checked[ $skin_id ] ) ) {
						$disabled[ $widget_slug ][] = $skin_id;
					}
				}
			}

			update_option( self::OPTION_KEY, $disabled );
			$this->disabled = null;
			$this->clear_elementor_cache();

			wp_safe_redirect( add_query_arg( 'elemental-skins-updated', '1', $this->get_page_url() ) );
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

if ( ! function_exists( 'elemental_addons_skins_manager' ) ) {
	/**
	 * @return Elemental_Addons_Skins_Manager
	 */
	function elemental_addons_skins_manager() {
		return Elemental_Addons_Skins_Manager::instance();
	}
}

if ( ! function_exists( 'elemental_addons_is_skin_enabled' ) ) {
	/**
	 * @param string $widget_slug Widget slug.
	 * @param string $skin_id     Skin id.
	 * @return bool
	 */
	function elemental_addons_is_skin_enabled( $widget_slug, $skin_id ) {
		if ( ! function_exists( 'elemental_addons_skins_manager' ) ) {
			return true;
		}
		return elemental_addons_skins_manager()->is_enabled( $widget_slug, $skin_id );
	}
}

if ( ! function_exists( 'elemental_addons_register_widget_skins' ) ) {
	/**
	 * Register enabled skins for a widget from the skins registry.
	 *
	 * @param \Elementor\Widget_Base $widget      Widget instance.
	 * @param string                 $widget_slug Registry key (e.g. team-block).
	 */
	function elemental_addons_register_widget_skins( $widget, $widget_slug ) {
		if ( ! function_exists( 'elemental_addons_skins_manager' ) ) {
			return;
		}
		elemental_addons_skins_manager()->register_enabled_skins( $widget, $widget_slug );
	}
}
