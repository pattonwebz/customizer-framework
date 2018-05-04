<?php
/**
 * The base customizer class used to define the interface for adding panels,
 * sections, settings and controls to the WordPress Cusomizer.
 *
 * @version 1.3.0-alpha
 *
 * @package   PattonWebz_Customizer
 * @since     1.0.0
 * @author    William Patton <will@pattonwebz.com>
 * @copyright Copyright (c) 2018, William Patton
 * @link      https://github.com/pattonwebz/customizer-framework/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace PattonWebz;

/**
 * Base class for handling the a customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
class Customizer implements Customizer\Customizer_Holder {

	/**
	 * Static propery to hold the customizer class' version.
	 *
	 * @since  1.2.0
	 * @access public
	 * @var    string
	 */
	public static $version = '1.3.0-alpha';
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
		include_once $this->customizer_root . 'helpers/class-helpers.php';

		// self init the hook_actions method - optionally do this outside the class.
		$this->hook_actions();

	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.3.0
	 * @access private
	 * @return void
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
	 * Used to add panels by passing them in as an array.
	 *
	 * Wrapper around add_generic() method.
	 *
	 * @method add_panels
	 * @param  object $wp_customize the cusomizer manager object.
	 * @param  array  $panels array of panels to add in 'id' -> array() format.
	 */
	public function add_panels( $wp_customize, $panels = array() ) {
		if ( is_array( $panels ) && ! empty( $panels ) ) {
			$this->add_generic_items( $wp_customize, 'panel', $panels );
		}
	}

	/**
	 * Used to add different items to the various types of customizer elements.
	 * Can be used by wrappers.
	 *
	 * @method add_generic_items
	 * @param  object $wp_customize the cusomizer manager object.
	 * @param  string $item_type    A string representing the item type requested.
	 * @param  array  $items        An array of args in 'id' -> array() format.
	 */
	private function add_generic_items( $wp_customize, $item_type = '', $items = array() ) {
		if ( '' !== $item_type ) {
			foreach ( $items as $item_id => $item ) {
				$wp_customize->add_{$item_type}(
					$item_id,
					$item
				);
			}
		}
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

	public function settings( $wp_customize ) {

		$defaults = $this->setting_defaults;

		// Load custom sections.
		require_once $this->customizer_root . 'sections/class-help-section.php';

		// Register custom section types.
		$wp_customize->register_section_type( '\PattonWebz\Customizer\Help_Section' );

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
			'url'         => esc_url( '#' ),
			'description' => $description,
			'priority'    => 1,
		);

		// NOTE: You should filter in some custom values.
		$help_section_values = apply_filters( 'framebase_filter_upsell_values', $help_section_values );

		// Register the help section.
		$wp_customize->add_section(
			new \PattonWebz\Customizer\Help_Section(
				$wp_customize,
				'pattonwebz-customizer-section-help',
				$help_section_values
			)
		);
		// NOTE: Add some settings.
	}

	/**
	 * A helper function to return default settings through a filter.
	 *
	 * @return array an array of settings in key => value format.
	 */
	public function setting_defaults() {
		return apply_filters( 'pattonwebz_customize_filter_setting_defaults', $this->setting_defaults );
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
	 * @since  1.3.0
	 * @access public
	 */
	public function enqueue_scripts() {

		// NOTE: enqueue scripts and styles for use in customizer.
		// Script and styles for the custom 'help section'.
		wp_enqueue_script( 'pattonwebz-customize-controls-script', $this->customizer_uri . 'js/customize-controls.js', array( 'customize-controls' ), self::$version );
		wp_enqueue_style( 'pattonwebz-customize-controls-style', $this->customizer_uri . 'css/customize-controls.css', self::$version );
	}
}
