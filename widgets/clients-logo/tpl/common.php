<div class="each-logo">
	<?php
		$attachment = wp_get_attachment_image_src( $clients_logo['logo']['id'], 'full' );

		if( !empty( $attachment ) ) {
			if( $clients_logo['logo_url'] ) {
				echo '<a href="' . esc_url( $clients_logo['logo_url'] ) . '" target="' . esc_attr( $clients_logo['link_target'] ) . '">';
			}
			echo '<img class="thumb" src="' . esc_url( $attachment[0] ) . '"  width="' . esc_attr( $attachment[1] ). '" height="' . esc_attr( $attachment[2] ). '" alt="">';
			if( $rollover_effect == 'yes' ) {
				echo '<img class="thumb-hover" src="' . esc_url( $attachment[0] ) . '"  width="' . esc_attr( $attachment[1] ). '" height="' . esc_attr( $attachment[2] ). '" alt="">';
			}
			if( $clients_logo['logo_url'] ) {
				echo '</a>';
			}

		} else {
			if( $clients_logo['logo_url'] ) {
				echo '<a href="' . esc_url( $clients_logo['logo_url'] ) . '" target="' . esc_attr( $clients_logo['link_target'] ) . '"></a>';
			}
			echo '<img class="thumb" src=" ' . esc_url( $clients_logo['logo']['url'] ) . ' " alt="">';
			if( $rollover_effect == 'yes' ) {
				echo '<img class="thumb-hover" src=" ' . esc_url( $clients_logo['logo']['url'] ) . ' " alt="">';
			}
			if( $clients_logo['logo_url'] ) {
				echo '</a>';
			}

		}
	?>
</div>