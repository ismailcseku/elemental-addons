<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$title = $service_item['title'];
$feature_link = $service_item['feature_link'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
$url = ! empty( $settings['view_details_button_url']['url'] ) ? $settings['view_details_button_url']['url'] : '#';

// Get dynamic text from Elementor
$lower_text = ! empty( $settings['lower_text'] ) ? $settings['lower_text'] : '';
?>



<div class="service-block-style13 service-item">

  <?php elemental_addons_get_shortcode_template_part( 'part-list-three', null, 'service-block/tpl', $service_item, false );?>

  <div class="options-text">
      <?php if ( $lower_text ) : ?>
          <div class="lower-text">
              <?php echo esc_html( $lower_text ); ?>
          </div>
      <?php endif; ?>

      <?php if ( $show_view_details_button == 'yes' ) : ?>
      <div class="options">
          <a class="button" href="<?php echo esc_url( $url );?>">
              <?php echo esc_html( $settings['view_details_button_text'] ); ?>
          </a>
          <a class="arrow fa-classic fa fa-arrow-right fa-fw" href="<?php echo esc_url( $url );?>"></a>
      </div>
      <?php endif; ?>

  </div>

  <?php elemental_addons_get_shortcode_template_part( 'part-list-four', null, 'service-block/tpl', $service_item, false );?>

</div>
