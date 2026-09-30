<div class="layer-image-wrapper <?php echo esc_attr(implode(' ', $classes_first)); ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" style="<?php echo esc_attr($wrapper_inline_css); ?>">
	<div class="layer-inner box-hover-effect video-play-button tm-sc-video-popup tm-sc-video-popup-css-button play-btn-default">
		<div class="effect-wrapper d-flex align-items-center <?php echo esc_attr($animation_type); ?>">
			<div class="animated-css-play-button"><span class="play-icon"><i class="fa fa-play"></i></span></div>
			<a class="hover-link" data-lightbox="iframe" href="<?php echo esc_url( $video_url ); ?>" title="<?php esc_attr_e( 'link', 'elemental-addons' ); ?>"></a>
		</div>
	</div>
</div>