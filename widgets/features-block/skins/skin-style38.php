<?php
namespace ElementalAddons\Widgets\FeaturesBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit;

class Skin_Style38 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-features-block/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style38';
	}

	public function get_title() {
		return __( 'Skin Style38', 'elemental-addons' );
	}

	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-features-block-style38', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/features-block/features-block-style38' . $direction_suffix . '.css', array(), ELEMENTAL_ADDONS_VERSION );

		$classes = array();
		if ( ! empty( $settings['animate_icon_on_hover'] ) ) {
			$classes[] = 'animate-hover animate-icon-' . $settings['animate_icon_on_hover'];
		}
		$settings['classes'] = $classes;
		$settings['icon_classes'] = array();
		if ( function_exists( 'elemental_addons_prepare_button_classes_from_params' ) ) {
			$settings['btn_classes'] = elemental_addons_prepare_button_classes_from_params( $settings );
		}
		$settings['holder_id'] = \elemental_addons_get_isotope_holder_ID( 'features-block' );
		$settings['settings'] = $settings;
		$html = elemental_addons_get_shortcode_template_part( 'features', $settings['display_type'], 'features-block/tpl', $settings, true );
		\elemental_addons_print_html( $html );
	}
}
