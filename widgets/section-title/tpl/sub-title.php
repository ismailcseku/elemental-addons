

<div class="sub-title-outer">
	<?php if ( $sub_title_text ) { ?>
	<<?php echo esc_attr( $subtitle_tag );?> class="subtitle <?php echo esc_attr(implode(' ', $sub_title_classes)); ?>">
	<?php if( $show_title_icon == 'yes' && $title_icon_position == 'icon-top'  && isset( $title_icon ) && !empty( $title_icon ) ): ?>
		<?php include('title-icon.php');?>
	<?php endif; ?>

		<?php if( $show_title_icon == 'yes' && $title_icon_position == 'icon-left'  && isset( $title_icon ) && !empty( $title_icon ) ): ?>
		<?php include('title-icon.php');?>
		<?php endif; ?>

		<?php echo ( $sub_title_text );?>
	</<?php echo esc_attr( $subtitle_tag );?>>
	<?php } ?>
</div>