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

<div class="service-block-style1">
  <div class="inner-block<?php echo ! empty( $service_is_first ) ? ' active' : ''; ?>">
    <div class="title-box">
      <div class="title-inner">
        <div class="count-number">/<?php echo esc_html( $count );?>/</div>
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      </div>
      <div class="arrow-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" focusable="false"><path fill="currentColor" d="M10 6 8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
      </div>
    </div>
    <div class="content-box">
      <div class="inner-box">
        <div class="inner-content">
          <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
          <div class="bottom-box">
            <?php
              // Sanitize the features list
              $list = wp_kses( $service_item['features_list'], 'post' );

              // Split into array by line breaks
              $items = preg_split('/\r\n|\r|\n/', $list);

              if ( ! empty( $items ) ) {
                  echo '<ul class="tag-items">';
                  foreach ( $items as $item ) {
                      $item = trim( $item );
                      if ( ! empty( $item ) ) {
                          echo '<li>' . esc_html( $item ) . '</li>';
                      }
                  }
                  echo '</ul>';
              }
            ?>
            <?php if ( $show_view_details_button == 'yes' ) : ?>
            <a href="<?php echo esc_url( $url );?>" class="service-btn"<?php if ( ! empty( $target ) ) : ?> target="_blank"<?php endif; ?>>
              <?php echo esc_html( $view_details_button_text  ); ?>
            </a>
            <?php endif; ?>
          </div>
        </div>
        <div class="image-box">
          <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
        </div>
      </div>
    </div>
  </div>
</div>