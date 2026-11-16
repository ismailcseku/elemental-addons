<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$first_letter_title = substr($features_item['title'], 0, 1);
$feature_link = $features_item['features_link'];
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>

<div class="features-block-style15">
	<div class="icon">
		<?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
	</div>
	<div class="content">
		<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
		<?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>

		<?php if ( $show_view_details_button == 'yes' ) : ?>
			<a href="<?php echo esc_url( $url );?>" class="text-btn">
				<?php echo esc_html( $settings['view_details_button_text']  ); ?>
			</a>
		<?php endif; ?>
	</div>
</div>