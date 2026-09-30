<?php $settings['settings'] = $settings;?>
  <div class="tm-sc-funfact <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
    <div class="funfact-inner">
      <div class="icon-wrapper">
        <?php if ( $show_icon_image == 'yes' ) : ?>
        <?php elemental_addons_get_widgetcore_template_part( 'icon-type', $icon_type, 'funfact-counter/tpl', $settings, false );?>
        <?php endif; ?>
      </div>

      <div class="details-wrapper">
        <div class="counter-wrapper">
            <?php if ( $show_counter == 'yes' ) : ?>
            <?php elemental_addons_get_widgetcore_template_part( 'counter', null, 'funfact-counter/tpl', $settings, false );?>
            <?php endif; ?>
        </div>

        <div class="title-wrapper">
          <?php if ( $show_title == 'yes' ) : ?>
            <?php elemental_addons_get_widgetcore_template_part( 'title', null, 'funfact-counter/tpl', $settings, false );?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>