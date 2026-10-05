<?php
namespace ElementalAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Clients_logo extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-clients-logo-style', ELEMENTAL_ADDONS_ASSETS_URI . '/css/widgets-core/clients-logo' . $direction_suffix . '.css' );
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
		return 'tm-ele-clients-logo';
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
		return esc_html__( 'Clients Logo', 'elemental-addons' );
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
		return [ 'tm-clients-logo-style' ];
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
			'tm_items_section',
			[
				'label' => esc_html__( 'Items', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();
		//image
		$repeater->add_control(
			'logo', [
				'label' => esc_html__( "Logo", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'logo_url',
			[
				'label' => esc_html__( "URL", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'link_target', [
				'label' => esc_html__( "Link Target", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'_blank'  =>  esc_html__( 'Opens in a new window or tab', 'elemental-addons' ),
					'_self' =>  esc_html__( 'Opens in the same window', 'elemental-addons' ),
				],
				'default' => '_blank'
			]
		);
		$this->add_control(
			'clients_logo_array',
			[
				'label' => esc_html__( "Clients Logo", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'logo' => Utils::get_placeholder_image_src(),
						'logo_url' => '',
					],
					[
						'logo' => Utils::get_placeholder_image_src(),
						'logo_url' => '',
					],
					[
						'logo' => Utils::get_placeholder_image_src(),
						'logo_url' => '',
					],
					[
						'logo' => Utils::get_placeholder_image_src(),
						'logo_url' => '',
					],
					[
						'logo' => Utils::get_placeholder_image_src(),
						'logo_url' => '',
					],
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'tm_general',
			[
				'label' => esc_html__( 'General', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'display_type', [
				'label' => esc_html__( "Display Type", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'grid'  =>  esc_html__( 'Grid', 'elemental-addons' ),
					'carousel' =>  esc_html__( 'Carousel/Slider', 'elemental-addons' ),
				],
				'default' => 'grid',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'columns', [
				'label' => esc_html__( "Columns Layout", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1col'  =>  '1 Col',
					'2col'  =>  '2 Col',
					'3col'  =>  '3 Col',
					'4col'  =>  '4 Col',
					'5col'  =>  '5 Col',
					'6col'  =>  '6 Col',
				],
				'default' => '5col',
				'condition' => [
					'display_type' => array('grid')
				],
			]
		);
		$this->add_control(
			'hover_animation_type',
			[
				'label' => esc_html__( "Hover Animation Type", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'clients-animation-no-effect' =>  esc_html__( 'No Effect', 'elemental-addons' ),
					'clients-animation-grayscale' =>  esc_html__( 'Grayscale Effect', 'elemental-addons' ),
					'clients-animation-opacity' =>  esc_html__( 'Opacity Effect', 'elemental-addons' ),
					'clients-animation-blur'  =>  esc_html__( 'Blur Effect', 'elemental-addons' ),
					'clients-animation-zoom'  =>  esc_html__( 'Zoom Effect', 'elemental-addons' ),
					'clients-animation-contrast'  =>  esc_html__( 'Contrast Effect', 'elemental-addons' ),
					'clients-animation-invert'  =>  esc_html__( 'Invert Effect', 'elemental-addons' ),
				],
				'default' => 'clients-animation-grayscale',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'rollover_effect',
			[
				'label' => esc_html__( "Make Roll Over Effect", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'logo_filter_options',
			[
				'label' => esc_html__( 'Filter Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'logo_filter_white',
			[
				'label' => esc_html__( 'Filter Logo to White', 'elemental-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo .thumb' => 'filter:brightness(0) invert(1);',
				],
			]
		);
		$this->add_control(
			'logo_filter_white_hover',
			[
				'label' => esc_html__( 'Filter Logo to White (Hover)', 'elemental-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo .thumb:hover' => 'filter:brightness(0) invert(1);',
				],
			]
		);
		$this->add_control(
			'logo_filter_black',
			[
				'label' => esc_html__( 'Filter Logo to Black', 'elemental-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo .thumb' => 'filter:brightness(0) invert(0);',
				],
			]
		);
		$this->add_control(
			'logo_filter_black_hover',
			[
				'label' => esc_html__( 'Filter Logo to Black (Hover)', 'elemental-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo .thumb:hover' => 'filter:brightness(0) invert(0);',
				],
			]
		);
		$this->end_controls_section();





		//Swiper Slider Options
		elemental_addons_get_swiper_slider_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		elemental_addons_get_swiper_slider_nav_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		elemental_addons_get_swiper_slider_dots_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );



		$this->start_controls_section(
			'each_logo_styling',
			[
				'label' => esc_html__( 'Each Logo Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'each_logo_flex_vertical',
			[
				'label' => esc_html__( "Logo Vertical Alignment", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo' => 'display:flex; align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'each_logo_flex_horizontal',
			[
				'label' => esc_html__( "Logo Horizontal Alignment", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'column_gap',
			[
				'label' => esc_html__( 'Column Gap', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo' => 'column-gap: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'each_logo_area_custom_width',
			[
				'label' => esc_html__( "Logo Area Custom Width", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'each_logo_img_custom_width',
			[
				'label' => esc_html__( "Logo/Image Custom Width", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'each_logo_margin',
			[
				'label' => esc_html__( 'Block Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'each_logo_padding',
			[
				'label' => esc_html__( 'Block Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'each_logo_border_radius',
			[
				'label' => esc_html__( "Block Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);


		$this->start_controls_tabs('tabs_title_block_style');
		$this->start_controls_tab(
			'each_logo_style_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'each_logo_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-clients-logo .each-logo',
			]
		);
		$this->add_control(
			'each_logo_border_color_options',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'each_logo_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-clients-logo .each-logo',
			]
		);
		$this->add_responsive_control(
			'each_logo_border_theme_colored', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_control(
			'each_logo_bg_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'each_logo_bg_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'each_logo_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'logo_opacity_options',
			[
				'label' => esc_html__( 'Opacity Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'opacity',
			[
				'label' => esc_html__( 'Opacity', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo .thumb' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'each_logo_style_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'each_logo_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-clients-logo .each-logo:hover',
			]
		);
		$this->add_control(
			'each_logo_border_color_options_hover',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'each_logo_border_hover',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-clients-logo .each-logo:hover',
			]
		);
		$this->add_responsive_control(
			'each_logo_border_theme_colored_hover', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo:hover' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_control(
			'each_logo_bg_color_options_hover',
			[
				'label' => esc_html__( 'BG Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'each_logo_bg_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo:hover' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'each_logo_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'logo_opacity_options_hover',
			[
				'label' => esc_html__( 'Opacity Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'hover_opacity',
			[
				'label' => esc_html__( 'Opacity', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo .thumb:hover, {{WRAPPER}} .tm-sc-clients-logo .each-logo .thumb-hover:hover' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'each_logo_style_first',
			[
				'label' => esc_html__('First Child', 'elemental-addons'),
			]
		);
		$this->add_control(
			'each_logo_border_color_options_first',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'each_logo_border_first',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-clients-logo .each-logo:first-child',
			]
		);
		$this->add_responsive_control(
			'each_logo_border_theme_colored_first', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo:first-child' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'each_logo_style_last',
			[
				'label' => esc_html__('Last Child', 'elemental-addons'),
			]
		);
		$this->add_control(
			'each_logo_border_color_options_last',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'each_logo_border_last',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-clients-logo .each-logo:last-child',
			]
		);
		$this->add_responsive_control(
			'each_logo_border_theme_colored_last', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-clients-logo .each-logo:last-child' => 'border-color: var(--theme-color{{VALUE}}) !important;'
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
		$settings = $this->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = $settings['hover_animation_type'];
		if( $settings['rollover_effect'] == 'yes' ) {
			$classes[] = 'clients-animation-rollover';
		}
		if( $settings['display_type'] == 'grid' ) {
			$classes[] = 'grid-' . $settings['columns'];
		}
		$settings['classes'] = $classes;

		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = elemental_addons_get_widgetcore_template_part( 'clients', $settings['display_type'], 'clients-logo/tpl', $settings, true );

		\elemental_addons_print_html( $html );
	}
}
