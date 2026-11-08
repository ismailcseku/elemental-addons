<!-- Service Block Style2-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block service-block-style48">
  <div class="inner-block">
    <div class="service-image">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="service-icons">
      <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
    </div>

    <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
    <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <a href="<?php echo esc_url( $feature_link['url'] );?>" class="service-button-one">
        <?php echo esc_html( $view_details_button_text  ); ?>
        <i class="flaticon-common-right-arrow"></i>
      </a>
    <?php endif; ?>
  </div>
</div>