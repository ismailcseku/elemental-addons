<?php if ( $settings['show_title'] == 'yes' ) { ?>
	<?php if( !empty( $title ) ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="testimonial-title">
		<?php echo wp_kses_post( $title ); ?>
	</<?php echo esc_attr( $title_tag );?>>
	<?php endif; ?>
<?php } ?>