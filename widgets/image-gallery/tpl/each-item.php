<div class="tm-image-gallery tm-gallery-item-default">
	<div class="tm-gallery-inner">
		<?php
			$attachment = wp_get_attachment_image_src( $gallery_item['logo']['id'], $featured_image_size );
			$attachment_full = wp_get_attachment_image_src( $gallery_item['logo']['id'], 'full' );
			$image_alt = get_post_meta($gallery_item['logo']['id'], '_wp_attachment_image_alt', TRUE);

			if( !empty( $attachment ) ) {
				if( $attachment[0] ) {
					echo '<a class="lightgallery-trigger" data-exthumbimage="' . esc_url( $attachment_full[0] ) . '" data-src="' . esc_url( $attachment_full[0] ) . '" href="' . esc_url( $attachment_full[0] ) . '">';
				}
				echo '<img class="thumb" src=" ' . esc_url( $attachment[0] ) . ' " alt="' . esc_html( $image_alt ) . '">';
				if( $attachment[0] ) {
					echo '</a>';
				}

			} else {
				if( $gallery_item['logo']['url'] ) {
					echo '<a class="lightgallery-trigger" data-exthumbimage="' . esc_url( $gallery_item['logo']['url'] ) . '" data-src="' . esc_url( $gallery_item['logo']['url'] ) . '" href="' . esc_url( $gallery_item['logo']['url'] ) . '"></a>';
				}
				echo '<img class="thumb" src=" ' . esc_url( $gallery_item['logo']['url'] ) . ' " alt="' . esc_html( $image_alt ) . '">';
				if( $gallery_item['logo']['url'] ) {
					echo '</a>';
				}

			}
		?>
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'image-gallery/tpl', $gallery_item, false );?>
	</div>
</div>