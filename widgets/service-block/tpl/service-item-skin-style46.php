<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$title = $service_item['title'];
$feature_link = $service_item['feature_link'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
$count = $service_item['count'];
?>
<div class="service-block-style46">
  <div class="inner-box">
    <div class="icon-box">
      <div class="image">
        <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
      </div>
      <span class="number"><?php echo $service_item['count']; ?></span>
    </div>
    <div class="content-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
      <a href="<?php echo esc_url( $url );?>" class="view-more"><i class="fa fa-arrow-right"></i><span><?php echo esc_html( $settings['view_details_button_text']  ); ?></a>
    </div>
  </div>
</div>