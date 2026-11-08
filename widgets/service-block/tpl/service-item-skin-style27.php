<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$title = $service_item['title'];
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block service-block-style27">
	<div class="inner-box">
		<div class="title-box">
			<div class="number">{<span><?php echo $count;?></span>}</div>
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
			<div class="row">
				<div class="image-column col-lg-6">
					<div class="inner-column">
						<div class="image">
							<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
						</div>
						<div class="button-box">
							<a href="<?php echo esc_url( $url );?>" class="btn-link"><?php echo esc_html( $settings['view_details_button_text']  ); ?>
								<i class="icon lnr-icon-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="content-column col-lg-5">
					<div class="inner-column">
						<?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>