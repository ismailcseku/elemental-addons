<!-- Testimonial Block Style1-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>

<div class="testimonial-item testimonial-block-style30">
  <div class="row g-4">
    <div class="col-md-6">
      <div class="testimonial-box-one">
        <div class="content">
          <?php elemental_addons_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
          <?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
        </div>
        <div class="info">
          <?php elemental_addons_get_shortcode_template_part( 'part-thumb-two', null, 'testimonial-block/tpl', $testimonial_item, false );?>
          <div>
            <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
            <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="testimonial-box-two">
        <div class="image">
          <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        </div>
        <div class="content">
          <?php elemental_addons_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
          <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
          <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        </div>
      </div>
    </div>
  </div>
</div>