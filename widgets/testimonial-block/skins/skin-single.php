<?php
namespace ElementalAddons\Widgets\TestimonialBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Single extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_script( 'tm-testimonial-thumb-carousel-script', ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/testimonial-thumb-carousel.js', array('jquery'), false, true );
		}
		add_action( 'elementor/element/elemental-testimonial-block/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-single';
	}


	public function get_title() {
		return __( 'Skin Single Testimonial', 'elemental-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
		//Current Skin Styling
		$this->start_controls_section(
			'current_wrapper_styling',
			[
				'label' => esc_html__( 'Current Skin Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'content_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .inner-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .inner-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .inner-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('tabs_current_theme_styling');
		$this->start_controls_tab(
			'tabs_current_theme_styling_normal1',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		// Background Color
		$this->add_control(
			'content_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'content_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .inner-box' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'content_wrapper_theme_colored',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .inner-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		// Border Color
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_area_normal_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .testimonial-item .inner-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_area_normal_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .testimonial-item .inner-box',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_current_theme_styling_hover1',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		//Background Hover Color
		$this->add_control(
			'content_wrapper_color_options_hover',
			[
				'label' => esc_html__( 'BG Color Options (Hover)', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .inner-box' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .inner-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		//Border Hover Color
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_area_hover_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .testimonial-item:hover .inner-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_area_hover_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .testimonial-item:hover .inner-box',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		//Quote Icon Styling
		$this->start_controls_section(
			'content_quote_icon_styling',
			[
				'label' => esc_html__( 'Quote Icon Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_quote_icon_styling');
		//Normal Color
		$this->start_controls_tab(
			'content_quote_icon_mormal_styling',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		$this->add_responsive_control(
			'content_quote_icon_mormal_bg_color',
			[
				'label' => esc_html__( "Quote Icon Bg Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .inner-box .quote-icon .icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_quote_icon_mormal_bg_theme_colored',
			[
				'label' => esc_html__( "Quote Icon Bg Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .inner-box .quote-icon .icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'content_quote_icon_mormal_color',
			[
				'label' => esc_html__( "Quote Icon Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .inner-box .quote-icon .icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_quote_icon_mormal_theme_colored',
			[
				'label' => esc_html__( "Quote Icon Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .inner-box .quote-icon .icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_quote_icon_hover_styling',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		//Hover Color
		$this->add_control(
			'quote_icon_hover_styling',
			[
				'label' => esc_html__( 'Quote Icon Styling (Hover)', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_quote_icon_bg_hover_color',
			[
				'label' => esc_html__( "Quote Icon Bg Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .inner-box .quote-icon .icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_quote_icon_hover_bg_theme_colored',
			[
				'label' => esc_html__( "Quote Icon Bg Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .inner-box .quote-icon .icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'content_quote_icon_hover_color',
			[
				'label' => esc_html__( "Quote Icon Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .inner-box .quote-icon .icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_quote_icon_hover_theme_colored',
			[
				'label' => esc_html__( "Quote Icon Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .inner-box .quote-icon .icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-testimonial-block-single', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/testimonial-block/testimonial-block-single' . $direction_suffix . '.css' );
		wp_enqueue_script( 'tm-testimonial-thumb-carousel-script', ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/testimonial-thumb-carousel.js', array('jquery'), false, true );


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

		$settings['holder_id'] = elemental_addons_get_isotope_holder_ID('testimonial-block');

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = elemental_addons_get_shortcode_template_part( 'testimonial', $settings['_skin'], 'testimonial-block/tpl', $settings, true );

		echo $html;
	}
}