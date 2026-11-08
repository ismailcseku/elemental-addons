<!-- Features Block Style3-->
<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$first_letter_title = substr($features_item['title'], 0, 1);
$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
// Get featured image ID
$image_id = $features_item['featured_image']['id'] ?? '';
$image_url = '';
if ( $image_id ) {
    $image_url = wp_get_attachment_image_url( $image_id, 'full' );
}
?>
<div class="features-block-style28">

  <div class="content">

    <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>

    <?php
    // Check if list items exist and have content
    $has_list_items = false;
    if( !empty( $features_item['list_items'] ) && is_array( $features_item['list_items'] ) ) {
      foreach( $features_item['list_items'] as $list_item ) {
        if( !empty( $list_item['list_item_text'] ) && trim( $list_item['list_item_text'] ) !== '' ) {
          $has_list_items = true;
          break;
        }
      }
    }

    if( $has_list_items ) : ?>
    <ul>
      <?php foreach( $features_item['list_items'] as $list_item ) : ?>
        <?php if( !empty( $list_item['list_item_text'] ) && trim( $list_item['list_item_text'] ) !== '' ) : ?>
        <li>
          <?php if( !empty( $list_item['list_item_link']['url'] ) ) : ?>
          <a href="<?php echo esc_url( $list_item['list_item_link']['url'] );?>" <?php echo ( !empty( $list_item['list_item_link']['is_external'] ) ) ? ' target="_blank"' : ''; ?>>
            <?php echo esc_html( $list_item['list_item_text'] );?>
          </a>
          <?php else: ?>
            <?php echo esc_html( $list_item['list_item_text'] );?>
          <?php endif; ?>
        </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>

  </div>

  <?php if ( $image_url ) : ?>
  <div class="hover-image d-none d-lg-block bg-cover" style="background-image: url('<?php echo esc_url( $image_url ); ?>');"></div>
  <?php endif; ?>

  <?php if ( !empty( $features_item['content'] ) ) : ?>
  <p class="text">
    <?php echo wp_kses_post( $features_item['content'] ); ?>
  </p>
  <?php endif; ?>

  <?php if ( $show_view_details_button == 'yes' ) : ?>
  <a href="<?php echo esc_url( $url );?>" class="arrow-icon" <?php echo $target;?>>
    <i class="fa fa-arrow-right"></i>
  </a>
  <?php endif; ?>

</div>