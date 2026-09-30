<!-- Gallery Block -->
<div class="tm-image-gallery tm-gallery-item-currenty-style2">
	<div class="inner-box">
		<div class="image-box">
			<div class="image">
				<?php
				$attachment = wp_get_attachment_image_src( $gallery_item['logo']['id'], $featured_image_size );
				$attachment_full = wp_get_attachment_image_src( $gallery_item['logo']['id'], 'full' );
				$image_alt = get_post_meta($gallery_item['logo']['id'], '_wp_attachment_image_alt', TRUE);

				if( !empty( $attachment ) ) {
					if( $attachment[0] ) {
					}
				?>
					<img class="thumb" src="<?php echo esc_url( $attachment[0] ) ?>" alt="<?php echo esc_html( $image_alt ) ?>">
				<?php
					if( $attachment[0] ) {
					}

				} else {
					if( $gallery_item['logo']['url'] ) {
					}
				?>
					<img src="<?php echo esc_url( $gallery_item['logo']['url'] ) ?>" alt="<?php echo esc_html( $image_alt ) ?>">
				<?php
					if( $gallery_item['logo']['url'] ) {
					}

				}
			?>
			</div>
		</div>
		<div class="info-box">
			<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'image-gallery/tpl', $gallery_item, false );?>
			<?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'image-gallery/tpl', $gallery_item, false );?>
		</div>
	</div>
</div>