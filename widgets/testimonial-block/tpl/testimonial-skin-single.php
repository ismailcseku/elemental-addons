<?php $settings['settings'] = $settings; ?>
<?php
	wp_enqueue_style( 'swiper' );
	wp_enqueue_script( 'swiper' );
	//Swiper Slider Data
	$swiper_slide_data_info = elemental_addons_swiper_data_params( $settings );
?>
<?php if ( $testimonial_items_array ) : ?>
	<div id="<?php echo esc_attr( $holder_id ) ?>" class="tm-sc-testimonials testimonial-item tm-testimonial-single-carousel" <?php echo html_entity_decode( esc_attr( implode(' ', $swiper_slide_data_info) ) ) ?>>

		<!-- Testimonial Slider -->
		<div class="swiper-container-inner swiper-content-container-inner">
			<div class="swiper-wrapper">
				<!-- the loop -->
				<?php foreach (  $testimonial_items_array as $testimonial_item ) { ?>
					<?php
						$testimonial_item['settings'] = $settings;
						$testimonial_item['name_tag'] = $name_tag;
						$testimonial_item['position_tag'] = $position_tag;
						$testimonial_item['title_tag'] = $title_tag;
					?>
					<?php
						$animation = "";
						$animation_delay = "";
						if(isset($testimonial_item['wow_appear_animation']) && !empty($testimonial_item['wow_appear_animation'])) {
							$animation = $testimonial_item['wow_appear_animation'];
						}
						if(isset($testimonial_item['wow_animation_delay']) && !empty($testimonial_item['wow_animation_delay'])) {
							$animation_delay = $testimonial_item['wow_animation_delay'] . 'ms';
						}
					?>
					<div class="swiper-slide elementor-repeater-item-<?php echo esc_attr( $testimonial_item['_id'] ); ?> <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
						<div class="testimonial-block-five swiper-slide">
							<div class="inner-box">
								<div class="quote-icon">
									<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
								</div>
								<div class="info-box">
									<div class="author-info">
										<?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
										<?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
									</div>
									<?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				<!-- end of the loop -->
			</div>
		</div>
		<!-- Testimonial Thumb -->
		<div class="swiper-container-inner testimonial-thumbs">
			<div class="swiper-wrapper">
				<!-- the loop -->
				<?php foreach (  $testimonial_items_array as $testimonial_item ) { ?>
					<?php
						$testimonial_item['settings'] = $settings;
						$testimonial_item['name_tag'] = $name_tag;
						$testimonial_item['position_tag'] = $position_tag;
						$testimonial_item['title_tag'] = $title_tag;
					?>
					<div class="swiper-slide">
						<?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="swiper-pagination <?php if( $bullets !== 'yes' ) echo esc_attr( "d-none" ); ?>"></div>

		<div class="tm-swiper-arrow tm-swiper-button-wrap <?php if( $arrow !== 'yes' ) echo esc_attr( "d-none" ); ?>">
			<div class="tm-swiper-arrow tm-swiper-button-prev"><i class="lnr-icon-arrow-left"></i></div>
			<div class="tm-swiper-arrow tm-swiper-button-next"><i class="lnr-icon-arrow-right"></i></div>
		</div>
	</div>

<?php else : ?>
	<?php elemental_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>