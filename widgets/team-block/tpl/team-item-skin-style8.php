<!-- Team Block Style8-->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>
<div class="team-current-theme8 team-item">
	<div class="inner-box">
		<div class="image-box">
			<div class="image">
				<?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
				<svg class="shape-style1" width="304" height="543" viewBox="0 0 304 543" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M304 0H103.746L0 288.319H86.8571L14.4762 543L265.397 192.212H176.127L304 0Z"/>
				</svg>
				<?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
			</div>
		</div>
		<div class="content-box">
			<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
			<?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
		</div>
	</div>
</div>