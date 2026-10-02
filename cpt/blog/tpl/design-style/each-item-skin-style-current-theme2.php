<!-- News Block -->
<div class="blog-item-current-style2">
	<div class="thumb">
		<?php evolta_get_post_thumbnail_img( $post_format, $featured_image_size ); ?>
		<?php evolta_get_post_thumbnail_img( $post_format, $featured_image_size ); ?>
	</div>
	<div class="content">
		<?php
		$categories = get_the_category();
		if ( !empty( $categories ) ) {
			$category = $categories[0];
			$category_link = get_category_link( $category->term_id );
			?>
			<a href="<?php echo esc_url( $category_link ); ?>" class="tag"><?php echo esc_html( $category->name ); ?></a>
			<?php
		}
		?>
		<?php if ( $show_title == 'yes' ) : ?>
			<?php the_title( '<'.esc_attr( $title_tag ).' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.esc_attr( $title_tag ).'>' ); ?>
		<?php endif; ?>
		<?php if ( $show_excerpt == 'yes' ) : ?>
				<?php if ( empty($excerpt_length) ) { ?>
					<?php evolta_get_excerpt(); ?>
				<?php } else { ?>
					<?php evolta_get_excerpt($excerpt_length); ?>
				<?php } ?>
		<?php endif; ?>
		<?php if ( $show_view_details_button == 'yes' ) : ?>
			<a href="<?php the_permalink();?>" class="link-btn">
				<?php echo esc_html( $view_details_button_text ); ?> <i class="fa fa-arrow-right"></i>
			</a>
		<?php endif; ?>
	</div>
</div>