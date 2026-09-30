<?php
    $social_links = array();
    if(isset($facebook) && !empty($facebook)) {
        $social_links['facebook'] = $facebook;
    }
    if(isset($twitter) && !empty($twitter)) {
        $social_links['twitter'] = $twitter;
    }
    if(isset($instagram) && !empty($instagram)) {
        $social_links['instagram'] = $instagram;
    }
    if(isset($linkedin) && !empty($linkedin)) {
        $social_links['linkedin'] = $linkedin;
    }
    if(isset($github) && !empty($github)) {
        $social_links['github'] = $github;
    }
    if(isset($youtube) && !empty($youtube)) {
        $social_links['youtube'] = $youtube;
    }
?>

<?php
    if( $settings['show_social_links'] == 'yes' && is_array($social_links) && !empty($social_links) ) {
?>


<div class="social-links">

    <?php
        foreach( $social_links as $key => $value ) {
    ?>
    <a aria-label="<?php echo esc_attr($key);?>" href="<?php echo esc_url($value);?>"><i class="fab fa-<?php echo esc_attr($key);?>"></i></a>
    <?php
        }
    ?>

</div>

<?php
    }
?>