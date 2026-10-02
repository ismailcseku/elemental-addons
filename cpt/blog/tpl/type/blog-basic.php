<?php $settings['post_format'] = get_post_format(get_the_ID()) ? : 'standard'; $settings['settings'] = $settings; ?>
<?php if ( $the_query->have_posts() ) : ?>
	<div class="tm-sc-blog tm-sc-blog-basic <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
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
		<div class="<?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
		<?php
			echo \elemental_addons_shortcode_get_blog_post_format( get_post_format(), $settings );
		?>
		</div>
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>


<?php else : ?>
	<?php \elemental_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>