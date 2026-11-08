<?php
$team_item['settings'] = $settings;
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>

<div class="team-skin-style31">
  <div class="team-media image-box">
    <?php elemental_addons_get_shortcode_template_part( 'part-social-links-two', null, 'team-block/tpl', $team_item, false );?>
    <figure class="team-media image">
      <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
    </figure>
  </div>
  <div class="team-content content-box text-center">
    <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
    <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
  </div>
</div>