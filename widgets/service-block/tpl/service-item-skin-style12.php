<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
	<div class="service-block-style12">
		<div class="inner-box">
			<div class="image-box">
				<div class="image">
          <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
				</div>
        <div class="icon">
          <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
        </div>
		  </div>
			<div class="content-box content">
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
        <?php if ( $show_view_details_button == 'yes' ) : ?>
          <a href="<?php echo esc_url( $url );?>" aria-label="Read More" class="read-more"><i class="lnr-icon-arrow-right1"></i></a>
        <?php endif; ?>
			</div>
		</div>
	</div>