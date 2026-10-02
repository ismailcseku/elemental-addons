<!-- Working Block Style1-->
<?php $working_item['settings'] = $settings; ?>
<div class="working-block-style1">
  <div class="inner-block">
    <div class="top-box">
      <div class="working-count">
        <?php \elemental_addons_get_shortcode_template_part( 'part-count', null, 'working-block/tpl', $working_item, false );?>
      </div>
    </div>
    <div class="content">
      <?php \elemental_addons_get_shortcode_template_part( 'part-title', null, 'working-block/tpl', $working_item, false );?>
      <?php \elemental_addons_get_shortcode_template_part( 'part-content', null, 'working-block/tpl', $working_item, false );?>
    </div>
  </div>
</div>