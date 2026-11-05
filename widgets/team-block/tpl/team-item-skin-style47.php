<!-- Team Block Style1-->
<?php
$team_item['settings'] = $settings;
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>
<div class="team-skin-style47 team-item">
  <div class="inner-box">
    <div class="content">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
      <!-- Info Btn -->
      <a href="tel:<?php echo wp_kses( $team_item['phone'], 'post' ); ?>" class="info-btn"> <i class="icon flaticon-common-mobile-phone"></i><strong><?php echo wp_kses( $team_item['phone'], 'post' ); ?></strong>
      </a>
    </div>
    <div class="image">
      <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
    </div>
    <?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
  </div>
</div>