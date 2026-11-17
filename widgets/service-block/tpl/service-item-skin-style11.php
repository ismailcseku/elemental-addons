<!-- Service Block Style2-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block service-block-style11">
	<div class="content">
		<div class="icon">
			<?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
		</div>
		<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
	</div>
	<div class="thumb">
		<?php if( !empty( $service_item['featured_image']['id'] ) ) : ?>
			<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
		<?php endif; ?>
	</div>
	<div class="service-shape">
		<img class="shape-default" src="<?php echo esc_url( ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/service-block-style11-shape-default.png' ); ?>" alt="<?php esc_attr_e( 'Service Shape', 'elemental-addons' ); ?>">
		<img class="shape-hover" src="<?php echo esc_url( ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/service-block-style11-shape-hover.png' ); ?>" alt="<?php esc_attr_e( 'Service Shape', 'elemental-addons' ); ?>">
	</div>
</div>
