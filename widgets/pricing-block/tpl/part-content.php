<?php if ( $settings['show_paragraph'] == 'yes' ) { ?>
<div class="pricing-details"><?php echo wp_kses( $content, 'post' ); ?></div>
<?php } ?>