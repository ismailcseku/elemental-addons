<!-- Service Block Style5-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
	<div class="service-block service-block-style5">
		<div class="thumb">
			<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
		</div>
		<div class="content">
			<?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
			<a href="<?php echo esc_url( $url );?>" class="theme-btn-main">
				<span class="theme-btn-arrow-left"> <i class="lnr-icon-arrow-right1"></i></span>
				<span class="btn-title"><?php echo esc_html( $view_details_button_text  ); ?></span>
				<span class="theme-btn-arrow-right"><i class="lnr-icon-arrow-right1"></i></span>
			</a>
		</div>
	</div>