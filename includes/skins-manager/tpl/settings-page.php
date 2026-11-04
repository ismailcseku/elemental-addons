<?php
/**
 * Visual skins manager screen.
 *
 * @var Elemental_Addons_Skins_Manager $manager
 * @package Elemental_Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$elemental_registry = $manager->get_registry();
$elemental_counts   = $manager->get_counts();
?>
<div class="wrap elemental-skins-manager">

	<h1 class="wp-heading-inline"><?php esc_html_e( 'Skins Manager', 'elemental-addons' ); ?></h1>

	<?php if ( ! empty( $_GET['elemental-skins-updated'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
		<div class="notice notice-success is-dismissible">
			<p><?php esc_html_e( 'Skin settings saved. The Elementor cache has been cleared.', 'elemental-addons' ); ?></p>
		</div>
	<?php endif; ?>

	<p class="elemental-skins-manager__intro">
		<?php esc_html_e( 'Choose which design skins appear in Elementor. Disable unused skins to keep the editor lighter. Click a card to select or deselect it.', 'elemental-addons' ); ?>
	</p>

	<div class="notice notice-warning inline elemental-skins-manager__warning">
		<p>
			<strong><?php esc_html_e( 'Important:', 'elemental-addons' ); ?></strong>
			<?php esc_html_e( 'If a skin is already used on a page and you disable it, Elementor will fall back to the default layout for that widget until you enable the skin again.', 'elemental-addons' ); ?>
		</p>
	</div>

	<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" id="elemental-skins-manager-form">
		<input type="hidden" name="action" value="<?php echo esc_attr( Elemental_Addons_Skins_Manager::NONCE_ACTION ); ?>" />
		<?php wp_nonce_field( Elemental_Addons_Skins_Manager::NONCE_ACTION ); ?>

		<div class="elemental-skins-manager__toolbar">
			<input type="search" id="elemental-skins-search" class="elemental-skins-manager__search" placeholder="<?php esc_attr_e( 'Search skins or widgets…', 'elemental-addons' ); ?>" />

			<div class="elemental-skins-manager__bulk">
				<button type="button" class="button" data-elemental-bulk="recommended"><?php esc_html_e( 'Use Recommended', 'elemental-addons' ); ?></button>
				<button type="button" class="button" data-elemental-bulk="enable"><?php esc_html_e( 'Enable All', 'elemental-addons' ); ?></button>
				<button type="button" class="button" data-elemental-bulk="disable"><?php esc_html_e( 'Disable All', 'elemental-addons' ); ?></button>
			</div>

			<span class="elemental-skins-manager__count">
				<strong id="elemental-skins-enabled-count"><?php echo esc_html( (string) $elemental_counts['enabled'] ); ?></strong>
				<?php
				printf(
					/* translators: %s: total number of skins. */
					esc_html__( 'of %s skins enabled', 'elemental-addons' ),
					'<strong>' . esc_html( (string) $elemental_counts['total'] ) . '</strong>'
				);
				?>
			</span>
		</div>

		<?php foreach ( $elemental_registry as $elemental_widget_slug => $elemental_widget ) : ?>
			<?php
			$elemental_skins = $manager->get_widget_skins( $elemental_widget_slug );
			if ( empty( $elemental_skins ) ) {
				continue;
			}
			$widget_label = isset( $elemental_widget['label'] ) ? $elemental_widget['label'] : $elemental_widget_slug;
			?>
			<div class="elemental-skins-group" data-group="<?php echo esc_attr( $elemental_widget_slug ); ?>">
				<div class="elemental-skins-group__head">
					<div>
						<h2 class="elemental-skins-group__title"><?php echo esc_html( $widget_label ); ?></h2>
						<p class="elemental-skins-group__desc"><?php echo esc_html( $elemental_widget_slug ); ?></p>
					</div>
					<div class="elemental-skins-group__actions">
						<button type="button" class="button button-small" data-elemental-group-bulk="enable"><?php esc_html_e( 'Enable All', 'elemental-addons' ); ?></button>
						<button type="button" class="button button-small" data-elemental-group-bulk="disable"><?php esc_html_e( 'Disable All', 'elemental-addons' ); ?></button>
					</div>
				</div>

				<ul class="elemental-skins-grid">
					<?php foreach ( $elemental_skins as $elemental_skin_id => $elemental_skin ) : ?>
						<?php
						$field_id    = 'elemental-skin-' . $elemental_widget_slug . '-' . $elemental_skin_id;
						$label       = isset( $elemental_skin['label'] ) ? $elemental_skin['label'] : $elemental_skin_id;
						$enabled     = $manager->is_enabled( $elemental_widget_slug, $elemental_skin_id );
						$recommended = $manager->is_recommended( $elemental_widget_slug, $elemental_skin_id );
						$preview     = $manager->get_preview_url( $elemental_widget_slug, array_merge( $elemental_skin, array( 'id' => $elemental_skin_id ) ) );
						$search      = strtolower( $widget_label . ' ' . $label . ' ' . $elemental_widget_slug . ' ' . $elemental_skin_id );
						?>
						<li
							class="elemental-skins-card<?php echo $enabled ? ' is-enabled' : ''; ?>"
							data-search="<?php echo esc_attr( $search ); ?>"
							data-recommended="<?php echo $recommended ? '1' : '0'; ?>"
						>
							<label class="elemental-skins-card__label" for="<?php echo esc_attr( $field_id ); ?>">
								<span class="elemental-skins-card__preview">
									<?php if ( $preview ) : ?>
										<img src="<?php echo esc_url( $preview ); ?>" alt="" loading="lazy" width="480" height="300" />
									<?php else : ?>
										<span class="elemental-skins-card__placeholder"><?php echo esc_html( $label ); ?></span>
									<?php endif; ?>
									<span class="elemental-skins-card__check" aria-hidden="true"></span>
								</span>
								<span class="elemental-skins-card__meta">
									<span class="elemental-skins-card__title">
										<?php echo esc_html( $label ); ?>
										<?php if ( ! $recommended ) : ?>
											<span class="elemental-skins-card__badge"><?php esc_html_e( 'extra', 'elemental-addons' ); ?></span>
										<?php endif; ?>
									</span>
									<span class="elemental-skins-card__slug"><?php echo esc_html( $elemental_skin_id ); ?></span>
								</span>
								<input
									type="checkbox"
									class="elemental-skins-card__input"
									id="<?php echo esc_attr( $field_id ); ?>"
									name="elemental_skins[<?php echo esc_attr( $elemental_widget_slug ); ?>][<?php echo esc_attr( $elemental_skin_id ); ?>]"
									value="1"
									<?php checked( $enabled ); ?>
								/>
							</label>
						</li>
					<?php endforeach; ?>
				</ul>

				<p class="elemental-skins-group__empty" hidden><?php esc_html_e( 'No skins match your search.', 'elemental-addons' ); ?></p>
			</div>
		<?php endforeach; ?>

		<p class="elemental-skins-manager__submit">
			<?php submit_button( esc_html__( 'Save Changes', 'elemental-addons' ), 'primary large', 'submit', false ); ?>
		</p>
	</form>
</div>
