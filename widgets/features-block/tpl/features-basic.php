<?php $settings['settings'] = $settings; ?>
<?php if ( $features_items_array ) : ?>
	<div class="tm-sc-features tm-features-basic">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="feature-layout clearfix">
				<!-- the loop -->
				<?php foreach (  $features_items_array as $features_item ) { ?>
				<?php $settings['features_item'] = $features_item; ?>
				<?php
					$animation = "";
					$animation_delay = "";
					if(isset($features_item['wow_appear_animation']) && !empty($features_item['wow_appear_animation'])) {
						$animation = $features_item['wow_appear_animation'];
					}
					if(isset($features_item['wow_animation_delay']) && !empty($features_item['wow_animation_delay'])) {
						$animation_delay = $features_item['wow_animation_delay'] . 'ms';
					}
				?>
				<div class="<?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
					<?php elemental_addons_get_shortcode_template_part( 'features-item', $_skin, 'features-block/tpl', $settings, false ); ?>
				</div>
				<?php } ?>
				<!-- end of the loop -->
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php elemental_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>