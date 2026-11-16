<?php $features_item['settings'] = $settings;
$features_item['title_tag'] = $title_tag;
$features_item['subtitle_tag'] = $subtitle_tag;
$features_link = $features_item['features_link'];
$target = ( $features_link && $features_link['is_external'] ) ? ' target="_blank"' : '';
$url = ( $features_link && $features_link['url'] ) ? $features_link['url'] : '';
?>

<div class="features-block-style18">
    <div class="icon">
        <?php elemental_addons_get_shortcode_template_part( 'icon-type', $features_item['icon_type'], 'features-block/tpl', $features_item, false );?>
    </div>
    <div class="content">
        <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'features-block/tpl', $features_item, false );?>
        <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'features-block/tpl', $features_item, false );?>
        <?php if ( $show_view_details_button == 'yes' ) : ?>
        <a href="<?php echo esc_url( $url );?>" class="link-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="68" viewBox="0 0 34 68" fill="none">
                <g clip-path="url(#clip0_1_1837)">
                <path d="M32.4322 35.3862H-32.4293C-33.2009 35.3862 -33.8242 34.7629 -33.8242 33.9913C-33.8242 33.2198 -33.2009 32.5964 -32.4293 32.5964H29.0627L20.5976 24.1313C20.0527 23.5864 20.0527 22.7016 20.5976 22.1567C21.1425 21.6118 22.0273 21.6118 22.5722 22.1567L33.4217 33.0062C33.8227 33.4072 33.9404 34.0044 33.7225 34.5275C33.5045 35.0462 32.9945 35.3862 32.4322 35.3862Z" fill="white"/>
                <path d="M21.5696 46.2479C21.2121 46.2479 20.8547 46.1127 20.5844 45.8381C20.0396 45.2932 20.0396 44.4084 20.5844 43.8635L31.447 33.0009C31.9919 32.4561 32.8767 32.4561 33.4216 33.0009C33.9665 33.5458 33.9665 34.4307 33.4216 34.9756L22.5591 45.8381C22.2844 46.1127 21.927 46.2479 21.5696 46.2479Z" fill="white"/>
                </g>
                <defs>
                <clipPath id="clip0_1_18373">
                    <rect width="34" height="68" fill="white"/>
                </clipPath>
                </defs>
            </svg>
        </a>
      <?php endif; ?>
    </div>
</div>