<?php
namespace ElementalAddons\Widgets\CounterBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/elemental-counter-block/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style1';
	}


	public function get_title() {
		return __( 'Skin Style1', 'elemental-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'content_wrapper_styling',
			[
				'label' => esc_html__( 'Content Wrapper Styling', 'elemental-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'featured_image',
			[
				'label' => __('Featured Images', 'elemental-addons'),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'content_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter-block .inner' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter-block .inner:hover' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_theme_colored',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter-block .inner' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'content_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Make BG Theme Colored (Hover)", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter-block .inner:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-counter-block-style1', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/counter-block/counter-block-style1' . $direction_suffix . '.css' );

		//classes
		$classes = array();
		if ( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'tm-animate-hover animate-icon-' . $settings['animate_icon_on_hover'];
		}
		if ( $settings['everything_centered_in_responsive_tablet'] === 'yes' ) {
			$classes[] = 'counter-centered-in-responsive-tablet';
		}
		if ( $settings['everything_centered_in_responsive_mobile'] === 'yes' ) {
			$classes[] = 'counter-centered-in-responsive-mobile';
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

		wp_register_script( 'jquery-animatenumbers', ELEMENTAL_ADDONS_ASSETS_URI . '/js/plugins/jquery.animatenumbers.min.js', array( 'jquery' ), false, true );
		wp_register_script( 'funfact-animate-number', ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/funfact-animate-number.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-animatenumbers' );
		wp_enqueue_script( 'funfact-animate-number' );
		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = elemental_addons_get_shortcode_template_part( 'counter-skin-style1', null, 'counter-block/tpl', $settings, true );

		echo $html;
	}
}