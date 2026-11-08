<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$first_letter_title = substr($features_item['title'], 0, 1);
?>
  <div class="features-block-style37">
    <div class="inner-block">
      <div class="image">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'features-block/tpl', $features_item, false );?>
      </div>
      <div class="content">
        <div class="icon-box">
          <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
        </div>
        <div class="inner">
          <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
          <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
        </div>
      </div>
    </div>
  </div>