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
class TM_Elementor_Floating_Objects extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style(
			'tm-floating-objects-style',
			ELEMENTAL_ADDONS_ASSETS_URI . '/css/widgets-core/floating-objects' . $direction_suffix . '.css',
			array(),
			ELEMENTAL_ADDONS_VERSION
		);
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
		return 'tm-ele-floating-objects';
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
		return esc_html__( 'Floating Objects', 'elemental-addons' );
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
		return 'eicon-parallax';
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
		return [ 'tm-floating-objects-style' ];
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
			'visible_mobile',
			[
				'label' => esc_html__( "Visible on Mobile Devices?", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);





		$repeater = new \Elementor\Repeater();
		//image
		$repeater->add_control(
			'image', [
				'label' => esc_html__( "Floating Image", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);




		$repeater->add_control(
			'logo_filter_options',
			[
				'label' => esc_html__( 'Filter Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_control(
			'logo_filter_white',
			[
				'label' => esc_html__( 'Filter Logo to White', 'elemental-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'filter:brightness(0) invert(1);',
				],
			]
		);
		$repeater->add_control(
			'logo_filter_black',
			[
				'label' => esc_html__( 'Filter Logo to Black', 'elemental-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'filter:brightness(0) invert(0);',
				],
			]
		);

		$repeater->add_control(
			'gsap_scrolling_effect',
			[
				'label' => esc_html__( "GSAP Scrolling Effect", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__('None', 'elemental-addons'),
					'parallax' => esc_html__('GSAP Parallax', 'elemental-addons'),
				],
				'default' => ''
			]
		);
		$repeater->add_control(
			'gsap_motion_animation_popover_toggle',
			[
				'label' => esc_html__( 'GSAP Motion Animation', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'Default', 'elemental-addons' ),
				'label_on' => esc_html__( 'Custom', 'elemental-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'gsap_scrolling_effect' => array('parallax')
				]
			]
		);
		$repeater->start_popover();
		$repeater->add_responsive_control(
			'gsap_motion_x',
			[
				'label' => esc_html__( "X", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => ''
			]
		);
		$repeater->add_responsive_control(
			'gsap_motion_y',
			[
				'label' => esc_html__( "Y", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => ''
			]
		);
		$repeater->add_responsive_control(
			'gsap_motion_rotate',
			[
				'label' => esc_html__( "Rotate", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => ''
			]
		);
		$repeater->add_responsive_control(
			'gsap_motion_scale',
			[
				'label' => esc_html__( "Scale", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => ''
			]
		);
		$repeater->add_responsive_control(
			'gsap_motion_opacity',
			[
				'label' => esc_html__( 'Opacity', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0,
						'step' => 0.01,
					],
				]
			]
		);
		$repeater->end_popover();



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
			'animation_type', [
				'label' => esc_html__( "Floating Animation Type", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => elemental_addons_get_animation_type(),
				'default' => 'tm-animation-floating'
			]
		);
		$repeater->add_control(
			'pos_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_responsive_control(
			'pos_orientation_vertical',
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
			'pos_orientation_offset_y',
			[
				'label' => __( 'Offset', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -700,
						'max' => 700,
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
							'{{pos_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'pos_orientation_horizontal',
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
			'pos_orientation_offset_x',
			[
				'label' => __( 'Offset', 'elemental-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -700,
						'max' => 700,
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
							'{{pos_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_control(
			'dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_responsive_control(
			'custom_image_size',
			[
				'label' => esc_html__( "Image Custom Size", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 800,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-size: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$repeater->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Container Width', 'elemental-addons' ),
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
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 800,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Container Height', 'elemental-addons' ),
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
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 130,
					],
					'px' => [
						'min' => 1,
						'max' => 800,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'z_index',
			[
				'label' => esc_html__( "Z Index", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'separator' => 'before',
			]
		);
		$repeater->add_responsive_control(
			'image_opacity',
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
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'opacity: {{SIZE}};',
				],
			]
		);
		$repeater->add_control(
			'image_custom_css_class',
			[
				'label' => esc_html__( "Image Custom CSS class", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'image_inline_style',
			[
				'label' => esc_html__( "Image Custom Inline CSS", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Example: top: 12px; left: 100px;", 'elemental-addons' ),
			]
		);


		$this->add_control(
			'floating_objects_array',
			[
				'label' => esc_html__( "Floating Objects", 'elemental-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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
		$classes[] = 'tm-ele-floating-objects';
		$classes[] = $settings['custom_css_class'];
		if ( $settings['visible_mobile'] != 'yes' ) {
			$classes[] = 'hide-on-mobile';
		}
		$settings['classes'] = $classes;
	?>
		<div class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<?php
		if ( $settings['floating_objects_array'] ) {
			$settings['iter'] = 1;
			foreach (  $settings['floating_objects_array'] as $item ) {
				$item['wrapper_inline_css'] = $this->inline_css( $item );
				$iter = $settings['iter']++;

				$img_classes = array();
				$img_classes[] = 'each-object elementor-repeater-item-' . $item['_id'];
				$img_classes[] = ! empty( $item['image_clip_path_animation'] ) ? $item['image_clip_path_animation'] : '';
				$img_classes[] = ! empty( $item['animation_type'] ) ? $item['animation_type'] : '';
				$img_classes[] = ! empty( $item['image_custom_css_class'] ) ? $item['image_custom_css_class'] : '';
				$item['img_classes'] = array_filter( $img_classes );


				if( ! empty( $item['gsap_scrolling_effect'] ) && $item['gsap_scrolling_effect'] === 'parallax') {
					wp_enqueue_script( 'gsap' );
					wp_enqueue_script( 'gsap-scrolltrigger' );
					wp_enqueue_script( 'tm-gsap-parallax' );
					$parallax_params = [
							'x' => $item['gsap_motion_x'],
							'y' => $item['gsap_motion_y'],
							'scale' => $item['gsap_motion_scale'],
							'rotate' => $item['gsap_motion_rotate'],
							'opacity' => $item['gsap_motion_opacity']['size'],
					];
					$item['parallax_params'] = wp_json_encode($parallax_params);
				}
				// Echo template directly so style/data attributes are not stripped by kses.
				elemental_addons_get_widgetcore_template_part( 'floating-objects', null, 'floating-objects/tpl', $item, false );
			}
		}
	?>
		</div>
	<?php
	}

	/**
	 * Get Wrapper Styles
	 */
	protected function inline_css( $params ) {
		$css_array = array();

		if( ! empty( $params['image']['url'] ) ) {
			$css_array[] = 'background-image: url(' . esc_url_raw( $params['image']['url'] ) . ')';
		} elseif ( ! empty( $params['image']['id'] ) ) {
			$image = wp_get_attachment_image_src( $params['image']['id'], 'full' );
			if ( $image !== false ) {
				$css_array[] = 'background-image: url(' . esc_url_raw( $image[0] ) . ')';
			}
		}
		if( !empty($params['z_index']) ) {
			$css_array[] = 'z-index: '.$params['z_index'];
		}

		$css_array = implode( '; ', $css_array ).';';

		if( $params['image_inline_style'] != '' ) {
			$css_array .= $params['image_inline_style'];
		}
		return $css_array;
	}
}
