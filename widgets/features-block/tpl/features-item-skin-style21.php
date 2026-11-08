<?php
$features_item['settings'] = $settings;
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$features_link = $features_item['features_link'];
$title = $features_item['title'];
$count = $features_item['count'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>
<div class="features-block-style21">
	<div class="inner-box">
		<div class="title-box">
      <div class="content">
        <div class="icon"><?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?></div>
        <?php if( !empty( $title ) ) : ?>
          <<?php echo esc_attr( $title_tag );?> class="features-title">
          <?php echo $title;?>
          </<?php echo esc_attr( $title_tag );?>>
        <?php endif; ?>
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
      </div>
    </div>
		<div class="content-box">
			<div class="inner-content">
        <div class="image">
					<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'features-block/tpl', $features_item, false );?>
				</div>
			</div>
		</div>
	</div>
</div>
