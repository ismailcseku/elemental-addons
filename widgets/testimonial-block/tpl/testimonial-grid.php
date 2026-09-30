<?php $settings['settings'] = $settings; ?>
<?php if ( $testimonial_items_array ) : ?>
	<div class="tm-testimonial-grid tm-sc-testimonials">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
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
				<div class="isotope-item testimonial-item elementor-repeater-item-<?php echo esc_attr( $testimonial_item['_id'] ); ?> <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
					<?php elemental_addons_get_shortcode_template_part( 'testimonial-item', $_skin, 'testimonial-block/tpl', $settings, false ); ?>
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