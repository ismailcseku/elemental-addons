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
		'description' => esc_html__( 'Blocks for teams, services, galleries, testimonials, and features.', 'elemental-addons' ),
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
		),
	),

	'core' => array(
		'label'       => esc_html__( 'Core Widgets', 'elemental-addons' ),
		'description' => esc_html__( 'Accordion.', 'elemental-addons' ),
		'widgets'     => array(
			'accordion' => array(
				'label'  => esc_html__( 'Accordion', 'elemental-addons' ),
				'class'  => $ns . 'Accordion\\TM_Elementor_Accordion',
				'folder' => 'widgets/accordion',
			),
		),
	),

);
