<div class="each-logo">
	<?php
		$attachment = wp_get_attachment_image_src( $gallery_item['logo']['id'], 'full' );

		if( !empty( $attachment ) ) {
			if( $gallery_item['logo_url'] ) {
				echo '<a href="' . esc_url( $gallery_item['logo_url'] ) . '" target="' . esc_attr( $gallery_item['link_target'] ) . '">';
			}
			echo '<img class="thumb" src=" ' . esc_url( $attachment[0] ) . ' " alt="">';
			if( $rollover_effect == 'yes' ) {
				echo '<img class="thumb-hover" src=" ' . esc_url( $attachment[0] ) . ' " alt="">';
			}
			if( $gallery_item['logo_url'] ) {
				echo '</a>';
			}

		} else {
			if( $gallery_item['logo_url'] ) {
				echo '<a href="' . esc_url( $gallery_item['logo_url'] ) . '" target="' . esc_attr( $gallery_item['link_target'] ) . '"></a>';
			}
			echo '<img class="thumb" src=" ' . esc_url( $gallery_item['logo']['url'] ) . ' " alt="">';
			if( $rollover_effect == 'yes' ) {
				echo '<img class="thumb-hover" src=" ' . esc_url( $gallery_item['logo']['url'] ) . ' " alt="">';
			}
			if( $gallery_item['logo_url'] ) {
				echo '</a>';
			}

		}
	?>
</div>