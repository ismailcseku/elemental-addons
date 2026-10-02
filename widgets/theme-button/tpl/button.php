<div class="btn-view-details <?php if(isset($button_alignment)) echo esc_attr( $button_alignment );?>">
	<a href="<?php echo esc_url( $button['url'] ); ?>" data-normal-link="<?php echo esc_url( $button['url'] ); ?>" data-secondary-link="<?php echo esc_url( $button_secondary_url ); ?>"
		target="<?php echo ( ( $button['target'] == '' ) ? esc_attr( '_self' ) : esc_attr( $button['target'] ) ); ?>"
		class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>">
	<?php echo esc_html( $view_details_button_text  ); ?>
	</a>
</div>