<?php if ( $settings['show_short_bio'] == 'yes' ) : ?>
	<div class="team-short-bio"><?php echo wp_kses( $short_bio, 'post' ); ?></div>
<?php endif; ?>