<?php if( !empty( $title ) ) : ?>
<div class="gallery-bottom-wrapper">
	<<?php echo esc_attr( $title_tag );?> class="title">
		<?php echo wp_kses_post( $title ); ?>
	</<?php echo esc_attr( $title_tag );?>>
</div>
<?php endif; ?>