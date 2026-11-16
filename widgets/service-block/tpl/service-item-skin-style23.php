<!-- Service Block Style1-->
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

<div class="service-block-style23">
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
        <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 8.00008L15 8.00008M18.3361 8.01939C15.2241 7.82927 9 9.16017 9 16.0048M18.3361 7.98545C15.2241 8.17558 9 6.84467 9 0" stroke="#0c2f25" stroke-width="1.5"/>
        </svg>
      </a>
    </div>
  </div>
</div>