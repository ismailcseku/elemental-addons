<?php if ( $gallery_images_array ) : ?>
	<div class="tm-sc-gallery tm-sc-gallery-grid <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout grid-<?php echo esc_attr( $columns );?> <?php echo esc_attr( $gutter );?> lightgallery-lightbox">
			<div class="isotope-layout-inner">

				<!-- the loop -->
				<?php foreach (  $gallery_images_array as $gallery_item ) { $settings['gallery_item'] = $gallery_item;?>
				<!-- Isotope Item Start -->
				<div class="isotope-item">
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