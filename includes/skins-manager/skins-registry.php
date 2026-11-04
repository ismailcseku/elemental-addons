<?php
/**
 * Registry of Elementor skins shipped by Elemental Addons.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return array(

	'accordion' => array(
		'label' => esc_html__( 'Accordion', 'elemental-addons' ),
		'skins' => array(
			'skin-active-light' => array(
				'label'   => esc_html__( 'Skin Light Color on Active', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Accordion\\Skins\\Skin_Accordion_Light_Active',
				'file'    => 'widgets/accordion/skins/skin-active-light.php',
				'default' => true,
				'preview' => 'assets/images/skins/accordion/skin-active-light.svg',
			),
			'skin-basic' => array(
				'label'   => esc_html__( 'Skin Basic', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Accordion\\Skins\\Skin_Accordion_Basic',
				'file'    => 'widgets/accordion/skins/skin-basic.php',
				'default' => true,
				'preview' => 'assets/images/skins/accordion/skin-basic.svg',
			),
			'skin-bordered' => array(
				'label'   => esc_html__( 'Skin Bordered', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Accordion\\Skins\\Skin_Accordion_Bordered',
				'file'    => 'widgets/accordion/skins/skin-bordered.php',
				'default' => true,
				'preview' => 'assets/images/skins/accordion/skin-bordered.svg',
			),
			'skin-bordered2' => array(
				'label'   => esc_html__( 'Skin Bordered2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Accordion\\Skins\\Skin_Accordion_Bordered2',
				'file'    => 'widgets/accordion/skins/skin-bordered2.php',
				'default' => true,
				'preview' => 'assets/images/skins/accordion/skin-bordered2.svg',
			),
			'skin-classic' => array(
				'label'   => esc_html__( 'Skin Classic', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Accordion\\Skins\\Skin_Accordion_Classic',
				'file'    => 'widgets/accordion/skins/skin-classic.php',
				'default' => true,
				'preview' => 'assets/images/skins/accordion/skin-classic.svg',
			),
			'skin-gradient' => array(
				'label'   => esc_html__( 'Skin Gradient', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Accordion\\Skins\\Skin_Accordion_Gradient',
				'file'    => 'widgets/accordion/skins/skin-gradient.php',
				'default' => true,
				'preview' => 'assets/images/skins/accordion/skin-gradient.svg',
			),
		),
	),

	'blog' => array(
		'label' => esc_html__( 'Blog', 'elemental-addons' ),
		'skins' => array(
			'skin-style-current-theme1' => array(
				'label'   => esc_html__( 'Style Current Theme1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Blog\\Skins\\Skin_Style_Current_Theme1',
				'file'    => 'cpt/blog/skins/skin-style-current-theme1.php',
				'default' => true,
				'preview' => 'assets/images/skins/blog/skin-style-current-theme1.svg',
			),
			'skin-style-current-theme2' => array(
				'label'   => esc_html__( 'Style Current Theme2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Blog\\Skins\\Skin_Style_Current_Theme2',
				'file'    => 'cpt/blog/skins/skin-style-current-theme2.php',
				'default' => true,
				'preview' => 'assets/images/skins/blog/skin-style-current-theme2.svg',
			),
			'skin-style-current-theme3' => array(
				'label'   => esc_html__( 'Style Current Theme3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Blog\\Skins\\Skin_Style_Current_Theme3',
				'file'    => 'cpt/blog/skins/skin-style-current-theme3.php',
				'default' => true,
				'preview' => 'assets/images/skins/blog/skin-style-current-theme3.svg',
			),
			'skin-style-current-theme4' => array(
				'label'   => esc_html__( 'Style Current Theme4', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Blog\\Skins\\Skin_Style_Current_Theme4',
				'file'    => 'cpt/blog/skins/skin-style-current-theme4.php',
				'default' => true,
				'preview' => 'assets/images/skins/blog/skin-style-current-theme4.svg',
			),
			'skin-style-current-theme5' => array(
				'label'   => esc_html__( 'Style Current Theme5', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Blog\\Skins\\Skin_Style_Current_Theme5',
				'file'    => 'cpt/blog/skins/skin-style-current-theme5.php',
				'default' => true,
				'preview' => 'assets/images/skins/blog/skin-style-current-theme5.svg',
			),
			'skin-vertical-list' => array(
				'label'   => esc_html__( 'Style - Vertical List', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\Blog\\Skins\\Skin_Vertical_List',
				'file'    => 'cpt/blog/skins/skin-vertical-list.php',
				'default' => true,
				'preview' => 'assets/images/skins/blog/skin-vertical-list.svg',
			),
		),
	),

	'counter-block' => array(
		'label' => esc_html__( 'Counter Block', 'elemental-addons' ),
		'skins' => array(
			'skin-style1' => array(
				'label'   => esc_html__( 'Skin Style1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\CounterBlock\\Skins\\Skin_Style1',
				'file'    => 'widgets/counter-block/skins/skin-style1.php',
				'default' => true,
				'preview' => 'assets/images/skins/counter-block/skin-style1.svg',
			),
			'skin-style2' => array(
				'label'   => esc_html__( 'Skin Style2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\CounterBlock\\Skins\\Skin_Style2',
				'file'    => 'widgets/counter-block/skins/skin-style2.php',
				'default' => true,
				'preview' => 'assets/images/skins/counter-block/skin-style2.svg',
			),
			'skin-style3' => array(
				'label'   => esc_html__( 'Skin Style3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\CounterBlock\\Skins\\Skin_Style3',
				'file'    => 'widgets/counter-block/skins/skin-style3.php',
				'default' => true,
				'preview' => 'assets/images/skins/counter-block/skin-style3.svg',
			),
			'skin-style4' => array(
				'label'   => esc_html__( 'Skin Style4', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\CounterBlock\\Skins\\Skin_Style4',
				'file'    => 'widgets/counter-block/skins/skin-style4.php',
				'default' => true,
				'preview' => 'assets/images/skins/counter-block/skin-style4.svg',
			),
			'skin-style5' => array(
				'label'   => esc_html__( 'Skin Style5', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\CounterBlock\\Skins\\Skin_Style5',
				'file'    => 'widgets/counter-block/skins/skin-style5.php',
				'default' => false,
				'preview' => 'assets/images/skins/counter-block/skin-style5.svg',
			),
			'skin-style6' => array(
				'label'   => esc_html__( 'Skin Style6', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\CounterBlock\\Skins\\Skin_Style6',
				'file'    => 'widgets/counter-block/skins/skin-style6.php',
				'default' => false,
				'preview' => 'assets/images/skins/counter-block/skin-style6.svg',
			),
			'skin-style7' => array(
				'label'   => esc_html__( 'Skin Style7', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\CounterBlock\\Skins\\Skin_Style7',
				'file'    => 'widgets/counter-block/skins/skin-style7.php',
				'default' => false,
				'preview' => 'assets/images/skins/counter-block/skin-style7.svg',
			),
		),
	),

	'features-block' => array(
		'label' => esc_html__( 'Features Block', 'elemental-addons' ),
		'skins' => array(
			'skin-style1' => array(
				'label'   => esc_html__( 'Skin Style1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style1',
				'file'    => 'widgets/features-block/skins/skin-style1.php',
				'default' => true,
				'preview' => 'assets/images/skins/features-block/skin-style1.svg',
			),
			'skin-style10' => array(
				'label'   => esc_html__( 'Skin Style10', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style10',
				'file'    => 'widgets/features-block/skins/skin-style10.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style10.svg',
			),
			'skin-style11' => array(
				'label'   => esc_html__( 'Skin Style11', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style11',
				'file'    => 'widgets/features-block/skins/skin-style11.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style11.svg',
			),
			'skin-style12' => array(
				'label'   => esc_html__( 'Skin Style12', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style12',
				'file'    => 'widgets/features-block/skins/skin-style12.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style12.svg',
			),
			'skin-style13' => array(
				'label'   => esc_html__( 'Skin Style13', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style13',
				'file'    => 'widgets/features-block/skins/skin-style13.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style13.svg',
			),
			'skin-style14' => array(
				'label'   => esc_html__( 'Skin Style14', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style14',
				'file'    => 'widgets/features-block/skins/skin-style14.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style14.svg',
			),
			'skin-style15' => array(
				'label'   => esc_html__( 'Skin Style15', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style15',
				'file'    => 'widgets/features-block/skins/skin-style15.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style15.svg',
			),
			'skin-style16' => array(
				'label'   => esc_html__( 'Skin Style16', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style16',
				'file'    => 'widgets/features-block/skins/skin-style16.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style16.svg',
			),
			'skin-style2' => array(
				'label'   => esc_html__( 'Skin Style2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style2',
				'file'    => 'widgets/features-block/skins/skin-style2.php',
				'default' => true,
				'preview' => 'assets/images/skins/features-block/skin-style2.svg',
			),
			'skin-style3' => array(
				'label'   => esc_html__( 'Skin Style3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style3',
				'file'    => 'widgets/features-block/skins/skin-style3.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style3.svg',
			),
			'skin-style4' => array(
				'label'   => esc_html__( 'Skin Style4', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style4',
				'file'    => 'widgets/features-block/skins/skin-style4.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style4.svg',
			),
			'skin-style5' => array(
				'label'   => esc_html__( 'Skin Style5', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style5',
				'file'    => 'widgets/features-block/skins/skin-style5.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style5.svg',
			),
			'skin-style6' => array(
				'label'   => esc_html__( 'Skin Style6', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style6',
				'file'    => 'widgets/features-block/skins/skin-style6.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style6.svg',
			),
			'skin-style7' => array(
				'label'   => esc_html__( 'Skin Style7', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style7',
				'file'    => 'widgets/features-block/skins/skin-style7.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style7.svg',
			),
			'skin-style8' => array(
				'label'   => esc_html__( 'Skin Style8', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style8',
				'file'    => 'widgets/features-block/skins/skin-style8.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style8.svg',
			),
			'skin-style9' => array(
				'label'   => esc_html__( 'Skin Style9', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\FeaturesBlock\\Skins\\Skin_Style9',
				'file'    => 'widgets/features-block/skins/skin-style9.php',
				'default' => false,
				'preview' => 'assets/images/skins/features-block/skin-style9.svg',
			),
		),
	),

	'image-gallery' => array(
		'label' => esc_html__( 'Image Gallery', 'elemental-addons' ),
		'skins' => array(
			'skin-style-current-theme1' => array(
				'label'   => esc_html__( 'Skin - Style Current Theme1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ImageGallery\\Skins\\Skin_Style_Current_Theme1',
				'file'    => 'widgets/image-gallery/skins/skin-style-current-theme1.php',
				'default' => true,
				'preview' => 'assets/images/skins/image-gallery/skin-style-current-theme1.svg',
			),
			'skin-style-current-theme2' => array(
				'label'   => esc_html__( 'Skin - Style Current Theme2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ImageGallery\\Skins\\Skin_Style_Current_Theme2',
				'file'    => 'widgets/image-gallery/skins/skin-style-current-theme2.php',
				'default' => true,
				'preview' => 'assets/images/skins/image-gallery/skin-style-current-theme2.svg',
			),
			'skin-style-current-theme3' => array(
				'label'   => esc_html__( 'Skin - Style Current Theme3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ImageGallery\\Skins\\Skin_Style_Current_Theme3',
				'file'    => 'widgets/image-gallery/skins/skin-style-current-theme3.php',
				'default' => true,
				'preview' => 'assets/images/skins/image-gallery/skin-style-current-theme3.svg',
			),
		),
	),

	'pricing-block' => array(
		'label' => esc_html__( 'Pricing Block', 'elemental-addons' ),
		'skins' => array(
			'skin-style1' => array(
				'label'   => esc_html__( 'Skin Style1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\PricingBlock\\Skins\\Skin_Style1',
				'file'    => 'widgets/pricing-block/skins/skin-style1.php',
				'default' => true,
				'preview' => 'assets/images/skins/pricing-block/skin-style1.svg',
			),
			'skin-style2' => array(
				'label'   => esc_html__( 'Skin Style2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\PricingBlock\\Skins\\Skin_Style2',
				'file'    => 'widgets/pricing-block/skins/skin-style2.php',
				'default' => true,
				'preview' => 'assets/images/skins/pricing-block/skin-style2.svg',
			),
			'skin-style3' => array(
				'label'   => esc_html__( 'Skin Style3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\PricingBlock\\Skins\\Skin_Style3',
				'file'    => 'widgets/pricing-block/skins/skin-style3.php',
				'default' => true,
				'preview' => 'assets/images/skins/pricing-block/skin-style3.svg',
			),
		),
	),

	'pricing-plan' => array(
		'label' => esc_html__( 'Pricing Plan', 'elemental-addons' ),
		'skins' => array(
			'skin-style1' => array(
				'label'   => esc_html__( 'Skin Pricing Style1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\PricingPlan\\Skins\\Skin_Pricing_Style1',
				'file'    => 'widgets/pricing-plan/skins/skin-style1.php',
				'default' => true,
				'preview' => 'assets/images/skins/pricing-plan/skin-style1.svg',
			),
			'skin-style2' => array(
				'label'   => esc_html__( 'Skin Pricing Style2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\PricingPlan\\Skins\\Skin_Pricing_Style2',
				'file'    => 'widgets/pricing-plan/skins/skin-style2.php',
				'default' => true,
				'preview' => 'assets/images/skins/pricing-plan/skin-style2.svg',
			),
			'skin-style3' => array(
				'label'   => esc_html__( 'Skin Pricing Style3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\PricingPlan\\Skins\\Skin_Pricing_Style3',
				'file'    => 'widgets/pricing-plan/skins/skin-style3.php',
				'default' => true,
				'preview' => 'assets/images/skins/pricing-plan/skin-style3.svg',
			),
			'skin-style4' => array(
				'label'   => esc_html__( 'Skin Pricing Style4', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\PricingPlan\\Skins\\Skin_Pricing_Style4',
				'file'    => 'widgets/pricing-plan/skins/skin-style4.php',
				'default' => true,
				'preview' => 'assets/images/skins/pricing-plan/skin-style4.svg',
			),
		),
	),

	'service-block' => array(
		'label' => esc_html__( 'Service Block', 'elemental-addons' ),
		'skins' => array(
			'skin-creative1' => array(
				'label'   => esc_html__( 'Skin Creative 1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Creative1',
				'file'    => 'widgets/service-block/skins/skin-creative1.php',
				'default' => false,
				'preview' => 'assets/images/skins/service-block/skin-creative1.svg',
			),
			'skin-cursor-floating-info' => array(
				'label'   => esc_html__( 'Skin Cursor Floating Info', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Cursor_Floating_Info',
				'file'    => 'widgets/service-block/skins/skin-cursor-floating-info.php',
				'default' => false,
				'preview' => 'assets/images/skins/service-block/skin-cursor-floating-info.svg',
			),
			'skin-style1' => array(
				'label'   => esc_html__( 'Skin Style1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Style1',
				'file'    => 'widgets/service-block/skins/skin-style1.php',
				'default' => true,
				'preview' => 'assets/images/skins/service-block/skin-style1.svg',
			),
			'skin-style10' => array(
				'label'   => esc_html__( 'Skin Style10', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Style10',
				'file'    => 'widgets/service-block/skins/skin-style10.php',
				'default' => false,
				'preview' => 'assets/images/skins/service-block/skin-style10.svg',
			),
			'skin-style2' => array(
				'label'   => esc_html__( 'Skin Style2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Style2',
				'file'    => 'widgets/service-block/skins/skin-style2.php',
				'default' => true,
				'preview' => 'assets/images/skins/service-block/skin-style2.svg',
			),
			'skin-style3' => array(
				'label'   => esc_html__( 'Skin Style3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Style3',
				'file'    => 'widgets/service-block/skins/skin-style3.php',
				'default' => true,
				'preview' => 'assets/images/skins/service-block/skin-style3.svg',
			),
			'skin-style4' => array(
				'label'   => esc_html__( 'Skin Style4', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Style4',
				'file'    => 'widgets/service-block/skins/skin-style4.php',
				'default' => true,
				'preview' => 'assets/images/skins/service-block/skin-style4.svg',
			),
			'skin-style5' => array(
				'label'   => esc_html__( 'Skin Style5', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Style5',
				'file'    => 'widgets/service-block/skins/skin-style5.php',
				'default' => false,
				'preview' => 'assets/images/skins/service-block/skin-style5.svg',
			),
			'skin-style6' => array(
				'label'   => esc_html__( 'Skin Style6', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Style6',
				'file'    => 'widgets/service-block/skins/skin-style6.php',
				'default' => false,
				'preview' => 'assets/images/skins/service-block/skin-style6.svg',
			),
			'skin-style7' => array(
				'label'   => esc_html__( 'Skin Style7', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Style7',
				'file'    => 'widgets/service-block/skins/skin-style7.php',
				'default' => false,
				'preview' => 'assets/images/skins/service-block/skin-style7.svg',
			),
			'skin-style8' => array(
				'label'   => esc_html__( 'Skin Style8', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Style8',
				'file'    => 'widgets/service-block/skins/skin-style8.php',
				'default' => false,
				'preview' => 'assets/images/skins/service-block/skin-style8.svg',
			),
			'skin-style9' => array(
				'label'   => esc_html__( 'Skin Style9', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ServiceBlock\\Skins\\Skin_Style9',
				'file'    => 'widgets/service-block/skins/skin-style9.php',
				'default' => false,
				'preview' => 'assets/images/skins/service-block/skin-style9.svg',
			),
		),
	),

	'team-block' => array(
		'label' => esc_html__( 'Team Block', 'elemental-addons' ),
		'skins' => array(
			'skin-style1' => array(
				'label'   => esc_html__( 'Skin Style1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TeamBlock\\Skins\\Skin_Style1',
				'file'    => 'widgets/team-block/skins/skin-style1.php',
				'default' => true,
				'preview' => 'assets/images/skins/team-block/skin-style1.svg',
			),
			'skin-style2' => array(
				'label'   => esc_html__( 'Skin Style2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TeamBlock\\Skins\\Skin_Style2',
				'file'    => 'widgets/team-block/skins/skin-style2.php',
				'default' => true,
				'preview' => 'assets/images/skins/team-block/skin-style2.svg',
			),
			'skin-style3' => array(
				'label'   => esc_html__( 'Skin Style3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TeamBlock\\Skins\\Skin_Style3',
				'file'    => 'widgets/team-block/skins/skin-style3.php',
				'default' => true,
				'preview' => 'assets/images/skins/team-block/skin-style3.svg',
			),
			'skin-style4' => array(
				'label'   => esc_html__( 'Skin Style4', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TeamBlock\\Skins\\Skin_Style4',
				'file'    => 'widgets/team-block/skins/skin-style4.php',
				'default' => false,
				'preview' => 'assets/images/skins/team-block/skin-style4.svg',
			),
			'skin-style5' => array(
				'label'   => esc_html__( 'Skin Style5', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TeamBlock\\Skins\\Skin_Style5',
				'file'    => 'widgets/team-block/skins/skin-style5.php',
				'default' => false,
				'preview' => 'assets/images/skins/team-block/skin-style5.svg',
			),
			'skin-style6' => array(
				'label'   => esc_html__( 'Skin Style6', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TeamBlock\\Skins\\Skin_Style6',
				'file'    => 'widgets/team-block/skins/skin-style6.php',
				'default' => false,
				'preview' => 'assets/images/skins/team-block/skin-style6.svg',
			),
			'skin-style7' => array(
				'label'   => esc_html__( 'Skin Style7', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TeamBlock\\Skins\\Skin_Style7',
				'file'    => 'widgets/team-block/skins/skin-style7.php',
				'default' => false,
				'preview' => 'assets/images/skins/team-block/skin-style7.svg',
			),
			'skin-style8' => array(
				'label'   => esc_html__( 'Skin Style8', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TeamBlock\\Skins\\Skin_Style8',
				'file'    => 'widgets/team-block/skins/skin-style8.php',
				'default' => false,
				'preview' => 'assets/images/skins/team-block/skin-style8.svg',
			),
			'skin-style9' => array(
				'label'   => esc_html__( 'Skin Style9', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TeamBlock\\Skins\\Skin_Style9',
				'file'    => 'widgets/team-block/skins/skin-style9.php',
				'default' => false,
				'preview' => 'assets/images/skins/team-block/skin-style9.svg',
			),
		),
	),

	'testimonial-block' => array(
		'label' => esc_html__( 'Testimonial Block', 'elemental-addons' ),
		'skins' => array(
			'skin-single' => array(
				'label'   => esc_html__( 'Skin Single Testimonial', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TestimonialBlock\\Skins\\Skin_Single',
				'file'    => 'widgets/testimonial-block/skins/skin-single.php',
				'default' => false,
				'preview' => 'assets/images/skins/testimonial-block/skin-single.svg',
			),
			'skin-style1' => array(
				'label'   => esc_html__( 'Skin Style1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TestimonialBlock\\Skins\\Skin_Style1',
				'file'    => 'widgets/testimonial-block/skins/skin-style1.php',
				'default' => true,
				'preview' => 'assets/images/skins/testimonial-block/skin-style1.svg',
			),
			'skin-style2' => array(
				'label'   => esc_html__( 'Skin Style2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TestimonialBlock\\Skins\\Skin_Style2',
				'file'    => 'widgets/testimonial-block/skins/skin-style2.php',
				'default' => true,
				'preview' => 'assets/images/skins/testimonial-block/skin-style2.svg',
			),
			'skin-style3' => array(
				'label'   => esc_html__( 'Skin Style3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TestimonialBlock\\Skins\\Skin_Style3',
				'file'    => 'widgets/testimonial-block/skins/skin-style3.php',
				'default' => false,
				'preview' => 'assets/images/skins/testimonial-block/skin-style3.svg',
			),
			'skin-style4' => array(
				'label'   => esc_html__( 'Skin Style4', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TestimonialBlock\\Skins\\Skin_Style4',
				'file'    => 'widgets/testimonial-block/skins/skin-style4.php',
				'default' => false,
				'preview' => 'assets/images/skins/testimonial-block/skin-style4.svg',
			),
			'skin-style5' => array(
				'label'   => esc_html__( 'Skin Style5', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TestimonialBlock\\Skins\\Skin_Style5',
				'file'    => 'widgets/testimonial-block/skins/skin-style5.php',
				'default' => false,
				'preview' => 'assets/images/skins/testimonial-block/skin-style5.svg',
			),
			'skin-style6' => array(
				'label'   => esc_html__( 'Skin Style6', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\TestimonialBlock\\Skins\\Skin_Style6',
				'file'    => 'widgets/testimonial-block/skins/skin-style6.php',
				'default' => false,
				'preview' => 'assets/images/skins/testimonial-block/skin-style6.svg',
			),
		),
	),

	'theme-button' => array(
		'label' => esc_html__( 'Theme Button', 'elemental-addons' ),
		'skins' => array(
			'skin-style1' => array(
				'label'   => esc_html__( 'Theme Button Style1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ThemeButton\\Skins\\Skin_Style1',
				'file'    => 'widgets/theme-button/skins/skin-style1.php',
				'default' => true,
				'preview' => 'assets/images/skins/theme-button/skin-style1.svg',
			),
			'skin-style2' => array(
				'label'   => esc_html__( 'Theme Button Style2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ThemeButton\\Skins\\Skin_Style2',
				'file'    => 'widgets/theme-button/skins/skin-style2.php',
				'default' => true,
				'preview' => 'assets/images/skins/theme-button/skin-style2.svg',
			),
			'skin-style3' => array(
				'label'   => esc_html__( 'Theme Button Style3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ThemeButton\\Skins\\Skin_Style3',
				'file'    => 'widgets/theme-button/skins/skin-style3.php',
				'default' => true,
				'preview' => 'assets/images/skins/theme-button/skin-style3.svg',
			),
			'skin-style4' => array(
				'label'   => esc_html__( 'Theme Button Style4', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ThemeButton\\Skins\\Skin_Style4',
				'file'    => 'widgets/theme-button/skins/skin-style4.php',
				'default' => true,
				'preview' => 'assets/images/skins/theme-button/skin-style4.svg',
			),
			'skin-style5' => array(
				'label'   => esc_html__( 'Theme Button Style5', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\ThemeButton\\Skins\\Skin_Style5',
				'file'    => 'widgets/theme-button/skins/skin-style5.php',
				'default' => true,
				'preview' => 'assets/images/skins/theme-button/skin-style5.svg',
			),
		),
	),

	'working-block' => array(
		'label' => esc_html__( 'Working Block', 'elemental-addons' ),
		'skins' => array(
			'skin-style1' => array(
				'label'   => esc_html__( 'Skin Style1', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\WorkingBlock\\Skins\\Skin_Style1',
				'file'    => 'widgets/working-block/skins/skin-style1.php',
				'default' => true,
				'preview' => 'assets/images/skins/working-block/skin-style1.svg',
			),
			'skin-style2' => array(
				'label'   => esc_html__( 'Skin Style2', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\WorkingBlock\\Skins\\Skin_Style2',
				'file'    => 'widgets/working-block/skins/skin-style2.php',
				'default' => true,
				'preview' => 'assets/images/skins/working-block/skin-style2.svg',
			),
			'skin-style3' => array(
				'label'   => esc_html__( 'Skin Style3', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\WorkingBlock\\Skins\\Skin_Style3',
				'file'    => 'widgets/working-block/skins/skin-style3.php',
				'default' => true,
				'preview' => 'assets/images/skins/working-block/skin-style3.svg',
			),
			'skin-style4' => array(
				'label'   => esc_html__( 'Skin Style4', 'elemental-addons' ),
				'class'   => 'ElementalAddons\\Widgets\\WorkingBlock\\Skins\\Skin_Style4',
				'file'    => 'widgets/working-block/skins/skin-style4.php',
				'default' => true,
				'preview' => 'assets/images/skins/working-block/skin-style4.svg',
			),
		),
	),

);
