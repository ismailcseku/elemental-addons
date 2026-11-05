<!-- Team Block Style5-->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
$count = $team_item['count'];
?>
<div class="team-skin-style42 team-item">
	<div class="inner-box">
		<div class="bg bg-image">
			<?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
		</div>
		<div class="anim-icons">
			<div class="shape-image1">
				<?php elemental_addons_get_shortcode_template_part( 'part-thumb2', null, 'team-block/tpl', $team_item, false );?>
			</div>
		</div>
		<div class="team-content content-box">
			<div class="row">
				<div class="col-lg-5 col-md-6">
					<div class="number">{<span><?php echo $count;?></span>}</div>
				</div>
				<div class="col-lg-7 col-md-6">
					<div class="team-content content">
						<div class="team-content info-box">
							<?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
							<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
							<?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
						</div>
						<?php elemental_addons_get_shortcode_template_part( 'part-short-bio', null, 'team-block/tpl', $team_item, false );?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>