<?php
/**
 * The main Visual Composer Param Class
 */
class Carbon_VC_Shortcode_Param {
	/**
	 * Holds the arguments for the current parameter
	 * 
	 * @var array $args
	 */
	public $args = array();

	/**
	 * Constructor
	 * 
	 * @param string $type The type of the Parameter
	 * @param string $param_name The Param_name of the Parameter
	 * @param string $heading The heading of the Parameter
	 */
	private function __construct($type, $param_name, $heading) {
		$this->set_type($type);
		$this->set_param_name($param_name);
		$this->set_heading($heading);
	}

	/**
	 * Creates a new parameter
	 * 
	 * @param string $type
	 * @param string $param_name
	 * @param string $heading
	 */
	public static function factory($type, $param_name, $heading) {
		$param = new self($type, $param_name, $heading);

		return $param;
	}

	/**
	 * Sets the Type of the Parameter
	 * 
	 * @param string $type The type of the parameter
	 */
	private function set_type($type) {
		$this->args['type'] = $type;

		return $this;
	}

	/**
	 * Returns the Type of the Parameter
	 * 
	 * @return string $type The type of the parameter
	 */
	public function get_type() {
		return $this->args['type'];
	}

	/**
	 * Sets the Param_name of the Parameter
	 * 
	 * @param string $param_name The param_name of the Parameter
	 */
	private function set_param_name($param_name) {
		$this->args['param_name'] = $param_name;

		return $this;
	}

	/**
	 * Returns the Param_name of the Parameter
	 * 
	 * @return string $param_name The param_name of the Parameter
	 */
	public function get_param_name() {
		return $this->args['param_name'];
	}

	/**
	 * Sets the Heading of the Parameter
	 * 
	 * @param string $heading The Heading of the Parameter
	 */
	private function set_heading($heading) {
		$this->args['heading'] = $heading;

		return $this;
	}

	/**
	 * Returns the Heading of the Parameter
	 * 
	 * @return string $heading The Heading of the Parameter
	 */
	public function get_heading() {
		return $this->args['heading'];
	}

	/**
	 * Sets the Description of the Parameter
	 * 
	 * @param string $description The description of the Parameter
	 */
	private function set_description($description) {
		$this->args['description'] = $description;

		return $this;
	}

	/**
	 * Returns the Description of the Parameter
	 * 
	 * @return string $description The description of the Parameter
	 */
	public function get_description() {
		return $this->args['description'];
	}

	/**
	 * Sets the option values for the current Parameter
	 * 
	 * @param array $options The options of the parameter
	 */
	public function set_options($options) {
		$this->args['value'] = $options;

		return $this;
	}

	/**
	 * Returns the option values for the current parameter
	 * 
	 * @return array $options The options of the parameter
	 */
	public function get_options() {
		return $this->args['value'];
	}
}