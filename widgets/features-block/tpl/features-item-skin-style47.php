<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$first_letter_title = substr($features_item['title'], 0, 1);
?>

<div class="features-block-style47">
  <figure class="image">
    <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
  </figure>
  <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>

  <?php if ( $show_view_details_button == 'yes' ) : ?>
  <a href="<?php echo esc_url( $url );?>" class="service-btn"><?php echo esc_html( $settings['view_details_button_text']  ); ?> <i class="fa fa-plus"></i></a>
  <?php endif; ?>

</div>