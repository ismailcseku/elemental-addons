<!-- Service Block Style1-->
<?php
$service_item['settings'] = $settings;
$service_item['title_tag'] = $title_tag;
$service_item['subtitle_tag'] = $subtitle_tag;
$count = $service_item['count'];
$title = $service_item['title'];
$first_letter_title = substr($title, 0, 1);
?>

<div class="service-block-style9">
  <div class="inner-box">
    <div class="image">
      <?php elemental_addons_get_shortcode_template_part( 'part-featured-image', null, 'service-block/tpl', $service_item, false );?>
      <span class="icon"><?php echo $first_letter_title; ?></span>
    </div>
    <?php elemental_addons_get_shortcode_template_part( 'part-title', null, 'service-block/tpl', $service_item, false );?>
    <?php elemental_addons_get_shortcode_template_part( 'part-content', null, 'service-block/tpl', $service_item, false );?>
  </div>
</div>