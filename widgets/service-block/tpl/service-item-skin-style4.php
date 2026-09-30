<!-- Service Block Style4-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block-style4">
  <div class="inner-block">
    <div class="content">
      <?php elemental_addons_get_shortcode_template_part( 'part-count', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="image">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      <div class="text">
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
      </div>
    </div>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <a class="btn-more" href="<?php echo esc_url( $url );?>"<?php echo $target;?>>
        <span class="btn-title"><?php echo esc_html( $settings['view_details_button_text'] ); ?></span>
        <span class="line"></span>
        <span class="arrow lnr-icon-arrow-right1"></span>
      </a>
    <?php endif; ?>
  </div>
</div>