<?php
namespace ElementalAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Section_Title extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_script( 'tm-section-title-split-text', ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/section-title-split-text.js', array( 'jquery', 'gsap', 'gsap-scrolltrigger', 'gsap-splittext' ), false, true );
		wp_register_script( 'tm-section-title-text-reveal', ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/section-title-text-reveal.js', array('jquery', 'gsap', 'gsap-scrolltrigger', 'gsap-splittext'), false, true );
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
		return 'tm-ele-section-title';
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
		return esc_html__( 'Section Title', 'elemental-addons' );
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
		return 'eicon-t-letter';
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
		return [ 'elemental-addons-js', 'tm-section-title-split-text' ];
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
			'title_options',
			[
				'label' => esc_html__( 'Title', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => esc_html__( "Title Text", 'elemental-addons' ),
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
				'default' => 'h2',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_appear_animation', [
				'label' => esc_html__( "Appeared Animation", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_animate_css_animation_list(),
			]
		);
		$this->add_control(
			'title_part1_slide_animation', [
				'label' => esc_html__( "On Appeared Slide Animation", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'enable_gsap_text_reveal', [
				'label' => esc_html__( "Enable GSAP Text Reveal Animation", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'gsap_text_reveal_opacity',
			[
				'label' => esc_html__( "Initial Opacity", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 0.3,
				],
				'condition' => [
					'enable_gsap_text_reveal' => 'yes'
				],
			]
		);
		$this->add_control(
			'gsap_text_reveal_x',
			[
				'label' => esc_html__( "Initial X Offset", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'size' => -15,
				],
				'condition' => [
					'enable_gsap_text_reveal' => 'yes'
				],
			]
		);


		$this->add_control(
			'title_other_part',
			[
				'label' => esc_html__( 'Other Parts', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'title_other_text',
			[
				'label' => esc_html__( "Title Text", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);
		$repeater->add_control(
			'title_other_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'title_other_theme_colored',
			[
				'label' => esc_html__( "Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_other_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .title  {{CURRENT_ITEM}}',
			]
		);
		$repeater->add_control(
			'title_other_slide_animation', [
				'label' => esc_html__( "On Appeared Slide Animation", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_wrapper_background',
				'label' => esc_html__( 'Background', 'elemental-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .title  {{CURRENT_ITEM}}',
				'fields_options' => [
					'position' => ['default' => 'bottom center'],
					'repeat' => ['default' => 'no-repeat'],
				],
			]
		);
		$repeater->add_responsive_control(
			'title_bg_img_size',
			[
				'label' => esc_html__( "Background Image Size", 'elemental-addons' ),
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
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => 'background-size: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$repeater->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Text Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
            'stroke_text_width_normal',
            [
                'label' => esc_html__( 'Stroke Width', 'elemental-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 0.1, 'max' => 10 ],
                ],
				'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .title  {{CURRENT_ITEM}}' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$repeater->add_control(
			'stroke_text_color_normal',
			[
				'label' => esc_html__( 'Stroke Color', 'elemental-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'stroke_text_theme_colored',
			[
				'label' => esc_html__( "Stroke Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title  {{CURRENT_ITEM}}' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$repeater->add_control(
			'cursor_mouseover_image', [
				'label' => esc_html__( "Cursor Mouse Over Image", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'link_url',
			[
				'label' => esc_html__( "Link URL", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Paste URL or type', 'elemental-addons' ),
			]
		);
		$this->add_control(
			'title_list',
			[
				'label' => esc_html__( "Title Other Parts", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->add_control(
			'enable_typed_text_effect', [
				'label' => esc_html__( "Enable Typed Text Effect using these parts", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'enable_typed_text_effect_options',
			[
				'label' => esc_html__( 'Typed Text Effect Options', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'enable_typed_text_effect' => array('yes')
				]
			]
		);
		$this->add_control(
			'typed_loop', [
				'label' => esc_html__( "Autotype loop", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'elemental-addons' ),
				'label_on' => __( 'On', 'elemental-addons' ),
				'return_value' => '1',
				'default' => '1',
				'condition' => array(
					'enable_typed_text_effect' => array('yes')
				),
			]
		);
		$this->add_control(
			'typed_cursor', [
				'label' => esc_html__( "Autotype cursor", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'Off', 'elemental-addons' ),
				'label_on' => __( 'On', 'elemental-addons' ),
				'return_value' => '1',
				'default' => '1',
				'condition' => array(
					'enable_typed_text_effect' => array('yes')
				),
			]
		);
		$this->add_control(
			'typed_cursor_char', [
				'label' => esc_html__( "Autotype cursor character", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"default" => esc_html__( '|', 'elemental-addons' ),
				'condition' => array(
					'enable_typed_text_effect' => array('yes')
				),
			]
		);
		$this->add_control(
			'typed_speed',
			[
				'label' => esc_html__( "Autotype speed", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => __('Autotype speed', 'elemental-addons'),
				'condition' => array(
					'enable_typed_text_effect' => array('yes')
				),
				'default' => array(
					'size' => 6
				),
				'step' => 0.5,
				'range' => array(
					'px' => array(
						'min' => 1,
						'max' => 10
					)
				)
			]
		);
		$this->add_control(
			'typed_delay',
			[
				'label' => esc_html__( "Autotype delay (in sec.)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'after',
				'condition' => array(
					'enable_typed_text_effect' => array('yes')
				),
				'default' => array(
					'size' => 2
				),
				'step' => 0.5,
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 10
					)
				)
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_other_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .title  .tm-typed-text-animation-wrapper',
			]
		);
		$this->add_control(
			'title_other_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title  .tm-typed-text-animation-wrapper' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_other_theme_colored',
			[
				'label' => esc_html__( "Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title  .tm-typed-text-animation-wrapper' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'subtitle_options',
			[
				'label' => esc_html__( 'Sub Title', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_subtitle', [
				'label' => esc_html__( "Show Sub Title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'sub_title_text',
			[
				'label' => esc_html__( "Sub Title Text", 'elemental-addons' ),
				"description" => esc_html__( "It will be displayed above/under title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "This is a Sub Title.", 'elemental-addons' ),
				'condition' => [
					'show_subtitle' => array('yes')
				]
			]
		);
		$this->add_control(
			'sub_title_position',
			[
				'label' => esc_html__( "Sub Title Position", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'above-title' => esc_html__( 'Above Title', 'elemental-addons' ),
					'below-title' => esc_html__( 'Below Title', 'elemental-addons' ),
				],
				'default' => 'above-title',
				'condition' => [
					'show_subtitle' => array('yes')
				]
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Sub Title Tag", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'div',
				'condition' => [
					'show_subtitle' => array('yes')
				]
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'paragraph_options',
			[
				'label' => esc_html__( 'Paragraph', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_paragraph', [
				'label' => esc_html__( "Show Paragraph", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
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
			"description" => esc_html__( 'To style particular content element.', 'elemental-addons' ),
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'design_style',
			[
				'label' => esc_html__( "Design Style", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'style1' => esc_html__( 'Style 1 - Default', 'elemental-addons' ),
				],
				'default' => 'style1'
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'horizontal_line_options',
			[
				'label' => esc_html__( 'Horizontal Line Options', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'line_bottom_style',
			[
				'label' => esc_html__( "Horizontal Line Bottom Style", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''	=> 	esc_html__( "No", 'elemental-addons' ),
					'line-left-current-theme'	=> 	esc_html__( "Style Left - Current Theme", 'elemental-addons' ),
					'line-left-current-theme-white'	=> 	esc_html__( "Style Left - Current Theme White", 'elemental-addons' ),
					'line-right-current-theme'	=> 	esc_html__( "Style Right - Current Theme", 'elemental-addons' ),
					'line-right-current-theme-white'	=> 	esc_html__( "Style Right - Current Theme White", 'elemental-addons' ),
					'line-center-current-theme'	=> 	esc_html__( "Style Center - Current Theme", 'elemental-addons' ),
					'line-center-current-theme-white'	=> 	esc_html__( "Style Center White - Current Theme", 'elemental-addons' ),
				],
				'default' => ''
			]
		);
		$this->add_responsive_control(
			'horizontal_line_align',
			[
				'label' => esc_html__('Line Horizontal Alignment', 'elemental-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'elemental-addons'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'elemental-addons'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'elemental-addons'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'horizontal-line-align-',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'vertical_line_align',
			[
				'label' => esc_html__('Line Vertical Alignment', 'elemental-addons'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'bottom',
				'options' => [
					'bottom' => [
						'title' => esc_html__('Bottom', 'elemental-addons'),
						'icon' => 'eicon-v-align-bottom',
					],
					'top' => [
						'title' => esc_html__('Top', 'elemental-addons'),
						'icon' => 'eicon-v-align-top',
					],
				],
				'prefix_class' => 'vertical-line-align-',
				'separator' => 'before',
			]
		);


		$this->start_controls_tabs('horizontal_line_after_style');
		$this->start_controls_tab(
			'horizontal_line_after',
			[
				'label' => esc_html__('After', 'elemental-addons'),
			]
		);
		$this->add_control(
			'horizontal_line_after_bg_color',
			[
				'label' => esc_html__( "Color (After)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-wrapper:after' => 'background-color: {{VALUE}};'
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'horizontal_line_after_bgtheme_colored',
			[
				'label' => esc_html__( "Theme Color (After)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-wrapper:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'horizontal_line_before',
			[
				'label' => esc_html__('Before', 'elemental-addons'),
			]
		);
		$this->add_control(
			'horizontal_line_before_bg_color',
			[
				'label' => esc_html__( "Color (Before)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-wrapper:before' => 'background-color: {{VALUE}};'
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'horizontal_line_before_bgtheme_colored',
			[
				'label' => esc_html__( "Theme Color (Before)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-wrapper:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();



		$this->start_controls_section(
			'title_icon_options',
			[
				'label' => esc_html__( 'Title Icon', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_title_icon',
			[
				'label' => esc_html__( "Show Title Icon?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_responsive_control(
			'title_icon_position',
			[
				'label' => esc_html__( "Icon Position", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-top' => esc_html__( 'Top', 'elemental-addons' ),
					'icon-left'  => esc_html__( 'Left of Subtitle', 'elemental-addons' ),
				],
				'default' => 'icon-top',
				'condition' => [
					'show_title_icon' => array('yes')
				]
			]
		);
		$this->add_control(
			'title_icon',
			[
				'label' => esc_html__( "Title Icon", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'show_title_icon' => array('yes')
				]
			]
		);
		$this->add_control(
			'title_icon_custom_size',
			[
				'label' => esc_html__( "Icon Custom Width", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'condition' => [
					'show_title_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .title-icon' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_title_icon' => array('yes')
				]
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'title_options_styling',
			[
				'label' => esc_html__( 'Title Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
				'label' => esc_html__( "Title Text Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .title' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .title' => 'color: var(--theme-color{{VALUE}});'
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
					'{{WRAPPER}}:hover .title' => 'color: var(--theme-color{{VALUE}});'
				],
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
			'title_margin_top',
			[
				'label' => esc_html__( "Margin Top", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'title_margin_bottom',
			[
				'label' => esc_html__( "Margin Bottom", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'title_bg_wrapper_options',
			[
				'label' => esc_html__( 'Title Background Image Options', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'title_bg_wrapper_background',
				'label' => esc_html__( 'Background', 'elemental-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .title',
				'fields_options' => [
					'position' => ['default' => 'bottom center'],
					'repeat' => ['default' => 'no-repeat'],
				],
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'subtitle_options_styling',
			[
				'label' => esc_html__( 'Sub Title Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Sub Title Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_control(
			'subtitle_text_color_hover',
			[
				'label' => esc_html__( "Sub Title Text Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-section-title .subtitle' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Sub Title Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'subtitle_theme_colored_hover',
			[
				'label' => esc_html__( "Sub Title Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-section-title .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-section-title .subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Sub Title Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_margin_top',
			[
				'label' => esc_html__( "Margin Top", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'subtitle_margin_bottom',
			[
				'label' => esc_html__( "Margin Bottom", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'subtitle_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'subtitle_wrapper_background',
				'label' => esc_html__( 'Background', 'elemental-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-section-title .title-wrapper .sub-title-outer .subtitle',
				'fields_options' => [
					'position' => ['default' => 'center center'],
					'repeat' => ['default' => 'no-repeat'],
				],
			]
		);
		$this->add_control(
			'subtitle_wrapper_bg_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'subtitle_wrapper_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-section-title .subtitle' =>
						'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();









		$this->start_controls_section(
			'title_shadow_text_options',
			[
				'label' => esc_html__( 'Title Shadow Text', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title_shadow_text',
			[
				'label' => esc_html__( "Title Shadow Text", 'elemental-addons' ),
				"description" => esc_html__( "It will be displayed behind the title as a big blurred gray text", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'shadow_text_enable_textillate_animation',
			[
				'label' => esc_html__( "Enable Text Textillate Animation on Text?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'title_shadow_options_styling',
			[
				'label' => esc_html__( 'Title Shadow Text Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .title .title-shadow-text',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .title .title-shadow-text',
			]
		);
		$this->add_control(
			'title_shadow_text_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_shadow_text_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .title .title-shadow-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_shadow_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_shadow_text_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .title .title-shadow-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'title_shadow_text_width',
			[
				'label' => esc_html__( "Text Container Width", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_shadow_text_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .title .title-shadow-text',
			]
		);


		$this->add_control(
			'title_shadow_text_pos_options',
			[
				'label' => esc_html__( 'Position', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_shadow_text_orientation_horizontal',
			[
				'label' => __( 'Horizontal Orientation', 'elemental-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => is_rtl() ? 'right' : 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elemental-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'elemental-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'title_shadow_text_orientation_offset_x',
			[
				'label' => __( 'Offset', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -600,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' =>
							'{{title_shadow_text_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_shadow_text_orientation_vertical',
			[
				'label' => __( 'Vertical Orientation', 'elemental-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'elemental-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'elemental-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'title_shadow_text_orientation_offset_y',
			[
				'label' => __( 'Offset', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -600,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title .title-shadow-text' =>
							'{{title_shadow_text_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_shadow_text_opacity_options',
			[
				'label' => esc_html__( 'Opacity Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_shadow_text_opacity',
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
					'{{WRAPPER}} .title .title-shadow-text' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'paragraph_options_styling',
			[
				'label' => esc_html__( 'Paragraph Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'paragraph_color',
			[
				'label' => esc_html__( "Paragraph Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .paragraph' => 'color: {{VALUE}};',
					'{{WRAPPER}} .paragraph *' => 'color: {{VALUE}};'
				],
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_control(
			'paragraph_color_hover',
			[
				'label' => esc_html__( "Paragraph Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .paragraph' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .paragraph *' => 'color: {{VALUE}};'
				],
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_control(
			'paragraph_theme_colored',
			[
				'label' => esc_html__( "Paragraph Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .paragraph' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .paragraph *' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'paragraph_theme_colored_hover',
			[
				'label' => esc_html__( "Paragraph Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .paragraph' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .paragraph *' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'paragraph_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .paragraph, {{WRAPPER}} .paragraph *',
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'bg_wrapper_options',
			[
				'label' => esc_html__( 'Wrapper Background Options', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'bg_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bg_wrapper_margin',
			[
				'label' => esc_html__( 'Wrapper Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bg_wrapper_background',
				'label' => esc_html__( 'Background', 'elemental-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .elementor-widget-container',
				'fields_options' => [
					'position' => ['default' => 'center center'],
					'repeat' => ['default' => 'no-repeat'],
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
		$settings = $this->get_settings_for_display();
		$settings['title_mouse_helper'] = $this->get_render_attribute_string('title');
		//classes
		$classes = array();

		if( $settings['line_bottom_style'] ) {
			$classes[] = $settings['line_bottom_style'];
		}
		if( $settings['title_icon_position'] ) {
			$classes[] = 'title-icon-pos-'.$settings['title_icon_position'];
		}
		$classes[] = $settings['custom_css_class'];
		$settings['classes'] = $classes;


		//title classes
		$title_classes = array();
		if( isset($settings['title_appear_animation']) && !empty($settings['title_appear_animation']) ) {
			$title_classes[] = $settings['title_appear_animation'];
			wp_enqueue_script( 'gsap' );
			wp_enqueue_script( 'gsap-scrolltrigger' );
			wp_enqueue_script( 'gsap-splittext' );
		}
		if( isset($settings['enable_gsap_text_reveal']) && $settings['enable_gsap_text_reveal'] == 'yes' ) {
			$title_classes[] = 'tm-text-reveal';
			wp_enqueue_script( 'gsap' );
			wp_enqueue_script( 'gsap-scrolltrigger' );
			wp_enqueue_script( 'gsap-splittext' );
			wp_enqueue_script( 'tm-section-title-text-reveal' );
		}
		$settings['title_classes'] = $title_classes;


		$title_part1_classes = array();
		if( $settings['title_part1_slide_animation'] == "yes" ) {
			$title_part1_classes[] = 'tm-onappear-slide-animation';
		}
		$settings['title_part1_classes'] = $title_part1_classes;


		$settings['holder_id'] = \elemental_addons_get_isotope_holder_ID('typed');
		if( $settings['enable_typed_text_effect'] == "yes" ) {
			wp_enqueue_script( 'typed', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/typed.min.js', array('jquery'), false, true );
			wp_enqueue_script( 'typed-custom', ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/typed-custom.js', array('typed'), false, true );
		}


		//sub title classes
		$sub_title_classes = array();
		$settings['sub_title_classes'] = $sub_title_classes;


		//title_shadow_text classes
		$title_shadow_text_class = array();
		if ( $settings['shadow_text_enable_textillate_animation'] == 'yes' ) {
			wp_enqueue_script( 'jquery-lettering' );
			wp_enqueue_script( 'jquery-textillate' );
			$title_shadow_text_class[] = 'tm-textillate-animation';
		}
		$settings['title_shadow_text_class'] = $title_shadow_text_class;


		$html = elemental_addons_get_widgetcore_template_part( 'section-title-' . $settings['design_style'], null, 'section-title/tpl', $settings, true );

		\elemental_addons_print_html( $html );
	}
}