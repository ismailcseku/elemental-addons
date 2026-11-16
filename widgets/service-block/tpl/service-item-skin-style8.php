<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>

<div class="service-block-style8">
  <div class="inner-box">
    <div class="image-box">
      <div class="image">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      </div>
      <?php if ( ! empty( $url ) ) : ?>
        <a href="<?php echo esc_url( $url );?>" class="icon"<?php if ( ! empty( $target ) ) : ?> target="_blank"<?php endif; ?>>
          <i class="flaticon-common-arrow-right"></i>
        </a>
      <?php endif; ?>
    </div>
    <div class="content-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
    </div>
  </div>
</div>
