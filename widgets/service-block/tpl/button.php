<div class="btn-view-details">
    <a
      <?php if ( ! empty( $feature_link['is_external'] ) ) : ?> target="_blank"<?php endif; ?>
      href="<?php echo esc_url( $feature_link['url'] );?>" aria-label="Read More"
      class="<?php echo esc_attr(implode(' ', $settings['btn_classes'])); ?>">
      <?php echo esc_html( $settings['view_details_button_text']  ); ?>
    </a>
</div>