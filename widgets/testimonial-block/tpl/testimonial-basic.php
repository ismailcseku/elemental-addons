<?php $settings['settings'] = $settings; ?>
<?php if ( $testimonial_items_array ) : ?>
	<div class="tm-testimonial-basic tm-sc-testimonials">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="testimonial-layout clearfix">
			<!-- the loop -->
			<?php foreach (  $testimonial_items_array as $testimonial_item ) { ?>
			<?php $settings['testimonial_item'] = $testimonial_item; ?>
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
			<?php elemental_addons_get_shortcode_template_part( 'testimonial-item', $_skin, 'testimonial-block/tpl', $settings, false ); ?>
			<?php } ?>
			<!-- end of the loop -->
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php elemental_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>