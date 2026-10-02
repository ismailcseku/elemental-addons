<?php
	//link url
	$target = ( $working_block_link && $working_block_link['is_external'] ) ? ' target="_blank"' : '';
	$url = ( $working_block_link && $working_block_link['url'] ) ? $working_block_link['url'] : '';
?>

	<?php if( !empty( $title ) ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="working-title">
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