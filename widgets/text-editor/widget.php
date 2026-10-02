<?php
namespace ElementalAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_TextEditor extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
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
		return 'tm-ele-text-editor';
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
		return esc_html__( 'Text Editor', 'elemental-addons' );
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
		return [ 'elemental-addons-js' ];
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
			'content',
			[
				'label' => esc_html__( "Description", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", 'elemental-addons' ),
			]
		);


		//gsap animation
		\elemental_addons_gsap_animation_arraylist($this);


		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'elemental-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => \elemental_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-text-editor, {{WRAPPER}} .tm-text-editor *',
			]
		);
		$this->add_responsive_control(
			'text_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tm-text-editor *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'margin_top',
			[
				'label' => esc_html__( "Only Margin Top", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor' => 'margin-top: {{VALUE}};',
					'{{WRAPPER}} .tm-text-editor *' => 'margin-top: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'margin_bottom',
			[
				'label' => esc_html__( "Only Margin Bottom", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor' => 'margin-bottom: {{VALUE}};',
					'{{WRAPPER}} .tm-text-editor *' => 'margin-bottom: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'text_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'text_options_settings',
			[
				'label' => esc_html__( 'Text Color Options', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_options',
			[
				'label' => esc_html__( 'Text Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( "Content Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-text-editor *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'content_color_hover',
			[
				'label' => esc_html__( "Content Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-text-editor' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .tm-text-editor *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'content_theme_colored',
			[
				'label' => esc_html__( "Content Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-text-editor *' => 'color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$this->add_control(
			'content_theme_colored_hover',
			[
				'label' => esc_html__( "Content Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-text-editor' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .tm-text-editor *' => 'color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'boldtext_options_settings',
			[
				'label' => esc_html__( 'Bold Text Options', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bold_text_options',
			[
				'label' => esc_html__( 'Bold Text Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'bold_text_typography',
				'label' => esc_html__( 'Bold Text Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-text-editor b, {{WRAPPER}} .tm-text-editor strong',
			]
		);
		$this->add_control(
			'bold_text_text_color',
			[
				'label' => esc_html__( "Bold Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor b, {{WRAPPER}} .tm-text-editor strong' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bold_text_text_color_hover',
			[
				'label' => esc_html__( "Bold Text Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor b:hover, {{WRAPPER}} .tm-text-editor strong:hover, {{WRAPPER}} .tm-text-editor b:hover *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bold_text_theme_colored',
			[
				'label' => esc_html__( "Bold Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor b, {{WRAPPER}} .tm-text-editor strong' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'bold_text_theme_colored_hover',
			[
				'label' => esc_html__( "Bold Text Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor b:hover, {{WRAPPER}} .tm-text-editor strong:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bold_text_bg_wrapper_background',
				'label' => esc_html__( 'Background', 'elemental-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tm-text-editor b, {{WRAPPER}} .tm-text-editor strong',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'bold_text_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor b, {{WRAPPER}} .tm-text-editor strong' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bold_text_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor b, {{WRAPPER}} .tm-text-editor strong' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bold_text_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor b, {{WRAPPER}} .tm-text-editor strong' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
            'bold_text_stroke_width_normal',
            [
                'label' => esc_html__( 'Stroke Width', 'elemental-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 0.1, 'max' => 10 ],
                ],
				'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tm-text-editor b, {{WRAPPER}} .tm-text-editor strong' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'bold_text_stroke_color_normal',
			[
				'label' => esc_html__( 'Stroke Color', 'elemental-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor b, {{WRAPPER}} .tm-text-editor strong' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bold_text_stroke_theme_colored',
			[
				'label' => esc_html__( "Stroke Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor b, {{WRAPPER}} .tm-text-editor strong' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'italic_options_settings',
			[
				'label' => esc_html__( 'Italic Text Options', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'italic_text_options',
			[
				'label' => esc_html__( 'Italic Text Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'italic_text_typography',
				'label' => esc_html__( 'Italic Text Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-text-editor em',
			]
		);
		$this->add_control(
			'italic_text_text_color',
			[
				'label' => esc_html__( "Italic Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor em' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'italic_text_text_color_hover',
			[
				'label' => esc_html__( "Italic Text Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor em:hover *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'italic_text_theme_colored',
			[
				'label' => esc_html__( "Italic Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor em' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'italic_text_theme_colored_hover',
			[
				'label' => esc_html__( "Italic Text Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor em:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'italic_text_bg_wrapper_background',
				'label' => esc_html__( 'Background', 'elemental-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tm-text-editor em',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'italic_text_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor em' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'italic_text_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor em' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'italic_text_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor em' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
            'italic_text_stroke_width_normal',
            [
                'label' => esc_html__( 'Stroke Width', 'elemental-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 0.1, 'max' => 10 ],
                ],
				'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tm-text-editor em' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'italic_text_stroke_color_normal',
			[
				'label' => esc_html__( 'Stroke Color', 'elemental-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor em' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'italic_text_stroke_theme_colored',
			[
				'label' => esc_html__( "Stroke Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor em' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'link_options_settings',
			[
				'label' => esc_html__( 'Link Text Options', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'link_options',
			[
				'label' => esc_html__( 'Link Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'label' => esc_html__( 'Link Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-text-editor a, {{WRAPPER}} .tm-text-editor a *',
			]
		);
		$this->add_control(
			'link_text_color',
			[
				'label' => esc_html__( "Link Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor a, {{WRAPPER}} .tm-text-editor a *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'link_text_color_hover',
			[
				'label' => esc_html__( "Link Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor a:hover, {{WRAPPER}} .tm-text-editor a:hover *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'link_theme_colored',
			[
				'label' => esc_html__( "Link Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor a, {{WRAPPER}} .tm-text-editor a *' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'link_theme_colored_hover',
			[
				'label' => esc_html__( "Link Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor a:hover, {{WRAPPER}} .tm-text-editor a:hover *' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'link_text_bg_wrapper_background',
				'label' => esc_html__( 'Background', 'elemental-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tm-text-editor a',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'link_text_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor a, {{WRAPPER}} .tm-text-editor a *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'link_text_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor a, {{WRAPPER}} .tm-text-editor a *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'link_text_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor a, {{WRAPPER}} .tm-text-editor a *' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
            'link_text_stroke_width_normal',
            [
                'label' => esc_html__( 'Stroke Width', 'elemental-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 0.1, 'max' => 10 ],
                ],
				'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tm-text-editor a' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'link_text_stroke_color_normal',
			[
				'label' => esc_html__( 'Stroke Color', 'elemental-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor a' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'link_text_stroke_theme_colored',
			[
				'label' => esc_html__( "Stroke Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor a' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'bg_options_settings',
			[
				'label' => esc_html__( 'Background Color Options', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'bg_color_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_color_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-text-editor' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_color_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'bg_color_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-text-editor' => 'background-color: var(--theme-color{{VALUE}});'
				],
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
		$html = '';
		$settings = $this->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = 'tm-text-editor';
		$parallax_params = null;
		if( ! empty( $settings['gsap_scrolling_effect'] ) && $settings['gsap_scrolling_effect'] === 'parallax') {
			$parallax_params = \elemental_addons_gsap_animation_json_data($settings);
		}
		$settings['classes'] = $classes;
	?>
		<div class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>" <?php if( ! empty( $parallax_params ) ) : ?> data-parallax="<?php echo esc_attr($parallax_params); ?>" <?php endif; ?>>
		<?php echo do_shortcode($settings['content']); ?>
		</div>
	<?php
	}
}