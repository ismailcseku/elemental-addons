<?php
/**
 * Elementor widgets manager screen.
 *
 * @var Elemental_Addons_Widgets_Manager $manager
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$elemental_groups = $manager->get_groups();
$elemental_counts = $manager->get_counts();
?>
<div class="wrap elemental-widgets-manager">

	<h1 class="wp-heading-inline"><?php esc_html_e( 'Widgets Manager', 'elemental-addons' ); ?></h1>

	<?php if ( ! empty( $_GET['elemental-widgets-updated'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
		<div class="notice notice-success is-dismissible">
			<p><?php esc_html_e( 'Widget settings saved. The Elementor cache has been cleared.', 'elemental-addons' ); ?></p>
		</div>
	<?php endif; ?>

	<p class="elemental-widgets-manager__intro">
		<?php esc_html_e( 'Turn off widgets this site does not use. Disabled widgets are not loaded, which keeps the Elementor editor lighter.', 'elemental-addons' ); ?>
	</p>

	<div class="notice notice-warning inline elemental-widgets-manager__warning">
		<p>
			<strong><?php esc_html_e( 'Important:', 'elemental-addons' ); ?></strong>
			<?php esc_html_e( 'If a widget is already used on a page and you disable it, that widget will disappear from the page until you switch it back on.', 'elemental-addons' ); ?>
		</p>
	</div>

	<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" id="elemental-widgets-manager-form">
		<input type="hidden" name="action" value="<?php echo esc_attr( Elemental_Addons_Widgets_Manager::NONCE_ACTION ); ?>" />
		<?php wp_nonce_field( Elemental_Addons_Widgets_Manager::NONCE_ACTION ); ?>

		<div class="elemental-widgets-manager__toolbar">
			<input type="search" id="elemental-widgets-search" class="elemental-widgets-manager__search" placeholder="<?php esc_attr_e( 'Search widgets…', 'elemental-addons' ); ?>" />

			<div class="elemental-widgets-manager__bulk">
				<button type="button" class="button" data-elemental-bulk="recommended"><?php esc_html_e( 'Use Recommended', 'elemental-addons' ); ?></button>
				<button type="button" class="button" data-elemental-bulk="enable"><?php esc_html_e( 'Enable All', 'elemental-addons' ); ?></button>
				<button type="button" class="button" data-elemental-bulk="disable"><?php esc_html_e( 'Disable All', 'elemental-addons' ); ?></button>
			</div>

			<span class="elemental-widgets-manager__count">
				<strong id="elemental-widgets-enabled-count"><?php echo esc_html( (string) $elemental_counts['enabled'] ); ?></strong>
				<?php
				printf(
					/* translators: %s: total number of widgets. */
					esc_html__( 'of %s widgets enabled', 'elemental-addons' ),
					'<strong>' . esc_html( (string) $elemental_counts['total'] ) . '</strong>'
				);
				?>
			</span>
		</div>

		<?php foreach ( $elemental_groups as $elemental_group_key => $elemental_group ) : ?>
			<?php
			$elemental_group_widgets = $manager->get_group_widgets( $elemental_group_key );
			if ( empty( $elemental_group_widgets ) ) {
				continue;
			}
			?>
			<div class="elemental-widgets-group" data-group="<?php echo esc_attr( $elemental_group_key ); ?>">
				<div class="elemental-widgets-group__head">
					<div>
						<h2 class="elemental-widgets-group__title"><?php echo esc_html( $elemental_group['label'] ); ?></h2>
						<?php if ( ! empty( $elemental_group['description'] ) ) : ?>
							<p class="elemental-widgets-group__desc"><?php echo esc_html( $elemental_group['description'] ); ?></p>
						<?php endif; ?>
					</div>
					<div class="elemental-widgets-group__actions">
						<button type="button" class="button button-small" data-elemental-group-bulk="enable"><?php esc_html_e( 'Enable All', 'elemental-addons' ); ?></button>
						<button type="button" class="button button-small" data-elemental-group-bulk="disable"><?php esc_html_e( 'Disable All', 'elemental-addons' ); ?></button>
					</div>
				</div>

				<ul class="elemental-widgets-list">
					<?php foreach ( $elemental_group_widgets as $elemental_slug => $elemental_widget ) : ?>
						<?php
						$field_id     = 'elemental-widget-' . $elemental_group_key . '-' . $elemental_slug;
						$label        = isset( $elemental_widget['label'] ) ? $elemental_widget['label'] : ucwords( str_replace( '-', ' ', $elemental_slug ) );
						$enabled      = $manager->is_enabled( $elemental_group_key, $elemental_slug );
						$recommended  = $manager->is_recommended( $elemental_group_key, $elemental_slug );
						?>
						<li class="elemental-widgets-item" data-search="<?php echo esc_attr( strtolower( $label . ' ' . $elemental_slug ) ); ?>" data-recommended="<?php echo $recommended ? '1' : '0'; ?>">
							<label class="elemental-widgets-item__label" for="<?php echo esc_attr( $field_id ); ?>">
								<input
									type="checkbox"
									class="elemental-widgets-item__input"
									id="<?php echo esc_attr( $field_id ); ?>"
									name="elemental_widgets[<?php echo esc_attr( $elemental_group_key ); ?>][<?php echo esc_attr( $elemental_slug ); ?>]"
									value="1"
									<?php checked( $enabled ); ?>
								/>
								<span class="elemental-widgets-item__switch" aria-hidden="true"></span>
								<span class="elemental-widgets-item__text">
									<span class="elemental-widgets-item__title">
										<?php echo esc_html( $label ); ?>
										<?php if ( ! $recommended ) : ?>
											<span class="elemental-widgets-item__badge" title="<?php esc_attr_e( 'Starts switched off on new sites.', 'elemental-addons' ); ?>"><?php esc_html_e( 'rarely used', 'elemental-addons' ); ?></span>
										<?php endif; ?>
									</span>
									<span class="elemental-widgets-item__slug"><?php echo esc_html( $elemental_slug ); ?></span>
								</span>
							</label>
						</li>
					<?php endforeach; ?>
				</ul>

				<p class="elemental-widgets-group__empty" hidden><?php esc_html_e( 'No widgets match your search.', 'elemental-addons' ); ?></p>
			</div>
		<?php endforeach; ?>

		<p class="elemental-widgets-manager__submit">
			<?php submit_button( esc_html__( 'Save Changes', 'elemental-addons' ), 'primary large', 'submit', false ); ?>
		</p>
	</form>
</div>
