<?php $settings['settings'] = $settings; ?>
<?php if ( $team_items_array ) : ?>
	<div class="tm-sc-team tm-team-masonry">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout masonry grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
        		<div class="isotope-item isotope-item-sizer"></div>
				<!-- the loop -->
				<?php foreach (  $team_items_array as $team_item ) { ?>
				<?php $settings['team_item'] = $team_item; ?>
				<?php
					$animation = "";
					$animation_delay = "";
					if(isset($team_item['wow_appear_animation']) && !empty($team_item['wow_appear_animation'])) {
						$animation = $team_item['wow_appear_animation'];
					}
					if(isset($team_item['wow_animation_delay']) && !empty($team_item['wow_animation_delay'])) {
						$animation_delay = $team_item['wow_animation_delay'] . 'ms';
					}
				?>
				<div class="isotope-item team-item elementor-repeater-item-<?php echo esc_attr( $team_item['_id'] ); ?> <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
					<?php elemental_addons_get_shortcode_template_part( 'team-item', $_skin, 'team-block/tpl', $settings, false ); ?>
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