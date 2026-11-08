<!-- Testimonial Block Style1-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>
<div class="testimonial-block-style7">
  <div class="inner-box">
    <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
    <?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
    <div class="testi-info">
      <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    </div>
  </div>
</div>