<?php $settings['settings'] = $settings; ?>
<?php if ( $service_items_array ) : ?>
	<div class="tm-sc-service tm-service-basic">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="service-layout clearfix">

		<?php if(isset($tm_gsap_pin) && !empty($tm_gsap_pin) && $tm_gsap_pin == 'yes' ) { $classes[] = 'gsap-pin-' . esc_attr($tm_gsap_pin); } ?>

		<div class="service-block-wrapper <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
			<!-- the loop -->
			<?php foreach (  $service_items_array as $service_item ) { ?>
			<?php $settings['service_item'] = $service_item; ?>
			<?php
				$animation = "";
				$animation_delay = "";
				if(isset($service_item['wow_appear_animation']) && !empty($service_item['wow_appear_animation'])) {
					$animation = $service_item['wow_appear_animation'];
				}
				if(isset($service_item['wow_animation_delay']) && !empty($service_item['wow_animation_delay'])) {
					$animation_delay = $service_item['wow_animation_delay'] . 'ms';
				}
			?>
			<div class="tm-service-basic-wrapper <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
				<?php elemental_addons_get_shortcode_template_part( 'service-item', $_skin, 'service-block/tpl', $settings, false ); ?>
			</div>
			<?php } ?>
			<!-- end of the loop -->
		</div>
			</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php elemental_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>