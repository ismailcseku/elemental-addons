<?php $post_format = get_post_format(get_the_ID()) ? : 'standard'; $settings['settings'] = $settings; ?>
<div class="tm-sc-blog blog-vertical-list <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<article <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() && $show_featured_image == 'yes' ) : ?>
			<div class="entry-header">
				<?php evolta_get_post_thumbnail( $post_format, $featured_image_size ); ?>
			</div>
			<?php endif; ?>

			<div class="entry-content">
				<?php if ( $show_post_meta == 'yes' &&  $skin_vertical_list_post_meta_placement == 'top' ) : ?>
				<?php evolta_post_shortcode_meta( $post_meta_options, array( $show_post_meta_over_featured_image ) ); ?>
				<?php endif; ?>

				<?php if ( $show_title == 'yes' ) : ?>
				<?php the_title( '<'.esc_attr( $title_tag ).' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.esc_attr( $title_tag ).'>' ); ?>
				<?php endif; ?>

				<?php if ( $show_post_meta == 'yes' &&  $skin_vertical_list_post_meta_placement == 'center' ) : ?>
				<?php evolta_post_shortcode_meta( $post_meta_options, array( $show_post_meta_over_featured_image ) ); ?>
				<?php endif; ?>

				<?php if ( $show_excerpt == 'yes' ) : ?>
				<div class="post-excerpt">
					<?php if ( empty($excerpt_length) ) { ?>
					<?php evolta_get_excerpt(); ?>
					<?php } else { ?>
					<?php evolta_get_excerpt($excerpt_length); ?>
					<?php } ?>
				</div>
				<?php endif; ?>

				<?php if ( $show_view_details_button == 'yes' ) : ?>
				<?php \elemental_addons_get_cpt_shortcode_template_part( 'button', null, 'blog/tpl/post-format', $settings, false );?>
				<?php endif; ?>


				<?php if ( $show_post_meta == 'yes' &&  $skin_vertical_list_post_meta_placement == 'bottom' ) : ?>
				<?php evolta_post_shortcode_meta( $post_meta_options, array( $show_post_meta_over_featured_image ) ); ?>
				<?php endif; ?>

				<div class="clearfix"></div>
			</div>
		</article>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
</div>