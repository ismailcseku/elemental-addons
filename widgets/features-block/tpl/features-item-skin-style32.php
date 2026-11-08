<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$first_letter_title = substr($features_item['title'], 0, 1);
?>
<div class="features-block-style32">
  <div class="inner-box">
    <div class="image-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'features-block/tpl', $features_item, false );?>
      <h4 class="word">
        <?php echo esc_html( strip_shortcodes( $first_letter_title ) ) ?>
      </h4>
    </div>
    <div class="content-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
      <?php if ( $show_view_details_button == 'yes' ) : ?>
        <?php elemental_addons_get_shortcode_template_part( 'button', null, 'features-block/tpl', $features_item, false );?>
      <?php endif; ?>
      <div class="icon-lines-3"></div>
    </div>
  </div>
</div>