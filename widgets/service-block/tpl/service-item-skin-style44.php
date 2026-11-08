<!-- Service Block Style7 (Accordion) -->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block-style44">
  <div class="inner-box">
    <div class="title-box">
      <div class="inner-title-box">
        <span class="count-prefix"><?php echo esc_html( $count ); ?>.</span>
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false ); ?>
      </div>
      <a href="<?php echo esc_url( $url ); ?>"<?php echo $target; ?> class="arrow-icon">
        <i class="flaticon-common-arrow-right"></i>
      </a>
    </div>
    <div class="content-box">
      <div class="inner-content">
        <div class="text">
          <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false ); ?>
        </div>
        <?php elemental_addons_get_shortcode_template_part( 'part-service-list-tagboxes', null, 'service-block/tpl', $service_item, false ); ?>
      </div>
      <div class="image-box">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false ); ?>
      </div>
    </div>
  </div>
</div>
