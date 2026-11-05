<!-- Team Block Style1-->
<?php
$team_item['settings'] = $settings;
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>

<div class="team-skin-style35 team-item">
  <div class="inner-box">
    <div class="team-media image">
      <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
    </div>
    <div class="team-content content">
      <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <div class="team-content info-box">
        <a href="tel:<?php echo wp_kses( $team_item['phone'], 'post' ); ?>" class="info-btn"> <span class="icon"><i class="flaticon-common-call"></i></span> <span class="text"><?php echo wp_kses( $team_item['phone'], 'post' ); ?></span> </a>
        <?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
      </div>
    </div>
  </div>
</div>