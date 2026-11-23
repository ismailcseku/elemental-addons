<!-- Testimonial Block Style1-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;

// Extract video_url from testimonial_item array
$video_url = !empty($testimonial_item['video_url']) ? $testimonial_item['video_url'] : '';
?>
<div class="testimonial-block testimonial-block-style7">
  <div class="inner-box">
	<div class="content-box">
	  <div class="logo">
		<?php if( !empty( $settings['icon'] ) && !empty( $settings['icon']['value'] ) ) : ?>
			<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
		<?php else : ?>
			<i class="fa-classic fa-solid fa-quote-left"></i>
		<?php endif; ?>
	  </div>
		<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'testimonial-block/tpl', $testimonial_item, false );?>
		<div class="text author-text"><?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false );?></div>
	  <div class="info-box">
		<div class="user-info">
		  <?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
		</div>
		<div class="rating">
		  <?php elemental_addons_get_shortcode_template_part( 'part-star-rating', null, 'testimonial-block/tpl', $testimonial_item, false );?>
		</div>
	  </div>
	</div>
	<figure class="image-box">
	  <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
	  <?php
	  // Handle video URL - Elementor URL control returns an array with 'url', 'is_external', 'nofollow'
	  $video_url_value = '';
	  $target = '';
	  $nofollow = '';

	  if( !empty( $video_url ) ) {
		if( is_array( $video_url ) && !empty( $video_url['url'] ) ) {
			$video_url_value = $video_url['url'];
			$target = !empty( $video_url['is_external'] ) ? ' target="_blank"' : '';
			$nofollow = !empty( $video_url['nofollow'] ) ? ' rel="nofollow"' : '';
		} elseif( is_string( $video_url ) ) {
			$video_url_value = $video_url;
		}
	  }

	  if( !empty( $video_url_value ) ) :
	  ?>
		<a href="<?php echo esc_url( $video_url_value ); ?>" data-lightbox="iframe" class="video-btn playbtnanim"<?php echo $target . $nofollow; ?>><i class="fa-sharp fa fa-play"></i></a>
	  <?php endif; ?>
	</figure>
  </div>
</div>