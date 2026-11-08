<!-- Testimonial Block Style1-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
$name = $testimonial_item['name'];
$position = $testimonial_item['position'];
$content = $testimonial_item['content'];
$feature_image = $testimonial_item['feature_image'];
$testimonial_logo = $testimonial_item['feature_image2'] ?? '';
$icon = $testimonial_item['icon'] ?? '';
?>
<div class="testimonial-block testimonial-block-style35">
  <div class="inner-box">

    <div class="testi-logo">
      <?php elemental_addons_get_shortcode_template_part( 'part-thumb2', null, 'testimonial-block/tpl', $testimonial_item, false );?>

      <div class="quote-icon">
        <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
      </div>
    </div>

    <div class="content-box">
      <?php if( !empty( $content ) ) { ?>
      <div class="text"><?php echo wp_kses( $content, 'post' ); ?></div>
      <?php } ?>
      <div class="author-box">
        <?php if( !empty( $feature_image['url'] ) ) : ?>
        <div class="thumb">
          <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        </div>
        <?php endif; ?>
        <div class="author-info">

          <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>

        </div>
      </div>
    </div>
  </div>
</div>