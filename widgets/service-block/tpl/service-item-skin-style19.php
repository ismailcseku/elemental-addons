<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
$image_position = $service_item['image_position'];
?>

<div class="service-block-style19">
  <div class="row feature-row g-0 <?php echo esc_attr( $image_position );?>">
    <div class="image-column col-lg-4">
      <div class="inner-column">
        <div class="image-box">
          <div class="image overlay-anim">
            <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
          </div>
        </div>
      </div>
    </div>
    <div class="content-column col-lg-8" >
      <div class="inner-column">
        <div class="content-box">
          <div class="sec-title">
            <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'service-block/tpl', $service_item, false );?>
            <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
            <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
          </div>
          <?php if ( $show_view_details_button == 'yes' ) : ?>
          <?php elemental_addons_get_shortcode_template_part( 'button', null, 'service-block/tpl', $service_item, false );?>
          <?php endif; ?>
          <div class="icon">
            <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>