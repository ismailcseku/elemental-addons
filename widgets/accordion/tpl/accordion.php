
  <div class="card <?php if($expand == 'yes') { echo esc_html( 'active' ); }?>">
    <div class="card-header p-0" id="heading<?php echo esc_attr($rand); ?>">
      <<?php echo esc_attr( $title_tag ); ?> class="title <?php if($expand !== 'yes') { echo esc_html( 'collapsed' ); }?>" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo esc_attr($rand); ?>" aria-expanded="<?php if($expand === 'yes') { echo esc_attr( 'true' ); } else echo esc_attr( 'false' );?>" aria-controls="collapse<?php echo esc_attr($rand); ?>">
        <span class="text"><?php echo esc_html( $title ); ?></span>
        <span class="accordion-controls-icon"><?php \Elementor\Icons_Manager::render_icon( $selected_icon ); ?></span>
      </<?php echo esc_attr( $title_tag ); ?>>
    </div>
    <div id="collapse<?php echo esc_attr($rand); ?>" class="collapse <?php if($expand === 'yes') { echo esc_attr( 'show' ); }?>" aria-labelledby="heading<?php echo esc_attr($rand); ?>" data-bs-parent="#<?php echo esc_attr($holder_id); ?>">
      <div class="card-body">
        <?php echo do_shortcode($content); ?>
      </div>
    </div>
  </div>
