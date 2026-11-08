<!-- Testimonial Block Style1-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>

<div class="testimonial-item testimonial-block-style24">
  <div class="inner-box">
    <div class="content-box">
      <div class="bg-shape1">
         <?php elemental_addons_get_shortcode_template_part( 'part-shape-image', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <div class="top-info">
        <div class="icon">
          <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
        </div>
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
    </div>
    <div class="info-box">
      <div class="user-thumb">
          <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <div class="user-info">
        <div class="user">
            <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
            <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        </div>
        <div class="rating">
            <?php elemental_addons_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        </div>
      </div>
    </div>
  </div>
</div>