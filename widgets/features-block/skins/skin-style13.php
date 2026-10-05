<?php
namespace ElementalAddons\Widgets\FeaturesBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style13 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-features-block/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style13';
	}


	public function get_title() {
		return __( 'Skin Style13', 'elemental-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-features-block-style13', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/features-block/features-block-style13' . $direction_suffix . '.css' );

		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'animate-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}

		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		//button classes
		$settings['btn_classes'] = elemental_addons_prepare_button_classes_from_params( $settings );


		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		$settings['holder_id'] = \elemental_addons_get_isotope_holder_ID('features-block');

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = elemental_addons_get_shortcode_template_part( 'features', $settings['display_type'], 'features-block/tpl', $settings, true );

		\elemental_addons_print_html( $html );
	}
}