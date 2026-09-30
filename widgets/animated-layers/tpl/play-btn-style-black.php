<div class="layer-image-wrapper <?php echo esc_attr(implode(' ', $classes_first)); ?> elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" style="<?php echo esc_attr($wrapper_inline_css); ?>">
	<div class="layer-inner box-hover-effect video-play-button tm-sc-video-popup play-btn-style-black">
		<div class="effect-wrapper <?php echo esc_attr($animation_type); ?>">
			<div class="icon"><i class="fa fa-play"></i></div>
			<a class="hover-link" data-lightbox="iframe" href="<?php echo esc_url( $video_url ); ?>" title="<?php esc_attr_e( 'link', 'elemental-addons' ); ?>"></a>
		</div>
	</div>
</div>