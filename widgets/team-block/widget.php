<?php
namespace ElementalAddons\Widgets\TeamBlock;

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
class TM_Elementor_TeamBlock extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'tm-team-block-loader', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/team-block/team-block-loader' . $direction_suffix . '.css' );
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
		return 'tm-ele-team-block';
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
		return esc_html__( 'Team Block', 'elemental-addons' );
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
		return 'eicon-person';
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
	 * Styles needed for hardcoded Font Awesome social / share icons in templates.
	 *
	 * Registers Elementor's FA assets under plugin handles so icons still load when
	 * Elementor's "Inline Font Icons" experiment skips its own FA stylesheet registration.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		if ( function_exists( 'elemental_addons_enqueue_font_awesome' ) ) {
			elemental_addons_enqueue_font_awesome();
		}

		return array(
			'elemental-addons-fa-brands',
			'elemental-addons-fa-solid',
		);
	}


	/**
	 * Skins
	 */
	protected function register_skins() {
		elemental_addons_register_widget_skins( $this, 'team-block' );
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
			'team_icons_options', [
				'label' => esc_html__( 'Team Items', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Name", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( "David Smith", 'elemental-addons' ),
			]
		);
		$repeater->add_control(
			'subtitle',
			[
				'label' => esc_html__( "Sub Title/ Job Title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( "This is a section subtitle", 'elemental-addons' ),
			]
		);
		$repeater->add_control(
			'phone',
			[
				'label' => esc_html__( "Phone Number", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( "+123456789", 'elemental-addons' ),
			]
		);
		$repeater->add_control(
			'feature_link',
			[
				'label' => esc_html__( "Title Link URL", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'label_block' => true,
				'show_external' => true,
				'placeholder' => esc_html__( 'Paste URL or type', 'elemental-addons' ),
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);
		$repeater->add_control(
			'featured_image',
			[
				'label' => esc_html__( "Thumbnail Image", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'featured_image_size',
			[
				'label' => esc_html__( "Thumbnail Image Size", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options' => elemental_addons_get_available_image_sizes(),
				'default' => 'full',
			]
		);
		$repeater->add_control(
			'social_links_heading',
			[
				'label' => esc_html__( 'Social Links', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'facebook',
			[
				'label' => esc_html__( "Facebook", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'twitter',
			[
				'label' => esc_html__( 'X', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'instagram',
			[
				'label' => esc_html__( "Instagram", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'linkedin',
			[
				'label' => esc_html__( "Linkedin", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'github',
			[
				'label' => esc_html__( "Github", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'youtube',
			[
				'label' => esc_html__( "Youtube", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'short_bio',
			[
				'label' => esc_html__( "Short Bio", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__( "Write a short bio, that will describe the title or something informational and useful.", 'elemental-addons' ),
				'separator' => 'before',
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
				'label_block' => true,
				'options' => elemental_addons_animate_css_animation_list(),
			]
		);
		$repeater->add_control(
			'wow_animation_delay',
			[
				'label' => esc_html__( 'Animation Delay', 'elemental-addons' ) . ' (ms)',
				'type' => Controls_Manager::NUMBER,
				'label_block' => true,
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
			'team_items_array',
			[
				'label' => esc_html__( "Team Items", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Title #1', 'elemental-addons' ),
						'subtitle' => esc_html__( 'subtitle #1', 'elemental-addons' ),
						'feature_link' => [
							'url' => '',
							'is_external' => false,
							'nofollow' => false,
						],
						'featured_image'     => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'facebook'  => '#',
						'twitter'   => '#',
						'instagram' => '#',
					],
					[
						'title' => esc_html__( 'Title #2', 'elemental-addons' ),
						'subtitle' => esc_html__( 'Title #2', 'elemental-addons' ),
						'feature_link' => [
							'url' => '',
							'is_external' => false,
							'nofollow' => false,
						],
						'featured_image'     => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'facebook'  => '#',
						'twitter'   => '#',
						'instagram' => '#',
					],
					[
						'title' => esc_html__( 'Title #3', 'elemental-addons' ),
						'subtitle' => esc_html__( 'Title #3', 'elemental-addons' ),
						'feature_link' => [
							'url' => '',
							'is_external' => false,
							'nofollow' => false,
						],
						'featured_image'     => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'facebook'  => '#',
						'twitter'   => '#',
						'instagram' => '#',
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
			'title_tag',
			[
				'label' => esc_html__( "Name Tag", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'h4'
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Sub Title/ Job Title Tag", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_heading_tag_list(),
				'default' => 'div'
			]
		);
		$this->add_control(
			'show_subtitle', [
				'label' => esc_html__( "Show Sub Title/ Job Title", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_short_bio', [
				'label' => esc_html__( "Show Short Bio", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'show_social_links', [
				'label' => esc_html__( "Show Social Links", 'elemental-addons' ),
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
			'team_content_styling',
			[
				'label' => esc_html__( 'Content Box Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'team_content_bg_theme_colored',
			[
				'label'   => esc_html__( 'BG Theme Colored', 'elemental-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-content' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'team_content_custom_bg_color',
			[
				'label' => esc_html__( 'Custom BG Color', 'elemental-addons' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'title_options_styling',
			[
				'label' => esc_html__( 'Name Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_title_styling');
		$this->start_controls_tab(
			'tabs_title_styling_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-title' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .team-item .team-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .team-item .team-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .team-item .team-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .team-item .team-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_title_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'title_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item:hover .team-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item:hover .team-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_title_styling_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-item .team-title a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-title:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .team-item .team-title a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();









		$this->start_controls_section(
			'subtitle_options_styling',
			[
				'label' => esc_html__( 'Sub Title/ Job Title Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_subtitle_styling');
		$this->start_controls_tab(
			'tabs_subtitle_styling_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .team-item .team-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .team-item .team-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .team-item .team-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_subtitle_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'subtitle_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item:hover .team-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item:hover .team-subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_subtitle_styling_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'subtitle_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-subtitle:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-item .team-subtitle a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-subtitle:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .team-item .team-subtitle a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();









		$this->start_controls_section(
			'shortbio_options_styling',
			[
				'label' => esc_html__( 'Short Bio Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_shortbio_styling');
		$this->start_controls_tab(
			'tabs_shortbio_styling_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);
		$this->add_control(
			'shortbio_text_color',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-short-bio' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'shortbio_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-short-bio' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'shortbio_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .team-item .team-short-bio',
			]
		);
		$this->add_responsive_control(
			'shortbio_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .team-item .team-short-bio' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'shortbio_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .team-item .team-short-bio' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_shortbio_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'shortbio_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item:hover .team-short-bio' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'shortbio_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item:hover .team-short-bio' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_shortbio_styling_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);
		$this->add_control(
			'shortbio_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-short-bio:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-item .team-short-bio a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'shortbio_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-short-bio:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .team-item .team-short-bio a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();













		$this->start_controls_section(
			'icon_custom_styling',
			[
				'label' => esc_html__( 'Social Links Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_current_theme_styling');
		$this->start_controls_tab(
			'tabs_current_theme_styling_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
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
					'{{WRAPPER}} .team-item .team-social a' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_custom_color',
			[
				'label' => esc_html__( "Icon Custom Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-social a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .team-item .team-social a',
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
				'label' => esc_html__( "Icon Area BG Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-social a' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color',
			[
				'label' => esc_html__( "Icon Area Custom BG Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-social a' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .team-item .team-social a' => 'line-height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .team-item .team-social a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .team-item .team-social a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'selector' => '{{WRAPPER}} .team-item .team-social a',
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .team-item .team-social a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_area_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .team-item .team-social a',
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
					'{{WRAPPER}} .team-item .team-social a' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_width_auto',
			[
				'label' => esc_html__( "Make Icon Width to Auto?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-social a' => 'width: auto;',
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
					'{{WRAPPER}} .team-item .team-social a' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_height_auto',
			[
				'label' => esc_html__( "Make Icon Height to Auto?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-social a' => 'height: auto;',
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_current_theme_styling_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
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
				'label' => esc_html__( "Make Icon Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-social a:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_custom_color_hover',
			[
				'label' => esc_html__( "Icon Custom Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-social a:hover' => 'color: {{VALUE}};',
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
				'label' => esc_html__( "Icon Area BG Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-social a:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color_hover',
			[
				'label' => esc_html__( "Icon Area Custom BG Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-social a:hover' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'share_icon_styling',
			[
				'label' => esc_html__( 'Share Icon Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'tabs_share_icon_styling' );
		$this->start_controls_tab(
			'tabs_share_icon_styling_normal',
			[
				'label' => esc_html__( 'Normal', 'elemental-addons' ),
			]
		);
		$this->add_control(
			'share_icon_color_heading',
			[
				'label' => esc_html__( 'Icon Color', 'elemental-addons' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'share_icon_theme_colored',
			[
				'label'   => esc_html__( 'Make Icon Theme Colored', 'elemental-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-share' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'share_icon_custom_color',
			[
				'label' => esc_html__( 'Icon Custom Color', 'elemental-addons' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-share' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'share_icon_bg_heading',
			[
				'label'     => esc_html__( 'Background Color', 'elemental-addons' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'share_icon_bg_theme_colored',
			[
				'label'   => esc_html__( 'BG Theme Colored', 'elemental-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-share' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'share_icon_custom_bg_color',
			[
				'label' => esc_html__( 'Custom BG Color', 'elemental-addons' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-share' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_share_icon_styling_hover',
			[
				'label' => esc_html__( 'Hover', 'elemental-addons' ),
			]
		);
		$this->add_control(
			'share_icon_color_heading_hover',
			[
				'label' => esc_html__( 'Icon Color', 'elemental-addons' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'share_icon_theme_colored_hover',
			[
				'label'   => esc_html__( 'Make Icon Theme Colored', 'elemental-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-share:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'share_icon_custom_color_hover',
			[
				'label' => esc_html__( 'Icon Custom Color', 'elemental-addons' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-share:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'share_icon_bg_heading_hover',
			[
				'label'     => esc_html__( 'Background Color', 'elemental-addons' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'share_icon_bg_theme_colored_hover',
			[
				'label'   => esc_html__( 'BG Theme Colored', 'elemental-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .team-item .team-share:hover' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'share_icon_custom_bg_color_hover',
			[
				'label' => esc_html__( 'Custom BG Color', 'elemental-addons' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-item .team-share:hover' => 'background-color: {{VALUE}};',
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

		if ( function_exists( 'elemental_addons_enqueue_font_awesome' ) ) {
			elemental_addons_enqueue_font_awesome();
		}

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'team-block-style1', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/team-block/team-block-style1' . $direction_suffix . '.css' );


		$settings['icon_classes'] = array();
		$settings['holder_id'] = \elemental_addons_get_isotope_holder_ID('team-block');

		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = elemental_addons_get_shortcode_template_part( 'team', $settings['display_type'], 'team-block/tpl', $settings, true );

		\elemental_addons_print_html( $html );
	}
}
