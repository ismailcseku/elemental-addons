<!-- Team Block Style2-->
<?php
$team_item['settings'] = $settings;
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
$rating = $team_item['rating'];
$rating_size = $rating['size'];
$featured_image_url = isset($team_item['featured_image']['url']) ? $team_item['featured_image']['url'] : '';
?>
<div class="team-skin-style30 team-item">
  <div class="inner-block">
    <div class="team-media images-box">
      <?php elemental_addons_get_shortcode_template_part('part-thumb', null, 'team-block/tpl', $team_item, false); ?>
    </div>
    <div class="rating"><i class="fas fa-star"></i>
      <?php echo esc_attr($rating_size); ?>
    </div>
    <div class="team-content author-info">
      <?php elemental_addons_get_shortcode_template_part('part-title', null, 'team-block/tpl', $team_item, false); ?>
      <?php elemental_addons_get_shortcode_template_part('part-subtitle', null, 'team-block/tpl', $team_item, false); ?>
    </div>
    <?php elemental_addons_get_shortcode_template_part('part-social-links', null, 'team-block/tpl', $team_item, false); ?>
    </a>
  </div>
</div>