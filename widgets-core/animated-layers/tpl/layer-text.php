<?php 
	//classes_first
	$classes_first = array();
	if( !empty($display_type) ) {
		$classes_first[] = $display_type;
	}
	if( !empty($image_clip_path_animation) ) {
		$classes_first[] = $image_clip_path_animation;
	}
	if( !empty($image_animation_effect) ) {
		$classes_first[] = 'tm-animation '.$image_animation_effect;
	}
	$classes_first[] = $image_wrapper_custom_css_class;
	$classes_first = $classes_first;
?>
<div class="layer-image-wrapper <?php echo esc_attr($animation_type); ?> <?php echo esc_attr(implode(' ', $classes_first)); ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" style="<?php echo esc_attr($wrapper_inline_css); ?>">
	<div class="layer-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>
