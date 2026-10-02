<?php if ( $show_paragraph == 'yes' ) { ?>
<div class="content"><?php echo wp_kses( $content, 'post' ); ?></div>
<?php } ?>