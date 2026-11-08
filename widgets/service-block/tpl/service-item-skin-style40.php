<!-- Service Block Style4-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block service-block-style40">
  <div class="inner-block">
    <div class="upper-box">
      <div class="icon">
        <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
      </div>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="bottom-box">
      <div class="text">
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
      </div>
      <?php if ( $show_view_details_button == 'yes' ) : ?>
      <div class="btn-box">
        <a href="<?php echo esc_url( $url );?>" class="read-more"<?php echo $target; ?>>
          <span class="arrow-left">
			<img src="<?php echo esc_url(ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/arrow-right-curve1.png'); ?>" alt="">
		</span>
          <span class="btn-title"><?php echo esc_html( $view_details_button_text ); ?></span>
          <span class="arrow-right">
			<img src="<?php echo esc_url(ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/arrow-right-curve1.png'); ?>" alt="">
		</span>
        </a>
      </div>
      <?php endif; ?>
    </div>
  </div>
</div>
