<div class="btn-view-details">
    <a
      <?php if ( ! empty( $features_link['is_external'] ) ) : ?> target="_blank"<?php endif; ?>
      href="<?php echo esc_url( $features_link['url'] );?>"
      class="<?php echo esc_attr(implode(' ', $settings['btn_classes'])); ?>">
      <?php echo esc_html( $settings['view_details_button_text']  ); ?>
    </a>
</div>