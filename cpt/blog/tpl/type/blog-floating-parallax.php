<?php $settings['post_format'] = get_post_format(get_the_ID()) ? : 'standard'; $settings['settings'] = $settings; ?>
<?php if ( $the_query->have_posts() ) : ?>
	<?php wp_enqueue_script( 'jquery-parallax-scroll' ); ?>
	<div class="tm-sc-blog tm-sc-blog-floating-parallax <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<?php include('filter.php'); ?>

		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout masonry grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
				<div class="isotope-item isotope-item-sizer"></div>

				<!-- the loop -->
				<?php $iter = 1; while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php include('filter-term-list-each-post.php'); ?>
				<div class="isotope-item floating-posts-holder <?php $floating_class = ( $iter++ % 2 == 0 ) ? 'floating-item-even' : 'floating-posts-odd';  echo esc_attr( $floating_class );?> <?php echo esc_attr( $term_slugs_list_string );?>">
					<div class="isotope-item-inner tm-smooth-parallax-scroll" data-parallax='{"y": -<?php echo esc_attr( rand(50, 160) );?>, "smoothness": 20}'>
						<?php echo \elemental_addons_shortcode_get_blog_post_format( get_post_format(), $settings ); ?>
					</div>
				</div>
				<?php endwhile; ?>
				<!-- end of the loop -->
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>


<?php else : ?>
	<?php \elemental_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>