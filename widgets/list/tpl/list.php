<ul class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
<?php
//echo wp_kses( $content, 'post' );

foreach (  $list as $item ) {
	$feature_classes = array();
	if( $item['disable_feature'] == 'yes' ) {
		$feature_classes[] = 'no-action';
	}
	if( $item['line_through'] == 'yes' ) {
		$feature_classes[] = 'line-through';
	}
	?>
	<li class="<?php echo esc_attr(implode(' ', $feature_classes)); ?>">
		<?php if( isset($item['list_icon_individual']['value']) && !empty($item['list_icon_individual']['value']) ) { ?>
		<?php \Elementor\Icons_Manager::render_icon( $item['list_icon_individual'], [ 'aria-hidden' => 'true' ] ); ?>
		<?php }else{ ?>
		<?php \Elementor\Icons_Manager::render_icon( $list_icon, [ 'aria-hidden' => 'true' ] ); ?>
		<?php } ?>
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
	echo "</span></li>";
}
?>
</ul>