
<!-- Testimonial Block Style1-->
<?php $testimonial_item['settings'] = $settings; ?>
<?php
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>

<div class="testimonial-item testimonial-block-style40">
  <div class="top">
    <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
    <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'testimonial-block/tpl', $testimonial_item, false );?>
  </div>
  <div class="content-box">
    <div class="content">
      <p class="text"><?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?></p>
      <div class="icon">
        <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
      </div>
    </div>
    <div class="bottom">
      <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <span class="line"></span>
      <span class="number"><?php elemental_addons_get_shortcode_template_part( 'part-rating-value', null, 'testimonial-block/tpl', $testimonial_item, false );?></span>
    </div>
  </div>
</div>