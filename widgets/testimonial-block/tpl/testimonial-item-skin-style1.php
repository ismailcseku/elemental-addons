<!-- Testimonial Block Style1-->
<?php
$testimonial_item['settings'] = $settings;
$testimonial_item['name_tag'] = $name_tag;
$testimonial_item['position_tag'] = $position_tag;
$testimonial_item['title_tag'] = $title_tag;
?>
<div class="testimonial-block testimonial-block-style1">
	<div class="quote-icon">
		<?php if ( !empty( $settings['icon_type'] ) && $settings['icon_type'] == 'image' && !empty( $settings['icon_image']['id'] ) ) : ?>
			<?php
			$image_alt = get_post_meta($settings['icon_image']['id'], '_wp_attachment_image_alt', TRUE);
			$image = wp_get_attachment_image_src( $settings['icon_image']['id'], 'full' );
			?>
			<img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_html( $image_alt ); ?>">
		<?php elseif ( !empty( $settings['icon_type'] ) && $settings['icon_type'] == 'icon' && !empty( $settings['icon'] ) && !empty( $settings['icon']['value'] ) ) : ?>
			<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' , 'class' => 'icon' ] ); ?>
		<?php else : ?>
			<img src="<?php echo esc_url( ELEMENTAL_ADDONS_ASSETS_URI . '/images/icons/quote.png' ); ?>" alt="<?php esc_attr_e( 'Quote Icon', 'elemental-addons' ); ?>">
		<?php endif; ?>
	</div>
	<p>
		<?php elemental_addons_get_shortcode_template_part( 'part-author-text', null, 'testimonial-block/tpl', $testimonial_item, false ); ?>
	</p>
	<div class="client-info">
		<div class="client-img">
			<?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'testimonial-block/tpl', $testimonial_item, false );?>
		</div>
		<div class="info-content">
			<?php elemental_addons_get_shortcode_template_part( 'part-name', null, 'testimonial-block/tpl', $testimonial_item, false );?>
			<?php elemental_addons_get_shortcode_template_part( 'part-position', null, 'testimonial-block/tpl', $testimonial_item, false );?>
		</div>
	</div>
</div>
