<div class="blog-item-current-style1">
  <div class="image">
    <?php evolta_get_post_thumbnail_img( $post_format, $featured_image_size ); ?>
    <?php evolta_get_post_thumbnail_img( $post_format, $featured_image_size ); ?>
  </div>
  <div class="content">
    <?php if ( $show_post_meta == 'yes' ) : ?>
      <?php evolta_post_shortcode_meta( $post_meta_options, array( $show_post_meta_over_featured_image ) ); ?>
    <?php endif; ?>
    <?php if ( $show_title == 'yes' ) : ?>
      <?php the_title( '<'.esc_attr( $title_tag ).' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.esc_attr( $title_tag ).'>' ); ?>
    <?php endif; ?>
    <?php if ( $show_view_details_button == 'yes' ) : ?>
      <a href="<?php the_permalink();?>" class="read">
        <span class="arrow-left"><i class="flaticon-common-right-arrow"></i></span>
        <span class="btn-title"><?php echo esc_html( $view_details_button_text  ); ?></span>
        <span class="arrow-right"><i class="flaticon-common-right-arrow"></i></span>
      </a>
    <?php endif; ?>
  </div>
</div>