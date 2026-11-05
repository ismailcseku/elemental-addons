<!-- Team Block Style1-->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $team_item['feature_link'];
$target = ($feature_link && $feature_link['is_external']) ? ' target="_blank"' : '';
$url = ($feature_link && $feature_link['url']) ? $feature_link['url'] : '';
?>
<div class="team-skin-style20 team-item">
	<div class="content">
		<div class="title-area">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
		</div>
		<a href="<?php echo esc_url($feature_link['url']); ?>" class="arrow-icon">
			<i class="fa fa-arrow-right"></i>
		</a>
	</div>
	<div class="image-wrap">
		<div class="image-shape"></div>
		<div class="image">
			<?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
		</div>
	</div>
  <?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
</div>