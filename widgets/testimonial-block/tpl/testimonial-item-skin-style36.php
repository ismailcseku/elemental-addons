<!-- Testimonial Block Style1-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>

<div class="testimonial-block testimonial-block-style36">
  <div class="content-box">
    <div class="inner-content">
      <div class="review">
        <?php elemental_addons_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <div class="quote-icon">
        <?php if ( isset( $settings['icon_type'] ) && $settings['icon_type'] === 'image' && ! empty( $settings['icon_image']['url'] ) ) : ?>
          <img class="icon" src="<?php echo esc_url( $settings['icon_image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
        <?php else : ?>
          <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
        <?php endif; ?>
      </div>
      <div class="testimonial-content">
        <?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
        <div class="author-info">
          <div class="testimonial-bio-img">
            <?php elemental_addons_get_shortcode_template_part( 'part-thumb-two', null, 'testimonial-block/tpl', $testimonial_item, false );?>
          </div>
          <div class="testimonial-bio-content">
            <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
            <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="testimonial-thumb">
    <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
  </div>
</div>