<div class="btn-view-details <?php if(isset($button_alignment)) echo esc_attr( $button_alignment );?>">
    <a  
      <?php echo esc_attr($target);?>
      href="<?php echo esc_url( $url );?>"
      class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>">
      <?php echo esc_html( $view_details_button_text  ); ?>
    </a>
</div>