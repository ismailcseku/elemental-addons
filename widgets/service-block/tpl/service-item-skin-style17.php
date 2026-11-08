<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$feature_link = $service_item['feature_link'];
$count = $service_item['count'];
$target = ( $feature_link && $feature_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $feature_link && $feature_link['url'] ) ? $feature_link['url'] : '';

// Get amenities list
$amenities_list = !empty($service_item['amenities_list']) ? $service_item['amenities_list'] : array();

// Get button icon settings
$button_icon_type = isset( $settings['read_more_button_icon_type'] ) ? $settings['read_more_button_icon_type'] : 'image';
?>
<div class="service-block-style17">
  <div class="inner-block">
    <div class="image-box">
		<div class="image">
			<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
			<?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
		</div>
	</div>
    <div class="content-box">
      <div class="title-box">
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
        <?php if ( $show_view_details_button == 'yes' ) : ?>
          <a href="<?php echo esc_url( $url ); ?>" class="read-more"<?php echo $target; ?>>
            <?php echo esc_html( !empty($view_details_button_text) ? $view_details_button_text : 'View Details' ); ?>
            <span class="icon">
              <?php if ( $button_icon_type === 'font-icon' && !empty( $settings['read_more_button_icon'] ) ) : ?>
                <?php \Elementor\Icons_Manager::render_icon( $settings['read_more_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
              <?php elseif ( $button_icon_type === 'image' ) : ?>
                <?php
                // Button icon image - can be customized via settings or use default
                $button_icon_image = isset( $settings['read_more_button_icon_image'] ) && !empty( $settings['read_more_button_icon_image']['url'] )
                  ? $settings['read_more_button_icon_image']['url']
                  : ( defined( 'ELEMENTAL_ADDONS_ASSETS_URI' ) ? ELEMENTAL_ADDONS_ASSETS_URI . '/images/current-theme/btn-icon-2.png' : get_template_directory_uri() . '/images/current-theme/btn-icon-2.png' );
                ?>
                <img src="<?php echo esc_url( $button_icon_image ); ?>" alt="<?php esc_attr_e( 'View Details', 'elemental-addons' ); ?>">
              <?php endif; ?>
            </span>
          </a>
        <?php endif; ?>
      </div>
      <div class="inner">
        <?php if ( !empty( $amenities_list ) ) : ?>
          <ul class="amenities-list">
            <?php foreach ( $amenities_list as $amenity ) : ?>
              <?php if ( !empty( $amenity['amenity_text'] ) ) : ?>
                <li><?php echo esc_html( $amenity['amenity_text'] ); ?></li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>