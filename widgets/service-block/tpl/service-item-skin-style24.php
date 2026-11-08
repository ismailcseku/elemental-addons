<!-- Service Block Style3-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block-style24">
	<div class="container">
	  <div class="row g-4 align-items-center">
		  <div class="col-xl-4 col-lg-3 col-md-6">
			  <div class="content">
				<div class="icon">
					<?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
				</div>
				<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
			  </div>
		  </div>
		  <div class="col-xl-4 col-lg-4 col-md-6">
			<div class="service-image">
			  <?php if( !empty( $service_item['featured_image']['id'] ) ) : ?>
			  <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
			  <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
			  <?php endif; ?>
			  <?php if( !empty( $count ) ) : ?>
			  <span class="number">
				<?php echo esc_html( $count ); ?><b>.</b>
			  </span>
			  <?php endif; ?>
			</div>
		  </div>
		  <div class="col-xl-4 col-lg-5 col-md-12">
			<div class="content-2">
			  <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
			  <?php if ( $show_view_details_button == 'yes' ) : ?>
				<a href="<?php echo esc_url( $url );?>" class="link-btn"<?php echo $target;?>>
				  <?php echo esc_html( $view_details_button_text  ); ?> <i class="fa fa-arrow-right"></i>
				</a>
			  <?php endif; ?>
			</div>
		  </div>
	  </div>
	</div>
</div>