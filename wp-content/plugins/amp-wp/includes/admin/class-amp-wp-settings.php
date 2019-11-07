<?php
/**
 * Amp_WP_Settings Class
 *
 * This is used to define AMP WP Settings Page.
 *
 * @link        https://pixelative.co
 * @since       1.0.0
 *
 * @package     Amp_WP_Settings
 * @subpackage  Amp_WP_Settings/includes
 * @author      Pixelative <mohsin@pixelative.co>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; } // Exit if accessed directly
class Amp_WP_Settings {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since   1.0.0
	 */
	public function __construct() {

		// Action - Add Settings Menu.
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 20 );

		/**
		 * Classes responsible for defining settings that occur in the frontend area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-amp-wp-general.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-amp-wp-layout.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-amp-wp-social-links.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-amp-wp-analytics.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-amp-wp-translation.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-amp-wp-notice-bar.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-amp-wp-gdpr.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/settings/class-amp-wp-structured-data.php';

		// Action - Save Settings.
		add_action( 'admin_notices', array( $this, 'amp_wp_save_settings' ) );
	}

	/**
	 * Add Setting Page Under AMP WP Admin Menu.
	 *
	 * @since   1.0.0
	 */
	public function admin_menu() {
		add_submenu_page(
			'amp-wp-welcome', // string $parent_slug.
			'Settings', // string $page_title.
			'Settings', // string $menu_title.
			'manage_options', // string $capability.
			'amp-wp-settings', // string $menu_slug.
			array( $this, 'amp_wp_settings_tab_menu' ) // callable $function.
		);
	}

	/**
	 * Add Settings Tab Menu.
	 *
	 * @Since   1.0.4
	 */
	public function amp_wp_settings_tab_menu() {
		$page = filter_input( INPUT_GET, 'page' );
		?>
		<div class="amp-wp-adb">
			<?php require_once AMP_WP_DIR_PATH . 'admin/partials/amp-wp-admin-header.php'; ?>

			<div class="amp-wp-vtabs">
				<div class="amp-wp-vtabs-sidebar">
					<div class="amp-wp-vtabs-menu">
					<?php
					/**
					 * Filter the Settings Tab Menus.
					 *
					 * @since 1.0.4
					 *
					 * @param array (){
					 *     @type array Tab Id => Settings Tab Name
					 * }
					 */
					$settings_tabs = apply_filters( 'amp_wp_settings_tab_menus', array() );

					$count = 1;
					if ( $settings_tabs ) {
						foreach ( $settings_tabs as $key => $tab_name ) {
							$active_tab = ( 1 === $count ) ? 'active' : '';
							echo '<a href="#settings-' . sanitize_key( $key ) . '" class="' . sanitize_html_class( $active_tab ) . ' ">' . wp_kses_post( $tab_name ) . '</a>';
							$count++;
						}
					}
					?>
					</div>
				</div>
				<div class="amp-wp-vtabs-content-wrap">
				<?php
				/**
				 * Action -> Display Settings Sections.
				 *
				 * @since 1.0.0
				 */
				do_action( 'amp_wp_settings_tab_section' );
				?>
		<?php
	}

	/**
	 * Save Settings.
	 *
	 * @since   1.0.4
	 */
	public function amp_wp_save_settings() {

		/**
		 * Action -> Save Setting Sections.
		 *
		 * @since   1.0.4
		 */
		do_action( 'amp_wp_save_setting_sections' );

		// Admin Notices.
		if ( isset( $_POST['admin_notices'] ) && ( null != filter_input( INPUT_POST, 'admin_notices' ) ) ) {
			?>
		<div class="notice updated is-dismissible">
			<p><?php echo apply_filters( 'amp_wp_save_setting_notice', esc_html__( 'Settings saved.', 'amp-wp' ) ); ?></p>
		</div>
			<?php
		}
	}
}
new Amp_WP_Settings();
