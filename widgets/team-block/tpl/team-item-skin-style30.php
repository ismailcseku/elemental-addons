<!-- Team Block Style30 (same as Style59) -->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>
<div class="team-skin-style30">
  <div class="team-media image-box">
    <figure class="team-media image">
      <?php elemental_addons_get_shortcode_template_part('part-thumb', null, 'team-block/tpl', $team_item, false); ?>
    </figure>
    <?php elemental_addons_get_shortcode_template_part('part-social-links', null, 'team-block/tpl', $team_item, false); ?>
    <span class="team-share fa fa-share-alt"></span>
  </div>
  <div class="team-content info-box">
    <?php elemental_addons_get_shortcode_template_part('part-title', null, 'team-block/tpl', $team_item, false); ?>
    <?php elemental_addons_get_shortcode_template_part('part-subtitle', null, 'team-block/tpl', $team_item, false); ?>
  </div>
  <div class="degency-hover-bx hover-bx"></div>
  <div class="degency-hover-bx hover-bx2"></div>
  <div class="degency-hover-bx hover-bx3"></div>
  <div class="degency-hover-bx hover-bx4"></div>
</div>
