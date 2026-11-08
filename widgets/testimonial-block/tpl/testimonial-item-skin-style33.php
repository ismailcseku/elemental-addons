
<!-- Testimonial Block Style1-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
$rating = $testimonial_item['rating'];
?>

<div class="testimonial-block testimonial-block-style33">
  <div class="clints-info">
    <div class="name">
      <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    </div>
    <div class="image">
      <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    </div>
  </div>
  <div class="content">
    <?php elemental_addons_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    <?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
    <div class="quata">
      <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
    </div>
  </div>
</div>