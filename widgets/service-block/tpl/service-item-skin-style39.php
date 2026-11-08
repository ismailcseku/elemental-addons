<!-- Service Block Style4-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
	<div class="service-block service-block-style39">
		<div class="inner-block">
			<div class="icon">
				<?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
			</div>
			<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
			<?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
			<div class="bottom-box">
				<a href="<?php echo esc_url( $url );?>" class="service-button-three">
					<?php echo esc_html( $view_details_button_text  ); ?>
					<?php if( ! empty( $button_icon['value'] ) ) { ?>
						<?php \Elementor\Icons_Manager::render_icon( $button_icon ); ?>
					<?php }?>
				</a>
				<div class="number">
					<?php elemental_addons_get_shortcode_template_part( 'part-count', null, 'service-block/tpl', $service_item, false );?>
				</div>
			</div>
		</div>
	</div>