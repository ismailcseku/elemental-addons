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
<div class="layer-image-wrapper <?php echo esc_attr(implode(' ', $classes_first)); ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" style="<?php echo esc_attr($wrapper_inline_css); ?>">
	
	<div class="layer-inner layer-animated-icon <?php echo esc_attr($animation_type); ?>">

		<?php if( isset( $animated_icon['id'] ) && !empty( $animated_icon['id'] ) ): ?>
		<?php
			$image_alt = get_post_meta($animated_icon['id'], '_wp_attachment_image_alt', TRUE);
		?>
		<img class="icon" src="<?php $image = wp_get_attachment_image_src( $animated_icon['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
		<?php endif; ?>


		<?php if( isset( $animated_icon_hover['id'] ) && !empty( $animated_icon_hover['id'] ) ): ?>
		<?php
			$image_alt = get_post_meta($animated_icon_hover['id'], '_wp_attachment_image_alt', TRUE);
		?>
		<img class="icon-hover" src="<?php $image = wp_get_attachment_image_src( $animated_icon_hover['id'], 'full'); echo esc_url( $image[0] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
		<?php endif; ?>
		
	</div>
</div>