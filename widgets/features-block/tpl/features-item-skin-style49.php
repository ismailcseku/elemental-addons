<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>
  <div class="features-block-style49">
    <div class="inner-block">
      <div class="icon">
        <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
      </div>
      <div class="content">
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
        <a href="<?php the_permalink();?>" class="arrow-link"><span class="text"><?php echo esc_html( $settings['view_details_button_text']  ); ?></span>
          <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 8.00008L15 8.00008M18.3361 8.01939C15.2241 7.82927 9 9.16017 9 16.0048M18.3361 7.98545C15.2241 8.17558 9 6.84467 9 0" stroke="#FF6B1E" stroke-width="1.5"/>
          </svg>
        </a>
      </div>
      <div class="border-line"></div>
    </div>
  </div>