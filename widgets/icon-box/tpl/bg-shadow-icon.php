
	<?php if ( $show_bg_shadow_icon == 'yes' ) : ?>
		<div class="bg-shadow-icon">
		<?php if( isset($icon_type) ) { ?>
			<?php \elemental_addons_get_widgetcore_template_part( 'icon-type', $icon_type, 'icon-box/tpl', $settings, false );?>
		<?php } ?>
		</div>
	<?php endif; ?>