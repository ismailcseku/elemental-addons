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
	<div class="service-block service-block-style14">
		<div class="inner-box">
			<div class="title-box">
				<div class="title-area">
					<?php elemental_addons_get_shortcode_template_part( 'part-count', null, 'service-block/tpl', $service_item, false );?>
					<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
				</div>
				<a href="<?php echo esc_url( $url );?>" class="icon-2"><i class="lnr-icon-arrow-right1"></i></a>
			</div>
			<div class="content-box">
				<div class="content">
					<?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
				</div>
				<div class="service-image">
					<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
				</div>
			</div>
		</div>
	</div>