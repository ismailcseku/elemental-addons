
		<?php if ( $show_title == 'yes' ) : ?>
		<?php the_title( '<'.esc_attr( $title_tag ).' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.esc_attr( $title_tag ).'>' ); ?>
		<?php endif; ?>

		<?php if ( $show_post_meta == 'yes' ) : ?>
		<?php evolta_post_shortcode_meta( $post_meta_options ); ?>
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

		<div class="clearfix"></div>