	<?php if ( $content ) { ?>
	<div class="paragraph">
		<?php echo wp_kses( $content, 'post' ); ?>
	</div>
	<?php } ?>