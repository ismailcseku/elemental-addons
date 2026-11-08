<?php
namespace ElementalAddons\Widgets\ServiceBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit;

class Skin_Style43 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-service-block/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style43';
	}

	public function get_title() {
		return __( 'Skin Style43', 'elemental-addons' );
	}

	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'service-block-style43', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/service-block/service-block-style43' . $direction_suffix . '.css', array(), ELEMENTAL_ADDONS_VERSION );

		wp_enqueue_script(
			'tm-service-block-style43-script',
			ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/service-block.js',
			array( 'jquery', 'elementor-frontend' ),
			ELEMENTAL_ADDONS_VERSION,
			true
		);

		$classes = array();
		if ( ! empty( $settings['animate_icon_on_hover'] ) ) {
			$classes[] = 'animate-hover animate-icon-' . $settings['animate_icon_on_hover'];
		}
		$settings['classes'] = $classes;
		$settings['icon_classes'] = array();
		if ( function_exists( 'elemental_addons_prepare_button_classes_from_params' ) ) {
			$settings['btn_classes'] = elemental_addons_prepare_button_classes_from_params( $settings );
		}
		$settings['holder_id'] = \elemental_addons_get_isotope_holder_ID( 'service-block' );
		$settings['settings'] = $settings;
		$html = elemental_addons_get_shortcode_template_part( 'service', $settings['display_type'], 'service-block/tpl', $settings, true );
		\elemental_addons_print_html( $html );
	}
}
