<?php if ( $settings['show_author_name'] == 'yes' ) { ?>
	<?php if( !empty( $name ) ) : ?>
	<<?php echo esc_attr( $name_tag );?> class="testimonial-name">
		<?php echo $name;?>
	</<?php echo esc_attr( $name_tag );?>>
	<?php endif; ?>
<?php } ?>