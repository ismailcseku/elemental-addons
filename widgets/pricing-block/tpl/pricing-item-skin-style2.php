<!-- Pricing Block Style2-->
<?php $pricing_item['settings'] = $settings; ?>
<div class="pricing-block-style2 <?php if( $pricing_item['plan_active'] === 'yes' ) echo esc_attr('active'); ?>">
  <div class="inner-box">
    <div class="image-box">
      <div class="image">
        <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'pricing-block/tpl', $pricing_item, false );?>
      </div>
    </div>
    <div class="content-box-hover">
      <div class="image-box-hover">
        <div class="image">
          <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'pricing-block/tpl', $pricing_item, false );?>
        </div>
      </div>
      <div class="content-box">
        <div class="inner-content-box">
          <div class="price"><?php echo esc_html($pricing_item['price']);?></div>
          <br>
          <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'pricing-block/tpl', $pricing_item, false );?>
          <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'pricing-block/tpl', $pricing_item, false );?>
        </div>
      </div>
    </div>
  </div>
</div>