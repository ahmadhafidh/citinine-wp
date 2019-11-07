<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://pixelative.co
 * @since      1.0.0
 *
 * @package    Amp_WP
 * @subpackage Amp_WP/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Amp_WP
 * @subpackage Amp_WP/admin
 * @author     Pixelative <mohsin@pixelative.co>
 */
class Amp_WP_Admin {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		add_action( 'admin_init', array( $this, 'amp_wp_page_welcome_redirect' ) );

		if ( get_transient( 'amp-wp-flush-rules' ) ) {
			add_action( 'admin_init', 'flush_rewrite_rules' );
			delete_transient( 'amp-wp-flush-rules' );
		}

		add_action( 'admin_bar_menu', array( $this, 'amp_wp_add_toolbar_item' ), 100 );

		add_filter(
			'plugin_action_links_' . plugin_basename( AMP_WP_DIR_PATH . $this->plugin_name . '.php' ),
			array(
				$this,
				'add_action_links',
			)
		);

		add_filter( 'plugin_row_meta', array( $this, 'add_plugin_meta_links' ), 10, 2 );

		/**
		 * Classes responsible for defining all actions that occur in the admin area.
		 */
		require_once AMP_WP_DIR_PATH . 'includes/admin/class-amp-wp-welcome.php';
		require_once AMP_WP_DIR_PATH . 'includes/admin/class-amp-wp-settings.php';
		require_once AMP_WP_DIR_PATH . 'includes/customizer/class-amp-wp-customize.php';
		require_once AMP_WP_DIR_PATH . 'includes/admin/class-amp-wp-add-ons.php';
		require_once AMP_WP_DIR_PATH . 'includes/admin/class-amp-wp-help.php';
		require_once AMP_WP_DIR_PATH . 'includes/admin/class-amp-wp-system-status.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once AMP_WP_DIR_PATH . 'admin/class-amp-wp-meta-box.php';

		// Filter -> Footer Branding - with Pixelative Logo.
		add_filter( 'admin_footer_text', array( $this, 'amp_wp_powered_by' ) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/amp-wp-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since      1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'select2', plugin_dir_url( __FILE__ ) . 'js/select2.js', array( 'jquery' ), '4.0.6', true );
		wp_enqueue_script( 'amp-wp-admin-ui-kit', plugin_dir_url( __FILE__ ) . 'js/amp-wp-admin-ui-kit.js', array( 'jquery' ), '0.0.1', true );
		wp_enqueue_script( 'tiptip-jquery-plugin', plugin_dir_url( __FILE__ ) . 'js/tiptip.jquery.min.js', array( 'jquery' ), '1.3', true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/amp-wp-admin.js', array( 'jquery' ), $this->version, true );
	}

	public function amp_wp_page_welcome_redirect() {
		$redirect = get_transient( '_amp_wp_page_welcome_redirect' );
		delete_transient( '_amp_wp_page_welcome_redirect' );
		$redirect && wp_redirect( add_query_arg( array( 'page' => 'amp-wp-welcome' ), 'admin.php' ) );
	}

	/**
	 * Check If the admin page is from AMP WP.
	 *
	 * @since   1.0.0
	 */
	public function is_amp_wp_admin_pages() {
		$screen = get_current_screen();
		return ( 'amp-wp-welcome' === $screen->parent_base ) ? true : false;
	}

	/**
	 * Add AMP Link to Admin Bar
	 *
	 * @param   object $admin_bar
	 * @since   1.0.0
	 * @access  public
	 * @return  void
	 */
	public function amp_wp_add_toolbar_item( $wp_admin_bar ) {
		$wp_admin_bar->add_menu(
			array(
				'parent' => 'site-name',
				'id'     => 'view-amp',
				'title'  => __( 'Visit AMP', 'amp-wp' ),
				'href'   => esc_url( amp_wp_home_url() ),
				'meta'   => false,
			)
		);
	}

	/**
	 * Setting Link displayed for AMP WP in the Plugins list table
	 *
	 * @param   array $links
	 * @since    1.4.0
	 *
	 * @return  array
	 */
	public function add_action_links( $links ) {
		return array_merge(
			array(
				'settings' => '<a href="' . esc_url( add_query_arg( array( 'page' => 'amp-wp-settings' ), 'admin.php' ) ) . '">' . __( 'Settings', 'amp-wp' ) . '</a>',
			),
			$links
		);
	}

	public function add_plugin_meta_links( $meta_fields, $file ) {

		if ( strpos( $file, 'amp-wp.php' ) !== false ) {
			$meta_fields[] = "<span class='amp-wp-adb'><a href='https://wordpress.org/support/plugin/amp-wp/reviews/#new-post' target='_blank' title='" . __( 'Share The Love!', 'amp-wp' ) . "'>
				  <i class='amp-wp-star-rating'>"
			  . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			  . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			  . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			  . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			  . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
			  . '</i></a></span>';
		}
		return $meta_fields;
	}

	/**
	 * Replace admin footer text with Brand.
	 *
	 * @since    1.0.0
	 */
	public function amp_wp_powered_by( $text ) {
		if ( is_admin() && $this->is_amp_wp_admin_pages() ) {
			$text = '<a href="' . esc_url( 'https://pixelative.co' ) . '" target="_blank"><img src="' . untrailingslashit( plugins_url( basename( plugin_dir_path( __DIR__ ) ), basename( __DIR__ ) ) ) . '/admin/images/pixelative.png" alt="Powered by Pixlative"></a>';
		}
		return $text;
	}
}

/**
 * AMP WP Version Check
 *
 * @since 1.2.0
 */
function amp_wp_version_check_using_wpapi() {
	$response = wp_safe_remote_get( 'https://api.wordpress.org/plugins/info/1.0/amp-wp.json' );

	// Check for error.
	if ( is_wp_error( $response ) ) {
		return;
	}

	// Parse remote HTML file.
	$data = json_decode( wp_remote_retrieve_body( $response ) );

	// Check for error.
	if ( is_wp_error( $data ) ) {
		return;
	}

	if ( ! empty( $data ) ) {
		return $data->version;
	}
}
