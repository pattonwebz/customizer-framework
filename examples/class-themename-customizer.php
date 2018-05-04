<?php
/**
 * A final class extending the package base customizer class.
 *
 * NOTE: THIS FILE IS PROBABLY NO LONGER CORRECT IMPLIMENTATION!
 *
 * @licence GPLv2 or later
 *
 * @package PattonWebz_Customize
 * @since 1.0.0
 */

namespace Themename;

/**
 * This is an example class extending the base cusomizer class from the package.
 */
final class Customizer extends PattonWebz\Customizer {

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
		// Load custom sections.
		require_once $this->customizer_root . 'sections/class-pattonwebz-help-section.php';

		// Register custom section types.
		$wp_customize->register_section_type( 'PattonWebz_Help_Section' );

		// Start a buffer to hold some html content.
		ob_start();
		?>
		<p><?php esc_html_e( 'You can contact me for support or customizations.', 'pattonwebz' ); ?></p>
		<?php
		// get the buffered content.
		$description = ob_get_clean();
		// start a holder array.
		$help_section_values = array(
			'title'       => esc_html( wp_get_theme()->get( 'Name' ) ), // current theme name.
			'text'        => esc_html__( 'Help and Support', 'pattonwebz' ),
			'url'         => esc_url( 'https://www.pattonwebz.com/contact/' ),
			'description' => $description,
			'priority'    => 1,
		);

		// NOTE: You should filter in some custom values.
		$help_section_values = apply_filters( 'prefix_filter_upsell_values', $help_section_values );

		// Register the help section.
		$wp_customize->add_section(
			new PattonWebz_Help_Section(
				$wp_customize,
				'pattonwebz-customizer-section-help',
				$help_section_values
			)
		);

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
		 * property at instantiation then the filter to add settings to the
		 * defautls array is: `pattonwebz_customize_filter_setting_defaults`.
		 */
		// get the defaults from property.
		$defaults = $this->setting_defaults;

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
	public function enqueue_scripts() {
		/**
		 * If you overwrite this method to add your own or additional scripts
		 * remember to either run the parent method or to enqueue the scripts
		 * and styles for 'help section' block.
		 *
		 * NOTE: You do not need to override this method if you are not adding
		 * additonal styles or scripts.
		 */
		parent::enqueue_scripts();

		// NOTE: Add some stles and scripts.
	}
}
