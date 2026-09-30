<?php $features_item['settings'] = $settings; ?>
<?php

$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$image[0] = '';
if( isset($skin_style9_featured_image['id']) && !empty($skin_style9_featured_image['id']) ){
  $image = wp_get_attachment_image_src( $skin_style9_featured_image['id'], 'full');
}

//if empty then use this default image
if( empty($image[0])) {
  $image[0] = ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/shape-1.jpg';
}
?>
<div class="features-block-style9">
  <div class="inner-box" style="--block-feature-style9-bg-featured-image: url('<?php echo esc_url( $image[0] );?>')">
    <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
    <span class="count"><?php echo $features_item['count']; ?></span>
    <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <?php elemental_addons_get_shortcode_template_part( 'button', null, 'features-block/tpl', $features_item, false );?>
    <?php endif; ?>
  </div>
</div>