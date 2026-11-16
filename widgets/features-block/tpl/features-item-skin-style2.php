
<?php
$features_item['settings'] = $settings;
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>

<div class="features-block-style2">
  <div class="shape"></div>
  <div class="ks-choose-icon">
    <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
  </div>
  <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
  <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
  <?php if ( $show_view_details_button == 'yes' ) : ?>
    <?php elemental_addons_get_shortcode_template_part( 'button', null, 'features-block/tpl', $features_item, false );?>
  <?php endif; ?>
</div>