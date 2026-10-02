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
class TM_Elementor_TextEditorAdvanced extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-text-editor-advanced-style', ELEMENTAL_ADDONS_ASSETS_URI . '/css/widgets-core/text-editor-advanced' . $direction_suffix . '.css' );
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
		return 'elemental-text-editor-advanced';
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
		return esc_html__( 'Text Editor Advanced', 'elemental-addons' );
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
		return [ 'tm-text-editor-advanced-style' ];
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

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Description", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", 'elemental-addons' ),
			]
		);

		//gsap animation
		\elemental_addons_gsap_animation_arraylist($repeater);


		$repeater->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'elemental-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => \elemental_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};'
				],
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'elemental-addons' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}, {{WRAPPER}} {{CURRENT_ITEM}} *',
			]
		);



		$repeater->add_control(
			'content_color',
			[
				'label' => esc_html__( "Content Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} *' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'content_color_hover',
			[
				'label' => esc_html__( "Content Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover {{CURRENT_ITEM}} *' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'content_theme_colored',
			[
				'label' => esc_html__( "Content Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} {{CURRENT_ITEM}} *' => 'color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$repeater->add_control(
			'content_theme_colored_hover',
			[
				'label' => esc_html__( "Content Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover {{CURRENT_ITEM}}' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover {{CURRENT_ITEM}} *' => 'color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$repeater->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}, {{WRAPPER}} {{CURRENT_ITEM}} *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'elemental-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}, {{WRAPPER}} {{CURRENT_ITEM}} *' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} {{CURRENT_ITEM}}, {{WRAPPER}} {{CURRENT_ITEM}} *' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} {{CURRENT_ITEM}}, {{WRAPPER}} {{CURRENT_ITEM}} *' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'stroke_text_theme_colored',
			[
				'label' => esc_html__( "Stroke Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}, {{WRAPPER}} {{CURRENT_ITEM}} *' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_control(
			'text_editor_advanced',
			[
				'label' => esc_html__( "Fields", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'other_settings',
			[
				'label' => esc_html__( 'Content Settings', 'elemental-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( "Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_color_hover',
			[
				'label' => esc_html__( "Background Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .elementor-widget-container' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .elementor-widget-container' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'bg_overlay_color_options',
			[
				'label' => esc_html__( 'Background Overlay Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bg_overlay_color',
			[
				'label' => esc_html__( "Background Overlay Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_overlay_color_hover',
			[
				'label' => esc_html__( "Background Overlay Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .elementor-widget-container:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_overlay_theme_colored',
			[
				'label' => esc_html__( "Background Overlay Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'bg_overlay_theme_colored_hover',
			[
				'label' => esc_html__( "Background Overlay Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => \elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .elementor-widget-container:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'items_display_type_options',
			[
				'label' => esc_html__( 'Display Type', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'items_display_type',
			[
				'label' => esc_html__( "Items Display Type", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'block'	=> 	esc_html__( "Block", 'elemental-addons' ),
					'flex'	=> 	esc_html__( "Flex", 'elemental-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor-advanced' => 'display: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'items_display_flex_justify',
			[
				'label' => esc_html__( "Flex - Justify Content center", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor-advanced' => 'justify-content: center;'
				],
				'condition' => [
					'items_display_type' => array('flex')
				]
			]
		);
		$this->add_control(
			'items_display_flex_align',
			[
				'label' => esc_html__( "Flex - Align Items center", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-text-editor-advanced' => 'align-items: center;'
				],
				'condition' => [
					'items_display_type' => array('flex')
				]
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
		$classes[] = 'tm-text-editor-advanced';
		$settings['classes'] = $classes;

	?>
		<div class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<?php
		if ( $settings['text_editor_advanced'] ) {
			$settings['iter'] = 1;
			foreach (  $settings['text_editor_advanced'] as $item ) {
				$iter = $settings['iter']++;
				$parallax_params = null;

				$item_classes = array();
				$item_classes[] = 'each-item elementor-repeater-item-' . $item['_id'];
				if( isset($item['content_theme_colored']) && $item['content_theme_colored'] ) {
					$item_classes[] = 'text-theme-colored' . $item['content_theme_colored'];
				}
				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)

				if( ! empty( $item['gsap_scrolling_effect'] ) && $item['gsap_scrolling_effect'] === 'parallax') {
					$parallax_params = \elemental_addons_gsap_animation_json_data($item);
				}
				?>
				<div class="<?php echo esc_attr(implode(' ', $item_classes)); ?>" <?php if( ! empty( $parallax_params ) ) : ?> data-parallax="<?php echo esc_attr($parallax_params); ?>" <?php endif; ?>>
				<?php
				echo do_shortcode($item['content']);
				?>
				</div>
				<?php
			}
		}
	?>
		</div>
	<?php
	}
}