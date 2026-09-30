<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
?>

<?php if ( $service_items_array ) : ?>
<div class="service-creative-tab">
  <div class="row">
    <div class="col-lg-6">
      <?php
        foreach (  $service_items_array as $key => $service_item ) {
          $feature_link = $service_item['feature_link'];
          $target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
          $url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
      ?>
      <div class="service-item <?php if ($key === array_key_first($service_items_array)) { echo esc_attr( 'current' ); }?>" data-tab="tab-<?php echo esc_attr($holder_id. '-' . $key);?>">
        <div class="info">
          <h4 class="service-title"><?php echo esc_html($service_item['title']);?></h4>
          <h6 class="service-subtitle"><?php echo esc_html($service_item['subtitle']);?></h6>
          <?php if ( $settings['show_paragraph'] == 'yes' ) { ?>
          <div class="service-content"><?php echo wp_kses($service_item['content'], 'post' ); ?></div>
          <?php } ?>
        </div>
        <div class="link-block">
          <a <?php if ( ! empty( $target ) ) : ?> target="_blank"<?php endif; ?> href="<?php echo esc_url( $url );?>">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 30 30">
              <g id="surface1">
              <path d="M 29.992188 23.992188 L 30 0 L 6 0.00390625 L 5.996094 3 L 24.878906 3 L 0 27.878906 L 2.121094 30 L 27 5.121094 L 27 24 Z M 29.992188 23.992188 "/>
              </g>
            </svg>
          </a>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="col-lg-5 offset-lg-1">
      <div class="item-images">
        <?php
          foreach (  $service_items_array as $key => $service_item ) {
            $featured_image = $service_item['featured_image'];
            $featured_image_size = $service_item['featured_image_size'];
            $image_alt = get_post_meta($featured_image['id'], '_wp_attachment_image_alt', TRUE);
        ?>
        <div id="tab-<?php echo esc_attr($holder_id. '-' . $key);?>" class="each-image <?php if ($key === array_key_first($service_items_array)) { echo esc_attr( 'current' ); }?>">
          <img src="<?php $image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size); echo esc_url( $image[0] );?>" width="<?php echo esc_attr( $image[1] );?>" height="<?php echo esc_attr( $image[2] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php else : ?>
  <?php elemental_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>