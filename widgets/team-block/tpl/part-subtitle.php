<?php if ( isset( $settings['show_subtitle'] ) && $settings['show_subtitle'] == 'yes' ) { ?>
	<?php $subtitle_tag = ! empty( $subtitle_tag ) ? $subtitle_tag : 'div'; ?>
	<?php if ( ! empty( $subtitle ) ) : ?>
	<<?php echo esc_attr( $subtitle_tag ); ?> class="team-subtitle">
		<?php echo esc_html( $subtitle ); ?>
	</<?php echo esc_attr( $subtitle_tag ); ?>>
	<?php endif; ?>
<?php } ?>
