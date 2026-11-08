<!-- Service Block Style13-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
$image_position = $service_item['image_position'];
$featured_image_url = isset($service_item['featured_image']['url']) ? $service_item['featured_image']['url'] : '';
?>

<div class="service-block-style33">
  <div class="inner-box">
    <div class="image-box" data-bg="<?php echo esc_url($featured_image_url); ?>">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="content-box">

      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>

      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>

      <div class="user-info">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image2', null, 'service-block/tpl', $service_item, false );?>
        <div class="user-content ms-3">
          <?php elemental_addons_get_shortcode_template_part( 'part-author', null, 'service-block/tpl', $service_item, false );?>
          <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'service-block/tpl', $service_item, false );?>
        </div>
      </div>
    </div>

    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <a href="<?php echo esc_url( $url );?>" class="read-more-btn"><i class="fa-classic fa fa-arrow-right"></i></a>
    <?php endif; ?>

  </div>
</div>