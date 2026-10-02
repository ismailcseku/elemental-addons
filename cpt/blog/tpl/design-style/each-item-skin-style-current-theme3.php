<!-- News Block -->
<div class="blog-item-current-style3">
  <div class="inner-box">
    <div class="entry-header">
      <div class="image">
        <?php evolta_get_post_thumbnail_img( $post_format, $featured_image_size ); ?>
        <?php evolta_get_post_thumbnail_img( $post_format, $featured_image_size ); ?>
      </div>

      <?php if ( $show_post_meta == 'yes' ) : ?>
        <?php
          $post_meta_options_array = explode(',', $post_meta_options);
          if ( in_array( $show_post_meta_over_featured_image, $post_meta_options_array ) ) {
            ?>
            <div class="post-single-meta">
              <?php evolta_post_shortcode_single_meta( $show_post_meta_over_featured_image ); ?>
            </div>
            <?php
          }
        ?>
		  <?php endif; ?>
    </div>
    <div class="entry-content">
      <?php if ( $show_post_meta == 'yes' ) : ?>
        <?php evolta_post_shortcode_meta( $post_meta_options, array( $show_post_meta_over_featured_image ) ); ?>
      <?php endif; ?>

      <?php if ( $show_title == 'yes' ) : ?>
        <?php the_title( '<'.esc_attr( $title_tag ).' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></'.esc_attr( $title_tag ).'>' ); ?>
      <?php endif; ?>

      <?php if ( $show_view_details_button == 'yes' ) : ?>
        <a href="<?php the_permalink();?>" class="theme-btn-main">
          <span class="theme-btn-arrow-left"> <i class="lnr-icon-arrow-right1"></i></span>
          <span class="btn-title"><?php echo esc_html( $view_details_button_text  ); ?></span>
          <span class="theme-btn-arrow-right"><i class="lnr-icon-arrow-right1"></i></span>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>