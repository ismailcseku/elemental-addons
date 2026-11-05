<?php
/**
 * Admin: Base default theme colors (--theme-color1…4).
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Elemental_Addons_Base_Colors' ) ) {

	class Elemental_Addons_Base_Colors {

		const SLUG          = 'elemental-addons-base-colors';
		const OPTION_KEY    = 'elemental_addons_base_colors';
		const NONCE_ACTION  = 'elemental_addons_save_base_colors';

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
		 * @return array<string,string>
		 */
		public static function get_colors() {
			$saved = get_option( self::OPTION_KEY, array() );
			if ( ! is_array( $saved ) ) {
				$saved = array();
			}
			$colors = array_merge( self::defaults(), $saved );
			foreach ( $colors as $key => $value ) {
				$colors[ $key ] = self::sanitize_hex( $value, self::defaults()[ $key ] );
			}
			return $colors;
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
		 * Pick readable text on a solid brand color.
		 *
		 * @param string $hex Background hex.
		 * @return string
		 */
		public static function contrast_text( $hex ) {
			$hex = ltrim( self::sanitize_hex( $hex ), '#' );
			$r   = hexdec( substr( $hex, 0, 2 ) );
			$g   = hexdec( substr( $hex, 2, 2 ) );
			$b   = hexdec( substr( $hex, 4, 2 ) );
			// Relative luminance threshold.
			$luma = ( 0.299 * $r + 0.587 * $g + 0.114 * $b );
			return ( $luma > 186 ) ? '#111827' : '#ffffff';
		}

		/**
		 * CSS custom properties block.
		 *
		 * @return string
		 */
		public static function css_variables() {
			$c = self::get_colors();
			$lines = array(
				':root{',
				'--theme-color1:' . $c['color1'] . ';',
				'--theme-color2:' . $c['color2'] . ';',
				'--theme-color3:' . $c['color3'] . ';',
				'--theme-color4:' . $c['color4'] . ';',
				'--theme-color1-rgb:' . self::hex_to_rgb_channels( $c['color1'] ) . ';',
				'--theme-color2-rgb:' . self::hex_to_rgb_channels( $c['color2'] ) . ';',
				'--theme-color3-rgb:' . self::hex_to_rgb_channels( $c['color3'] ) . ';',
				'--theme-color4-rgb:' . self::hex_to_rgb_channels( $c['color4'] ) . ';',
				'--theme-color1-text-color:' . self::contrast_text( $c['color1'] ) . ';',
				'--theme-color2-text-color:' . self::contrast_text( $c['color2'] ) . ';',
				'--theme-color3-text-color:' . self::contrast_text( $c['color3'] ) . ';',
				'--theme-color4-text-color:' . self::contrast_text( $c['color4'] ) . ';',
				'--text-color-bg-theme-color1:' . self::contrast_text( $c['color1'] ) . ';',
				'--text-color-bg-theme-color2:' . self::contrast_text( $c['color2'] ) . ';',
				'--text-color-bg-theme-color3:' . self::contrast_text( $c['color3'] ) . ';',
				'--text-color-bg-theme-color4:' . self::contrast_text( $c['color4'] ) . ';',
				'}',
			);
			return implode( '', $lines );
		}

		public static function init() {
			add_action( 'admin_menu', array( __CLASS__, 'register_menu' ), 12 );
			add_action( 'admin_init', array( __CLASS__, 'handle_save' ) );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin' ) );
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_front_vars' ), 20 );
			add_action( 'elementor/editor/after_enqueue_styles', array( __CLASS__, 'enqueue_front_vars' ) );
			add_action( 'elementor/frontend/after_enqueue_styles', array( __CLASS__, 'enqueue_front_vars' ) );
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
			wp_add_inline_script(
				'wp-color-picker',
				"jQuery(function($){ $('.elemental-base-color-field').wpColorPicker(); });"
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

			$defaults = self::defaults();
			$colors   = array();
			foreach ( array_keys( $defaults ) as $key ) {
				$raw            = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : $defaults[ $key ]; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				$colors[ $key ] = self::sanitize_hex( $raw, $defaults[ $key ] );
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

			$colors = self::get_colors();
			$labels = array(
				'color1' => esc_html__( 'Theme Color 1', 'elemental-addons' ),
				'color2' => esc_html__( 'Theme Color 2', 'elemental-addons' ),
				'color3' => esc_html__( 'Theme Color 3', 'elemental-addons' ),
				'color4' => esc_html__( 'Theme Color 4', 'elemental-addons' ),
			);
			$hints  = array(
				'color1' => esc_html__( 'Primary accent (buttons, social backgrounds, highlights).', 'elemental-addons' ),
				'color2' => esc_html__( 'Secondary / dark accent.', 'elemental-addons' ),
				'color3' => esc_html__( 'Tertiary accent (icons, share, secondary highlights).', 'elemental-addons' ),
				'color4' => esc_html__( 'Quaternary accent.', 'elemental-addons' ),
			);
			?>
			<div class="wrap elemental-base-colors">
				<h1><?php esc_html_e( 'Base default colors', 'elemental-addons' ); ?></h1>
				<p class="elemental-base-colors__intro">
					<?php esc_html_e( 'These colors set the CSS variables used across Elemental Addons skins (--theme-color1 through --theme-color4). Changes apply site-wide on the front end and in the Elementor editor.', 'elemental-addons' ); ?>
				</p>

				<?php settings_errors( 'elemental_addons_base_colors' ); ?>

				<form method="post" action="">
					<?php wp_nonce_field( self::NONCE_ACTION ); ?>
					<div class="elemental-base-colors__grid">
						<?php foreach ( $labels as $key => $label ) : ?>
							<div class="elemental-base-colors__card">
								<label class="elemental-base-colors__label" for="<?php echo esc_attr( $key ); ?>">
									<span class="elemental-base-colors__swatch" style="background:<?php echo esc_attr( $colors[ $key ] ); ?>"></span>
									<span><?php echo esc_html( $label ); ?></span>
								</label>
								<input
									type="text"
									class="elemental-base-color-field"
									id="<?php echo esc_attr( $key ); ?>"
									name="<?php echo esc_attr( $key ); ?>"
									value="<?php echo esc_attr( $colors[ $key ] ); ?>"
									data-default-color="<?php echo esc_attr( self::defaults()[ $key ] ); ?>"
								/>
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
