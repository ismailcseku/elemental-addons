<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$image[0] = '';
if( isset($skin_style10_featured_image['id']) && !empty($skin_style10_featured_image['id']) ){
  $image = wp_get_attachment_image_src( $skin_style10_featured_image['id'], 'full');
}

//if empty then use this default image
if( empty($image[0])) {
  $image[0] = ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/icon-shape-9.png';
}
?>
<div class="features-block-style11">
  <div class="info-box-wrapper">
    <div class="icon-wrapper elementor-icon">
      <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
    </div>
    <div class="info-text">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
      <?php if ( $show_view_details_button == 'yes' ) : ?>
        <?php elemental_addons_get_shortcode_template_part( 'button', null, 'info-box/tpl', $settings, false );?>
      <?php endif; ?>
    </div>
    <div class="top-shape"></div>
  </div>
</div>