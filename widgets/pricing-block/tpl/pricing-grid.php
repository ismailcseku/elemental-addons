<?php $settings['settings'] = $settings; ?>
<?php if ( $pricing_items_array ) : ?>
	<div class="tm-sc-pricing tm-pricing-grid">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
				<!-- the loop -->
				<?php foreach (  $pricing_items_array as $pricing_item ) { ?>
				<?php $settings['pricing_item'] = $pricing_item; $class_item = 'elementor-repeater-item-' . $pricing_item['_id']; ?>
				<?php
				  $animation = "";
				  if(isset($pricing_item['wow_appear_animation']) && !empty($pricing_item['wow_appear_animation'])) {
				    $animation = $pricing_item['wow_appear_animation'];
				  }
				?>
				<div class="isotope-item pricing-item <?php echo esc_attr( $class_item) ?> <?php echo esc_attr($animation);?>">
					<?php elemental_addons_get_shortcode_template_part( 'pricing-item', $_skin, 'pricing-block/tpl', $settings, false ); ?>
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