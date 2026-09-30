<?php
use Elementor\Controls_Manager;

if(!function_exists('elemental_addons_get_cpt_shortcode_template_part')) {
	/**
	 * Load a cpt shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function elemental_addons_get_cpt_shortcode_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start = false ) {

		$template_path = 'cpt/' . $folder . '/' . $slug;

		return elemental_addons_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('elemental_addons_get_shortcode_template_part')) {
	/**
	 * Load a shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function elemental_addons_get_shortcode_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start = false ) {

		$template_path = 'widgets/' . $folder . '/' . $slug;

		return elemental_addons_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('elemental_addons_get_widgetcore_template_part')) {
	/**
	 * Load a shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function elemental_addons_get_widgetcore_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start = false ) {

		$template_path = 'widgets/' . $folder . '/' . $slug;

		return elemental_addons_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('elemental_addons_get_shortcode_shop_template_part')) {
	/**
	 * Load a shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function elemental_addons_get_shortcode_shop_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start = false ) {

		$template_path = 'widgets-shop/' . $folder . '/' . $slug;

		return elemental_addons_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}



if(!function_exists('elemental_addons_get_template_part')) {
	/**
	 * Load a template part into a template
	 *
	 * @param string $template_path path of the specialised template.
	 * @param string $name The name of the specialised template.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function elemental_addons_get_template_part( $template_path, $name = null, $params = array(), $shortcode_ob_start = false ) {

		$output_html = '';

		if( is_array($params) && count($params) ) {
			extract($params);
		}

		$templates = array();
		$name = (string) $name;
		if ( '' !== $name )
			$templates[] = "{$template_path}-{$name}.php";

		$templates[] = "{$template_path}.php";

		$located = elemental_addons_locate_template($templates);

		if($located) {
			if( $shortcode_ob_start ) {
				ob_start();
				include($located);
				$output_html = ob_get_clean();
			} else {
				include($located);
			}
		}

		return $output_html;
	}
}

if(!function_exists('elemental_addons_locate_template')) {
	/**
	 * Retrieve the name of the highest priority template file that exists.
	 *
	 * Searches in the MASCOT_STYLESHEET_DIR before MASCOT_TEMPLATE_DIR
	 * so that themes which inherit from a parent theme can just overload one file.
	 *
	 * @param string|array $template_names Template file(s) to search for, in order.
	 * @return string The template filename if one is located.
	 */
	function elemental_addons_locate_template($template_names) {
		$located = '';
		foreach ( (array) $template_names as $template_name ) {
			if ( !$template_name ) {
				continue;
			}
			if ( file_exists(ELEMENTAL_ADDONS_ABS_PATH . $template_name)) {
				$located = ELEMENTAL_ADDONS_ABS_PATH . $template_name;
				break;
			}
		}
		return $located;
	}
}



if (!function_exists('elemental_addons_shortcode_get_blog_post_format')) {
  /**
   * Return Shortcode Blog Post Format HTML
   */
  function elemental_addons_shortcode_get_blog_post_format( $post_format = '', $params = array() ) {

    $format = $post_format ? : 'standard';
    $params['post_format'] = $format;

    //Produce HTML version by using the parameters (filename, variation, folder name, parameters)
    $html = elemental_addons_get_cpt_shortcode_template_part( 'post-format', $format, 'blog/tpl/post-format', $params, true );
    return $html;
  }
}

if ( ! function_exists( 'elemental_addons_is_elementor_pro_activated' ) ) {
    function elemental_addons_is_elementor_pro_activated() {
        return function_exists( 'elementor_pro_load_plugin' ) ? true : false;
    }
}

if ( ! function_exists( 'elemental_addons_elementor_grid_responsive_columns' ) ) {
    function elemental_addons_elementor_grid_responsive_columns( $control_object ) {
			$control_object->add_responsive_control(
				'responsive_columns', [
					'label' => esc_html__( "Responsive Columns Layout", 'elemental-addons' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'100'  	=>  '1',
						'49.98' =>  '2',
						'33.2'  =>  '3',
						'24.98' =>  '4',
						'19.98' =>  '5',
						'14.2'  =>  '6',
					],
					'condition' => [
						'display_type!' => array('carousel')
					],
					'selectors' => [
						'{{WRAPPER}} .isotope-layout .isotope-item' => 'width: {{VALUE}}% !important;'
					]
				]
			);
    }
}


if(!function_exists('elemental_addons_get_redux_option')) {
	/**
	 * Retuns Redux Theme Option
	 */
	function elemental_addons_get_redux_option( $id, $fallback = false, $param = false ) {
		global $evolta_redux_theme_opt;

		if ( $fallback == false ) $fallback = '';

		$output = ( isset( $evolta_redux_theme_opt[$id] ) && $evolta_redux_theme_opt[$id] !== '' ) ? $evolta_redux_theme_opt[$id] : $fallback;

		if ( !empty( $evolta_redux_theme_opt[$id] ) && $param ) {
			$output = $evolta_redux_theme_opt[$id][$param];
		}
		return $output;
	}
}
