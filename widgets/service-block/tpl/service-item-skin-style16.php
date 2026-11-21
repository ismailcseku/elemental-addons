<!-- Service Block Style16 (from Skin 23 / greenland) -->
<?php
$service_item['settings']      = $settings;
$service_item['title_tag']     = $title_tag;
$service_item['subtitle_tag']  = $subtitle_tag;
$feature_link                  = $service_item['feature_link'];
$target                        = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url                           = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
$featured_image                = isset( $service_item['featured_image'] ) ? $service_item['featured_image'] : array();
$featured_image_size           = isset( $service_item['featured_image_size'] ) ? $service_item['featured_image_size'] : 'full';
?>

<div class="service-block-style16">
  <div class="inner-block">
    <div class="image-box">
      <div class="icon-block">
        <div class="icon">
          <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
        </div>
      </div>

      <?php if ( ! empty( $featured_image['id'] ) ) : ?>
      <div class="image">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      </div>
      <?php endif; ?>
    </div>

    <div class="content-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <a class="btn-more" href="<?php echo esc_url( $url );?>">
        <i class="ei ei-arrow-right"></i>
      </a>
    </div>
  </div>
</div>
