<?php
	// Link only when a real URL is set (blank / # = no link).
	$feature_link = ( isset( $feature_link ) && is_array( $feature_link ) ) ? $feature_link : array();
	$raw_url      = isset( $feature_link['url'] ) ? trim( (string) $feature_link['url'] ) : '';
	$url          = ( '' !== $raw_url && '#' !== $raw_url ) ? $raw_url : '';
	$target       = ( ! empty( $feature_link['is_external'] ) ) ? ' target="_blank"' : '';
?>

	<?php if ( ! empty( $title ) ) : ?>
	<<?php echo esc_attr( $title_tag ); ?> class="team-title">
		<?php if ( ! empty( $url ) ) : ?>
		<a
			<?php if ( ! empty( $target ) ) : ?> target="_blank"<?php endif; ?>
			href="<?php echo esc_url( $url ); ?>">
			<?php echo wp_kses_post( $title ); ?>
		</a>
		<?php else : ?>
			<?php echo wp_kses_post( $title ); ?>
		<?php endif; ?>
	</<?php echo esc_attr( $title_tag ); ?>>
	<?php endif; ?>
