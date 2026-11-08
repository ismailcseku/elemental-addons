<!-- Service Block Two -->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block-style30">
  <div class="inner-box">
    <div class="image-box">
      <div class="image">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      </div>
      <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="content">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
      <?php if ( $show_view_details_button == 'yes' ) : ?>
        <a href="<?php echo esc_url( $url );?>" <?php echo esc_html( $settings['view_details_button_text']  ); ?> <i class="icon fa fa-angle-double-right"></i></a>
      <?php endif; ?>
    </div>
  </div>
</div>