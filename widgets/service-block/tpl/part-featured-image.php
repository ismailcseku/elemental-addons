
<?php
	$image_url    = '';
	$image_width  = '';
	$image_height = '';
	$image_alt    = '';

	if ( ! empty( $featured_image['id'] ) ) {
		$image = wp_get_attachment_image_src( $featured_image['id'], ! empty( $featured_image_size ) ? $featured_image_size : 'full' );
		if ( $image ) {
			$image_url    = $image[0];
			$image_width  = $image[1];
			$image_height = $image[2];
		}
		$image_alt = get_post_meta( $featured_image['id'], '_wp_attachment_image_alt', true );
	}

	if ( ! $image_url && ! empty( $featured_image['url'] ) ) {
		$image_url = $featured_image['url'];
	}

	if ( ! $image_url ) {
		return;
	}
?>
<img src="<?php echo esc_url( $image_url ); ?>"<?php if ( $image_width ) : ?> width="<?php echo esc_attr( $image_width ); ?>"<?php endif; ?><?php if ( $image_height ) : ?> height="<?php echo esc_attr( $image_height ); ?>"<?php endif; ?> alt="<?php echo esc_attr( $image_alt ); ?>">
