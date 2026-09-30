<div class="tm-sc-progress-bar <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>" data-percent="<?php echo esc_attr( $percentage_value );?>" data-unit-left="<?php echo esc_attr( $unit_symbol_left );?>" data-unit-right="<?php echo esc_attr( $unit_symbol_right );?>">
	<div class="progress-title-holder">
		<<?php echo esc_attr( $title_tag );?> class="pb-title"><?php echo esc_html( $title );?></<?php echo esc_attr( $title_tag );?>>
	</div>
	<div class="progress-holder">
		<div class="progress-content"><span class="symbol-left"><?php echo esc_attr( $unit_symbol_left );?></span><span class="value"><?php echo esc_attr( $percentage_value );?></span><span class="symbol-right"><?php echo esc_attr( $unit_symbol_right );?></span></div>
	</div>
</div>