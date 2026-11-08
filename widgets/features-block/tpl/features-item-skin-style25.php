<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$image_position = $features_item['image_position'];
?>
<div class="features-block-style25">
  <div class="inner-box">
    <div class="image">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'features-block/tpl', $features_item, false );?>
    </div>
    <div class="content-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
    </div>
  </div>
</div>