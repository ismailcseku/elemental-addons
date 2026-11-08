<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;

$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>


<div class="features-block-style17">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'features-block/tpl', $features_item, false );?>
      <div class="icon">
        <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
      </div>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <div class="btn-wrp">
          <?php if ($show_view_details_button == 'yes') : ?>
            <a href="<?php echo esc_url( $url );?>" class="go-btn"><i class="fa fa-arrow-right"></i><?php echo esc_html( $settings['view_details_button_text']  ); ?></a>
          <?php endif; ?>
      </div>
</div>