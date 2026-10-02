
  <?php if( $add_bg_img_on_hover == 'yes' && isset( $bg_img_on_hover['id'] ) && !empty( $bg_img_on_hover['id'] ) ): ?>
  <?php $image = wp_get_attachment_image_src( $bg_img_on_hover['id'], 'full');?>
  <div class="bg-img-wrapper" style="background-image: url('<?php echo esc_url( $image[0] );?>')">
  </div>
  <?php endif; ?>