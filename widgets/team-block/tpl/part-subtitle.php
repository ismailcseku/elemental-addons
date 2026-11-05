<?php if ( isset( $settings['show_subtitle'] ) && $settings['show_subtitle'] == 'yes' ) { ?>
	<?php
		$feature_link = ( isset( $feature_link ) && is_array( $feature_link ) ) ? $feature_link : array();
		$raw_url      = isset( $feature_link['url'] ) ? trim( (string) $feature_link['url'] ) : '';
		$url          = ( '' !== $raw_url && '#' !== $raw_url ) ? $raw_url : '';
		$target       = ( ! empty( $feature_link['is_external'] ) ) ? ' target="_blank"' : '';
	?>
	<?php if ( ! empty( $subtitle ) ) : ?>
	<<?php echo esc_attr( $subtitle_tag ); ?> class="team-subtitle">
		<?php if ( ! empty( $url ) ) : ?>
		<a
			<?php if ( ! empty( $target ) ) : ?> target="_blank"<?php endif; ?>
			href="<?php echo esc_url( $url ); ?>">
			<?php echo esc_html( $subtitle ); ?>
		</a>
		<?php else : ?>
			<?php echo esc_html( $subtitle ); ?>
		<?php endif; ?>
	</<?php echo esc_attr( $subtitle_tag ); ?>>
	<?php endif; ?>
<?php } ?>
