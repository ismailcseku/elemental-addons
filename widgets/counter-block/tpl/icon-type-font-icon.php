<?php if( isset( $icon_bg_img ) && !empty( $icon_bg_img ) ) { ?>
<?php $image = wp_get_attachment_image_src( $icon_bg_img['id'], 'full');?>
<div class="counter-icon">
<?php } else {?>
<div class="counter-icon">
<?php }?>
<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
</div>