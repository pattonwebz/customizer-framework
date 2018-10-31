<?php
/**
 * The base customizer class used to define the interface for adding panels,
 * sections, settings and controls to the WordPress Cusomizer.
 *
 * @version 2.0.0-alpha
 *
 * @package   PattonWebz_Customizer
 * @since     2.0.0
 * @author    William Patton <will@pattonwebz.com>
 * @copyright Copyright (c) 2018, William Patton
 * @link      https://github.com/pattonwebz/customizer-framework/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace PattonWebz\Customizer\;

/**
 * Base class for handling the a customizer integration.
 *
 * @since  2.0.0
 * @access public
 */
class Customizer implements CustomizerHolder {

	/**
	 * Static propery to hold the customizer class' version.
	 *
	 * @since  2.0.0
	 * @access public
	 * @var    string
	 */
	public static $version = '2.0.0-alpha';

	/**
	 * Holder for the setting array defaults.
	 *
	 * NOTE: Array properties were not available pre PHP 7.
	 *
	 * @since  2.0.0
	 * @access public
	 * @var array
	 */
	public $setting_defaults = [];

	/**
	 * Constructor method for the base customizer integration class.
	 *
	 * You should pass all 3 expected paramiters otherwise semi-sane defaults
	 * will be used that may not be approprite in some situations.
	 *
	 * @param array $settings is a key => values store of defaults that can be used in customizer settings.
	 *
	 * @since  2.0.0
	 * @access private
	 */
	public function __construct( $settings = [] ) {

		// hold themes settings.
		$this->setting_defaults = $settings;

		// self init the hook_actions method - optionally do this outside the class.
		$this->hook_actions();

	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  2.0.0
	 * @access private
	 */
	private function hook_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'panels' ) );
		add_action( 'customize_register', array( $this, 'sections' ) );
		add_action( 'customize_register', array( $this, 'settings' ) );
		add_action( 'customize_register', array( $this, 'controls' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_scripts' ), 0 );
	}

	/**
	 * A helper function to return default settings through a filter.
	 *
	 * @since  2.0.0
	 * @access public
	 *
	 * @return array an array of settings in key => value format.
	 */
	public function setting_defaults() {

		return apply_filters( 'pattonwebz_customize_filter_setting_defaults', $this->setting_defaults );
	}

	/**
	 * Adds any panels to the customizer.
	 *
	 * @param object $wp_customize the cusomizer manager object.
	 *
	 * @since  2.0.0
	 * @access public
	 */
	public function panels( $wp_customize ) {

		// NOTE: STUB.
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  object $wp_customize the WordPress custmizer object.
	 */
	public function sections( $wp_customize ) {

		// NOTE: STUB.
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  object $wp_customize the WordPress custmizer object.
	 * @return void
	 */
	public function settings( $wp_customize ) {

		// NOTE: STUB.
	}

	/**
	 * Adds the controls for all the settings.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param object $wp_customize the WordPress customizer object.
	 */
	public function controls( $wp_customize ) {

		// NOTE: STUB.
	}

	/**
	 * Loads theme customizer CSS and scripts.
	 *
	 * @since  2.0.0
	 * @access public
	 */
	public function enqueue_scripts() {

		do_action( 'pattonwebz_customizer_enqueue_scripts' );
	}
}
