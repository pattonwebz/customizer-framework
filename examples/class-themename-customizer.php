<?php
/**
 * A final class extending the package base customizer class.
 *
 * @package PattonWebz_Customize
 * @since 1.0.0
 */

/**
 * This is an example class extending the base cusomizer class from the package.
 */
final class Themename_Customizer extends PattonWebz_Customizer {

	/**
	 * Sets up some non static properties for the class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_properties() {
		/**
		 * NOTE: If this file is not included inside /path/to/theme/inc/customizer/
		 * then you should override this method and set the root directory and uri.
		 */
		// Set the root directory where the customizer packages is found. Here is set to: /path/to/theme/inc/customizer/.
		$this->customizer_root = trailingslashit( get_template_directory() ) . 'inc/customizer/';
		// TODO: get this directory url properly by matching against directory structure.
		$this->customizer_uri = trailingslashit( get_template_directory_uri() ) . 'inc/customizer/';
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
		// parent adds the 'help section' in this method.
		parent::sections();
		// NOTE: Add some sections.
	}

	/**
	 * Adds the settings, sets their defaults and sanitization callbacks.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param object $wp_customize the WordPress customizer object.
	 */
	public function settings( $wp_customize ) {
		/**
		 * NOTE: if you choose not to override the parents setting_defaults
		 * method then the filter to add settings to the defautls array is:
		 * `pattonwebz_customize_filter_setting_defaults`.
		 */
		// get the defaults from a function that should return a filtered array.
		$defaults = self::setting_defaults();

		// NOTE: Add some settings.
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
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		/**
		 * If you overwrite this method to add your own or additional scripts
		 * remember to either run the parent method or to enqueue the scripts
		 * and styles for 'help section' block.
		 *
		 * NOTE: You do not need to override this method if you are not adding
		 * additonal styles or scripts.
		 */
		parent::enqueue_control_scripts();
	}
}
