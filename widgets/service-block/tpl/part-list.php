<?php if ( $settings['show_features_list'] == 'yes' ) { ?>
		<?php echo wp_kses( $service_list, 'post' ); ?>
<?php } ?>