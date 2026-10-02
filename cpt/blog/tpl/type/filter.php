
	<?php if ( $show_cat_filter == 'yes' ) : ?>
	<?php
		$portfolio_filters = array();
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			//Returns All Term Items for $ptTaxKey
			$term_list = wp_get_post_terms(get_the_ID(), 'category', array("fields" => "all"));
			if ( !empty ( $term_list) && !is_wp_error( $term_list ) ) {
				foreach($term_list as $term) {
					$portfolio_filters[$term->slug] = $term->name;
				}
			}
		endwhile;
		wp_reset_postdata();
		$portfolio_filters = array_unique($portfolio_filters);
	?>
	<!-- Isotope Filter -->
	<div class="isotope-layout-filter <?php echo esc_attr( $cat_filter_style );?>" data-link-with="<?php echo esc_attr( $holder_id ) ?>">
		<a href="#" class="active" data-filter="*"><?php echo esc_html__( 'All', 'elemental-addons') ?></a>
		<?php if ( !empty($portfolio_filters) ) { foreach ( $portfolio_filters as $slug=>$name ) { ?>
		<a href="#<?php echo esc_attr( $slug );?>" class="" data-filter=".<?php echo esc_attr( $slug );?>"><?php echo esc_html( $name );?></a>
		<?php } } ?>
	</div>
	<!-- End Isotope Filter -->
	<?php endif; ?>