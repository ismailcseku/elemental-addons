<?php
namespace ElementalAddons\Widgets\PricingPlan\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Pricing_Style2 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-pricing-plan/sub_title_options/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style2';
	}


	public function get_title() {
		return __( 'Skin Pricing Style2', 'elemental-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
		$this->start_controls_section(
			'title_head_section_options',
			[
				'label' => esc_html__( 'Title Head Section Options', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_head_section_background',
				'label' => esc_html__( 'Head Background', 'elemental-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-head',
			]
		);
		$this->add_control(
			'title_head_section_bg_theme_colored',
			[
				'label' => esc_html__( "Head BG Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-head' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_head_section_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Head BG Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-head' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label' => esc_html__( 'Head Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-pricing-skin-style2', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/pricing-plan/pricing-skin-style2' . $direction_suffix . '.css' );


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

		echo $html;
	}
}
