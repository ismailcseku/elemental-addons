<!-- Service Block Style2-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = isset( $service_item['feature_link'] ) ? $service_item['feature_link'] : [];
$count = isset( $service_item['count'] ) ? $service_item['count'] : '';
$target = ( $feature_link && ! empty( $feature_link['is_external'] ) ) ? ' target="_blank"' : '';
$url = ( $feature_link && ! empty( $feature_link['url'] ) ) ? $feature_link['url'] : '';
$services_list_lines = ! empty( $service_item['services_list'] ) ? array_filter( array_map( 'trim', explode( "\n", $service_item['services_list'] ) ) ) : [];
?>

<div class="service-block-style29">
  <div class="inner-block">
    <div class="title-block">
      <?php if( !empty( $count ) ) : ?>
			  <span class="number"><?php echo esc_html( $count ); ?><span class="dots">.</span></span>
        <?php endif; ?>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false ); ?>
    </div>
    <div class="image-block">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="content-block">
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false ); ?>
      <?php if ( $show_view_details_button == 'yes' ) : ?>
        <div class="btn-box">
          <a href="<?php echo esc_url( $url );?>">
            <span class="arrow-left"><i class="lnr-icon-arrow-right1"></i></span>
            <span class="btn-title"><?php echo esc_html( $view_details_button_text  ); ?></span>
            <span class="arrow-right"><i class="lnr-icon-arrow-right1"></i></span>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>