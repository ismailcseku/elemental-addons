<?php
namespace ElementalAddons\Widgets\Blog\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style_Current_Theme1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-blog/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style-current-theme1';
	}


	public function get_title() {
		return __( 'Style Current Theme1', 'elemental-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;


		$this->start_controls_section(
			'content_wrapper_styling',
			[
				'label' => esc_html__( 'Content Wrapper Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_wrapper_color_options',
			[
				'label' => esc_html__( 'background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-item-current-style1, {{WRAPPER}} .blog-item-current-style1 .entry-content' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom background Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-item-current-style1:hover .entry-content' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'content_wrapper_color_border_options',
			[
				'label' => esc_html__( 'Border Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_border_bg_color',
			[
				'label' => esc_html__( "Custom Border Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-blog .blog-item-current-style1' => 'border-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$class_instance =  '';

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-blog-skin-style-current-theme1', ELEMENTAL_ADDONS_ASSETS_URI . '/css/cpt/blog/blog-skin-style-current-theme1' . $direction_suffix . '.css' );

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
