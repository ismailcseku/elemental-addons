<?php
namespace ElementalAddons\Widgets\ServiceBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style9 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/elemental-service-block/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style9';
	}


	public function get_title() {
		return __( 'Skin Style9', 'elemental-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'service-block-style9', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/service-block/service-block-style9' . $direction_suffix . '.css' );


		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'animate-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}

		//classes
		$classes = array();
		$settings['classes'] = $classes;

		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		//button classes
		$settings['btn_classes'] = elemental_addons_prepare_button_classes_from_params( $settings );


		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		$settings['holder_id'] = elemental_addons_get_isotope_holder_ID('service-block');

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = elemental_addons_get_shortcode_template_part( 'service', $settings['display_type'], 'service-block/tpl', $settings, true );

		echo $html;
	}
}