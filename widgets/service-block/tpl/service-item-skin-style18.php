<!-- Service Block Style7-->
<?php $service_item['settings'] = $settings; ?>
<div class="service-block-style18">
  <div class="inner-box">
    <div class="content">
      <div class="icon-box">
        <?php elemental_addons_get_shortcode_template_part( 'icon-type', $service_item['icon_type'], 'service-block/tpl', $service_item, false );?>
      </div>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
    </div>
  </div>
</div>