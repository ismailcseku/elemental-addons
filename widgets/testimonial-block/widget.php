<?php
namespace ElementalAddons\Widgets\TestimonialBlock;

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
class TM_Elementor_TestimonialBlock extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'tm-testimonial-block-loader', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/testimonial-block/testimonial-block-loader' . $direction_suffix . '.css' );
		}
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
		return 'elemental-testimonial-block';
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
		return esc_html__( 'Testimonial Block', 'elemental-addons' );
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
		return [ 'elemental-addons-js', 'elemental-addons-isotope' ];
	}


	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Style1( $this ) );
		$this->add_skin( new Skins\Skin_Style2( $this ) );
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
			'testimonial_icons_options', [
				'label' => esc_html__( 'Testimonial Items', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'name',
			[
				'label' => esc_html__( "Author Name", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "David Smith", 'elemental-addons' ),
			]
		);
		$repeater->add_control(
			'position',
			[
				'label' => esc_html__( "Author Position", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Designer", 'elemental-addons' ),
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Reason/Title (Optional)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'rating',
			[
				'label' => esc_html__( 'Rating Value', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Testimonial Text", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Write a short description, that will describe the title or something informational and useful.", 'elemental-addons' ),
			]
		);
		$repeater->add_control(
			'feature_image',
			[
				'label' => esc_html__( "Author Thumbnail Image", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$repeater->add_control(
			'feature_image_size',
			[
				'label' => esc_html__( "Choose Thumbnail Image Size", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_get_available_image_sizes(),
				'default' => 'full',
			]
		);
		$repeater->add_control(
			'section_effects',
			[
				'label' => esc_html__( 'Motion Effects', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'wow_appear_animation',
			[
				'label' => esc_html__( "Wow Appear Animation", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_animate_css_animation_list(),
			]
		);
		$repeater->add_control(
			'wow_animation_delay',
			[
				'label' => esc_html__( 'Animation Delay', 'elemental-addons' ) . ' (ms)',
				'type' => Controls_Manager::NUMBER,
				'default' => '',
				'min' => 0,
				'step' => 100,
				'condition' => [
					'wow_appear_animation!' => '',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'testimonial_items_array',
			[
				'label' => esc_html__( "Testimonial Items", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Title #1', 'elemental-addons' ),
						'position' => esc_html__( 'position #1', 'elemental-addons' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'elemental-addons' ),
						'count' => esc_html__( '01', 'elemental-addons' ),
					],
					[
						'title' => esc_html__( 'Title #2', 'elemental-addons' ),
						'position' => esc_html__( 'Title #2', 'elemental-addons' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'elemental-addons' ),
						'count' => esc_html__( '02', 'elemental-addons' ),
					],
					[
						'title' => esc_html__( 'Title #3', 'elemental-addons' ),
						'position' => esc_html__( 'Title #3', 'elemental-addons' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'elemental-addons' ),
						'count' => esc_html__( '03', 'elemental-addons' ),
					],
				],
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
			'display_type', [
				'label' => esc_html__( "Display Type", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'grid'  =>  esc_html__( 'Grid', 'elemental-addons' ),
					'masonry' =>  esc_html__( 'Masonry', 'elemental-addons' ),
					'carousel'  =>  esc_html__( 'Carousel/Slider', 'elemental-addons' ),
					'basic'  =>  esc_html__( 'Basic', 'elemental-addons' )
				],
				'default' => 'grid'
			]
		);
		$this->add_control(
			'columns', [
				'label' => esc_html__( "Columns Layout", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  =>  '1',
					'2'  =>  '2',
					'3'  =>  '3',
					'4'  =>  '4',
					'5'  =>  '5',
					'6'  =>  '6',
				],
				'default' => '4',
				'condition' => [
					'display_type!' => array('carousel')
				]
			]
		);

		//responsive grid layout
		elemental_addons_elementor_grid_responsive_columns($this);

		$this->add_control(
			'gutter',
			[
				'label' => esc_html__( "Gutter", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_isotope_gutter_list_elementor(),
				'default' => 'gutter-10',
				'condition' => [
					'display_type' => array('grid', 'masonry', 'masonry-tiles')
				]
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label' => esc_html__( 'Icon Type', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon' => esc_html__( 'Icon', 'elemental-addons' ),
					'image' => esc_html__( 'Image', 'elemental-addons' ),
				],
				'default' => 'icon',
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __('Testimonial Icon', 'elemental-addons'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-quote',
					'library' => 'font-awesome',
				],
				'condition' => [
					'icon_type' => 'icon',
				],
			]
		);
		$this->add_control(
			'icon_image',
			[
				'label' => esc_html__( 'Testimonial Image', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);

		$this->add_control(
			'name_tag',
			[
				'label' => esc_html__( "Name Tag", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'h4'
			]
		);
		$this->add_control(
			'position_tag',
			[
				'label' => esc_html__( "Position Tag", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'div'
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Reason/Title Tag", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'h5'
			]
		);

		$this->add_control(
			'show_author_name', [
				'label' => esc_html__( "Show Author Name", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_author_position', [
				'label' => esc_html__( "Show Author Position", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_title', [
				'label' => esc_html__( "Show Reason/Title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_rating', [
				'label' => esc_html__( "Show Rating", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->end_controls_section();







		//Swiper Slider Options
		elemental_addons_get_swiper_slider_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		elemental_addons_get_swiper_slider_nav_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		elemental_addons_get_swiper_slider_dots_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );











		$this->start_controls_section(
			'icon_styling',
			[
				'label' => esc_html__( 'Icon Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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

		$this->end_controls_section();










		$this->start_controls_section(
			'author_name_options_styling',
			[
				'label' => esc_html__( 'Author Name Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_author_name_styling');
		$this->start_controls_tab(
			'tabs_author_name_styling_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		$this->add_control(
			'author_name_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-name' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_name_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-name' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_name_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-name',
			]
		);
		$this->add_responsive_control(
			'author_name_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'author_name_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_name_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'author_name_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item:hover .inner-box .testimonial-name' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_name_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item:hover .inner-box .testimonial-name' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_name_styling_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'author_name_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-name:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-name a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_name_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-name:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-name a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();







		$this->start_controls_section(
			'author_position_options_styling',
			[
				'label' => esc_html__( 'Author Position Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_author_position_styling');
		$this->start_controls_tab(
			'tabs_author_position_styling_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		$this->add_control(
			'author_position_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-position' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_position_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-position' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_position_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-position',
			]
		);
		$this->add_responsive_control(
			'author_position_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'author_position_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-position' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_position_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'author_position_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item:hover .inner-box .testimonial-position' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_position_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item:hover .inner-box .testimonial-position' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_position_styling_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'author_position_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-position:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-position a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_position_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-position:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-testimonials .testimonial-item .inner-box .testimonial-position a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();








		$this->start_controls_section(
			'author_text_options_styling',
			[
				'label' => esc_html__( 'Author Text Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_author_text_styling');
		$this->start_controls_tab(
			'tabs_author_text_styling_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		$this->add_control(
			'author_text_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_text_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .testimonial-item .author-text',
			]
		);
		$this->add_responsive_control(
			'author_text_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'author_text_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_text_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'author_text_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .author-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_text_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .author-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_author_text_styling_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'author_text_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-item .author-text a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'author_text_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .author-text:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .testimonial-item .author-text a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();








		$this->start_controls_section(
			'testimonial_title_options_styling',
			[
				'label' => esc_html__( 'Reason/Title Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_testimonial_title_styling');
		$this->start_controls_tab(
			'tabs_testimonial_title_styling_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		$this->add_control(
			'testimonial_title_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .rating .testimonial-title' => 'color: {{VALUE}} !important;'
				]
			]
		);
		$this->add_control(
			'testimonial_title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .rating .testimonial-title' => 'color: var(--theme-color{{VALUE}}) !important;'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testimonial_title_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .testimonial-item .testimonial-title',
			]
		);
		$this->add_responsive_control(
			'testimonial_title_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'testimonial_title_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_testimonial_title_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'testimonial_title_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .testimonial-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'testimonial_title_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item:hover .testimonial-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_testimonial_title_styling_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'testimonial_title_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-item .testimonial-title a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'testimonial_title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-item .testimonial-title:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .testimonial-item .testimonial-title a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();










		$this->start_controls_section(
			'button_options',
			[
				'label' => esc_html__( 'Button Options', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		elemental_addons_get_viewdetails_button_arraylist($this, 1);
		elemental_addons_get_viewdetails_button_arraylist($this, 2);
		elemental_addons_get_button_arraylist($this, 1);
		$this->end_controls_section();



		$this->start_controls_section(
			'button_color_typo_options', [
				'label' => esc_html__( 'Button Color/Typography', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		elemental_addons_get_button_text_color_typo_arraylist($this, 1);
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

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-testimonial-block-style1', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/testimonial-block/testimonial-block-style1' . $direction_suffix . '.css' );

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

		$settings['holder_id'] = \elemental_addons_get_isotope_holder_ID('testimonial-block');

		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = elemental_addons_get_shortcode_template_part( 'testimonial', $settings['display_type'], 'testimonial-block/tpl', $settings, true );

		echo $html;
	}
}
