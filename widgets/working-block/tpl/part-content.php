<?php if ( $settings['show_paragraph'] == 'yes' ) { ?>
<div class="working-details"><?php echo wp_kses( $content, 'post' ); ?></div>
<?php } ?>