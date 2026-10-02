<?php $settings['settings'] = $settings;?>

<div class="tm-sc-pricing-plan <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> pricing-plan-skin-style3">
  <div class="inner-block">
    <div class="price-head">
      <div class="title-box">
				<?php if ( $title ) { ?>
					<div class="pricing-plan-title-area">
						<?php \elemental_addons_get_shortcode_template_part( 'title', null, 'pricing-plan/tpl', $settings, false );?>
					</div>
				<?php } ?>
				<?php if ( $sub_title ) { ?>
					<?php \elemental_addons_get_shortcode_template_part( 'subtitle', null, 'pricing-plan/tpl', $settings, false );?>
				<?php } ?>
      </div>

				<?php \elemental_addons_get_shortcode_template_part( 'pricing', null, 'pricing-plan/tpl', $settings, false );?>
				<?php if ( $show_view_details_button == 'yes' ) : ?>
					<div class="btn-box">
						<a href="<?php echo esc_url( $button['url'] ); ?>" class="btn-style2">
							<span class="theme-btn-arrow-left"><i class=" flaticon-common-arrow-right1"></i></span>
							<span class="theme-btn"><?php echo esc_html( $view_details_button_text  ); ?></span>
							<span class="theme-btn-arrow-right"><i class=" flaticon-common-arrow-right1"></i></span>
						</a>
					</div>
				<?php endif; ?>
    </div>
			<?php \elemental_addons_get_shortcode_template_part( 'content', null, 'pricing-plan/tpl', $settings, false );?>
    <div class="image">
			<?php \elemental_addons_get_shortcode_template_part( 'thumb', $icon_type, 'pricing-plan/tpl', $settings, false );?>
			<?php \elemental_addons_get_shortcode_template_part( 'thumb', $icon_type, 'pricing-plan/tpl', $settings, false );?>
    </div>
  </div>
</div>