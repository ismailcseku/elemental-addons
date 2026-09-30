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
    </div>
  </div>
</div>