
<!-- Testimonial Block Style1-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
$rating = $testimonial_item['rating'];
?>
<?php
	$rating = $rating['size'];
	if( is_numeric( $rating ) && $rating > 0) {
		if( $rating > 5 ) {
			$rating = 5;
		}
	} else {
		$rating = 0;
	}
?>
<div class="testimonial-block testimonial-block-style12">
  <div class="inner-box">
    <div class="review">
      <div class="rating-count"><?php echo esc_attr( $rating ); ?></div>
      <div class="rating">
        <?php elemental_addons_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
    </div>
    <?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
    <div class="info-box">
      <div class="user-thumb">
        <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
      <div class="user-info">
        <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      </div>
    </div>
  </div>
</div>