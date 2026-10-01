<?php
$image_id  = ( is_array( $featured_image ) && ! empty( $featured_image['id'] ) ) ? (int) $featured_image['id'] : 0;
$image_alt = $image_id ? (string) get_post_meta( $image_id, '_wp_attachment_image_alt', true ) : '';
$image     = $image_id ? wp_get_attachment_image_src( $image_id, $featured_image_size ) : false;

if ( empty( $image[0] ) && is_array( $featured_image ) && ! empty( $featured_image['url'] ) ) {
	$image = array( $featured_image['url'], '', '' );
}

if ( empty( $image[0] ) ) {
	return;
}
?>
<img src="<?php echo esc_url( $image[0] ); ?>" width="<?php echo esc_attr( $image[1] ); ?>" height="<?php echo esc_attr( $image[2] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
