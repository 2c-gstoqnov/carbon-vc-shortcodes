<?php
/**
 * The main class that handels the shortcodes
 * 
 * Singleton, used as a bootstrap to include all dependency files
 * 
 * @version 1.0
 */
final class Carbon_VC_Shortcodes {
	/**
	 * Instance Container
	 * 
	 * @static
	 * 
	 * @var Carbon_VC_Shortcodes
	 */
	static $instance = null;

	/**
	 * Holds the Shortcode templates directory
	 * 
	 * @static
	 * 
	 * @var string
	 */
	static $templates_dir = '';

	/**
	 * Holds the directory where this library is located
	 * 
	 * @static
	 * 
	 * @var string
	 */
	static $lib_dir = '';

	/**
	 * Holds all Custom Visual Composer Shortcodes
	 * 
	 * @var array $shortcodes
	 */
	public static $shortcodes = array();

	/**
	 * Constructor
	 * 
	 * @access private
	 */
	private function __construct() {
		if ( !function_exists('vc_map') || !defined('WPB_VC_VERSION') ) {
			add_action( 'admin_notices', array($this, 'display_dependency_notice') );
			return;
		}

		self::$lib_dir = dirname(__FILE__);
		self::$templates_dir = self::$lib_dir . '/templates';

		self::include_files();

		// Attach shortcodes registration
		add_action( 'vc_before_init', array('Carbon_VC_Shortcodes', 'register_shortcodes') );
	}

	/**
	 * Retrieve or create the Carbon_VC_Shortcodes instance
	 * 
	 * @static
	 * 
	 * @access public 
	 */
	public static function init() {
		$instance = self::get_instance();
	}

	/**
	 * Returns or creates the Carbon_VC_Shortcodes instance
	 * 
	 * @static
	 * 
	 * @access public
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Includes all dependency files
	 * 
	 * @access private
	 */
	private function include_files() {
		include_once self::$lib_dir . '/carbon-vc-shortcode.php';

		include_once self::$lib_dir . '/carbon-vc-shortcode-param.php';
	}

	/**
	 * Registers the Shortcodes
	 * 
	 * @access private
	 */
	public static function register_shortcodes() {
		include_once self::$lib_dir . '/vc-shortcodes.php';

		foreach (self::$shortcodes as $shortcode) {
			$shortcode_atts = array_merge(
				$shortcode->args,
				array( 'params' => $shortcode->get_params() )
			);

			vc_map($shortcode_atts);
		}
	}

	/**
	 * Displays the activation notice
	 */
	public function display_dependency_notice() {
		_e('Please activate Visual Composer plugin.', 'crb');
	}
}

// Initialize the Plugin
Carbon_VC_Shortcodes::init();