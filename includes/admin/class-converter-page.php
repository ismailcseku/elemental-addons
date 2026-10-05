<?php
/**
 * Admin UI: Evolta → Elemental layout converter.
 *
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Elemental_Addons_Converter_Page' ) ) {

	class Elemental_Addons_Converter_Page {

		const SLUG = 'elemental-addons-converter';

		public static function init() {
			add_action( 'admin_menu', array( __CLASS__, 'register_menu' ) );
			add_action( 'admin_post_elemental_addons_convert_layout', array( __CLASS__, 'handle_convert' ) );
		}

		public static function register_menu() {
			add_submenu_page(
				Elemental_Addons_Admin::MENU_SLUG,
				__( 'Layout Converter', 'elemental-addons' ),
				__( 'Layout Converter', 'elemental-addons' ),
				'manage_options',
				self::SLUG,
				array( __CLASS__, 'render_page' )
			);
		}

		public static function render_page() {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$result   = get_transient( 'elemental_addons_convert_result_' . get_current_user_id() );
			$download = '';
			$report   = null;
			$template = 0;

			if ( is_array( $result ) ) {
				delete_transient( 'elemental_addons_convert_result_' . get_current_user_id() );
				$download = isset( $result['json'] ) ? $result['json'] : '';
				$report   = isset( $result['report'] ) ? $result['report'] : null;
				$template = isset( $result['template_id'] ) ? (int) $result['template_id'] : 0;
			}

			$supported = Elemental_Addons_Layout_Converter::supported_widget_types();
			$tm_types  = array_values( array_filter( $supported, function ( $t ) {
				return 0 === strpos( $t, 'tm-ele-' );
			} ) );
			sort( $tm_types );
			?>
			<div class="wrap">
				<h1><?php echo esc_html__( 'Elemental Layout Converter', 'elemental-addons' ); ?></h1>
				<p><?php echo esc_html__( 'Paste or upload Elementor JSON exported from an Evolta / mascot-core site. Unsupported widgets are converted so the layout can be imported into Hello Elementor + Elemental Addons.', 'elemental-addons' ); ?></p>

				<div class="card" style="max-width:960px;padding:16px 20px;margin-top:16px;">
					<h2 style="margin-top:0;"><?php echo esc_html__( 'How to use', 'elemental-addons' ); ?></h2>
					<ol>
						<li><?php echo esc_html__( 'On the Evolta site: in Elementor, save the section/page as a Template, then Templates → Saved Templates → Export (JSON).', 'elemental-addons' ); ?></li>
						<li><?php echo esc_html__( 'Upload that JSON here (or paste it). Choose what to do with widgets not included in Elemental Addons.', 'elemental-addons' ); ?></li>
						<li><?php echo esc_html__( 'Download the converted JSON and import it via Elementor → Templates → Import, or save it directly as a library template.', 'elemental-addons' ); ?></li>
						<li><?php echo esc_html__( 'Shortcut: for a single widget/section that only uses supported widgets (same tm-ele-* IDs), Elementor Ctrl+C / Ctrl+V between sites should work after a hard refresh.', 'elemental-addons' ); ?></li>
					</ol>
					<p><strong><?php echo esc_html__( 'Supported Elemental widgets right now:', 'elemental-addons' ); ?></strong> <?php echo esc_html( implode( ', ', $tm_types ) ); ?></p>
				</div>

				<?php if ( is_array( $report ) ) : ?>
					<div class="notice notice-success" style="max-width:960px;">
						<p><strong><?php echo esc_html__( 'Conversion complete.', 'elemental-addons' ); ?></strong></p>
						<ul>
							<li><?php echo esc_html( sprintf( __( 'Containers/sections kept: %d', 'elemental-addons' ), (int) $report['containers'] ) ); ?></li>
							<li><?php echo esc_html( sprintf( __( 'Widgets kept: %d types', 'elemental-addons' ), count( $report['kept'] ) ) ); ?></li>
							<li><?php echo esc_html( sprintf( __( 'Mapped IDs: %d', 'elemental-addons' ), count( $report['mapped'] ) ) ); ?></li>
							<li><?php echo esc_html( sprintf( __( 'Replaced with HTML: %d', 'elemental-addons' ), count( $report['replaced'] ) ) ); ?></li>
							<li><?php echo esc_html( sprintf( __( 'Removed: %d', 'elemental-addons' ), count( $report['removed'] ) ) ); ?></li>
						</ul>
						<?php if ( ! empty( $report['replaced'] ) ) : ?>
							<p><code><?php echo esc_html( implode( ', ', array_unique( $report['replaced'] ) ) ); ?></code></p>
						<?php endif; ?>
						<?php if ( $template ) : ?>
							<p>
								<a class="button button-primary" href="<?php echo esc_url( admin_url( 'post.php?post=' . $template . '&action=elementor' ) ); ?>">
									<?php echo esc_html__( 'Open converted template in Elementor', 'elemental-addons' ); ?>
								</a>
							</p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data" style="max-width:960px;margin-top:20px;">
					<input type="hidden" name="action" value="elemental_addons_convert_layout" />
					<?php wp_nonce_field( 'elemental_addons_convert_layout' ); ?>

					<table class="form-table" role="presentation">
						<tr>
							<th scope="row"><label for="elemental_json_file"><?php echo esc_html__( 'Upload JSON', 'elemental-addons' ); ?></label></th>
							<td><input type="file" name="elemental_json_file" id="elemental_json_file" accept=".json,application/json" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="elemental_json"><?php echo esc_html__( 'Or paste JSON', 'elemental-addons' ); ?></label></th>
							<td><textarea name="elemental_json" id="elemental_json" rows="14" class="large-text code" placeholder="{ &quot;content&quot;: [ ... ] }"></textarea></td>
						</tr>
						<tr>
							<th scope="row"><?php echo esc_html__( 'Unsupported widgets', 'elemental-addons' ); ?></th>
							<td>
								<label><input type="radio" name="unsupported_mode" value="html" checked /> <?php echo esc_html__( 'Replace with HTML placeholder (recommended)', 'elemental-addons' ); ?></label><br />
								<label><input type="radio" name="unsupported_mode" value="remove" /> <?php echo esc_html__( 'Remove them', 'elemental-addons' ); ?></label><br />
								<label><input type="radio" name="unsupported_mode" value="keep" /> <?php echo esc_html__( 'Keep as-is (import may show missing widgets)', 'elemental-addons' ); ?></label>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="template_title"><?php echo esc_html__( 'Template title', 'elemental-addons' ); ?></label></th>
							<td><input type="text" class="regular-text" name="template_title" id="template_title" value="Converted Layout" /></td>
						</tr>
						<tr>
							<th scope="row"><?php echo esc_html__( 'After convert', 'elemental-addons' ); ?></th>
							<td>
								<label><input type="checkbox" name="save_template" value="1" checked /> <?php echo esc_html__( 'Save as Elementor library template', 'elemental-addons' ); ?></label>
							</td>
						</tr>
					</table>

					<?php submit_button( __( 'Convert layout', 'elemental-addons' ) ); ?>
				</form>

				<?php if ( $download ) : ?>
					<h2><?php echo esc_html__( 'Converted JSON', 'elemental-addons' ); ?></h2>
					<p>
						<button type="button" class="button" id="elemental-download-json"><?php echo esc_html__( 'Download JSON', 'elemental-addons' ); ?></button>
					</p>
					<textarea id="elemental-converted-json" rows="16" class="large-text code" readonly><?php echo esc_textarea( $download ); ?></textarea>
					<script>
					(function(){
						var btn = document.getElementById('elemental-download-json');
						var ta = document.getElementById('elemental-converted-json');
						if (!btn || !ta) return;
						btn.addEventListener('click', function(){
							var blob = new Blob([ta.value], {type:'application/json'});
							var a = document.createElement('a');
							a.href = URL.createObjectURL(blob);
							a.download = 'elemental-converted-layout.json';
							a.click();
							URL.revokeObjectURL(a.href);
						});
					})();
					</script>
				<?php endif; ?>
			</div>
			<?php
		}

		public static function handle_convert() {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'Forbidden', 'elemental-addons' ) );
			}
			check_admin_referer( 'elemental_addons_convert_layout' );

			$raw = '';
			if ( ! empty( $_FILES['elemental_json_file']['tmp_name'] ) && is_uploaded_file( $_FILES['elemental_json_file']['tmp_name'] ) ) {
				// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
				$raw = file_get_contents( $_FILES['elemental_json_file']['tmp_name'] );
			}
			if ( '' === $raw && isset( $_POST['elemental_json'] ) ) {
				$raw = wp_unslash( $_POST['elemental_json'] );
			}

			$document = Elemental_Addons_Layout_Converter::decode( $raw );
			if ( is_wp_error( $document ) ) {
				wp_die( esc_html( $document->get_error_message() ) );
			}

			$mode = isset( $_POST['unsupported_mode'] ) ? sanitize_key( wp_unslash( $_POST['unsupported_mode'] ) ) : 'html';
			if ( ! in_array( $mode, array( 'html', 'remove', 'keep' ), true ) ) {
				$mode = 'html';
			}

			$title = isset( $_POST['template_title'] ) ? sanitize_text_field( wp_unslash( $_POST['template_title'] ) ) : 'Converted Layout';
			$document['title'] = $title;

			$result   = Elemental_Addons_Layout_Converter::convert( $document, $mode );
			$json     = wp_json_encode( $result['document'] );
			$template = 0;

			if ( ! empty( $_POST['save_template'] ) ) {
				$saved = Elemental_Addons_Layout_Converter::save_as_template( $result['document'], $title );
				if ( ! is_wp_error( $saved ) ) {
					$template = $saved;
				}
			}

			set_transient(
				'elemental_addons_convert_result_' . get_current_user_id(),
				array(
					'json'        => $json,
					'report'      => $result['report'],
					'template_id' => $template,
				),
				10 * MINUTE_IN_SECONDS
			);

			wp_safe_redirect( admin_url( 'admin.php?page=' . self::SLUG ) );
			exit;
		}
	}
}
