<?php $settings['settings'] = $settings;?>
<a  href="<?php echo esc_url( $button['url'] ); ?>"
		<?php if ( ! empty( $link['is_external'] ) ) : ?> target="_blank"<?php endif; ?>
		<?php if ( ! empty( $link['nofollow'] ) ) : ?> rel="nofollow"<?php endif; ?>
		class="theme-btn btn-style5">
	<span class="btn-title">
		<?php
			if( !empty( $button_text ) ) {
				echo esc_html( $button_text );
			}
		?>
	</span>
	<span class="dot-box"><span class="dot-item"></span></span>
</a>