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
class TM_Elementor_Animated_Layers extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-animated-layer-advanced-style', ELEMENTAL_ADDONS_ASSETS_URI . '/css/widgets-core/animated-layer-advanced' . $direction_suffix . '.css' );
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
		return 'tm-ele-animated-layers';
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
		return esc_html__( 'Animated Layers', 'elemental-addons' );
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
		return [ 'tm-animated-layer-advanced-style' ];
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
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'parent_image_animation_effect', [
				'label' => esc_html__( "On Appeared Animation Effect", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_custom_animation_class_list(),
			]
		);
		$this->add_control(
			'parent_animation_type', [
				'label' => esc_html__( "Floating Animation Type", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_get_animation_type(),
				'default' => ''
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'display_type', [
				'label' => esc_html__( "Layer Type", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'layer-image' =>  esc_html__( 'Image Layer', 'elemental-addons' ),
					'layer-text'  =>  esc_html__( 'Text Layer', 'elemental-addons' ),
					'layer-blank'  =>  esc_html__( 'Blank Layer', 'elemental-addons' ),
					'layer-animated-icon'  =>  esc_html__( 'Animated Icon', 'elemental-addons' ),
					'layer-play-btn'  =>  esc_html__( 'Video Play Button', 'elemental-addons' ),
				],
				'default' => 'layer-image'
			]
		);

		//play btn
		$repeater->add_control(
			'play_btn_options',
			[
				'label' => esc_html__( 'Play Button Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'display_type' => array('layer-play-btn')
				]
			]
		);
		$repeater->add_control(
			'play_btn_style', [
				'label' => esc_html__( "Video Play Button Style", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' =>  esc_html__( 'Default - CSS Animated', 'elemental-addons' ),
					'style-black'  =>  esc_html__( 'Style - Black', 'elemental-addons' ),
				],
				'default' => 'style-black',
				'condition' => [
					'display_type' => array('layer-play-btn')
				]
			]
		);
		$repeater->add_control(
			'video_url', [
				'label' => esc_html__( "Youtube Video URL", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'https://www.youtube.com/watch?v=Tb1HsAGy-ls',
				'condition' => [
					'display_type' => array('layer-play-btn')
				]
			]
		);
		$repeater->add_control(
			'play_btn_bg_options',
			[
				'label' => esc_html__( 'Background Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
			]
		);
		$repeater->add_control(
			'play_btn_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '1',
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .video-play-button' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$repeater->add_control(
			'play_btn_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .video-play-button:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$repeater->add_control(
			'play_btn_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .video-play-button' => 'background-color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'play_btn_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .video-play-button:hover' => 'background-color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'separator' => 'before',
				'default' => '',
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .video-play-button .icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$repeater->add_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .video-play-button:hover .icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$repeater->add_control(
			'icon_custom_color',
			[
				'label' => esc_html__( "Icon Custom Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .video-play-button .icon' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'icon_custom_color_hover',
			[
				'label' => esc_html__( "Icon Custom Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .video-play-button:hover .icon' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'separator' => 'before',
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .video-play-button .icon',
			]
		);
		$repeater->add_responsive_control(
			'play_btn_width',
			[
				'label' => esc_html__( 'Play Button Dimension', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 600,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'condition' => [
					'display_type' => array('layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .video-play-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);






		$repeater->add_responsive_control(
			'display_visibility',
			[
				'label' => esc_html__( "Visibility (Show/Hide)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => [
					'block' =>  esc_html__( 'Show', 'elemental-addons' ),
					'none'  =>  esc_html__( 'Hide', 'elemental-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'display: {{VALUE}};'
				]
			]
		);

		//text
		$repeater->add_control(
			'image_wrapper_custom_css_class',
			[
				'label' => esc_html__( "Parent Wrapper Custom CSS class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "To style particular content element.", 'elemental-addons' ),
				'condition' => [
					'display_type' => array('layer-text')
				]
			]
		);





		$repeater->add_control(
			'animation_options',
			[
				'label' => esc_html__( 'Animation Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_control(
			'image_clip_path_animation',
			[
				'label' => esc_html__( "Clip Path Appear Animation", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' =>  esc_html__( 'No Animation', 'elemental-addons' ),
					'tm-item-appear-clip-path'  =>  esc_html__( 'Clip Path Animation', 'elemental-addons' ),
					'tm-item-appear-clip-path-right'  =>  esc_html__( 'Clip Path Animation Right to Left', 'elemental-addons' ),
					'tm-appear-block-holder'  =>  esc_html__( 'Block Clip Path Animation', 'elemental-addons' ),
				],
			]
		);
		$repeater->add_control(
			'image_animation_effect', [
				'label' => esc_html__( "Appeared Animation Effect", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_custom_animation_class_list(),
			]
		);
		$repeater->add_control(
			'animation_type', [
				'label' => esc_html__( "Floating Animation Type", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_get_animation_type(),
				'default' => ''
			]
		);
		$repeater->add_control(
			'animation_animation_speed',
			[
				'label' => esc_html__( 'Floating Animation Duration(s) (High-Low)', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 60,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-inner' => 'animation-duration: {{SIZE}}s;',
				],
			]
		);
		$repeater->add_control(
			'image_hover_effect', [
				'label' => esc_html__( "Image Hover Effect", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' =>  esc_html__( 'No Effect', 'elemental-addons' ),
					'effect-shine' =>  esc_html__( 'Shine Effect', 'elemental-addons' ),
					'effect-circle'  =>  esc_html__( 'Circle Effect', 'elemental-addons' ),
					'effect-grayscale'  =>  esc_html__( 'Gray Scale Effect', 'elemental-addons' ),
					'effect-sepia'  =>  esc_html__( 'Sepia Effect', 'elemental-addons' ),
				],
				'default' => 'effect-shine',
				'condition' => [
					'display_type' => array('layer-image')
				]
			]
		);



		//image
		$repeater->add_control(
			'image', [
				'label' => esc_html__( "Image", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'display_type' => array('layer-image')
				]
			]
		);
		$repeater->add_control(
			'image_size', [
				'label' => esc_html__( "Image Size", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_get_available_image_sizes(),
				'default' => 'full',
				'condition' => [
					'display_type' => array('layer-image')
				]
			]
		);
		$repeater->add_control(
			'main_parent_wrapper_custom_css_class',
			[
				'label' => esc_html__( "Main Parent Wrapper Custom CSS class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "To style particular content element.", 'elemental-addons' ),
				'condition' => [
					'display_type' => array('layer-image')
				]
			]
		);
		$repeater->add_control(
			'image_parent_custom_css_class',
			[
				'label' => esc_html__( "Image Parent Custom CSS class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "To style particular content element.", 'elemental-addons' ),
				'condition' => [
					'display_type' => array('layer-image')
				]
			]
		);
		$repeater->add_control(
			'image_custom_css_class',
			[
				'label' => esc_html__( "Image Custom CSS class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "To style particular content element.", 'elemental-addons' ),
				'condition' => [
					'display_type' => array('layer-image')
				]
			]
		);








		//animated icon
		$repeater->add_control(
			'animated_icon', [
				'label' => esc_html__( "Icon", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'display_type' => array('layer-animated-icon')
				]
			]
		);
		$repeater->add_control(
			'animated_icon_hover', [
				'label' => esc_html__( "Hover Icon", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'display_type' => array('layer-animated-icon')
				]
			]
		);
		$repeater->add_control(
			'animated_icon_bg_color',
			[
				'label' => esc_html__( "Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-animated-icon')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-animated-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'animated_icon_bg_color_hover',
			[
				'label' => esc_html__( "Background Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-animated-icon')
				],
				'selectors' => [
					'{{WRAPPER}}:hover {{CURRENT_ITEM}} .layer-animated-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'animated_icon_bg_theme_color',
			[
				'label' => esc_html__( "Background Theme Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'condition' => [
					'display_type' => array('layer-animated-icon')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-animated-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$repeater->add_control(
			'animated_icon_bg_theme_color_hover',
			[
				'label' => esc_html__( "Background Theme Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'condition' => [
					'display_type' => array('layer-animated-icon')
				],
				'selectors' => [
					'{{WRAPPER}}:hover {{CURRENT_ITEM}} .layer-animated-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);











		//commom
		$repeater->add_control(
			'hr2-marginpadding',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_control(
			'padding_margin_options',
			[
				'label' => esc_html__( 'Padding/Margin Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'display_type!' => array('layer-animated-icon','layer-play-btn')
				],
			]
		);
		$repeater->add_responsive_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'display_type!' => array('layer-animated-icon','layer-play-btn')
				],
			]
		);
		$repeater->add_responsive_control(
			'margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'display_type!' => array('layer-animated-icon','layer-play-btn')
				],
			]
		);
		$repeater->add_control(
			'hr2-pos',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_control(
			'pos_options',
			[
				'label' => esc_html__( 'Postion Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_control(
			'layer_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_responsive_control(
			'layer_orientation_vertical',
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
		$repeater->add_responsive_control(
			'layer_orientation_offset_y',
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
					'{{WRAPPER}} {{CURRENT_ITEM}}' =>
							'{{layer_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'layer_orientation_horizontal',
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
		$repeater->add_responsive_control(
			'layer_orientation_offset_x',
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
					'{{WRAPPER}} {{CURRENT_ITEM}}' =>
							'{{layer_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'elemental-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => elemental_addons_text_align_choose(),
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'carousel_arrow_nav_pos_center', [
				'label' => esc_html__( "Box Position Horizontal Vertical Center", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: 50%;top: 50%; transform: translate(-50%, -50%);'
				],
			]
		);
		$repeater->add_control(
			'vertical_align',
			[
				'label' => esc_html__( "Content Display Flex + Vertical Center?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'display: flex; align-items: center; justify-content: center;',
					'{{WRAPPER}} {{CURRENT_ITEM}} > *' => 'display: flex; align-items: center; justify-content: center;'
				]
			]
		);
		$repeater->add_control(
			'hr2-dimension',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_control(
			'dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'display_type!' => array('layer-animated-icon','layer-play-btn')
				],
			]
		);
		$repeater->add_control(
			'make_item_fullwidth', [
				'label' => esc_html__( "Make this Item Fullwidth?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'display_type' => array('layer-image')
				]
			]
		);
		$repeater->add_control(
			'make_item_maxwidth_100p', [
				'label' => esc_html__( "Make Image Max Width 100%?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'display_type' => array('layer-image')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-image' => 'max-width: 100%;'
				]
			]
		);
		$repeater->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 130,
					],
					'px' => [
						'min' => 1,
						'max' => 600,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'display_type!' => array('layer-animated-icon','layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} > *' => 'width: 100%;',
				],
			]
		);

		$repeater->add_responsive_control(
			'space',
			[
				'label' => esc_html__( 'Max Width', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 130,
					],
					'px' => [
						'min' => 1,
						'max' => 600,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'display_type!' => array('layer-animated-icon','layer-play-btn')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'max-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} > *' => 'max-width: 100%;',
				],
			]
		);

		$repeater->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 130,
					],
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'display_type!' => array('layer-animated-icon','layer-play-btn','layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'height_layer_text',
			[
				'label' => esc_html__( 'Height', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 130,
					],
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .layer-inner' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'height_wrapper',
			[
				'label' => esc_html__( 'Wrapper Height', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 130,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$repeater->add_control(
			'hr2-border',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} > *' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( "Border", 'elemental-addons' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} > *',
			]
		);
		$repeater->add_responsive_control(
			'border_theme_colored', [
				'label' => esc_html__( "Border Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}  {{CURRENT_ITEM}} > *' => 'border-color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$repeater->add_control(
			'wrapper_overflow_hidden',
			[
				'label' => esc_html__( "Make Item Overflow Hidden", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'overflow: hidden;',
					'{{WRAPPER}} {{CURRENT_ITEM}} > *' => 'overflow: hidden;'
				]
			]
		);


		$repeater->add_control(
			'hr4-rotate_options',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'display_type' => array('layer-text')
				],
			]
		);
		$repeater->add_control(
			'text_rotate_options_options',
			[
				'label' => esc_html__( 'Rotate Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_responsive_control(
			'rotate_text',
			[
				'label' => esc_html__( 'Rotate', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'range' => [
					'deg' => [
						'min' => -90,
						'max' => 90,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}} {{CURRENT_ITEM}}' => '-ms-transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}} {{CURRENT_ITEM}}' => '-webkit-transform: rotate({{SIZE}}deg);',
				],
			]
		);




		$repeater->add_control(
			'hr1-bg_img_overlay',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'display_type' => array('layer-text')
				],
			]
		);
		$repeater->add_control(
			'text_layer_bg_image_options',
			[
				'label' => esc_html__( 'Background Image Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'display_type' => array('layer-text')
				],
			]
		);
		$repeater->add_control(
			'text_layer_bg_image', [
				'label' => esc_html__( "Background Image", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'z-index: 1;'
				]
			]
		);
		$repeater->add_control(
			'bg_img_overlay_color',
			[
				'label' => esc_html__( "Background Image Overlay Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'z-index: 1;',
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' => 'background-color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'bg_img_overlay_color_hover',
			[
				'label' => esc_html__( "Background Image Overlay Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'z-index: 1;',
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover:after' => 'background-color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'bg_img_overlay_theme_color',
			[
				'label' => esc_html__( "BG Image Overlay Theme Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'z-index: 1;',
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' => 'background-color: rgba(var(--theme-color{{VALUE}}-rgb), 0.9);;'
				],
			]
		);
		$repeater->add_control(
			'bg_img_overlay_theme_color_hover',
			[
				'label' => esc_html__( "BG Image Overlay Theme Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'z-index: 1;',
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover:after' => 'background-color: rgba(var(--theme-color{{VALUE}}-rgb), 0.9);;'
				],
			]
		);
		$repeater->add_control(
			'hr2-bg_img_overlay_theme_colored',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'display_type' => array('layer-text')
				],
			]
		);
		$repeater->add_control(
			'bg_theme_colored_options',
			[
				'label' => esc_html__( 'Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'display_type' => array('layer-text', 'layer-blank')
				],
			]
		);
		$repeater->add_control(
			'bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'condition' => [
					'display_type' => array('layer-text', 'layer-blank')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} > *' => 'background-color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$repeater->add_control(
			'bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'condition' => [
					'display_type' => array('layer-text', 'layer-blank')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover > *' => 'background-color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$repeater->add_control(
			'custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-text', 'layer-blank')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} > *' => 'background-color: {{VALUE}};',
				]
			]
		);
		$repeater->add_control(
			'custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-text', 'layer-blank')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover > *' => 'background-color: {{VALUE}};',
				]
			]
		);
		$repeater->add_control(
			'hr3-bg_img_overlay_other',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);
		$repeater->add_control(
			'icon_bg_img_opacity',
			[
				'label' => esc_html__( 'Opacity', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'opacity: {{SIZE}};'
				]
			]
		);
		$repeater->add_control(
			'z_index',
			[
				'label' => esc_html__( "Z Index", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'z-index: {{VALUE}};'
				]
			]
		);


		$repeater->add_control(
			'hr4-bg_paragraph',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$repeater->add_control(
			'content_color_options',
			[
				'label' => esc_html__( 'Paragraph Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'display_type' => array('layer-text')
				],
			]
		);
		$repeater->add_control(
			'content_color',
			[
				'label' => esc_html__( "Paragraph Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} *' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'content_color_hover',
			[
				'label' => esc_html__( "Paragraph Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}}:hover *' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Paragraph Typography', 'elemental-addons' ),
				'condition' => [
					'display_type' => array('layer-text')
				],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}, {{WRAPPER}} {{CURRENT_ITEM}} *'
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Paragraph", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Write a short description.", 'elemental-addons' ),
				'condition' => [
					'display_type' => array('layer-text')
				]
			]
		);








		$this->add_control(
			'animated_layer_images',
			[
				'label' => esc_html__( "Animated Layer Images", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				//'title_field' => esc_html__('Each Animated Layer Image'),
				'title_field' => '{{{ display_type }}}',
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
		$html = '';
		//classes
		$classes = array();
		$classes[] = 'tm-sc-animated-layer-advanced';
		$classes[] = $settings['custom_css_class'];
		if( $settings['parent_image_animation_effect'] ) {
			$classes[] = $settings['parent_image_animation_effect'];
		}
		if( $settings['parent_animation_type'] ) {
			$classes[] = $settings['parent_animation_type'];
		}
		$settings['classes'] = $classes;
	?>
		<div class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
			<div class="animated-layer-advanced-inner clearfix">
	<?php
		if ( $settings['animated_layer_images'] ) {
			foreach (  $settings['animated_layer_images'] as $item ) {
				$item['wrapper_inline_css'] = elemental_addons_animated_layer_wrapper_inline_css( $item );
				$item['settings'] = $settings;
				$item['item'] = $item;
				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
				$html .= elemental_addons_get_widgetcore_template_part( $item['display_type'], null, 'animated-layers/tpl', $item, true );
			}
		}
		\elemental_addons_print_html( $html );
	?>
			</div>
			<div class="clearfix"></div>
		</div>
	<?php
	}
}

if(!function_exists('elemental_addons_animated_layer_wrapper_inline_css')) {
	/**
	 * Get Wrapper Styles
	 */
	function elemental_addons_animated_layer_wrapper_inline_css( $params ) {
		$css_array = array();

		if( isset($params['text_layer_bg_image']['url']) && $params['text_layer_bg_image']['url'] != '' ) {
			$css_array[] = 'background-image: url('.$params['text_layer_bg_image']['url'].')';
		}
		return implode( '; ', $css_array );
	}
}