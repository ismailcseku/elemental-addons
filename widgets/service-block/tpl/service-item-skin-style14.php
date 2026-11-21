<!-- Service Block Style1-->
<?php $service_item['settings'] = $settings; ?>
<?php
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>

<div class="service-block service-block-style14">
	<div class="inner-block">
		<div class="icon-block">
			<div class="icon">
				<?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
			</div>
		</div>
		<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
		<?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
		<?php
			// Sanitize the service list
			$list = wp_kses( $service_item['service_list'], 'post' );

			// Split into array by line breaks
			$items = preg_split('/\r\n|\r|\n/', $list);

			if ( ! empty( $items ) ) {
				echo '<ul class="list-info">';
				foreach ( $items as $item ) {
					$item = trim( $item );
					if ( ! empty( $item ) ) {
						echo '<li>' . esc_html( $item ) . '</li>';
					}
				}
				echo '</ul>';
			}
		?>
		<?php if ( $show_view_details_button == 'yes' ) : ?>
			<a href="<?php echo esc_url( $url );?>" class="btn-more">
				<span class="btn-title"><?php echo esc_html( $settings['view_details_button_text'] ?? '' ); ?></span>
				<span class="btn-icon"><i class="ei ei-arrow-right"></i></span>
			</a>
		<?php endif; ?>
	</div>
</div>