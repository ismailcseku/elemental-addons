	<<?php echo esc_attr( $title_tag );?> class="title <?php echo esc_attr(implode(' ', $title_classes)); ?>" <?php echo $title_mouse_helper?><?php if( isset($enable_gsap_text_reveal) && $enable_gsap_text_reveal == 'yes' && isset($gsap_text_reveal_opacity) && !empty($gsap_text_reveal_opacity['size']) ) { ?> data-reveal-opacity="<?php echo esc_attr( $gsap_text_reveal_opacity['size'] ); ?>"<?php } ?><?php if( isset($enable_gsap_text_reveal) && $enable_gsap_text_reveal == 'yes' && isset($gsap_text_reveal_x) && !empty($gsap_text_reveal_x['size']) ) { ?> data-reveal-x="<?php echo esc_attr( $gsap_text_reveal_x['size'] ); ?>"<?php } ?>>

		<?php if ( $title_shadow_text ) { ?>
		<span class="title-shadow-text <?php echo esc_attr(implode(' ', $title_shadow_text_class)); ?>"><?php echo esc_html( $title_shadow_text );?></span>
		<?php } ?>

		<?php if ( $title_text ) { ?>
		<span class="title-part1 <?php echo esc_attr(implode(' ', $title_part1_classes)); ?>"><?php echo wp_kses_post( $title_text ); ?></span>
		<?php } ?>

		<?php if ( $enable_typed_text_effect == "yes" ) { ?>
			<?php
				$title_parts = array();
				foreach (  $title_list as $item ) {
					$title_parts[] = $item['title_other_text'];
				}
				?>
				<span class="tm-typed-text-animation-wrapper">
					<span id="typed-text-animation-<?php echo esc_attr($holder_id);?>" class="tm-typed-text-animation"
						data-typed-strings="<?php echo esc_attr(json_encode($title_parts)); ?>"
						data-loop="<?php echo esc_attr( !empty($typed_loop) ? 1 : 0 ); ?>"
						data-cursor="<?php echo esc_attr( !isset($typed_cursor) || !empty($typed_cursor) ? 1 : 0 ); ?>"
						data-cursor-char="<?php echo esc_attr( !empty($typed_cursor_char) ? $typed_cursor_char : '|' ); ?>"
						data-speed="<?php echo esc_attr( !empty($typed_speed['size']) ? $typed_speed['size'] : 6 ); ?>"
						data-delay="<?php echo esc_attr( !empty($typed_delay['size']) ? $typed_delay['size'] : 1 ); ?>"
					><?php echo esc_html( $title_parts[0] );?></span>
				</span>

		<?php } else { ?>
			<?php
			foreach (  $title_list as $item ) {
				$title_part_classes = array();
				$title_part_classes[] = 'elementor-repeater-item-' . esc_attr( $item['_id'] );
				if( $item['title_other_slide_animation'] == 'yes' ) {
					$title_part_classes[] = 'tm-onappear-slide-animation';
				}
				?>



				<?php

				if( isset( $item['cursor_mouseover_image']['id'] ) && !empty( $item['cursor_mouseover_image']['id'] ) ) {
				$img = '<img src="' . esc_url( $item['cursor_mouseover_image']['url'] ) . '" alt="">';

				?>
				<a href="<?php if( $item['link_url'] ) { echo esc_url( $item['link_url'] ); } ?>" class="tm-floating-cursor-image-item" data-cursor-image="<?php echo esc_attr( $img );?>">
					<span class="<?php echo esc_attr(implode(' ', $title_part_classes)); ?>"><?php echo esc_html( $item['title_other_text'] );?></span>
				</a>
				<?php } else if( $item['link_url'] ) { ?>
				<a href="<?php echo esc_url( $item['link_url'] ) ?>">';
					<span class="<?php echo esc_attr(implode(' ', $title_part_classes)); ?>"><?php echo esc_html( $item['title_other_text'] );?></span>
				</a>
				<?php } else { ?>
				<span class="<?php echo esc_attr(implode(' ', $title_part_classes)); ?>"><?php echo esc_html( $item['title_other_text'] );?></span>
				<?php } ?>
			<?php } ?>
		<?php } ?>

	</<?php echo esc_attr( $title_tag );?>>
	<div class="title-seperator-line"></div>