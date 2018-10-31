<?php
/**
 * The base customizer interface for defining customizer options in a theme.
 *
 * @package   PattonWebz_Customize
 * @since     1.3.0
 * @author    William Patton <will@pattonwebz.com>
 * @copyright Copyright (c) 2018, William Patton
 * @link      https://github.com/pattonwebz/customizer-framework/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace PattonWebz\Customizer;

interface CustomizerHolder {

	/**
	 * Constructor should setup properties to hold the passed properties.
	 *
	 * @param  string $dir      Should be directory to the customizer directory.
	 * @param  string $uri      URI to the customizer directory.
	 * @param  array  $settings Array of settings from theme that can be used to store default values to use when registering settings.
	 */
	public function __construct( $dir = '', $uri = '', $settings = array() );

	/**
	 * Adds any panels to the customizer.
	 *
	 * @param object $wp_customize the cusomizer manager object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function panels( $wp_customize );

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize the WordPress custmizer object.
	 * @return void
	 */
	public function sections( $wp_customize );

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize the WordPress custmizer object.
	 * @return void
	 */
	public function settings( $wp_customize );

	/**
	 * A helper function to return default settings for the customizer items.
	 *
	 * @return array an array of settings in key => value format.
	 */
	public function setting_defaults();

	/**
	 * Adds the controls for all the settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param object $wp_customize the WordPress customizer object.
	 */
	public function controls( $wp_customize );

	/**
	 * Loads any styles or scripts needed by the added customizer items.
	 *
	 * @since  1.3.0
	 * @access public
	 */
	public function enqueue_scripts();

}
