<?php
namespace ElementalAddons\Widgets\Accordion\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Accordion_Basic extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/tm-ele-accordion/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-basic';
	}


	public function get_title() {
		return __( 'Skin Basic', 'elemental-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		$html = '';
		$settings = $this->parent->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = 'tm-accordion';
		if( $settings['icon_round_border'] === 'yes' ) {
			$classes[] = 'icon-round-border';
		}
		$classes[] = $settings['_skin'];
		$settings['classes'] = $classes;

		$settings['holder_id'] = \elemental_addons_get_isotope_holder_ID('accordion');
	?>
		<div id="<?php echo esc_attr( $settings['holder_id'] ) ?>" class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<?php
		if ( $settings['accordion_items'] ) {
			$rand = rand(10,100);
			$i=1;
			foreach (  $settings['accordion_items'] as $item ) {
				$item['rand'] = $rand.''.$i;
				$item['holder_id'] = $settings['holder_id'];
				$item['selected_icon'] = $settings['selected_icon'];
				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
				$html .= elemental_addons_get_widgetcore_template_part( $settings['display_type'], null, 'accordion/tpl', $item, true );
				$i++;
			}
		}
		\elemental_addons_print_html( $html );
	?>
		</div>
	<?php
	}
}
