<?php
namespace ElementalAddons\Widgets\PricingPlan\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Pricing_Style4 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-pricing-plan/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style4';
	}


	public function get_title() {
		return __( 'Skin Pricing Style4', 'elemental-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-pricing-skin-style4', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/pricing-plan/pricing-skin-style4' . $direction_suffix . '.css' );


		//link url
		$settings['button']['target'] = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$settings['button']['url'] = $settings['link']['url'];

		//link url - secondary
		$settings['button_secondary_url'] = '';
		if(!empty($settings['link_secondary']['url'])) {
			$settings['button_secondary_url'] = $settings['link_secondary']['url'];
		}

		//classes
		$settings['classes'] = $this->parent->get_classes($settings);

		//button classes
		$settings['btn_classes'] = \elemental_addons_prepare_button_classes_from_params( $settings );

		//title classes
		$title_classes = array();
		$title_classes[] = $settings['title_custom_css_class'];
		$settings['title_classes'] = $title_classes;

		//sub title classes
		$sub_title_classes = array();
		$sub_title_classes[] = $settings['subtitle_custom_css_class'];
		$settings['sub_title_classes'] = $sub_title_classes;

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = \elemental_addons_get_shortcode_template_part( 'pricing-plan', $settings['_skin'], 'pricing-plan/tpl', $settings, true );

		\elemental_addons_print_html( $html );
	}
}
