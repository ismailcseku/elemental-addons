<div class="funfact-icon funfact-thumb">
<?php
	$image = wp_get_attachment_image_src( $image_icon['id'], $image_icon_predefined_image_size);
			$image_alt = get_post_meta($image_icon['id'], '_wp_attachment_image_alt', TRUE);
	if( !empty($image[0]) ) {
?>
<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_html( $image_alt ) ?>">
<?php } ?>
</div>