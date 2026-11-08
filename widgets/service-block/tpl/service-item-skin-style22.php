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

<div class="service-block service-block-style22">
	<div class="container">
		<div class="row align-items-center">
			<div class="content-column col-xl-5 col-lg-6">
				<div class="inner-column">
					<div class="content"><?php elemental_addons_get_shortcode_template_part( 'part-count', null, 'service-block/tpl', $service_item, false );?></div>
					<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
					<div class="text"><?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?></div>

					<?php elemental_addons_get_shortcode_template_part( 'part-content2', null, 'service-block/tpl', $service_item, false );?>

					<?php if ( $show_view_details_button == 'yes' ) : ?>
					<div class="button-box">
						<a class="theme-btn btn-style-one" href="<?php echo esc_url( $url );?>">
							<span class="left-arrow"><i class="icon fa fa-long-arrow-right"></i></span>
							<span class="btn-text"><?php echo esc_html( $view_details_button_text  ); ?></span>
							<span class="right-arrow"><i class="icon fa fa-long-arrow-right"></i></span>
						</a>
					</div>
					<?php endif; ?>

				</div>
			</div>
			<div class="image-column col-xl-7 col-lg-6">
				<div class="inner-column">
					<div class="image">
						<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>