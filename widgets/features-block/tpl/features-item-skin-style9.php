<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
?>

<div class="features-block-style9">
	<div class="inner-block">
		<div class="icon-block">
			<?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
		</div>
		<div class="content-block">
			<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
			<div class="text">
				<?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
			</div>
		</div>
		<div class="shape-1">
			<img src="<?php echo esc_url( ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/choose-shape1-1.png' ); ?>" alt="<?php esc_attr_e( 'Shape', 'elemental-addons' ); ?>">
		</div>
	</div>
</div>
