<?php $settings['settings'] = $settings;?>
	<div class="tm-sc-funfact <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<div class="funfact-inner">
			<div class="element-left">
				<?php if ( $show_icon_image == 'yes' ) : ?>
				<?php elemental_addons_get_widgetcore_template_part( 'icon-type', $icon_type, 'funfact-counter/tpl', $settings, false );?>
				<?php endif; ?>
			</div>


			<div class="details">
				<?php if ( $counter_position == 'icon_counter_title' ) { ?>
					<?php if ( $show_counter == 'yes' ) : ?>
					<?php elemental_addons_get_widgetcore_template_part( 'counter', null, 'funfact-counter/tpl', $settings, false );?>
					<?php endif; ?>

					<?php if ( $show_title == 'yes' ) : ?>
					<?php elemental_addons_get_widgetcore_template_part( 'title', null, 'funfact-counter/tpl', $settings, false );?>
					<?php endif; ?>
				<?php } else { ?>
					<?php if ( $show_title == 'yes' ) : ?>
					<?php elemental_addons_get_widgetcore_template_part( 'title', null, 'funfact-counter/tpl', $settings, false );?>
					<?php endif; ?>

					<?php if ( $show_counter == 'yes' ) : ?>
					<?php elemental_addons_get_widgetcore_template_part( 'counter', null, 'funfact-counter/tpl', $settings, false );?>
					<?php endif; ?>
				<?php } ?>

				<?php if ( $show_paragraph == 'yes' ) : ?>
				<?php elemental_addons_get_widgetcore_template_part( 'content', null, 'funfact-counter/tpl', $settings, false );?>
				<?php endif; ?>
			</div>
		</div>
	</div>