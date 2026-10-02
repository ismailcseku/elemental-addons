<?php $settings['post_format'] = get_post_format(get_the_ID()) ? : 'standard'; ?>
<?php $settings['settings'] = $settings; ?>
<?php
	wp_enqueue_style( 'swiper' );
	wp_enqueue_script( 'swiper' );
	//Swiper Slider Data
	$swiper_slide_data_info = \elemental_addons_swiper_data_params( $settings );
?>
<?php if ( $the_query->have_posts() ) : ?>
	<div id="<?php echo esc_attr( $holder_id ) ?>" class="tm-sc-blog tm-sc-blog-carousel tm-swiper-container <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>" <?php echo html_entity_decode( esc_attr( implode(' ', $swiper_slide_data_info) ) ) ?>>
		<div class="swiper-container-inner">
			<div class="swiper-wrapper">
				<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="swiper-slide">
					<?php
						echo \elemental_addons_shortcode_get_blog_post_format( get_post_format(), $settings );
					?>
				</div>
				<?php endwhile; ?>
				<!-- end of the loop -->
			</div>
		</div>

		<div class="swiper-pagination <?php if( $bullets !== 'yes' ) echo esc_attr( "d-none" ); ?>"></div>

		<div class="tm-swiper-arrow tm-swiper-button-wrap <?php if( $arrow !== 'yes' ) echo esc_attr( "d-none" ); ?>">
			<div class="tm-swiper-arrow tm-swiper-button-prev"><i class="lnr-icon-arrow-left"></i></div>
			<div class="tm-swiper-arrow tm-swiper-button-next"><i class="lnr-icon-arrow-right"></i></div>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php \elemental_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>