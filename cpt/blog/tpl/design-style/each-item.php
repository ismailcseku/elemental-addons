<!-- News Block Style1 -->
<div class="blog-item-current-style1">
    <?php if ( $show_featured_image == 'yes' ) : ?>
      <div class="entry-header">
        <?php evolta_get_post_thumbnail( $post_format, $featured_image_size ); ?>
        <?php evolta_post_category();?>
      </div>
    <?php endif; ?>
    <div class="entry-content">

      <?php if ( $show_post_meta == 'yes' ) : ?>
        <?php evolta_post_shortcode_meta( $post_meta_options, array( $show_post_meta_over_featured_image ) ); ?>
      <?php endif; ?>
      <?php if ( $show_title == 'yes' ) : ?>
        <div class="title-holder">
          <?php the_title( '<'.esc_attr( $title_tag ).' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.esc_attr( $title_tag ).'>' ); ?>
        </div>
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

    </div>
  <div class="clearfix"></div>
</div>