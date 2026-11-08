<!-- Service Block Nine -->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>

<div class="service-block-style50">
  <div class="inner-box">
    <div class="bg bg-image"></div>
    <div class="image-two">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image-two', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="content-box-hover">
      <div class="content-box">
        <div class="icon">
          <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
        </div>
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
        <a class="read-more" href="<?php echo esc_url( $url );?>"><i class="fa-sharp fa fa-arrow-right"></i></a>
      </div>
      <div class="image-box">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      </div>
    </div>
  </div>
</div>