<!-- Service Block Style4-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
$featured_image = isset( $service_item['featured_image'] ) ? $service_item['featured_image'] : array();
$featured_image_size = isset( $service_item['featured_image_size'] ) ? $service_item['featured_image_size'] : 'full';
?>
<div class="service-block-style6">
  <div class="inner-block">
    <div class="content">
      <?php elemental_addons_get_shortcode_template_part( 'part-count', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="image">
      <?php if ( is_array( $featured_image ) && ! empty( $featured_image['id'] ) ) :
        $image_alt = get_post_meta( $featured_image['id'], '_wp_attachment_image_alt', true );
        $image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size );
        if ( ! empty( $image[0] ) ) :
          for ( $i = 0; $i < 2; $i++ ) : ?>
            <img src="<?php echo esc_url( $image[0] ); ?>" width="<?php echo esc_attr( $image[1] ); ?>" height="<?php echo esc_attr( $image[2] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
          <?php endfor;
        endif;
      elseif ( is_array( $featured_image ) && ! empty( $featured_image['url'] ) ) :
        for ( $i = 0; $i < 2; $i++ ) : ?>
          <img src="<?php echo esc_url( $featured_image['url'] ); ?>" alt="">
        <?php endfor;
      endif; ?>
      <div class="text">
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
      </div>
    </div>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <a class="btn-more" href="<?php echo esc_url( $url );?>"<?php echo $target;?>>
        <span class="btn-title"><?php echo esc_html( $settings['view_details_button_text'] ); ?></span>
        <span class="line"></span>
        <span class="arrow"><i class="ei ei-arrow-right"></i></span>
      </a>
    <?php endif; ?>
  </div>
</div>
