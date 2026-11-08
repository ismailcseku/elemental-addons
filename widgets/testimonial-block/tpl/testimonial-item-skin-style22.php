
<!-- Testimonial Block Style3-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>
<div class="testimonial-block testimonial-block-style22">
<div class="inner-box">
  <div class="image-box">
    <div class="thumb overlay-anim">
      <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    </div>
  </div>
  <div class="info-box">
    <div class="info-box-content">
      <div class="icon-wheel-compass-2"></div>
      <div class="icon-quote"></div>
      <?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
      <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    </div>
    </div>
  </div>
</div>