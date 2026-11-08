<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;

$featured_image = $features_item['featured_image'];

$first_letter_title = substr($features_item['title'], 0, 1);
$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';

$image[0] = '';
if( isset($featured_image['id']) && !empty($featured_image['id']) ){
	$image = wp_get_attachment_image_src( $featured_image['id'], 'full');
}
//if empty then use this default image
if( empty($image[0])) {
  $image[0] = ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/feature-image1.jpg';
}
?>

<!-- Feature Block -->
<div class="features-block-style18">
  <div class="inner-box">
    <div class="bg bg-image" style="--bg-featured-image: url('<?php echo esc_url( $image[0] );?>')"></div>
    <div class="icon-lines-3"></div>
    <div class="icon">
      <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
    </div>
    <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
    <a href="<?php echo esc_url( $url );?>" class="read-more"><i class="fa fa-long-arrow-right"></i></a>
  </div>
</div>