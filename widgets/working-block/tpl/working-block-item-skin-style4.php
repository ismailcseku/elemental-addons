<!-- Working Block Style2-->
<?php $working_item['settings'] = $settings; ?>
  <div class="working-block-style4">
    <div class="head">
      <div class="image">
        <?php \elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'working-block/tpl', $working_item, false );?>
      </div>
      <?php \elemental_addons_get_shortcode_template_part( 'part-count', null, 'working-block/tpl', $working_item, false );?>
    </div>
    <div class="content">
      <?php \elemental_addons_get_shortcode_template_part( 'part-title', null, 'working-block/tpl', $working_item, false );?>
      <?php \elemental_addons_get_shortcode_template_part( 'part-content', null, 'working-block/tpl', $working_item, false );?>
    </div>
  </div>