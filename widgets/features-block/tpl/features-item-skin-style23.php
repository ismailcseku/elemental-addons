<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>

<!-- Service Block -->
<div class="features-block features-block-style23">
  <div class="inner-box">
    <div class="icon-box">
      <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
    </div>
    <div class="content-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <div class="features-details">
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
      </div>
    </div>

    <?php if ( $show_view_details_button == 'yes' ) : ?>
    <div class="btn-box">
      <a href="<?php echo esc_url( $url );?>" class="theme-btn btn-style-two">
        <span class="btn-title"><?php echo esc_html( $settings['view_details_button_text']  ); ?></span> <i class="flaticon-common-arrow-right"></i>
      </a>
    </div>
    <?php endif; ?>

  </div>
</div>