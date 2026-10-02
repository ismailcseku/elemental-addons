
	<?php if( isset( $pricing_image['id'] ) && !empty( $pricing_image['id'] ) ): ?>
	<div class="pricing-plan-thumb <?php if( isset( $pricing_image_hover['id'] ) && !empty( $pricing_image_hover['id'] ) ) echo "has-thumb-hover" ?>">
		<?php
			$image_alt = get_post_meta($pricing_image['id'], '_wp_attachment_image_alt', TRUE);
		?>
		<img class="thumb" src="<?php $image = wp_get_attachment_image_src( $pricing_image['id'], $pricing_predefined_image_size); echo esc_url( $image[0] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
		<?php if( isset( $pricing_image_hover['id'] ) && !empty( $pricing_image_hover['id'] ) ) { ?>
		<?php
			$image_alt = get_post_meta($pricing_image_hover['id'], '_wp_attachment_image_alt', TRUE);
		?>
		<img class="thumb-hover" src="<?php $image = wp_get_attachment_image_src( $pricing_image_hover['id'], $pricing_predefined_image_size); echo esc_url( $image[0] );?>" alt="<?php echo esc_html( $image_alt ) ?>">
		<?php } ?>
	</div>
	<?php endif; ?>