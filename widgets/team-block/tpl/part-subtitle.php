<?php if ( $settings['show_subtitle'] == 'yes' ) { ?>
	<?php if( !empty( $subtitle ) ) : ?>
	<<?php echo esc_attr( $subtitle_tag );?> class="team-subtitle">
		<?php if( !empty( $url ) ): ?>
		<a
			<?php if ( ! empty( $target ) ) : ?> target="_blank"<?php endif; ?>
			href="<?php echo esc_url( $url );?>">
			<?php echo esc_html( $subtitle );?>
		</a>
		<?php else: ?>
			<?php echo esc_html( $subtitle );?>
		<?php endif ?>
	</<?php echo esc_attr( $subtitle_tag );?>>
	<?php endif; ?>
<?php } ?>