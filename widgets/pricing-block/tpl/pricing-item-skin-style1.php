<!-- Pricing Block Style1-->
<?php $pricing_item['settings'] = $settings; ?>
<div class="pricing-block-style1 style-thumb-<?php echo esc_attr($pricing_item['image_position']);?>">
  <div class="inner-box">
    <div class="image-box">
      <div class="image">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'pricing-block/tpl', $pricing_item, false );?>
      </div>
    </div>
    <div class="content-box">
      <div class="price"><?php echo esc_html($pricing_item['price']);?></div>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'pricing-block/tpl', $pricing_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'pricing-block/tpl', $pricing_item, false );?>
      <?php if ( ! empty( $settings['show_view_details_button'] ) && $settings['show_view_details_button'] === 'yes' ) : ?>
        <?php
          $feature_link = ! empty( $pricing_item['feature_link'] ) ? $pricing_item['feature_link'] : array( 'url' => '#', 'is_external' => '' );
          elemental_addons_get_shortcode_template_part( 'button', null, 'pricing-block/tpl', array_merge( $pricing_item, compact( 'feature_link', 'settings' ) ), false );
        ?>
      <?php endif; ?>
    </div>
  </div>
</div>