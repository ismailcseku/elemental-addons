<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
?>
  <div class="features-block-style8">
    <div class="thumb">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'features-block/tpl', $features_item, false );?>
    </div>
    <div class="content">
      <div class="service-icon icon">
        <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
      </div>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
      <?php if ( $show_view_details_button == 'yes' ) : ?>
        <?php elemental_addons_get_shortcode_template_part( 'button', null, 'services/tpl', $params, false ); ?>
      <?php endif; ?>
    </div>
    <div class="clearfix"></div>
  </div>