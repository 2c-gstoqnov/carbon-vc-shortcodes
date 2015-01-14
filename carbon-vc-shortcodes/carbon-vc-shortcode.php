<?php
/**
 * @todo
 */
class Carbon_VC_Shortcode {
	/**
	 * Holds all arguments for the current shortcode
	 * 
	 * @var array $args
	 */
	public $args = array();

	/**
	 * Additional Parameters for the current shortcode
	 * 
	 * @var array $params
	 */
	public $params = array();

	/**
	 * Constructor
	 * 
	 * @param string $base The shortcode, which will be used
	 * @param string $name The name of the Shortcode
	 */
	private function __construct($base, $name) {
		$this->set_base($base);
		$this->set_name($name);

		$this->args['category'] = __( 'Custom Modules', 'crb' );

		// Add the shortcode to the set of shortcodes
		Carbon_VC_Shortcodes::$shortcodes[ $this->get_base() ] = $this;

		// Register the shortcode
		add_shortcode( $this->get_base(), array($this, 'render') );
	}

	/**
	 * Registers a new shortcode
	 * 
	 * @param string $base The shortcode, which will be used
	 * @param string $name The name of the shortcode
	 * 
	 * @return Carbon_VC_Shortcode
	 */
	public static function factory($base, $name) {
		$shortcode = new self($base, $name);

		return $shortcode;
	}

	/**
	 * Renders the Shortcode
	 */
	public function render($atts, $content = null) {
		ob_start();

		include( locate_template( $this->get_template() ) );

		return ob_get_clean();
	}

	/**
	 * Sets the Arguments of the shortcode
	 * 
	 * @access public
	 * @param array $args The passed arguments
	 */
	public function set_args($args) {
		$args = wp_parse_args($args, $this->args);

		$this->args = $args;

		return $this;
	}

	/**
	 * Sets the Base of the shortcode
	 * 
	 * @access private
	 * 
	 * @param string $base The Base of the shortcode
	 */
	private function set_base($base) {
		$this->args['base'] = $base;

		return $this;
	}

	/**
	 * Returns the Base of the shortcode
	 * 
	 * @access public
	 * 
	 * @return string $base The Base of the shortcode
	 */
	public function get_base() {
		return $this->args['base'];
	}

	/**
	 * Sets the Name of the shortcode
	 * 
	 * @access private
	 * 
	 * @param string $name The Name of the shortcode
	 */
	private function set_name($name) {
		$this->args['name'] = $name;

		return $this;
	}

	/**
	 * Returns the Name of the shortcode
	 * 
	 * @access public
	 * 
	 * @return string $base The Name of the shortcode
	 */
	public function get_name() {
		return $this->args['name'];
	}

	/**
	 * Sets the Template Name
	 * 
	 * @access public
	 * 
	 * @param string $template_name The name of the used template
	 */
	public function set_template($template_name) {
		$this->args['html_template'] = 'includes/vc-shortcodes/templates/' . $template_name;

		return $this;
	}

	/**
	 * Returns the Template Name
	 * 
	 * @access public
	 * 
	 * @return string $template_name The name of the used template
	 */
	public function get_template() {
		return $this->args['html_template'];
	}

	/**
	 * Sets the Description of the Shortcode
	 * 
	 * @access public
	 * 
	 * @param string $description The description of the shortcode
	 */
	public function set_description($description) {
		$this->args['description'] = $description;

		return $this;
	}

	/**
	 * Returns the Description of the Shortcode
	 * 
	 * @access public
	 * 
	 * @return string $description The description of the shortcode
	 */
	public function get_description() {
		return $this->args['description'];
	}

	/**
	 * Sets additional parameters for the current shortcode
	 * 
	 * @access public
	 * 
	 * @param array $params The parameters of the shortcode
	 */
	public function set_params($params) {
		$this->params = $params;

		return $this;
	}

	/**
	 * Returns the parameters of the shortcode
	 * 
	 * @access public
	 * 
	 * @return array $params The parameters of the shortcode
	 */
	public function get_params() {
		$return = array();

		$params = $this->params;

		foreach ($params as $param) {
			$return[] = $param->args;
		}

		return $return;
	}
}