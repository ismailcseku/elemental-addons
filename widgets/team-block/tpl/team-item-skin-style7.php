<!-- Team Block Style2-->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>

<div class="team-skin-style7">
  <div class="inner-block">
    <div class="team-media image-box">
      <div class="team-media image">
        <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
      </div>
    </div>
    <div class="team-content info-box">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
    </div>
    <div class="team-content content">
      <div class="title-box">
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
      </div>
      <div class="team-socials">
        <?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
      </div>
    </div>
  </div>
</div>