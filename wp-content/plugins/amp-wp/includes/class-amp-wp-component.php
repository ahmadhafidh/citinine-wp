<?php
/**
 * AMP WP Component Factory Class
 *
 * @since 1.0.0
 */

class Amp_WP_Component extends Amp_WP_Component_Base {

	/**
	 * Component instance
	 *
	 * @since 1.0.0
	 *
	 * @var Amp_WP_Component_Interface
	 */
	private $component;

	/**
	 * Component class name
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	private $class_name;

	/**
	 * Store components instance
	 *
	 * @since 1.0.0
	 *
	 * @var array
	 */
	private static $instances;

	/**
	 * Get self instance
	 *
	 * @param   string $component_class component class name that implements Amp_WP_Component_Interface
	 * @param   bool   $fresh  new fresh object?
	 *
	 * @since   1.0.0
	 *
	 * @return  Amp_WP_Component|bool Amp_WP_Component object on success or false on failure.
	 */
	public static function instance( $component_class, $fresh = false ) {
		if ( isset( self::$instances[ $component_class ] ) && ! $fresh ) {
			return self::$instances[ $component_class ];
		}

		if ( class_exists( $component_class ) ) {
			return self::$instances[ $component_class ] = new Amp_WP_Component( $component_class );
		}

		return false;
	}

	/**
	 * Clean instance storage cache
	 *
	 * @since 1.0.0
	 */
	public static function flush_instances() {
		self::$instances = array();
	}

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string $component_class
	 */
	public function __construct( $component_class ) {
		$this->class_name = $component_class;
		$this->set_component_instance( new $this->class_name() );
	}

	/**
	 * Set a component class instance
	 *
	 * @param Amp_WP_Component_Interface $instance
	 *
	 * @since 1.0.0
	 */
	public function set_component_instance( Amp_WP_Component_Interface $instance ) {
		$this->component = $instance;
	}

	/**
	 * Get a component instance
	 *
	 * @return Amp_WP_Component_Interface;
	 *
	 * @since 1.0.0
	 */
	public function get_component_instance() {
		return $this->component;
	}

	/**
	 * Execute component and Transform HTML content to AMP content
	 *
	 * @param string $content HTML content.
	 *
	 * @since 1.0.0
	 *
	 * @return string transformed content
	 */
	public function render( $content ) {
		return $this->component->transform( $content );
	}

	/**
	 * Get component config
	 *
	 * @see   Amp_WP_Component_Interface for more documentation
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_config() {
		return wp_parse_args(
			$this->component->config(),
			array(
				'shortcodes' => array(),
				'scripts'    => array(),
			)
		);
	}

	/**
	 * Replaces the default shortcode with the component shortcode
	 *
	 * @since 1.0.0
	 */
	public function register_shortcodes() {
		$config = $this->get_config();
		foreach ( $config['shortcodes'] as $shortcode => $callback ) {
			remove_shortcode( $shortcode );
			add_shortcode( $shortcode, $callback );
		}
	}

	/**
	 * Magic method handler
	 *
	 * Make private/protected methods readable for fire component method via this object instance
	 *
	 * @param string $method
	 * @param array  $args
	 *
	 * @since 1.0.0
	 *
	 * @return mixed
	 */
	public function __call( $method, $args ) {
		$callback = array( $this->component, $method );
		if ( is_callable( $callback ) ) {
			return call_user_func_array( $callback, $args );
		}
	}

	/**
	 * Enqueues component script.
	 *
	 * @param array $deps
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function enqueue_amp_scripts( $deps = array() ) {
		$config = $this->get_config();
		foreach ( $config['scripts'] as $name => $script ) {
			amp_wp_enqueue_script( $name, $script, $deps );
		}
		return $deps; // Pass $deps to work with series call {@see Amp_WP::call_component_method}.
	}

	/**
	 * Determines the script should be enqueued!
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function can_enqueue_scripts() {
		return ! empty( $this->component->enable_enqueue_scripts );
	}

	/**
	 * Enqueue AMP component script if amp tag exists in the page and script was not printed yet
	 *
	 * @param Amp_WP_Html_Util $dom
	 *
	 * @return Amp_WP_Html_Util
	 */
	public function enqueue_amp_tags_script( $dom ) {
		$has_enqueue_scripts = $this->can_enqueue_scripts();

		// If script was not printed previously.
		if ( ! $has_enqueue_scripts ) {
			$config = $this->get_config();

			foreach ( $config['scripts'] as $tag => $script ) {
				if ( $dom->getElementsByTagName( $tag )->length ) {
					amp_wp_enqueue_script( $tag, $script, array( 'ampproject' ) );
				}
			}
		}
		return $dom;
	}
}
