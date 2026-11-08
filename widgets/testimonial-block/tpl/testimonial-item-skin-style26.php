<!-- Testimonial Block Style2-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>
<div class="testimonial-block testimonial-block-style26">
  <div class="inner-box">
    <div class="image-box">
      <div class="image overlay-anim">
        <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <div class="image two overlay-anim">
        <?php elemental_addons_get_shortcode_template_part( 'part-thumb-two', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <i class="icon-quote"></i>
    </div>
    <div class="content">
      <?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
      <div class="author-box">
        <div class="author-info">
          <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
          <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        </div>
      </div>
    </div>
  </div>
</div>