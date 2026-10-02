<div class="btn-view-details post-btn-readmore <?php if(isset($button_alignment)) echo esc_attr( $button_alignment );?>">
    <a href="<?php the_permalink();?>"
      class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>">
      <?php echo esc_html( $view_details_button_text  ); ?>
    </a>
</div>