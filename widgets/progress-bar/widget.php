<?php
namespace ElementalAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Progress_Bar extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script( 'jquery-countto', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.countto.js', array('jquery'), false, true );

		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-progress-bar-style', ELEMENTAL_ADDONS_ASSETS_URI . '/css/widgets-core/progress-bar' . $direction_suffix . '.css' );
		wp_register_script( 'tm-progress-bar', ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/progress-bar.js', array('jquery', 'jquery-countto'), false, true );
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'elemental-progress-bar';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Progress Bar', 'elemental-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tm-elementor-widget-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_keywords() {
		return array( 'elemental', 'elemental addons' );
	}

	public function get_categories() {
		return [ 'elemental-addons' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'elemental-addons-js', 'jquery-countto', 'tm-progress-bar' ];
	}

	public function get_style_depends() {
		return [ 'tm-progress-bar-style' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'tm_general',
			[
				'label' => esc_html__( 'General', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				"description" => esc_html__( "Add your Progress/Skill Title Text. Default: WordPress", 'elemental-addons' ),
				'default' => esc_html__( "WordPress", 'elemental-addons' )
			]
		);
		$this->add_control(
			'design_style',
			[
				'label' => esc_html__( "Design Style", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'elemental-addons' ),
					'floating-percent' => esc_html__( 'Floating Percent', 'elemental-addons' ),
					'fixed-right-percent' => esc_html__( 'Fixed Right Percent', 'elemental-addons' ),
				],
				'default' => 'default'
			]
		);
		$this->add_control(
			'percentage_value',
			[
				'label' => esc_html__( "Percentage Value", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Add a Percentage Value. Maximum 100. Default: 85", 'elemental-addons' ),
				'default' => esc_html__( "85", 'elemental-addons' )
			]
		);
		$this->add_control(
			'unit_symbol_left',
			[
				'label' => esc_html__( "Unit Symbol Left", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Add an Unit Symbol to the Left of Percent Value", 'elemental-addons' ),
			]
		);
		$this->add_control(
			'unit_symbol_right',
			[
				'label' => esc_html__( "Unit Symbol Right", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Add an Unit Symbol to the Right of Percent Value", 'elemental-addons' ),
				'default' => esc_html__( "%", 'elemental-addons' )
			]
		);
		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();











		$this->start_controls_section(
			'other_options',
			[
				'label' => esc_html__( 'Progress Options', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'progress_color',
			[
				'label' => esc_html__( "Progress Custom Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				"description" => esc_html__( "Pick a color for progress bar. Leave empty for default value", 'elemental-addons' ),
				'default' => '#21325e',
				'selectors' => [
					'{{WRAPPER}} .progress-holder .progress-content' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'progress_theme_colored',
			[
				'label' => esc_html__( "Progress Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .progress-holder .progress-content' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'progress_border_radius',
			[
				'label' => esc_html__( "Progress Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .progress-holder .progress-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'progress_bar_options',
			[
				'label' => esc_html__( 'Progress Bar Options', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'progress_bar_height',
			[
				'label' => esc_html__( "Progress Bar Height", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-progress-bar .progress-holder' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tm-sc-progress-bar .progress-holder .progress-content' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hr2-progress',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'background_color',
			[
				'label' => esc_html__( "Progress Bar Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				"description" => esc_html__( "Pick a color for the background of progress bar. Leave empty for default value", 'elemental-addons' ),
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .progress-holder' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'progress_bar_theme_colored',
			[
				'label' => esc_html__( "Progress Bar Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .progress-holder' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'progress_bar_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .progress-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();












		$this->start_controls_section(
			'title_options',
			[
				'label' => esc_html__( 'Title Options', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'h5'
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Title Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progress-title-holder .pb-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Title Text Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .progress-title-holder .pb-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Title Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .progress-title-holder .pb-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Title Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .progress-title-holder .pb-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .progress-title-holder .pb-title',
			]
		);
		$this->add_responsive_control(
			'title_margin_top',
			[
				'label' => esc_html__( "Margin Top", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .progress-title-holder .pb-title' => 'margin-top: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'title_margin_bottom',
			[
				'label' => esc_html__( "Margin Bottom", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .progress-title-holder .pb-title' => 'margin-bottom: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'percent_value_options',
			[
				'label' => esc_html__( 'Percentage Value Typography', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'percent_value_text_color',
			[
				'label' => esc_html__( "Percentage Value Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progress-title-holder .percent' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'percent_value_text_color_hover',
			[
				'label' => esc_html__( "Percentage Value Text Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .progress-title-holder .percent' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'percent_value_theme_colored',
			[
				'label' => esc_html__( "Percentage Value Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .progress-title-holder .percent' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'percent_value_theme_colored_hover',
			[
				'label' => esc_html__( "Percentage Value Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .progress-title-holder .percent' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'percent_value_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .progress-title-holder .percent',
			]
		);
		$this->end_controls_section();


	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = 'progress-bar-' . $settings['design_style'];
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;

		wp_register_script( 'jquery-countto', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.countto.js', array('jquery'), false, true );
		wp_enqueue_script( 'jquery-countto' );


		$html = elemental_addons_get_widgetcore_template_part( 'progress-bar-' . $settings['design_style'], null, 'progress-bar/tpl', $settings, true );

		echo $html;
	}
}
