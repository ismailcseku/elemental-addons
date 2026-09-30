<?php if ( $settings['show_author_position'] == 'yes' ) { ?>
	<?php if( !empty( $position ) ) : ?>
	<<?php echo esc_attr( $position_tag );?> class="testimonial-position">
		<?php if( !empty( $url ) ): ?>
		<a
			<?php if ( ! empty( $target ) ) : ?> target="_blank"<?php endif; ?>
			href="<?php echo esc_url( $url );?>">
			<?php echo esc_html( $position );?>
		</a>
		<?php else: ?>
			<?php echo esc_html( $position );?>
		<?php endif ?>
	</<?php echo esc_attr( $position_tag );?>>
	<?php endif; ?>
<?php } ?>