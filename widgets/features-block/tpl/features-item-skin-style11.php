<!-- Features Block Style6 -->
<?php
$features_item['settings'] = $settings;
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';

//Bg Image
$featured_image = $features_item['featured_image'];
$featured_image_size = isset( $features_item['featured_image_size'] ) ? $features_item['featured_image_size'] : 'full';
$image = ! empty( $featured_image['id'] ) ? wp_get_attachment_image_src( $featured_image['id'], $featured_image_size ) : null;
?>

<div class="features-block-style11" data-bg="<?php if( isset($image[0]) && !empty($image[0]) ) echo esc_url( $image[0] ); ?>">
  <div class="inner-block">
    <div class="icon-block">
      <div class="icon">
        <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
      </div>
    </div>
    <div class="content-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <div class="features-details">
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
      </div>
    </div>
  </div>
</div>
