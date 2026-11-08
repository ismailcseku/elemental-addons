<!-- Testimonial Block Style1-->
<?php
$default_image[0] = '';
if( isset($skin_style1_featured_image['id']) && !empty($skin_style1_featured_image['id']) ){
  $default_image = wp_get_attachment_image_src( $skin_style1_featured_image['id'], 'full');
}
//if empty then use this default image
if( empty($default_image[0])) {
  $default_image[0] = ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/thumb-1-1.jpg';
}
?>

<?php
$default_image2[0] = '';
if( isset($skin_style1_featured_image2['id']) && !empty($skin_style1_featured_image2['id']) ){
  $default_image2 = wp_get_attachment_image_src( $skin_style1_featured_image2['id'], 'full');
}
//if empty then use this default image
if( empty($default_image2[0])) {
  $default_image2[0] = ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/thumb-1-2.jpg';
}
?>

<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>


<div class="testimonial-block-style17">
    <div class="ks-testimonial-item d-flex">
        <div class="ks-testimonial-shape-1"></div>
        <div class="ks-testimonial-content">
            <div class="quote d-block">
                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
            </div>
            <?php elemental_addons_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
            <?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
        </div>
        <div class="ks-testimonial-thumb">
            <?php if( isset( $skin_style1_featured_image['id'] ) && !empty( $skin_style1_featured_image['id'] ) ): ?>
                <img src="<?php $image = wp_get_attachment_image_src( $skin_style1_featured_image['id'], $skin_style1_featured_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'elemental-addons'); ?>">
                <?php else: ?>
                <img src="<?php echo esc_url( $default_image[0] );?>" alt="<?php esc_attr_e( 'Image', 'elemental-addons'); ?>">
            <?php endif; ?>

            <div class="ks-testimonial-thumb-sm">
                <?php if( isset( $skin_style1_featured_image2['id'] ) && !empty( $skin_style1_featured_image2['id'] ) ): ?>
                    <img src="<?php $image = wp_get_attachment_image_src( $skin_style1_featured_image2['id'], $skin_style1_featured_image_size); echo esc_url( $image[0] );?>" alt="<?php esc_attr_e( 'Image', 'elemental-addons'); ?>">
                    <?php else: ?>
                    <img src="<?php echo esc_url( $default_image2[0] );?>" alt="<?php esc_attr_e( 'Image', 'elemental-addons'); ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="ks-testimonial-bottom">
        <div class="align-items-center">
          <div class="ks-testimonial-user d-flex align-items-center">
              <div class="thumb">
                  <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
              </div>
              <div class="ks-testimonial-user-info">
                <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
                <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
              </div>
          </div>
        </div>
    </div>
</div>