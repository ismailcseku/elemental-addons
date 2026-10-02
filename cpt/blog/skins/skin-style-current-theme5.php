<?php
namespace ElementalAddons\Widgets\Blog\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style_Current_Theme5 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-blog/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style-current-theme5';
	}


	public function get_title() {
		return __( 'Style Current Theme5', 'elemental-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$class_instance =  '';

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-blog-skin-style-current-theme5', ELEMENTAL_ADDONS_ASSETS_URI . '/css/cpt/blog/blog-skin-style-current-theme5' . $direction_suffix . '.css' );

		if(isset($settings['post_meta_options']) && !empty($settings['post_meta_options'])) {
			$settings['post_meta_options'] = implode(",", $settings['post_meta_options']);
		}
		$settings['holder_id'] = evolta_get_isotope_holder_ID('blog');

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$settings['the_query'] = $this->parent->query_posts();

		//button classes
		$settings['btn_classes'] = \elemental_addons_prepare_button_classes_from_params( $settings );

		//classes
		$classes = array();
		$settings['classes'] = $classes;


		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = \elemental_addons_get_cpt_shortcode_template_part( 'blog', $settings['display_type'], 'blog/tpl/type', $settings, true );

		echo $html;
	}
}
