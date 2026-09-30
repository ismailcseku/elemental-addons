<?php
	//link url
	$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
	$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>

	<?php if( !empty( $title ) ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="features-title">
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