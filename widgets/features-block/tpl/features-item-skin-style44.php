<?php $features_item['settings'] = $settings; ?>
<?php
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '#0';
?>
<div class="features-block features-block-style44">
  <?php if ( $url && $url != '#0' ) : ?>
  <a class="btn-more" href="<?php echo esc_url( $url ); ?>"<?php echo $target; ?>><i class="fa fa-arrow-right"></i></a>
  <?php else : ?>
  <a class="btn-more" href="#0"><i class="fa fa-arrow-right"></i></a>
  <?php endif; ?>
  <div class="inner-box">
	<div class="block-dots">
	  <img src="<?php echo esc_url( ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/service-block-dots.png' ); ?>" alt="Image">
	</div>
	<div class="block-dots-active">
	  <img src="<?php echo esc_url( ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/service-block-dots-active.png' ); ?>" alt="Image">
	</div>
	<div class="icon-box2">
	  <i class="icon">
		<?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
	  </i>
	</div>
	<?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
  <p class="text"><?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?></p>
	<div class="block-shadow">
	  <img src="<?php echo esc_url( ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/service-block-shadow.png' ); ?>" alt="">
	</div>
  </div>
</div>