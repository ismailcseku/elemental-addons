<!-- Team Block Style8-->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>
  <div class="team-skin-style36">
    <div class="team-media team-image">
      <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
      <div class="social-item">
        <div class="social-icon">
          <?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
        </div>
        <a href="<?php echo esc_url( $url );?>" class="arrow-icon"><i class="lnr-icon-arrow-right"></i></a>
      </div>
    </div>
    <div class="team-content">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
    </div>
  </div>