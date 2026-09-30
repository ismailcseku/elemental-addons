<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
?>
<div class="features-block-style7">
  <div class="inner-box">
    <div class="image-box">
      <div class="image">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'features-block/tpl', $features_item, false );?>
      </div>
      <div class="info-box">
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
        <a href="<?php echo esc_url( $url );?>" class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a>
      </div>
    </div>
    <div class="overlay-content">
      <div class="info-box">
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
        <a href="<?php echo esc_url( $url );?>" class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a>
      </div>
    </div>
  </div>
</div>