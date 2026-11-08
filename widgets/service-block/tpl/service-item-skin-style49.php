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

<div class="service-block-style49">
  <div class="inner-block">
    <div class="image">
      <a href="<?php echo esc_url( $url );?>">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      </a>
    </div>
    <div class="content">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <div class="text"><?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?></div>
      <div class="info-box">
        <div class="count-box">
          <div class="count-bar" data-percent="<?php elemental_addons_get_shortcode_template_part( 'part-count', null, 'service-block/tpl', $service_item, false );?>%">
          </div>
        </div>
        <div class="donate-info">
          <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'service-block/tpl', $service_item, false );?>
        </div>
      </div>

      <?php if ( $show_view_details_button == 'yes' ) : ?>
      <a class="btn-style-three" href="<?php echo esc_url( $url );?>"><?php echo esc_html( $settings['view_details_button_text']  ); ?></a>
      <?php endif; ?>

    </div>
  </div>
</div>