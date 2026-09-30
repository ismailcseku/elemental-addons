<?php
	//link url
	$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
	$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>

	<?php if( !empty( $title ) ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="service-title">
		<?php if( !empty( $url ) ): ?>
		<a
			<?php if ( ! empty( $target ) ) : ?> target="_blank"<?php endif; ?>
			href="<?php echo esc_url( $url );?>">
			<?php echo wp_kses_post( $title ); ?>
		</a>
		<?php else: ?>
			<?php echo wp_kses_post( $title ); ?>
		<?php endif ?>
	</<?php echo esc_attr( $title_tag );?>>
	<?php endif; ?>