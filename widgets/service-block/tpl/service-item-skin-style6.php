<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$title = $service_item['title'];
$count = $service_item['count'];
$feature_link = $service_item['feature_link'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block-style6">
	<div class="inner-box">
		<div class="title-box">
			<div class="number">{<span><?php echo esc_html( $count );?></span>}</div>
			<?php if( !empty( $title ) ) : ?>
			<<?php echo esc_attr( $title_tag );?> class="service-title">
				<?php echo wp_kses_post( $title ); ?>
			</<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>
		</div>
		<div class="content-box">
			<div class="image-column">
				<div class="inner-column">
					<div class="image">
						<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
					</div>
					<div class="icon-box">
						<div class="inner">
							<a href="<?php echo esc_url( $url );?>"><i class="icon lnr-icon-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="content-column">
				<div class="inner-column">
					<?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
				</div>
			</div>
		</div>
	</div>
</div>