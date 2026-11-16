<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
?>

<div class="features-block-style24">
  <div class="inner-block">
    <div class="icon">
      <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
    </div>
    <div class="content">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <div class="text">
        <?php
          if ( ! empty( $features_item['content'] ) ) {
            echo wp_kses( $features_item['content'], 'post' );
          }
        ?>
      </div>
    </div>
  </div>
</div>