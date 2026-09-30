
		<?php
			$image_alt = get_post_meta($featured_image['id'], '_wp_attachment_image_alt', TRUE);
		?>
<div class="pricing-featured-img">
	<img src="<?php $image = wp_get_attachment_image_src( $featured_image['id'], $featured_image_size); echo esc_url( $image[0] );?>" width="<?php echo esc_attr( $image[1] );?>" height="<?php echo esc_attr( $image[2] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
</div>