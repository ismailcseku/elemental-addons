
	<?php if( isset($icon_type) && $icon_type != "no-icon" ) { ?>
	<div class="icon-wrapper">
		<div class="icon <?php echo esc_attr(implode(' ', $icon_classes)); ?>">
			<?php \elemental_addons_get_widgetcore_template_part( 'icon-type', $icon_type, 'icon-box/tpl', $settings, false );?>
		</div>

		<?php if( isset( $show_icon_bg_img ) && $show_icon_bg_img == 'yes' ) { ?>
			<div class="icon-bg-img">
				<?php $image = wp_get_attachment_image_src( $icon_bg_img['id'], 'full');?>
  				<?php if( isset( $icon_bg_img['id'] ) && !empty( $icon_bg_img['id'] ) ) { ?>
					<img src="<?php echo esc_url( $image[0] );?>">
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<?php } ?>