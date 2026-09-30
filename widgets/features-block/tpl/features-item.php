<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
?>
<div class="features-block features-block-style1">
  <div class="inner-box">
    <div class="content">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <div class="icon">
        <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
      </div>
    </div>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <?php elemental_addons_get_shortcode_template_part( 'button', null, 'features-block/tpl', $features_item, false );?>
    <?php endif; ?>
  </div>
</div>