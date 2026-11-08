<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$title = $service_item['title'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block-style21">
	<div class="inner-box">
		<div class="title-box">
			<?php if( !empty( $title ) ) : ?>
				<<?php echo esc_attr( $title_tag );?> class="service-title">
				<?php echo $title;?>
				</<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>
			<div class="icon-box">
				<?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
			</div>
		</div>
		<div class="content-box">
			<div class="inner-content">
				<div class="image-column">
					<div class="inner-column">
						<div class="image">
							<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
						</div>
					</div>
				</div>
				<div class="content-column">
					<div class="inner-column">
						<?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'service-block/tpl', $service_item, false );?>
						<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
						<?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
						<div class="image">
							<a class="ks-btn-black" href="<?php echo esc_url( $url );?>">
								<span>
									<span class="text-1">
										<?php echo esc_html( $settings['view_details_button_text']  ); ?>
									</span>
									<span class="text-2">
										<?php echo esc_html( $settings['view_details_button_text']  ); ?>
									</span>
								</span>
								<i>
									<svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M10.0035 3.90804L1.41153 12.5L0 11.0885L8.59097 2.49651H1.01922V0.5H12V11.4808H10.0035V3.90804Z" fill="white"></path>
									</svg>
									<svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M10.0035 3.90804L1.41153 12.5L0 11.0885L8.59097 2.49651H1.01922V0.5H12V11.4808H10.0035V3.90804Z" fill="white"></path>
									</svg>
								</i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>