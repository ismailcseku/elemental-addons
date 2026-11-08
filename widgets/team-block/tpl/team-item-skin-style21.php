<!-- Team Block Style2-->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $team_item['feature_link'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';
?>
<div class="team-skin-style21">
  <div class="team-content team-info">
    <div class="team-media image">
      <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
    </div>
    <div class="team-content content">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
    </div>
  </div>
</div>