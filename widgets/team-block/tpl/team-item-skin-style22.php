<!-- Team Block Style1-->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>

<div class="team-skin-style22 team-block">
	<div class="inner-block rr-hover-reveal-item2">
		<div class="team-content content-box">
			<div class="team-content content">
				<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
				<div class="team-memeber-designation">
					<?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
					<?php elemental_addons_get_shortcode_template_part( 'part-short-bio', null, 'team-block/tpl', $team_item, false );?>
				</div>
			</div>        
			<?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
		</div>		
		<div class="hover-image"><?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?></div>
	</div>
</div>