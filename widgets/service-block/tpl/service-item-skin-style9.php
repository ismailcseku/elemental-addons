<!-- Service Block Style17-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$title = $service_item['title'];
$feature_link = $service_item['feature_link'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
$count = $service_item['count'];
?>
<div class="service-block service-block-style9">
    <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
    <div class="ks-service-link">
      <a href="<?php echo esc_url( $url );?>">
        <svg width="14" height="15" viewBox="0 0 14 15" fill="none"xmlns="http://www.w3.org/2000/svg"><path d="M5.90207 14.025V8.295H0.17207V6.09H5.90207V0.374999H8.10707V6.09H13.8221V8.295H8.10707V14.025H5.90207Z" fill="currentcolor" />
        </svg>
      </a>
    </div>
    <div class="ks-service-thumb">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
    <div class="ks-service-icon">
			<?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
			</div>
    </div>
    <div class="ks-service-list-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <a href="<?php echo esc_url( $url );?>" class="ks-service-more"><?php echo esc_html( $settings['view_details_button_text']  ); ?></a>
</div>