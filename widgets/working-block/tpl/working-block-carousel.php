<?php $settings['settings'] = $settings; ?>
<?php
	wp_enqueue_style( 'swiper' );
	wp_enqueue_script( 'swiper' );
	//Swiper Slider Data
	$swiper_slide_data_info = \elemental_addons_swiper_data_params( $settings );
?>
<?php if ( $working_block_items_array ) : ?>
	<div id="<?php echo esc_attr( $holder_id ) ?>" class="tm-sc-working tm-working-carousel tm-swiper-container" <?php echo html_entity_decode( esc_attr( implode(' ', $swiper_slide_data_info) ) ) ?>>
		<div class="swiper-container-inner">
			<div class="swiper-wrapper">
				<!-- the loop -->
				<?php foreach (  $working_block_items_array as $working_item ) { ?>
					<?php $settings['working_item'] = $working_item; ?>
					<?php
						$animation = "";
						$animation_delay = "";
						if(isset($working_item['wow_appear_animation']) && !empty($working_item['wow_appear_animation'])) {
							$animation = $working_item['wow_appear_animation'];
						}
						if(isset($working_item['wow_animation_delay']) && !empty($working_item['wow_animation_delay'])) {
							$animation_delay = $working_item['wow_animation_delay'] . 'ms';
						}
					?>
					<div class="swiper-slide elementor-repeater-item-<?php echo esc_attr( $working_item['_id'] ); ?> <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
						<?php \elemental_addons_get_shortcode_template_part( 'working-block-item', $_skin, 'working-block/tpl', $settings, false ); ?>
					</div>
				<?php } ?>
				<!-- end of the loop -->
			</div>
		</div>

		<div class="swiper-pagination <?php if( $bullets !== 'yes' ) echo esc_attr( "d-none" ); ?>"></div>

		<div class="tm-swiper-arrow tm-swiper-button-wrap <?php if( $arrow !== 'yes' ) echo esc_attr( "d-none" ); ?>">
			<div class="tm-swiper-arrow tm-swiper-button-prev"><i class="lnr-icon-arrow-left"></i></div>
			<div class="tm-swiper-arrow tm-swiper-button-next"><i class="lnr-icon-arrow-right"></i></div>
		</div>
	</div>

<?php else : ?>
	<?php \elemental_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>