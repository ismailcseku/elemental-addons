<?php
/**
 * Registry of every Elementor widget shipped by Elemental Addons.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$ns = 'ElementalAddons\\Widgets\\';

return array(

	'general' => array(
		'label'       => esc_html__( 'Content Widgets', 'elemental-addons' ),
		'description' => esc_html__( 'Blocks for teams, services, pricing, galleries, and similar content.', 'elemental-addons' ),
		'widgets'     => array(
			'team-block' => array(
				'label'  => esc_html__( 'Team Block', 'elemental-addons' ),
				'class'  => $ns . 'TeamBlock\\TM_Elementor_TeamBlock',
				'folder' => 'widgets/team-block',
			),
			'testimonial-block' => array(
				'label'  => esc_html__( 'Testimonial Block', 'elemental-addons' ),
				'class'  => $ns . 'TestimonialBlock\\TM_Elementor_TestimonialBlock',
				'folder' => 'widgets/testimonial-block',
			),
			'service-block' => array(
				'label'  => esc_html__( 'Service Block', 'elemental-addons' ),
				'class'  => $ns . 'ServiceBlock\\TM_Elementor_ServiceBlock',
				'folder' => 'widgets/service-block',
			),
			'pricing-block' => array(
				'label'  => esc_html__( 'Pricing Block', 'elemental-addons' ),
				'class'  => $ns . 'PricingBlock\\TM_Elementor_PricingBlock',
				'folder' => 'widgets/pricing-block',
			),
			'pricing-plan' => array(
				'label'  => esc_html__( 'Pricing Plan', 'elemental-addons' ),
				'class'  => $ns . 'PricingPlan\\TM_Elementor_Pricing_Plan',
				'folder' => 'widgets/pricing-plan',
			),
			'image-gallery' => array(
				'label'  => esc_html__( 'Image Gallery', 'elemental-addons' ),
				'class'  => $ns . 'ImageGallery\\TM_Elementor_Image_Gallery',
				'folder' => 'widgets/image-gallery',
			),
			'features-block' => array(
				'label'  => esc_html__( 'Features Block', 'elemental-addons' ),
				'class'  => $ns . 'FeaturesBlock\\TM_Elementor_FeaturesBlock',
				'folder' => 'widgets/features-block',
			),
			'counter-block' => array(
				'label'  => esc_html__( 'Counter Block', 'elemental-addons' ),
				'class'  => $ns . 'CounterBlock\\TM_Elementor_CounterBlock',
				'folder' => 'widgets/counter-block',
			),
			'working-block' => array(
				'label'  => esc_html__( 'Working Process Block', 'elemental-addons' ),
				'class'  => $ns . 'WorkingBlock\\TM_Elementor_WorkingBlock',
				'folder' => 'widgets/working-block',
			),
			'theme-button' => array(
				'label'  => esc_html__( 'Theme Button', 'elemental-addons' ),
				'class'  => $ns . 'ThemeButton\\TM_Elementor_Theme_Button',
				'folder' => 'widgets/theme-button',
			),
			'swiper-carousel-arrow' => array(
				'label'  => esc_html__( 'Swiper Carousel Arrow', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_Swiper_Carousel_Arrow',
				'folder' => 'widgets/swiper-carousel-arrow',
			),
			'clients-logo' => array(
				'label'  => esc_html__( 'Clients Logo', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_Clients_logo',
				'folder' => 'widgets/clients-logo',
			),
			'blog' => array(
				'label'  => esc_html__( 'Blog / News Grid', 'elemental-addons' ),
				'class'  => $ns . 'Blog\\TM_Elementor_Blog',
				'folder' => 'cpt/blog',
			),
		),
	),

	'core' => array(
		'label'       => esc_html__( 'Core Widgets', 'elemental-addons' ),
		'description' => esc_html__( 'General purpose widgets for text, icons, forms, and animation.', 'elemental-addons' ),
		'widgets'     => array(
			'accordion' => array(
				'label'  => esc_html__( 'Accordion', 'elemental-addons' ),
				'class'  => $ns . 'Accordion\\TM_Elementor_Accordion',
				'folder' => 'widgets/accordion',
			),
			'animated-layers' => array(
				'label'  => esc_html__( 'Animated Layers', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_Animated_Layers',
				'folder' => 'widgets/animated-layers',
			),
			'contact-form-7' => array(
				'label'  => esc_html__( 'Contact Form 7', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_Contact_Form_7',
				'folder' => 'widgets/contact-form-7',
			),
			'floating-objects' => array(
				'label'  => esc_html__( 'Floating Objects', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_Floating_Objects',
				'folder' => 'widgets/floating-objects',
			),
			'funfact-counter' => array(
				'label'  => esc_html__( 'Funfact Counter', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_Funfact_Counter',
				'folder' => 'widgets/funfact-counter',
			),
			'icon-box' => array(
				'label'  => esc_html__( 'Icon Box', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_Iconbox',
				'folder' => 'widgets/icon-box',
			),
			'list' => array(
				'label'  => esc_html__( 'List', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_List',
				'folder' => 'widgets/list',
			),
			'progress-bar' => array(
				'label'  => esc_html__( 'Progress Bar', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_Progress_Bar',
				'folder' => 'widgets/progress-bar',
			),
			'section-title' => array(
				'label'  => esc_html__( 'Section Title', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_Section_Title',
				'folder' => 'widgets/section-title',
			),
			'text-editor' => array(
				'label'  => esc_html__( 'Text Editor', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_TextEditor',
				'folder' => 'widgets/text-editor',
			),
			'text-editor-advanced' => array(
				'label'  => esc_html__( 'Text Editor Advanced', 'elemental-addons' ),
				'class'  => $ns . 'TM_Elementor_TextEditorAdvanced',
				'folder' => 'widgets/text-editor-advanced',
			),
		),
	),

);
