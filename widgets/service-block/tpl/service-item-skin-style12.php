<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';


// Get mask image from upload option or use default
$mask_image_url = '';
if( isset($service_item['featured_image_mask']['id']) && !empty($service_item['featured_image_mask']['id']) ){
	$mask_image = wp_get_attachment_image_src( $service_item['featured_image_mask']['id'], 'full');
	if( isset($mask_image[0]) && !empty($mask_image[0]) ) {
		$mask_image_url = $mask_image[0];
	}
}
//if empty then use this default image
if( empty($mask_image_url)) {
  $mask_image_url = ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/service1-shape-mask1.png';
}

?>
<div class="service-block-style12">
  <div class="inner-column">
    <div class="image-box service-image-mask" style="--service-mask-image: url('<?php echo esc_url( $mask_image_url );?>');">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="content-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
      <?php if ( $show_view_details_button == 'yes' ) : ?>
        <a href="<?php echo esc_url( $feature_link['url'] );?>" class="theme-btn-two"><?php echo esc_html( $view_details_button_text  ); ?> <i class="flaticon-common-arrow-right1"></i></a>
      <?php endif; ?>
    </div>
  </div>
</div>