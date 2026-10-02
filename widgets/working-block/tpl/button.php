<div class="btn-view-details <?php if( isset($settings['button_alignment']) & !empty($settings['button_alignment']) ) echo esc_attr( $settings['button_alignment'] );?>">
    <a
      <?php if ( ! empty( $working_block_link['is_external'] ) ) : ?> target="_blank"<?php endif; ?>
      href="<?php echo esc_url( $working_block_link['url'] );?>"
      class="<?php echo esc_attr(implode(' ', $settings['btn_classes'])); ?>">
      <?php echo esc_html( $settings['view_details_button_text']  ); ?>
    </a>
</div>