<!-- Service Block Two -->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
?>

<div class="service-block-style37">
    <div class="inner-box">
    <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
        <div class="content-box">
        <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'service-block/tpl', $service_item, false );?>
            <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
        </div>

        <?php if ( $show_view_details_button == 'yes' ) : ?>
          <?php elemental_addons_get_shortcode_template_part( 'button', null, 'service-block/tpl', $service_item, false ); ?>
        <?php endif; ?>
        
        <div class="hover-content">
        <?php elemental_addons_get_shortcode_template_part( 'part-subtitle', null, 'service-block/tpl', $service_item, false );?>
            <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
        </div>
    </div>
</div>