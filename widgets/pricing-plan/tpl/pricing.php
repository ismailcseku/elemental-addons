<div class="pricing-plan-pricing">
	<div class="price price-normal <?php if ( $on_sale == 'yes' ) echo esc_attr("on-sale"); ?>">
		<?php if(!empty($price_prefix)): ?><span class="pricing-plan-prefix"><?php echo esc_html($price_prefix); ?></span><?php endif; ?>
		<?php if(!empty($price)): ?><span class="pricing-plan-price"><?php echo esc_html($price); ?></span><?php endif; ?>
		<?php if ( $on_sale == 'yes' ) : ?>
		<?php if(!empty($price_sale)): ?><span class="pricing-plan-price-sale"><?php echo esc_html($price_sale); ?></span><?php endif; ?>
		<?php endif; ?>
		<?php if(!empty($price_separator)): ?><span class="pricing-plan-separator"><?php echo esc_html($price_separator); ?></span><?php endif; ?>
		<?php if(!empty($price_postfix)): ?><span class="pricing-plan-postfix"><?php echo esc_html($price_postfix); ?></span><?php endif; ?>
	</div>

	<?php if(!empty($price_secondary)) { ?>
	<div class="price price-secondary <?php if ( $on_sale_secondary == 'yes' ) echo esc_attr("on-sale"); ?>">
		<?php if(!empty($price_prefix_secondary)): ?><span class="pricing-plan-prefix"><?php echo esc_html($price_prefix_secondary); ?></span><?php endif; ?>
		<span class="pricing-plan-price"><?php echo esc_html($price_secondary); ?></span>
		<?php if ( $on_sale_secondary == 'yes' ) : ?>
		<?php if(!empty($price_sale_secondary)): ?><span class="pricing-plan-price-sale"><?php echo esc_html($price_sale_secondary); ?></span><?php endif; ?>
		<?php endif; ?>
		<?php if(!empty($price_separator_secondary)): ?><span class="pricing-plan-separator"><?php echo esc_html($price_separator_secondary); ?></span><?php endif; ?>
		<?php if(!empty($price_postfix_secondary)): ?><span class="pricing-plan-postfix"><?php echo esc_html($price_postfix_secondary); ?></span><?php endif; ?>
	</div>
	<?php } ?>
</div>