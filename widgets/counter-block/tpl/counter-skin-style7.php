<!-- Counter block six -->
<?php $settings['settings'] = $settings;?>
<?php
$animation = "";
$animation_delay = "";
if(isset($wow_appear_animation) && !empty($wow_appear_animation)) {
	$animation = $wow_appear_animation;
}
if(isset($wow_animation_delay) && !empty($wow_animation_delay)) {
	$animation_delay = $wow_animation_delay . 'ms';
}
?>
<div class="counter-block-seven mascot-counter <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
	<div class="inner">
		<div class="content">
			<i class="icon lnr-icon-plus"></i>
			<div class="count-box">
				<?php if ( $show_counter == 'yes' ): ?>
					<?php elemental_addons_get_shortcode_template_part( 'counter', null, 'counter-block/tpl', $settings, false );?>
				<?php endif;?>
			</div>
			<?php if ( $show_title == 'yes' ): ?>
				<?php elemental_addons_get_shortcode_template_part( 'title', null, 'counter-block/tpl', $settings, false );?>
			<?php endif;?>
		</div>
	</div>
</div>