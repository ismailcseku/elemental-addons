<<?php echo esc_attr( $counter_tag );?> class="counter <?php echo esc_attr(implode(' ', $counter_classes)); ?>">
	<?php if(!empty($counter_prefix)): ?><span class="counter-prefix"><?php echo esc_html($counter_prefix); ?></span><?php endif; ?><span class="animate-number" data-value="<?php echo esc_attr( $counter_range );?>" <?php echo html_entity_decode( esc_attr( $animation_duration ) );?>>0</span><?php if(!empty($counter_postfix)): ?><span class="counter-postfix"><?php echo esc_html($counter_postfix); ?></span><?php endif; ?>
</<?php echo esc_attr( $counter_tag );?>>
