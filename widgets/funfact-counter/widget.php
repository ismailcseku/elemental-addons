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
class TM_Elementor_Funfact_Counter extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-funfacts-style', ELEMENTAL_ADDONS_ASSETS_URI . '/css/widgets-core/funfacts' . $direction_suffix . '.css' );
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
		return 'tm-ele-funfact-counter';
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
		return esc_html__( 'Funfact Counter', 'elemental-addons' );
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

	public function get_style_depends() {
		return [ 'tm-funfacts-style' ];
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
				'label' => esc_html__( 'General Settings', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'design_style',
			[
				'label' => esc_html__( "Design Style", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'funfact-default' => esc_html__( 'Default', 'elemental-addons' ),
					'funfact-number-behind-text' => esc_html__( 'Number behind Text', 'elemental-addons' ),
					'funfact-iconleft' => esc_html__( 'Icon Left', 'elemental-addons' ),
					'funfact-iconright' => esc_html__( 'Icon Right', 'elemental-addons' ),
					'funfact-horizontal' => esc_html__( 'Horizontal FunFact', 'elemental-addons' ),
					'funfact-current-theme1' => esc_html__( 'Current Theme 1', 'elemental-addons' ),
					'funfact-current-theme2' => esc_html__( 'Current Theme 2', 'elemental-addons' ),
				],
				'default' => 'funfact-default'
			]
		);
		$this->add_control(
			'counter_position',
			[
				'label' => esc_html__( "Counter Positioning", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Icon - Title - Counter', 'elemental-addons' ),
					'icon_counter_title' => esc_html__( 'Icon - Counter - Title', 'elemental-addons' ),
				],
				'default' => 'icon_counter_title'
			]
		);
		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'elemental-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => elemental_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .tm-sc-funfact' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-funfact .details' => 'text-align: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'icon_pos_left_flex_vertical',
			[
				'label' => esc_html__( "Icon Vertical Alignment(Flex)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .funfact-iconleft .funfact-inner' => 'align-items: {{VALUE}};',
					'{{WRAPPER}} .funfact-iconleft .funfact-inner .funfact-icon i' => 'line-height: 1;',
				],
				'condition' => [
					'design_style' => array('funfact-iconleft','funfact-iconright')
				]
			]
		);
		$this->add_control(
			'funfact_wrapper_funfact_inner_flex',
			[
				'label' => esc_html__( "Content Display Flex?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-funfact .funfact-inner' => 'display: flex;',
				],
				'condition' => [
					'design_style' => array('funfact-iconleft','funfact-iconright')
				]
			]
		);
		$this->add_control(
			'everything_centered_in_responsive_tablet',
			[
				'label' => esc_html__( "Make everything centered in Tablet?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'everything_centered_in_responsive_mobile',
			[
				'label' => esc_html__( "Make everything centered in Mobile?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->end_controls_section();










		$this->start_controls_section(
			'counter_options',
			[
				'label' => esc_html__( 'Counter Value', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'counter_range',
			[
				'label' => esc_html__( "Counting Value/Number", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Enter number for counter without any special character. Default: 1250', 'elemental-addons' ),
				'default' => esc_html__( "1250", 'elemental-addons' )
			]
		);
		$this->add_control(
			'counter_prefix',
			[
				'label' => esc_html__( "Counting Value Prefix", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Add an Unit Symbol to the Right of Percent Value", 'elemental-addons' ),
			]
		);
		$this->add_control(
			'counter_postfix',
			[
				'label' => esc_html__( "Counting Value Postfix", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'counter_duration',
			[
				'label' => esc_html__( "Counter Duration(ms)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Default: 1500', 'elemental-addons' ),
				'default' => '1500'
			]
		);
		$this->add_control(
			'counter_tag',
			[
				'label'   => esc_html__( 'Counter Tag', 'elemental-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'no',
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'h2'
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'title_section',
			[
				'label' => esc_html__( 'Title', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "This is a section title", 'elemental-addons' ),
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'h4'
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'subtitle_section',
			[
				'label' => esc_html__( 'Sub Title', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'subtitle_show',
			[
				'label' => esc_html__( 'Show/Hide Sub Title', 'elemental-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'elemental-addons' ),
				'label_off' => __( 'Show', 'elemental-addons' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( "Sub Title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Subtitle Here", 'elemental-addons' ),
				'condition' => [
					'subtitle_show' => array('yes')
				]
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Sub Title Tag", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'h6',
				'condition' => [
					'subtitle_show' => array('yes')
				]
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'icon_section',
			[
				'label' => esc_html__( 'Icon', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'icon_custom_css_class',
			[
				'label' => esc_html__( "Icon Custom CSS Class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label' => esc_html__( "Icon Type", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'no-icon' => esc_html__( 'No Icon', 'elemental-addons' ),
					'font-icon' => esc_html__( 'Font Icon', 'elemental-addons' ),
					'image' => esc_html__( 'JPG/PNG Image', 'elemental-addons' ),
				],
				'default' => 'no-icon'
			]
		);
		//image
		$this->add_control(
			'image_icon',
			[
				'label' => esc_html__( "Upload Image Icon", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_control(
			'image_icon_predefined_image_size',
			[
				'label' => esc_html__( "Choose Predefined Image Size", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_get_available_image_sizes(),
				'default' => 'full',
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_control(
			'image_icon_custom_size',
			[
				'label' => esc_html__( "Image Custom Width", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				"description" => esc_html__( "Put custom width of the uploaded image in positive value. Example: 120px", 'elemental-addons' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .funfact-thumb img' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		//font icon
		$this->add_control(
			'icon',
			[
				'label' => __('Icon', 'elemental-addons'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-chart-bar',
					'library' => 'font-awesome',
				],
				'condition' => [
					'icon_type' => array('font-icon')
				]
			]
		);
		$this->end_controls_section();

















		$this->start_controls_section(
			'icon_custom_styling',
			[
				'label' => esc_html__( 'Icon Custom Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_icon_wrapper_style');
		$this->start_controls_tab(
			'icon_wrapper_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		$this->add_control(
			'animate_icon_on_hover',
			[
				'label' => esc_html__( "Animate Icon on Hover", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'elemental-addons' ),
					'rotate' => esc_html__( 'Rotate', 'elemental-addons' ),
					'rotate-x' => esc_html__( 'Rotate X', 'elemental-addons' ),
					'rotate-y' => esc_html__( 'Rotate Y', 'elemental-addons' ),
					'translate'  => esc_html__( 'Translate', 'elemental-addons' ),
					'translate-x'  => esc_html__( 'Translate X', 'elemental-addons' ),
					'translate-y'  => esc_html__( 'Translate Y', 'elemental-addons' ),
					'scale'  => esc_html__( 'Scale', 'elemental-addons' ),
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'icon_text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'elemental-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => elemental_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'icon_flex_horizontal_alignment',
			[
				'label' => esc_html__( "Icon Horizontal Alignment(Flex)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'display:inline-flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_flex_vertical_alignment',
			[
				'label' => esc_html__( "Icon Vertical Alignment(Flex)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'display:inline-flex; align-items: {{VALUE}};',
					'{{WRAPPER}} .icon i' => 'line-height: 1;',
				],
			]
		);

		$this->add_control(
			'icon_area_dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_area_width',
			[
				'label' => esc_html__( "Width", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_width_auto',
			[
				'label' => esc_html__( "Make Icon Width to Auto?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'width: auto;',
				]
			]
		);
		$this->add_responsive_control(
			'icon_area_height',
			[
				'label' => esc_html__( "Height", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_height_auto',
			[
				'label' => esc_html__( "Make Icon Height to Auto?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'height: auto;',
				]
			]
		);
		$this->add_responsive_control(
			'icon-line-height',
			[
				'label' => esc_html__( "Icon Line Height", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .funfact-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .funfact-icon svg' => 'line-height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_border_options',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_area_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .funfact-icon',
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_area_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .funfact-icon',
			]
		);

		$this->add_control(
			'hr01-pos',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'icon_color_options',
			[
				'label' => esc_html__( 'Icon Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .funfact-icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_custom_color',
			[
				'label' => esc_html__( "Icon Custom Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array('font-icon')
				],
				'selectors' => [
					'{{WRAPPER}} .funfact-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .funfact-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .funfact-icon i, {{WRAPPER}} .funfact-icon svg',
			]
		);
		$this->add_control(
			'hr1-funfact',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'icon_bgcolor_options',
			[
				'label' => esc_html__( 'Icon Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_area_bg_theme_colored',
			[
				'label' => esc_html__( "Icon/Image Area BG Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color',
			[
				'label' => esc_html__( "Icon/Image Area Custom BG Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .funfact-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'icon_wrapper_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'icon_area_border_options_hover',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_area_border_hover',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}}:hover .funfact-icon',
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius_hover',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}:hover .funfact-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_area_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}}:hover .funfact-icon',
			]
		);

		$this->add_control(
			'hr01-pos_hover',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'icon_color_options_hover',
			[
				'label' => esc_html__( 'Icon Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .funfact-icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .funfact-icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_custom_color_hover',
			[
				'label' => esc_html__( "Icon Custom Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array('font-icon')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .funfact-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .funfact-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'hr1-funfact_hover',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'icon_bgcolor_options_hover',
			[
				'label' => esc_html__( 'Icon Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_area_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon/Image Area BG Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .funfact-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color_hover',
			[
				'label' => esc_html__( "Icon/Image Area Custom BG Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .funfact-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


















		$this->start_controls_section(
			'counter_styling',
			[
				'label' => esc_html__( 'Counter Value Styling', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'counter_custom_css_class',
			[
				'label' => esc_html__( "Counter Custom CSS Class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'counter_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'counter_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .counter' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'counter_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'counter_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .counter' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .counter',
			]
		);
		$this->add_responsive_control(
			'counter_margin',
			[
				'label' => esc_html__( 'Counter Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();












		$this->start_controls_section(
			'title_styling',
			[
				'label' => esc_html__( 'Title Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_custom_css_class',
			[
				'label' => esc_html__( "Title Custom CSS Class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'funfact_title_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'funfact_title_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .title',
			]
		);
		$this->add_control(
			'title_disply_type',
			[
				'label' => esc_html__('Display Type', 'elemental-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => elemental_addons_disply_type_list_elementor(),
				'selectors' => [
					'{{WRAPPER}} .title' => 'display: {{UNIT}}',
				],
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'subtitle_styling',
			[
				'label' => esc_html__( 'Subtitle Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_custom_css_class',
			[
				'label' => esc_html__( "Subtitle Custom CSS Class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'subtitle_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Subtitle Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'content_options',
			[
				'label' => esc_html__( 'Content', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_paragraph', [
				'label' => esc_html__( "Show Content", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'content',
			[
				'label' => esc_html__( "Paragraph", 'elemental-addons' ),
				"description" => esc_html__( "It will be displayed above/under title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Write a short description, that will describe something useful.", 'elemental-addons' ),
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'content_styling',
			[
				'label' => esc_html__( 'Content Styling', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( "Content Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact-content' => 'color: {{VALUE}};',
					'{{WRAPPER}} .funfact-content *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'content_color_hover',
			[
				'label' => esc_html__( "Content Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .funfact-content' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .funfact-content *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .funfact-content, {{WRAPPER}} .funfact-content *',
			]
		);
		$this->end_controls_section();










		$this->start_controls_section(
			'funfact_wrapper_styling',
			[
				'label' => esc_html__( 'Funfact Wrapper Style', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_funfact_wrapper_style');
		$this->start_controls_tab(
			'funfact_wrapper_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);

		$this->add_responsive_control(
			'funfact_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-funfact' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_margin',
			[
				'label' => esc_html__( 'Wrapper Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-funfact' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'funfact_wrapper_vertical_align',
			[
				'label' => esc_html__( "Content Display Flex + Vertical Center?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-funfact' => 'display: flex; align-items: center;',
				]
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_min_height',
			[
				'label' => esc_html__( "Minimum Height", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-funfact' => 'min-height: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'funfact_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-funfact' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-funfact' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'funfact_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-funfact' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'funfact_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-funfact',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-funfact',
			]
		);
		$this->add_control(
			'funfact_wrapper_border_theme_colored',
			[
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-funfact' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'funfact_wrapper_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'funfact_wrapper_color_options_hover',
			[
				'label' => esc_html__( 'BG Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-funfact' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "BG Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-funfact' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'funfact_wrapper_border_options_hover',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_border_radius_hover',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-funfact' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'funfact_wrapper_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}}:hover .tm-sc-funfact',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'funfact_wrapper_border_hover',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}}:hover .tm-sc-funfact',
			]
		);
		$this->add_control(
			'funfact_wrapper_border_theme_colored_hover',
			[
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-funfact' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();









		$this->start_controls_section(
			'other_options',
			[
				'label' => esc_html__( 'Other Options', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_icon_image',
			[
				'label' => esc_html__( "Show Icon/Image", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_counter',
			[
				'label' => esc_html__( "Show Counter", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( "Show Title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
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
		$classes[] = $settings['design_style'];
		$classes[] = $settings['custom_css_class'];
		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'tm-animate-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}
		if( $settings['everything_centered_in_responsive_tablet'] === 'yes' ) {
			$classes[] = 'funfact-centered-in-responsive-tablet';
		}
		if( $settings['everything_centered_in_responsive_mobile'] === 'yes' ) {
			$classes[] = 'funfact-centered-in-responsive-mobile';
		}
		$settings['classes'] = $classes;


		$settings['animation_duration'] = elemental_addons_get_inline_attributes( $settings['counter_duration'], 'data-animation-duration' );


		//counter classes
		$counter_classes = array();
		$counter_classes[] = $settings['counter_custom_css_class'];
		$settings['counter_classes'] = $counter_classes;

		//title classes
		$title_classes = array();
		$title_classes[] = $settings['title_custom_css_class'];
		$settings['title_classes'] = $title_classes;


		wp_register_script( 'jquery-animatenumbers', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.animatenumbers.min.js', array('jquery'), false, true );
		wp_register_script( 'funfact-animate-number', ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/funfact-animate-number.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-animatenumbers' );
		wp_enqueue_script( 'funfact-animate-number' );
		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = elemental_addons_get_widgetcore_template_part( $settings['design_style'], null, 'funfact-counter/tpl', $settings, true );

		\elemental_addons_print_html( $html );
	}
}