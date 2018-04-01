<?php
/**
 * The base customizer class used to define the interface for adding panels,
 * sections, settings and controls to the WordPress Cusomizer.
 *
 * @version 1.2.0
 *
 * @package PattonWebz_Customize
 * @since 1.0.0
 */

/**
 * Base class for handling the a customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
class PattonWebz_Customizer {

	/**
	 * Static propery to hold the customizer class' version.
	 *
	 * @since  1.2.0
	 * @access public
	 * @var    string
	 */
	public static $version = '1.3.0';
	/**
	 * The absolute directory to the base customizer package.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $customizer_root = '';

	/**
	 * The uri to the base customizer package directory.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $customizer_uri = '';

	/**
	 * Holder for the themes customizer setting defaults.
	 *
	 * @since  1.2.0
	 * @access public
	 * @var array
	 */
	public $setting_defaults = array();

	/**
	 * Constructor method for the base customizer integration class.
	 *
	 * You should pass all 3 expected paramiters otherwise semi-sane defaults
	 * will be used that may not be approprite in some situations.
	 *
	 * @param string $dir      should be an absolute path to customizer directory.
	 * @param string $uri      should be the uri to the customizer directory.
	 * @param array  $settings key => values store of defaults that can be used in customizer settings.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	public function __construct( $dir = '', $uri = '', $settings = array() ) {

		// set root to customizer and uri to it's path.
		$this->customizer_root = $dir;
		$this->customizer_uri  = $uri;

		// hold themes settings.
		$this->setting_defaults = $settings;

		// include a class with some useful helper functions.
		include_once $this->customizer_root . 'helpers/class-pattonwebz-customizer-helpers.php';

		// setup actions for the customizer class.
		$this::setup_actions();
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'panels' ) );
		add_action( 'customize_register', array( $this, 'sections' ) );
		add_action( 'customize_register', array( $this, 'settings' ) );
		add_action( 'customize_register', array( $this, 'controls' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Adds any panels to the customizer.
	 *
	 * @param object $wp_customize the cusomizer manager object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function panels( $wp_customize ) {

		// NOTE: Add some panels.
	}
	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize the WordPress custmizer object.
	 * @return void
	 */
	public function sections( $wp_customize ) {

		// NOTE: Add some sections.
	}

	/**
	 * A helper function to return default settings for the customizer items.
	 *
	 * @return array an array of settings in key => value format.
	 */
	public static function setting_defaults() {
		$defaults = array(
			'example-setting' => 'value for the example setting',
		);
		return apply_filters( 'pattonwebz_customize_filter_setting_defaults', $defaults );
	}

	/**
	 * Adds the controls for all the settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param object $wp_customize the WordPress customizer object.
	 */
	public function controls( $wp_customize ) {

		// NOTE: Add some controls.
	}

	/**
	 * Loads theme customizer CSS and scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function enqueue_control_scripts() {

		// NOTE: enqueue scripts and styles for use in customizer.
		// The enqueues below include the script and styles for the custom 'help section'.
		wp_enqueue_script( 'pattonwebz-customize-controls-script', $this->customizer_uri . 'js/customize-controls.js', array( 'customize-controls' ), self::$version );
		wp_enqueue_style( 'pattonwebz-customize-controls-style', $this->customizer_uri . 'css/customize-controls.css', self::$version );
	}
}
