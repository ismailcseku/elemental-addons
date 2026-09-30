<?php $settings['settings'] = $settings; ?>
<?php
	wp_enqueue_style( 'swiper' );
	wp_enqueue_script( 'swiper' );

	$direction_suffix = is_rtl() ? '.rtl' : '';
	wp_enqueue_style( 'service-creative-style1', ELEMENTAL_ADDONS_ASSETS_URI . '/css/shortcodes/service-block/service-creative-style1' . $direction_suffix . '.css' );
	wp_register_script( 'service-creative-style1', ELEMENTAL_ADDONS_ASSETS_URI . '/js/widgets/service-creative-style1.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'service-creative-style1' );
?>

<?php if ( $service_items_array ) : ?>
	<!-- Service Section -->
	<div class="service-creative-style1">
		<div class="row">
			<div class="image-column col-xl-5 col-md-6 col-sm-12">
				<!-- the loop -->
				<?php foreach (  $service_items_array as $service_item ) { ?>
					<?php $settings['service_item'] = $service_item; ?>
					<div class="inner-colmun">
						<div class="image-box">
							<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
						</div>
					</div>
				<?php } ?>
				<!-- end of the loop -->
			</div>
			<div class="content-colmun col-xl-6 offset-xl-1 col-md-5 offset-md-1 col-sm-12">
				<div class="inner-colmun">
					<div class="services-list">
						<!-- the loop -->
						<?php foreach (  $service_items_array as $service_item ) { ?>
						<?php
						$service_item['title_tag'] = $title_tag;
						$service_item['subtitle_tag'] = $subtitle_tag;
						?>

						<div class="service-creative-detials">
							<div class="title-area">
								<?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
								<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
							</div>
						</div>

						<?php } ?>
						<!-- end of the loop -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Service Section -->
<?php else : ?>
	<?php elemental_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>