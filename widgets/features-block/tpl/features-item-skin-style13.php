<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;

$image[0] = '';
if( isset($skin_style13_featured_image['id']) && !empty($skin_style13_featured_image['id']) ){
	$image = wp_get_attachment_image_src( $skin_style13_featured_image['id'], 'full');
}
//if empty then use this default image
if( empty($image[0])) {
  $image[0] = ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/shape-1.jpg';
}
?>
<div class="features-block-style13">
  <div class="inner-box" style="--feature-current-style13-bg-featured-image: url('<?php echo esc_url( $image[0] );?>')">
    <div class="title-box">
    <div class="features-icon">
      <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
    </div>
    <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
    </div>
    <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
  </div>
</div>