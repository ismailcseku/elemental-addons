<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$first_letter_title = substr($features_item['title'], 0, 1);
$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>

<div class="features-block-style50">
  <div class="icon">
    <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
  </div>
  <div class="content">
      <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
      <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <a href="<?php echo esc_url( $url );?>" class="arrow-icon">
        <svg width="17" height="12" viewBox="0 0 17 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2483 6.64957L0 6.64957L0 5.25684L16.2483 5.25684V6.64957Z" fill="#0F0B19"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M15.5522 5.25635C12.2769 5.25635 9.60059 8.13661 9.60059 11.2079V11.9043H10.9933V11.2079C10.9933 8.87605 13.0755 6.64908 15.5522 6.64908H16.2482V5.25635H15.5522Z" fill="#0F0B19"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M15.5512 6.64802C12.276 6.64802 9.59961 3.76772 9.59961 0.696366V0L10.9923 0V0.696366C10.9923 3.02834 13.0746 5.25529 15.5512 5.25529H16.2472V6.64802H15.5512Z" fill="#0F0B19"/>
        </svg>
      </a>
    <?php endif; ?>
  </div>
</div>