<!-- Team Block Style5-->
<?php $team_item['settings'] = $settings; ?>
<div class="team-skin-style37 team-item">
  <div class="team-inner">
    <div class="team-thumb">
      <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
      <div class="staff-social-links">
        <?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
      </div>
    </div>
    <div class="team-content">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-short-bio', null, 'team-block/tpl', $team_item, false );?>
    </div>
  </div>
</div>