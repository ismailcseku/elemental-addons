<!-- Team Block Style1-->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
// Get featured image ID
$image_id = $team_item['featured_image']['id'] ?? '';
$image_url = '';
if ( $image_id ) {
    $image_url = wp_get_attachment_image_url( $image_id, 'full' );
}
?>


<div class="team-skin-style11 team-item">
	<div class="inner-box">
		<div class="team-media member-image" style="background-image: url(<?php echo esc_url( $image_url ); ?>)"></div>
		<div class="team-content content-box">
			<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
		</div>
		<div class="team-share">
			<span class="icon team-share fa fa-share-alt"></span>
				<?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
		</div>
	</div>
</div>