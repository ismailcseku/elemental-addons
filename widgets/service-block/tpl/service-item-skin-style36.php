<!-- Service Block Style9-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$count = $service_item['count'];
$title = $service_item['title'];
$first_letter_title = substr($title, 0, 1);
$feature_link = $service_item['feature_link'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="service-block service-block-style36">
  <div class="single-inner">
    <div class="col-xl-3 col-lg-3 col-md-12">
      <?php elemental_addons_get_shortcode_template_part( 'part-count', null, 'service-block/tpl', $service_item, false );?>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12">
      <div class="single-card">
        <div class="shape-1">
        </div>
        <div class="equal-section">
          <div class="content">
            <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
            <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>

              <a class="theme-btn-main" href="<?php echo esc_url( $url );?>">
                <span class="theme-btn-arrow-left it-btn-arrow "> <i class="fa fa-long-arrow-right"></i> </span>
                <span class="theme-btn it-theme-btn"><?php echo esc_html( $view_details_button_text  ); ?></span>
                <span class="theme-btn-arrow-right it-btn-arrow "> <i class="fa fa-long-arrow-right"></i> </span>
              </a>

          </div>
          <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
        </div>
      </div>
    </div>
  </div>
</div>
