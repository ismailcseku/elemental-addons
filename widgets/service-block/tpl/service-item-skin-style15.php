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
  <div class="service-block service-block-style15">
    <div class="inner-block">
      <div class="service-icon">
          <?php if ( isset( $settings['icon_type'] ) && $settings['icon_type'] === 'image' && ! empty( $settings['icon_image']['url'] ) ) : ?>
            <img class="icon" src="<?php echo esc_url( $settings['icon_image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
          <?php else : ?>
            <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
          <?php endif; ?>
        </div>
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
        <?php if ( $show_view_details_button == 'yes' ) : ?>
          <a class="service-btn" href="<?php echo esc_url( $url );?>">
            <span class="btn-title"><?php echo esc_html( $view_details_button_text  ); ?></span>
          </a>
        <?php endif; ?>
    </div>
  </div>