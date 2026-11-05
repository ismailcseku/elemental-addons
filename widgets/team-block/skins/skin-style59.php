<?php
namespace ElementalAddons\Widgets\TeamBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit;

class Skin_Style59 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-team-block/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style59';
	}

	public function get_title() {
		return __( 'Skin Style59', 'elemental-addons' );
	}

	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		elemental_addons_enqueue_font_awesome();
		$settings = $this->parent->get_settings_for_display();
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'team-block-style59', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/team-block/team-block-style59' . $direction_suffix . '.css', array(), ELEMENTAL_ADDONS_VERSION );
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;
		$settings['holder_id'] = \elemental_addons_get_isotope_holder_ID('team-block');
		$settings['settings'] = $settings;
		$html = elemental_addons_get_shortcode_template_part( 'team', $settings['display_type'], 'team-block/tpl', $settings, true );
		\elemental_addons_print_html( $html );
	}
}