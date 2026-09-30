<?php if ( $gallery_images_array ) : ?>
	<div class="tm-sc-gallery tm-sc-gallery-masonry <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout masonry grid-<?php echo esc_attr( $columns );?> <?php echo esc_attr( $gutter );?> lightgallery-lightbox">
			<div class="isotope-layout-inner">
				<div class="isotope-item isotope-item-sizer"></div>

				<!-- the loop -->
				<?php foreach (  $gallery_images_array as $gallery_item ) { $settings['gallery_item'] = $gallery_item;?>
				<?php
					//masonry image sizes
					$image_size = '';
					if ( isset($gallery_item['image_size']) && !empty($gallery_item['image_size'])) {
						$settings['featured_image_size'] = $image_size = $gallery_item['image_size'];

						if($image_size == 'evolta_landscape') {
							$image_size = 'tm-masonry-large-wide';
						} else if($image_size == 'evolta_huge_square') {
							$image_size = 'tm-masonry-large-width-height';
						}
					} else {
						$settings['featured_image_size']  = $featured_image_size;
					}
				?>
				<!-- Isotope Item Start -->
				<div class="isotope-item <?php echo esc_attr( $image_size );?> elementor-repeater-item-<?php echo esc_attr( $gallery_item['_id'] );?>">
					<div class="isotope-item-inner">
						<?php elemental_addons_get_shortcode_template_part( 'each-item', $_skin, 'image-gallery/tpl', $settings, false ); ?>
					</div>
				</div>
				<!-- Isotope Item End -->
				<?php } ?>
				<!-- end of the loop -->
			</div>
		</div>
		<!-- End Isotope Gallery Grid -->
	</div>
<?php endif; ?>