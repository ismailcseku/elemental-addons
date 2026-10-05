<?php
namespace ElementalAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Contact_Form_7 extends Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        $direction_suffix = is_rtl() ? '.rtl' : '';

        wp_register_style( 'tm-contact-form-7-style', ELEMENTAL_ADDONS_ASSETS_URI . '/css/widgets-core/contact-form-7' . $direction_suffix . '.css' );
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
		return 'tm-ele-contact-form-7';
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
		return esc_html__( 'Contact Form 7', 'elemental-addons' );
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
		return [ 'tm-contact-form-7-style' ];
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


		if (!function_exists('wpcf7')) {
			$this->start_controls_section(
				'tm_global_warning',
				[
					'label' => esc_html__('Warning!', 'elemental-addons'),
				]
			);

			$this->add_control(
				'tm_global_warning_text',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => esc_html__('<strong>Contact Form 7</strong> is not installed/activated on your site. Please install and activate <strong>Contact Form 7</strong> first.', 'elemental-addons'),
					'content_classes' => 'tm-warning',
				]
			);

			$this->end_controls_section();
		} else {
			/**
			 * Content Tab: Contact Form
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_info_box',
				[
					'label' => esc_html__('Contact Form', 'elemental-addons'),
				]
			);
			$this->add_control(
				'contact_form_list',
				[
					'label' => esc_html__('Select Form', 'elemental-addons'),
					'type' => Controls_Manager::SELECT,
					'label_block' => true,
					'options' => elemental_addons_get_wpcf7_list(),
					'default' => '0',
				]
			);
			$this->add_control(
				'labels_switch',
				[
					'label' => esc_html__('Show Labels', 'elemental-addons'),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
					'label_on' => esc_html__('Show', 'elemental-addons'),
					'label_off' => esc_html__('Hide', 'elemental-addons'),
					'return_value' => 'yes',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'section_form_subtitle',
				[
					'label' => esc_html__('Sub Title', 'elemental-addons'),
				]
			);
			$this->add_control(
				'form_subtitle',
				[
					'label' => esc_html__('Form Sub Title', 'elemental-addons'),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__('On', 'elemental-addons'),
					'label_off' => esc_html__('Off', 'elemental-addons'),
					'return_value' => 'yes',
				]
			);
			$this->add_control(
				'form_subtitle_text',
				[
					'label' => esc_html__('Sub Title', 'elemental-addons'),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'label_block' => true,
					'default' => '',
					'condition' => [
						'form_subtitle' => 'yes',
					],
				]
			);
			$this->add_control(
				'subtitle_tag',
				[
					'label' => esc_html__( "Sub Title Tag", 'elemental-addons' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => elemental_addons_heading_tag_list(),
					'default' => 'h5',
					'condition' => [
						'form_subtitle' => 'yes',
					],
				]
			);
			$this->add_control(
				'form_subtitle_position',
				[
					'label' => esc_html__( "Sub Title Position", 'elemental-addons' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'above-title' => esc_html__( 'Above Title', 'elemental-addons' ),
						'below-title' => esc_html__( 'Below Title', 'elemental-addons' ),
					],
					'default' => 'above-title',
					'condition' => [
						'form_subtitle' => 'yes',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'section_form_title',
				[
					'label' => esc_html__('Title', 'elemental-addons'),
				]
			);
			$this->add_control(
				'form_title',
				[
					'label' => esc_html__('Form Title', 'elemental-addons'),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__('On', 'elemental-addons'),
					'label_off' => esc_html__('Off', 'elemental-addons'),
					'return_value' => 'yes',
				]
			);
			$this->add_control(
				'form_title_text',
				[
					'label' => esc_html__('Title', 'elemental-addons'),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'label_block' => true,
					'default' => '',
					'condition' => [
						'form_title' => 'yes',
					],
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
			$this->end_controls_section();

			$this->start_controls_section(
				'section_form_description',
				[
					'label' => esc_html__('Description', 'elemental-addons'),
				]
			);
			$this->add_control(
				'form_description',
				[
					'label' => esc_html__('Form Description', 'elemental-addons'),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__('On', 'elemental-addons'),
					'label_off' => esc_html__('Off', 'elemental-addons'),
					'return_value' => 'yes',
				]
			);
			$this->add_control(
				'form_description_text',
				[
					'label' => esc_html__('Description', 'elemental-addons'),
					'type' => Controls_Manager::TEXTAREA,
					'dynamic' => [
						'active' => true,
					],
					'default' => '',
					'condition' => [
						'form_description' => 'yes',
					],
				]
			);
			$this->end_controls_section();

			/**
			 * Content Tab: Errors
			 * -------------------------------------------------
			 */
			$this->start_controls_section(
				'section_errors',
				[
					'label' => esc_html__('Errors', 'elemental-addons'),
				]
			);

			$this->add_control(
				'error_messages',
				[
					'label' => esc_html__('Error Messages', 'elemental-addons'),
					'type' => Controls_Manager::SELECT,
					'default' => 'show',
					'options' => [
						'show' => esc_html__('Show', 'elemental-addons'),
						'hide' => esc_html__('Hide', 'elemental-addons'),
					],
					'selectors_dictionary' => [
						'show' => 'block',
						'hide' => 'none',
					],
					'selectors' => [
						'{{WRAPPER}} .tm-contact-form-7 .wpcf7-not-valid-tip' => 'display: {{VALUE}} !important;',
					],
				]
			);

			$this->add_control(
				'validation_errors',
				[
					'label' => esc_html__('Validation Errors', 'elemental-addons'),
					'type' => Controls_Manager::SELECT,
					'default' => 'show',
					'options' => [
						'show' => esc_html__('Show', 'elemental-addons'),
						'hide' => esc_html__('Hide', 'elemental-addons'),
					],
					'selectors_dictionary' => [
						'show' => 'block',
						'hide' => 'none',
					],
					'selectors' => [
						'{{WRAPPER}} .tm-contact-form-7 .wpcf7-validation-errors' => 'display: {{VALUE}} !important;',
					],
				]
			);

			$this->end_controls_section();
		}

		/*-----------------------------------------------------------------------------------*/
		/*    STYLE TAB
		/*-----------------------------------------------------------------------------------*/
		/**
		 * Style Tab: Form Container
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_container_style',
			[
				'label' => esc_html__('Form Container', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tm_contact_form_background',
				'label' => esc_html__('Background', 'elemental-addons'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .tm-contact-form',
			]
		);
		$this->add_control(
			'section_container_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'section_container_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-contact-form' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_responsive_control(
			'tm_contact_form_alignment',
			[
				'label' => esc_html__('Form Alignment', 'elemental-addons'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'default' => [
						'title' => esc_html__('Default', 'elemental-addons'),
						'icon' => 'eicon-h-align-stretch',
					],
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
				'default' => 'default',
			]
		);

		$this->add_responsive_control(
			'tm_contact_form_max_width',
			[
				'label' => esc_html__('Form Max Width', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7-wrapper .tm-contact-form.tm-contact-form-7' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tm_contact_form_margin',
			[
				'label' => esc_html__('Margin', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tm_contact_form_padding',
			[
				'label' => esc_html__('Form Padding', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tm_contact_form_border_radius',
			[
				'label' => esc_html__('Border Radius', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tm_contact_form_border',
				'selector' => '{{WRAPPER}} .tm-contact-form',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tm_contact_form_box_shadow',
				'selector' => '{{WRAPPER}} .tm-contact-form',
			]
		);

		$this->end_controls_section();










		/**
		 * Style Tab: Title & Description
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_fields_title_description',
			[
				'label' => esc_html__('Title & Description', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'heading_alignment',
			[
				'label' => esc_html__('Alignment', 'elemental-addons'),
				'type' => Controls_Manager::CHOOSE,
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-heading' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__('Title', 'elemental-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'title_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Margin', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);





		$this->add_control(
			'subtitle_heading',
			[
				'label' => esc_html__('Sub Title', 'elemental-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'subtitle_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__('Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__('Margin', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);





		$this->add_control(
			'description_heading',
			[
				'label' => esc_html__('Description', 'elemental-addons'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_text_color',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'description_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-description' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => esc_html__('Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-description',
			]
		);
		$this->add_responsive_control(
			'description_margin',
			[
				'label' => esc_html__('Margin', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .tm-contact-form-7-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();



















		$this->start_controls_section(
			'form_heading_wrapper_styling',
			[
				'label' => esc_html__( 'Heading Wrapper Style', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'form_heading_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'form_heading_wrapper_margin',
			[
				'label' => esc_html__( 'Wrapper Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'form_heading_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_heading_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7-heading' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_heading_wrapper_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7-heading' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'form_heading_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_heading_wrapper_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-form-7-heading',
			]
		);
		$this->add_responsive_control(
			'form_heading_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_heading_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-form-7-heading',
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'form_wrapper_styling',
			[
				'label' => esc_html__( 'Form Wrapper Style', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'form_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'form_wrapper_margin',
			[
				'label' => esc_html__( 'Wrapper Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'form_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'form_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'form_wrapper_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'form_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_wrapper_border',
				'label' => esc_html__( 'Border', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7',
			]
		);
		$this->add_responsive_control(
			'form_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7',
			]
		);
		$this->end_controls_section();





		/**
		 * Style Tab: Only Select/Dropdown
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_dropdown_fields_style',
			[
				'label' => esc_html__('Only Select/Dropdown Field', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'field_dropdown_arrow_color',
			[
				'label' => esc_html__('Dropdown Arrow Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select.nice-select:after' => 'border-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'field_dropdown_placeholder_text_color',
			[
				'label' => esc_html__('Placeholder Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select.nice-select .current' => 'color: {{VALUE}} !important',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'field_dropdown_box_shadow',
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select.nice-select, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select',
				'separator' => 'before',
			]
		);
		$this->end_controls_section();










		/**
		 * Style Tab: Input & Textarea
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_fields_style',
			[
				'label' => esc_html__('Input, Select & Textarea', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_fields_style');

		$this->start_controls_tab(
			'tab_fields_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);

		$this->add_control(
			'field_bg',
			[
				'label' => esc_html__('Background Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'field_bg_theme_color',
			[
				'label' => esc_html__('Background Theme Color', 'elemental-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'background-color: var(--theme-color{{VALUE}})',
				],
			]
		);
		$this->add_control(
			'field_text_color',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select, {{WRAPPER}} .tm-contact-form-7 .wpcf7-list-item-label' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'field_margin',
			[
				'label' => esc_html__('Margin Bottom', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '0',
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form .wpcf7-form-control-wrap .wpcf7-form-control' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'field_padding',
			[
				'label' => esc_html__('Padding', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_indent',
			[
				'label' => esc_html__('Text Indent', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 30,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'text-indent: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'input_width',
			[
				'label' => esc_html__('Input Width', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control-wrap' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'input_height',
			[
				'label' => esc_html__('Input Height', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'textarea_width',
			[
				'label' => esc_html__('Textarea Width', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'textarea_height',
			[
				'label' => esc_html__('Textarea Height', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'field_border',
				'label' => esc_html__('Border', 'elemental-addons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'field_radius',
			[
				'label' => esc_html__('Border Radius', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-date, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'field_typography',
				'label' => esc_html__('Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'field_box_shadow',
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-text, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-quiz, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-textarea, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control.wpcf7-select',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_fields_focus',
			[
				'label' => esc_html__('Focus', 'elemental-addons'),
			]
		);

		$this->add_control(
			'field_bg_focus',
			[
				'label' => esc_html__('Background Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form textarea:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'input_border_focus',
				'label' => esc_html__('Border', 'elemental-addons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form textarea:focus',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'focus_box_shadow',
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input:focus, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form textarea:focus',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();




		/**
		 * Style Tab: Label Section
		 */
		$this->start_controls_section(
			'section_label_style',
			[
				'label' => esc_html__('Labels', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'labels_switch' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_error_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__('if label spacing doesn\'t worked, please update label display', 'elemental-addons'),
				'content_classes' => 'tm-warning',
			]
		);
		$this->add_control(
			'label_disply_type',
			[
				'label' => esc_html__('Display', 'elemental-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => elemental_addons_disply_type_list_elementor(),
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form label, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form .wpcf7-quiz-label' => 'display: {{UNIT}}',
				],
			]
		);

		$this->add_control(
			'text_color_label',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form label' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tm-contact-form-7 label' => 'color: {{VALUE}}',
				],
				'condition' => [
					'labels_switch' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'label_spacing',
			[
				'label' => esc_html__('Spacing', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form label, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form .wpcf7-quiz-label' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'labels_switch' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_label',
				'label' => esc_html__('Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form label, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form .wpcf7-quiz-label',
				'condition' => [
					'labels_switch' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Placeholder Section
		 */
		$this->start_controls_section(
			'section_placeholder_style',
			[
				'label' => esc_html__('Placeholder', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'placeholder_switch',
			[
				'label' => esc_html__('Show Placeholder', 'elemental-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => esc_html__('Yes', 'elemental-addons'),
				'label_off' => esc_html__('No', 'elemental-addons'),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'text_color_placeholder',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control::-moz-placeholder' => 'color: {{VALUE}}',
				],
				'condition' => [
					'placeholder_switch' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_placeholder',
				'label' => esc_html__('Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control::-webkit-input-placeholder, {{WRAPPER}} .tm-contact-form-7 .wpcf7-form-control::-moz-placeholder',
				'condition' => [
					'placeholder_switch' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Style Tab: Radio & Checkbox
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_radio_checkbox_style',
			[
				'label' => esc_html__('Radio & Checkbox', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'custom_radio_checkbox',
			[
				'label' => esc_html__('Custom Styles', 'elemental-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'elemental-addons'),
				'label_off' => esc_html__('No', 'elemental-addons'),
				'return_value' => 'yes',
			]
		);

		$this->add_responsive_control(
			'radio_checkbox_size',
			[
				'label' => esc_html__('Size', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '15',
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .tm-custom-radio-checkbox input[type="radio"]' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_radio_checkbox_style');

		$this->start_controls_tab(
			'radio_checkbox_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'radio_checkbox_color',
			[
				'label' => esc_html__('Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .tm-custom-radio-checkbox input[type="radio"]' => 'background: {{VALUE}}',
				],
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'radio_checkbox_border_width',
			[
				'label' => esc_html__('Border Width', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 15,
						'step' => 1,
					],
				],
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .tm-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .tm-custom-radio-checkbox input[type="radio"]' => 'border-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'radio_checkbox_border_color',
			[
				'label' => esc_html__('Border Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .tm-custom-radio-checkbox input[type="radio"]' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'checkbox_heading',
			[
				'label' => esc_html__('Checkbox', 'elemental-addons'),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'checkbox_border_radius',
			[
				'label' => esc_html__('Border Radius', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-custom-radio-checkbox input[type="checkbox"], {{WRAPPER}} .tm-custom-radio-checkbox input[type="checkbox"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'radio_heading',
			[
				'label' => esc_html__('Radio Buttons', 'elemental-addons'),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'radio_border_radius',
			[
				'label' => esc_html__('Border Radius', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-custom-radio-checkbox input[type="radio"], {{WRAPPER}} .tm-custom-radio-checkbox input[type="radio"]:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'radio_checkbox_checked',
			[
				'label' => esc_html__('Checked', 'elemental-addons'),
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'radio_checkbox_color_checked',
			[
				'label' => esc_html__('Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-custom-radio-checkbox input[type="checkbox"]:checked:before, {{WRAPPER}} .tm-custom-radio-checkbox input[type="radio"]:checked:before' => 'background: {{VALUE}}',
				],
				'condition' => [
					'custom_radio_checkbox' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();











		/**
		 * Style Tab: Submit Button
		 */
		$this->start_controls_section(
			'section_submit_button_style',
			[
				'label' => esc_html__('Submit Button', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__('Alignment', 'elemental-addons'),
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
				'prefix_class' => 'tm-contact-form-7-button-align-',
				'condition' => [
					'button_width_type' => 'custom',
				],
			]
		);

		$this->add_control(
			'button_width_type',
			[
				'label' => esc_html__('Width', 'elemental-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'full-width' => esc_html__('Full Width', 'elemental-addons'),
					'custom' => esc_html__('Custom', 'elemental-addons'),
				],
				'prefix_class' => 'tm-contact-form-7-button-',
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label' => esc_html__('Width', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'button_width_type' => 'custom',
				],
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'elemental-addons'),
			]
		);

		$this->add_control(
			'button_bg_color_normal',
			[
				'label' => esc_html__('Background Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_theme_color_normal',
			[
				'label' => esc_html__('Background Theme Color', 'elemental-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'background-color: var(--theme-color{{VALUE}})',
				],
			]
		);

		$this->add_control(
			'button_text_color_normal',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_normal',
				'label' => esc_html__('Border', 'elemental-addons'),
				'default' => '1px',
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__('Border Radius', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Margin Top', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'elemental-addons'),
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label' => esc_html__('Background Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]:hover,{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_theme_color_hover',
			[
				'label' => esc_html__('Background Theme Color', 'elemental-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]:hover,{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]:focus' => 'background-color: var(--theme-color{{VALUE}})',
				],
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]:hover,{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]:focus' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'button_text_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]:hover,{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]:focus' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[
				'label' => esc_html__('Border Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]:hover,{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();





		$this->start_controls_section(
			'section_submit_button_position',
			[
				'label' => esc_html__('Submit Button Position', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'submit_button_pos_top',
			[
				'label' => esc_html__( "Top", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'position:absolute;top: {{VALUE}};bottom:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'submit_button_pos_right',
			[
				'label' => esc_html__( "Right", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'position:absolute;right: {{VALUE}};left:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'submit_button_pos_bottom',
			[
				'label' => esc_html__( "Bottom", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'position:absolute;bottom: {{VALUE}};top:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'submit_button_pos_left',
			[
				'label' => esc_html__( "Left", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form input[type="submit"]' => 'position:absolute;left: {{VALUE}};right:auto;'
				]
			]
		);
		$this->end_controls_section();




		/**
		 * Style Tab: After Submit Spinner Icon
		 */
		$this->start_controls_section(
			'spinner_icon_style',
			[
				'label' => esc_html__('After Submit Spinner Icon', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'hide_wpcf7_spinner',
			[
				'label' => esc_html__( 'Hide Spinner Icon', 'elemental-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form .wpcf7-spinner' => 'display: none',
				],
			]
		);
		$this->end_controls_section();




		/**
		 * Style Tab: Progress Range Styling
		 */
		$this->start_controls_section(
			'progress_range_style',
			[
				'label' => esc_html__('Progress Range Styling (Optional)', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'progress_range_label_text_color',
			[
				'label' => esc_html__('Label/Title Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .get-quote__progress-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'progress_range_label_text_typography',
				'label' => esc_html__('Label/Title Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .get-quote__progress-title',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'progress_range_amount_text_color',
			[
				'label' => esc_html__('Amount Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .get-quote__balance-box' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'progress_range_amount_text_typography',
				'label' => esc_html__('Amount Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .get-quote__balance-box .get-quote__balance',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'progress_range_progress_bg_color',
			[
				'label' => esc_html__('Progress Background Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .get-quote__progress-range .irs--flat .irs-bar' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'progress_range_bar_bg_color',
			[
				'label' => esc_html__('Bar Background Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .get-quote__progress-range .irs--flat .irs-line' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'progress_range_bar_bg_border',
				'label' => esc_html__('Bar Border', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .get-quote__progress-range .irs--flat .irs-line',
			]
		);
		$this->add_control(
			'progress_range_bar_handle_bg_color',
			[
				'label' => esc_html__('Bar Handle Background Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .get-quote__progress-range .irs--flat .irs-handle' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();









		/**
		 * Style Tab: Errors
		 */
		$this->start_controls_section(
			'section_error_style',
			[
				'label' => esc_html__('Errors', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'error_messages_heading',
			[
				'label' => esc_html__('Error Messages', 'elemental-addons'),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->start_controls_tabs('tabs_error_messages_style');

		$this->start_controls_tab(
			'tab_error_messages_alert',
			[
				'label' => esc_html__('Alert', 'elemental-addons'),
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_control(
			'error_alert_text_color',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-not-valid-tip' => 'color: {{VALUE}}',
				],
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_control(
			'error_alert_bg_color',
			[
				'label' => esc_html__('Background Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-not-valid-tip' => 'background: {{VALUE}}',
				],
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'error_alert_typography',
				'label' => esc_html__('Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-not-valid-tip',
				'separator' => 'before',
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'error_alert_border',
				'label' => esc_html__('Border', 'elemental-addons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-not-valid-tip',
				'separator' => 'before',
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_responsive_control(
			'error_alert_padding',
			[
				'label' => esc_html__('Padding', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-not-valid-tip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_responsive_control(
			'error_alert_spacing',
			[
				'label' => esc_html__('Spacing', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-not-valid-tip' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_error_messages_fields',
			[
				'label' => esc_html__('Fields', 'elemental-addons'),
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_control(
			'error_field_bg_color',
			[
				'label' => esc_html__('Background Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-not-valid' => 'background: {{VALUE}}',
				],
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_control(
			'error_field_color',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-not-valid.wpcf7-text' => 'color: {{VALUE}}',
				],
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'error_field_border',
				'label' => esc_html__('Border', 'elemental-addons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-not-valid',
				'separator' => 'before',
				'condition' => [
					'error_messages' => 'show',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * Style Tab: After Submit Feedback
		 */
		$this->start_controls_section(
			'ajaxloader_style',
			[
				'label' => esc_html__('Ajax Loader Image', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'hide_ajaxloader',
			[
				'label' => esc_html__('Hide Ajax Loader Image', 'elemental-addons'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form .ajax-loader' => 'display: none;',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-form.submitting .ajax-loader' => 'display: block;',
				]
			]
		);
		$this->end_controls_section();



		/**
		 * Style Tab: After Submit Feedback
		 */
		$this->start_controls_section(
			'section_after_submit_feedback_style',
			[
				'label' => esc_html__('After Submit Feedback', 'elemental-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'contact_form_after_submit_feedback_typography',
				'label' => esc_html__('Typography', 'elemental-addons'),
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ng, {{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ok, {{WRAPPER}} .tm-contact-form-7 .wpcf7-response-output',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'contact_form_after_submit_feedback_color',
			[
				'label' => esc_html__('Text Color', 'elemental-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ng' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ok' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-response-output' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'contact_form_after_submit_feedback_background',
				'label' => esc_html__('Background', 'elemental-addons'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ng, {{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ok, {{WRAPPER}} .tm-contact-form-7 .wpcf7-response-output',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'contact_form_after_submit_feedback_border',
				'label' => esc_html__('Border', 'elemental-addons'),
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ng, {{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ok, {{WRAPPER}} .tm-contact-form-7 .wpcf7-response-output',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'contact_form_after_submit_feedback_border_radius',
			[
				'label' => esc_html__('Radius', 'elemental-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ng' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ok' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-response-output' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'contact_form_after_submit_feedback_border_margin',
			[
				'label' => esc_html__('Margin', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ng' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ok' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'contact_form_after_submit_feedback_border_padding',
			[
				'label' => esc_html__('Padding', 'elemental-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ng' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-mail-sent-ok' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tm-contact-form-7 .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
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
	protected function render2() {
		$settings = $this->get_settings_for_display();

		//classes
		$classes = array();
		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		//$html = elemental_addons_get_widgetcore_template_part( 'wpcf7', null, 'wpcf7/tpl', $settings, true );

		//echo $html;
	}
	protected function render() {
		if (!function_exists('wpcf7')) {
			return;
		}
		add_filter( 'wpcf7_autop_or_not', '__return_false' );

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('contact-form', 'class', [
			'tm-contact-form',
			'tm-contact-form-7',
			'tm-contact-form-' . esc_attr($this->get_id()),
		]);

		if ($settings['labels_switch'] != 'yes') {
			$this->add_render_attribute('contact-form', 'class', 'labels-hide');
		}
		if ($settings['placeholder_switch'] == 'yes') {
			$this->add_render_attribute('contact-form', 'class', 'placeholder-show');
		}
		if ($settings['custom_radio_checkbox'] == 'yes') {
			$this->add_render_attribute('contact-form', 'class', 'tm-custom-radio-checkbox');
		}
		if ($settings['tm_contact_form_alignment'] == 'left') {
			$this->add_render_attribute('contact-form', 'class', 'tm-contact-form-align-left');
		} elseif ($settings['tm_contact_form_alignment'] == 'center') {
			$this->add_render_attribute('contact-form', 'class', 'tm-contact-form-align-center');
		} elseif ($settings['tm_contact_form_alignment'] == 'right') {
			$this->add_render_attribute('contact-form', 'class', 'tm-contact-form-align-right');
		} else {
			$this->add_render_attribute('contact-form', 'class', 'tm-contact-form-align-default');
		}

		if (!empty($settings['contact_form_list'])) {
			echo '<div class="tm-contact-form-7-wrapper">
				<div ' . $this->get_render_attribute_string('contact-form') . '>';
			if ($settings['form_title'] == 'yes' || $settings['form_description'] == 'yes') {
				echo '<div class="tm-contact-form-7-heading">';

				if ($settings['form_subtitle'] == 'yes' && $settings['form_subtitle_text'] != '') {
					if ($settings['form_subtitle_position'] == 'above-title') {
						echo '<'.esc_attr( $settings['subtitle_tag'] ).' class="tm-contact-form-subtitle tm-contact-form-7-subtitle">
								' . esc_attr($settings['form_subtitle_text']) . '
							</'.esc_attr( $settings['subtitle_tag'] ).'>';
					}
				}

				if ($settings['form_title'] == 'yes' && $settings['form_title_text'] != '') {
					echo '<'.esc_attr( $settings['title_tag'] ).' class="tm-contact-form-title tm-contact-form-7-title">
								' . esc_attr($settings['form_title_text']) . '
							</'.esc_attr( $settings['title_tag'] ).'>';
				}

				if ($settings['form_subtitle'] == 'yes' && $settings['form_subtitle_text'] != '') {
					if ($settings['form_subtitle_position'] == 'below-title') {
						echo '<'.esc_attr( $settings['subtitle_tag'] ).' class="tm-contact-form-subtitle tm-contact-form-7-subtitle">
								' . esc_attr($settings['form_subtitle_text']) . '
							</'.esc_attr( $settings['subtitle_tag'] ).'>';
					}
				}

				if ($settings['form_description'] == 'yes' && $settings['form_description_text'] != '') {
					\elemental_addons_print_html(
						'<div class="tm-contact-form-description tm-contact-form-7-description">' .
						$this->parse_text_editor( $settings['form_description_text'] ) .
						'</div>'
					);
				}

				echo '</div>';
			}
			$form_id = absint( $settings['contact_form_list'] );
			if ( $form_id ) {
				\elemental_addons_print_html( do_shortcode( '[contact-form-7 id="' . $form_id . '"]' ) );
			}
			echo '</div>
			</div>';
		}
	}
}
