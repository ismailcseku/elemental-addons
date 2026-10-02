
<?php if(!empty($features_list_title)): ?><h5 class="features-list-title"><?php echo esc_html($features_list_title); ?></h5><?php endif; ?>
<ul class="features-list list-unstyled">
<?php
//echo wp_kses( $content, 'post' );

foreach (  $settings['features_list'] as $item ) {
	$feature_classes = array();
	if( $item['disable_item'] == 'yes' ) {
		$feature_classes[] = 'no-action';
	}
	if( $item['line_through'] == 'yes' ) {
		$feature_classes[] = 'line-through';
	}
	?>
	<li class="<?php echo esc_attr(implode(' ', $feature_classes)); ?>">
		<?php

			if( $item['disable_item'] == 'yes' ) {
				\Elementor\Icons_Manager::render_icon( $settings['features_list_noaction_icon'], [ 'aria-hidden' => 'true', 'class' => 'icon' ] );
			} else if( $item['line_through'] == 'yes' ) {
				\Elementor\Icons_Manager::render_icon( $settings['features_list_line_through_icon'], [ 'aria-hidden' => 'true', 'class' => 'icon' ] );
			} else {
				\Elementor\Icons_Manager::render_icon( $settings['features_list_icon'], [ 'aria-hidden' => 'true', 'class' => 'icon' ] );
			}
		?>
		<span>
		<?php
			echo wp_kses(
				$item['content'],
				array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
					'br' => array(),
					'em' => array(),
					'strong' => array(),
				)
			);
		?>
		</span>
		<div class="has-tooltip" data-toggle="tooltip" title="<?php echo esc_attr($item['tooltip_text']); ?>"><i class="fas fa-info-circle tooltip-icon"></i></div>
	</li>
<?php } ?>
</ul>