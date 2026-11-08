<!-- Team Block Default -->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>
<div class="team-skin-style-default">
	<div class="team-media">
		<?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false ); ?>
	</div>
	<div class="team-content">
		<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false ); ?>
		<?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false ); ?>
		<?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false ); ?>
		<span class="team-share fa fa-share-alt" aria-hidden="true"></span>
	</div>
</div>
