<?php
namespace ElementalAddons\Widgets\ImageGallery\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style_Current_Theme3 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/elemental-image-gallery/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style-current-theme3';
	}


	public function get_title() {
		return __( 'Skin - Style Current Theme3', 'elemental-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();
		elemental_addons_wp_enqueue_script_lightgallery();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-skin-style-current-theme3', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/image-gallery/skin-style-current-theme3' . $direction_suffix . '.css' );

		//classes
		$classes = array();
		if( $settings['display_type'] == 'grid' ) {
			$classes[] = 'grid-' . $settings['columns'];
		}
		$settings['classes'] = $classes;

		$settings['holder_id'] = mascot_core_elemental_addons_get_isotope_holder_ID('gallery');


		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = elemental_addons_get_shortcode_template_part( 'gallery', $settings['display_type'], 'image-gallery/tpl', $settings, true );

		echo $html;
	}
}
