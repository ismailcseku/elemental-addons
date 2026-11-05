<!-- Team Block Style1-->
<?php $team_item['settings'] = $settings; ?>
<?php
$team_item['title_tag'] = $title_tag;
$team_item['subtitle_tag'] = $subtitle_tag;
?>
  <div class="team-skin-style27 team-item">
    <div class="inner-block">
        <div class="team-media images">
          <?php elemental_addons_get_shortcode_template_part( 'part-thumb', null, 'team-block/tpl', $team_item, false );?>
        </div>
        <div class="team-items-hover">
          <div class="inner-box">
            <div class="title-box">
              <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'team-block/tpl', $team_item, false );?>
              <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'team-block/tpl', $team_item, false );?>
            </div>
						<?php elemental_addons_get_shortcode_template_part( 'part-short-bio', null, 'team-block/tpl', $team_item, false );?>
            <div class="bottom-box">
              <div class="social-links">
                <?php elemental_addons_get_shortcode_template_part( 'part-social-links', null, 'team-block/tpl', $team_item, false );?>
              </div>
              <?php if ( $show_view_details_button == 'yes' ) : ?>
                <a href="<?php echo esc_url( $url );?>" class="arrow-icon">
                  <i class="flaticon-common-right-arrow"></i>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
    </div>
  </div>