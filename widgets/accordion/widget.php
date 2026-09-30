<?php
namespace ElementalAddons\Widgets\Accordion;

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
class TM_Elementor_Accordion extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-accordion-style', ELEMENTAL_ADDONS_ASSETS_URI . '/css/widgets-core/accordion' . $direction_suffix . '.css' );
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
		return 'elemental-accordion';
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
		return esc_html__( 'Accordion', 'elemental-addons' );
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

	public function get_style_depends() {
		return [ 'tm-accordion-style' ];
	}

	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Accordion_Bordered( $this ) );
		$this->add_skin( new Skins\Skin_Accordion_Bordered2( $this ) );
		$this->add_skin( new Skins\Skin_Accordion_Basic( $this ) );
		$this->add_skin( new Skins\Skin_Accordion_Classic( $this ) );
		$this->add_skin( new Skins\Skin_Accordion_Gradient( $this ) );
		$this->add_skin( new Skins\Skin_Accordion_Light_Active( $this ) );
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
			'display_type', [
				'label' => esc_html__( "Behavior", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'accordion' =>  esc_html__( 'Accordion', 'elemental-addons' ),
					'toggle'  =>  esc_html__( 'Toggle', 'elemental-addons' ),
				],
				'default' => 'accordion'
			]
		);


		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'h5',
			]
		);
		$repeater->add_control(
			'expand',
			[
				'label' => esc_html__( "Make Expand?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Description", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.", 'elemental-addons' ),
			]
		);
		$this->add_control(
			'accordion_items',
			[
				'label' => esc_html__( "Item", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Accordion #1', 'elemental-addons' ),
						'expand' => 'yes',
						'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elemental-addons' ),
					],
					[
						'title' => esc_html__( 'Accordion #2', 'elemental-addons' ),
						'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elemental-addons' ),
					],
					[
						'title' => esc_html__( 'Accordion #3', 'elemental-addons' ),
						'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elemental-addons' ),
					],
				],
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'elemental-addons' ),
				'type' => Controls_Manager::ICONS,
				'separator' => 'before',
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-chevron-down',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-down',
						'angle-down',
						'angle-double-down',
						'caret-down',
						'caret-square-down',
					],
					'fa-regular' => [
						'caret-square-down',
					],
				],
				'label_block' => false,
				'skin' => 'inline',
			]
		);
		$this->add_control(
			'rotate_icon',
			[
				'label' => esc_html__( 'Rotate Icon on Active', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card .card-header .title:not(.collapsed) .accordion-controls-icon' => 'transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}} .tm-accordion .card .card-header .title:not(.collapsed) .accordion-controls-icon' => '-ms-transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}} .tm-accordion .card .card-header .title:not(.collapsed) .accordion-controls-icon' => '-webkit-transform: rotate({{SIZE}}deg);',
				],
			]
		);
		$this->add_control(
			'icon_round_border',
			[
				'label' => esc_html__( "Icon Round Border?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->end_controls_section();










		$this->start_controls_section(
			'title_section_styling',
			[
				'label' => esc_html__( 'Title Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_title_style');
		$this->start_controls_tab(
			'title_style_normal',
			[
				'label' => esc_html__('Title on Normal', 'elemental-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card-header .title',
			]
		);
		$this->add_control(
			'title_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'title_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card-header .title',
			]
		);
		$this->add_control(
			'title_border_color_options',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card-header .title',
			]
		);
		$this->add_responsive_control(
			'title_border_color_normal', [
				'label' => esc_html__( "Border Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title.collapsed' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_border_theme_colored_normal', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title.collapsed' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'title_style_active',
			[
				'label' => esc_html__('Title on Active', 'elemental-addons'),
			]
		);
		$this->add_control(
			'title_text_color_options_active',
			[
				'label' => esc_html__( 'Text Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_text_color_active',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed)' => 'color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_control(
			'title_theme_colored_active',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed)' => 'color: var(--theme-color{{VALUE}}) !important;',
				],
			]
		);
		$this->add_control(
			'title_bg_color_options_active',
			[
				'label' => esc_html__( 'Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_custom_bg_color_active',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed)' => 'background-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_bg_theme_colored_active',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed)' => 'background-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_boxshadow_active',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed)',
			]
		);
		$this->add_control(
			'title_border_color_options_active',
			[
				'label' => esc_html__( 'Border Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_border_color_active', [
				'label' => esc_html__( "Border Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed)' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_border_theme_colored_active', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed)' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();










		$this->start_controls_section(
			'title_icon_section_styling',
			[
				'label' => esc_html__( 'Icon Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('title_tabs_icon_style');
		$this->start_controls_tab(
			'title_icon_style_normal',
			[
				'label' => esc_html__('Icon on Normal', 'elemental-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_icon_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card-header .title .accordion-controls-icon',
			]
		);
		$this->add_control(
			'title_icon_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_icon_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title .accordion-controls-icon' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_icon_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title .accordion-controls-icon' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'title_icon_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_icon_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title .accordion-controls-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_icon_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title .accordion-controls-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'title_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title .accordion-controls-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_icon_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title .accordion-controls-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_icon_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title .accordion-controls-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_icon_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card-header .title .accordion-controls-icon',
			]
		);
		$this->add_control(
			'title_icon_border_color_options',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_icon_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card-header .title .accordion-controls-icon',
			]
		);
		$this->add_responsive_control(
			'title_icon_border_color_normal', [
				'label' => esc_html__( "Border Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title.collapsed .accordion-controls-icon' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_icon_border_theme_colored_normal', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title.collapsed .accordion-controls-icon' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'title_icon_style_active',
			[
				'label' => esc_html__('Icon on Active', 'elemental-addons'),
			]
		);
		$this->add_control(
			'title_icon_text_color_options_active',
			[
				'label' => esc_html__( 'Text Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_icon_text_color_active',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed) .accordion-controls-icon' => 'color: {{VALUE}} !important;',
				]
			]
		);
		$this->add_control(
			'title_icon_theme_colored_active',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed) .accordion-controls-icon' => 'color: var(--theme-color{{VALUE}}) !important;',
				],
			]
		);
		$this->add_control(
			'title_icon_bg_color_options_active',
			[
				'label' => esc_html__( 'Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_icon_custom_bg_color_active',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed) .accordion-controls-icon' => 'background-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_icon_bg_theme_colored_active',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed) .accordion-controls-icon' => 'background-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_icon_boxshadow_active',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed) .accordion-controls-icon',
			]
		);
		$this->add_control(
			'title_icon_border_color_options_active',
			[
				'label' => esc_html__( 'Border Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_icon_border_color_active', [
				'label' => esc_html__( "Border Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed) .accordion-controls-icon' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'title_icon_border_theme_colored_active', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed) .accordion-controls-icon' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_responsive_control(
			'title_icon_margin_active',
			[
				'label' => esc_html__( 'Icon Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed) .accordion-controls-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_icon_padding_active',
			[
				'label' => esc_html__( 'Icon Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card-header .title:not(.collapsed) .accordion-controls-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();










		$this->start_controls_section(
			'content_section_styling',
			[
				'label' => esc_html__( 'Content Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card .card-body',
			]
		);
		$this->add_control(
			'content_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'content_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card .card-body' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'content_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card .card-body' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'content_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'content_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card .card-body' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card .card-body' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card .card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card .card-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card .card-body',
			]
		);
		$this->add_control(
			'content_border_color_options',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card .card-body',
			]
		);
		$this->add_responsive_control(
			'content_border_color_normal', [
				'label' => esc_html__( "Border Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card .card-body' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'content_border_theme_colored_normal', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card .card-body' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'wrapper_section_styling',
			[
				'label' => esc_html__( 'Wrapper Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('wrapper_tabs_icon_style');
		$this->start_controls_tab(
			'wrapper_style_normal',
			[
				'label' => esc_html__('Wrapper on Normal', 'elemental-addons'),
			]
		);
		$this->add_responsive_control(
			'wrapper__margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'wrapper_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'wrapper_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_background',
				'label' => esc_html__( 'Background', 'elemental-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tm-accordion .card',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'wrapper_border_color_options',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'wrapper_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card',
			]
		);
		$this->add_responsive_control(
			'wrapper_border_color_normal', [
				'label' => esc_html__( "Border Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'wrapper_border_theme_colored_normal', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'wrapper_style_active',
			[
				'label' => esc_html__('Wrapper on Active', 'elemental-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_background_active',
				'label' => esc_html__( 'Background', 'elemental-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tm-accordion .card.active',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wrapper_boxshadow_active',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card.active',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'wrapper_border_color_options_active',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'wrapper_border_active',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-accordion .card.active',
			]
		);
		$this->add_responsive_control(
			'wrapper_border_color_active', [
				'label' => esc_html__( "Border Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card.active' => 'border-color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_responsive_control(
			'wrapper_border_theme_colored_active', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-accordion .card.active' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
		$classes[] = 'tm-accordion';
		if( $settings['icon_round_border'] === 'yes' ) {
			$classes[] = 'icon-round-border';
		}
		$classes[] = $settings['display_type'];
		$settings['classes'] = $classes;

		$settings['holder_id'] = mascot_core_elemental_addons_get_isotope_holder_ID('accordion');
	?>
		<div id="<?php echo esc_attr( $settings['holder_id'] ) ?>" class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<?php
		if ( $settings['accordion_items'] ) {
			$rand = rand(10,100);
			$i=1;
			foreach (  $settings['accordion_items'] as $item ) {
				$item['rand'] = $rand.''.$i;
				$item['holder_id'] = $settings['holder_id'];
				$item['selected_icon'] = $settings['selected_icon'];
				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
				$html .= elemental_addons_get_widgetcore_template_part( $settings['display_type'], null, 'accordion/tpl', $item, true );
				$i++;
			}
		}
		echo $html;
	?>
		</div>
	<?php
	}
}