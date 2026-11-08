
<!-- Testimonial Block Style1-->
<?php
$image[0] = '';
if( isset($skin_style3_featured_image['id']) && !empty($skin_style3_featured_image['id']) ){
	$image = wp_get_attachment_image_src( $skin_style3_featured_image['id'], 'full');
}
//if empty then use this default image
if( empty($image[0])) {
  $image[0] = ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/testimonial-shape.png';
}
?>
<?php $testimonial_item['settings'] = $settings; ?>
<?php
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>

<div class="testimonial-block testimonial-block-style18">
  <div class="inner-box">
      <div class="text"><?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?></div>
    <div class="author-info">
      <div class="info-box">
        <figure class="thumb">
          <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        </figure>
        <div class="info">
          <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
          <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        </div>
      </div>
      <span class="shape-1">
        <?php elemental_addons_get_shortcode_template_part( 'part-thumb2', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </span>
    </div>
  </div>
</div>