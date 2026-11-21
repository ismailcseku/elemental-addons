<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = isset( $service_item['feature_link'] ) ? $service_item['feature_link'] : [];
$target = ( $feature_link && ! empty( $feature_link['is_external'] ) ) ? ' target="_blank"' : '';
$rel = ( $feature_link && ! empty( $feature_link['nofollow'] ) ) ? ' rel="nofollow"' : '';
$url = ( $feature_link && ! empty( $feature_link['url'] ) && '#' !== $feature_link['url'] ) ? $feature_link['url'] : '';
?>

<div class="service-block-style1">
  <div class="inner-block">
	<?php if ( ! empty( $service_item['featured_image']['id'] ) ) : ?>
	<div class="image">
	  <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false ); ?>
	</div>
	<?php endif; ?>
	<div class="icon">
	  <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false ); ?>
	</div>
	<div class="content-box">
	  <div class="inner-box">
		<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false ); ?>
		<div class="text">
		  <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false ); ?>
		</div>
		<?php if ( ! empty( $show_view_details_button ) && $show_view_details_button === 'yes' ) : ?>
		  <a href="<?php echo esc_url( $url ); ?>"<?php echo $target; ?><?php echo $rel; ?> class="btn-more"><span class="btn-title"><?php echo esc_html( $view_details_button_text ); ?></span> <span class="arrow"><i class="ei ei-arrow-right"></i></span></a>
		<?php endif; ?>
	  </div>
	</div>
  </div>
</div>
