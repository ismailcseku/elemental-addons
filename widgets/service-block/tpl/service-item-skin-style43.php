<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block-style43">
  <div class="inner-box">
    <div class="image-box">
      <div class="bg-gradient-shape"></div>
      <div class="service-featured-img">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      </div>
      <div class="icon-box">
        <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
      </div>
    </div>
    <div class="content-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <div class="text">
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
      </div>
      <a href="<?php echo esc_url( $url );?>" class="btn-more"><?php echo esc_html( $settings['view_details_button_text'] ?? 'Read More' ); ?> <i class="fa fa-arrow-right ms-2"></i></a>
      <div class="count"><?php echo esc_html( str_pad( $count, 2, '0', STR_PAD_LEFT ) ); ?></div>
    </div>
  </div>
</div>