<!-- Team Block Style1-->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>
	<div class="team-skin-style43">
    <div class="inner-box">
      <div class="team-media image">
        <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
      </div>
      <svg class="shape-style1" width="270" height="482" viewBox="0 0 270 482" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0H177.857L270 255.929H192.857L257.143 482L34.2857 170.619H113.571L0 0Z" fill="black" fill-opacity="0.1"/>
      </svg>
      <div class="socials">
        <span class="team-share fa fa-share-alt"></span>
        <?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
      </div>
      <div class="team-content content-box">
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
      </div>
    </div>
  </div>