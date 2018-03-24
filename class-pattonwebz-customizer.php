<?php
/**
 * The main customizer class for the theme used to add all panels, sections,
 * settings and controls used in the theme.
 *
 * @package PattonWebz_Customize
 * @since 1.0.0
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
class PattonWebz_Customizer {

	/**
	 * Holds an instance of the class.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var stdObject
	 */
	private static $instance = null;

	/**
	 * The absolute directory to the customizer package.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	private $customizer_root = '';

	/**
	 * The uri to the customizer package directory.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	private $customizer_uri = '';

	/**
	 * Returns the instance of this class. There can be only 1 instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		// if an instance doesn't already exist then instanciate one.
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		// return an instance of the class.
		return self::$instance;
	}

	/**
	 * Constructor method for this class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {
		// setup actions for the customizer class.
		self::setup_actions();
		// assumes directory will be /path/to/theme/inc/customizer/.
		$this->customizer_root = trailingslashit( dirname( __FILE__ ) );
		// TODO: get this directory url properly by matching against directory structure.
		$this->customizer_uri = trailingslashit( get_template_directory_uri() ) . 'inc/customizer/';
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
		// start a holder array
		$help_section_values = array(
			'title'       => esc_html( wp_get_theme()->get( 'Name' ) ), // current theme name.
			'text'        => esc_html__( 'Help and Support', 'pattonwebz' ),
			'url'         => esc_url( 'https://www.pattonwebz.com/contact/' ),
			'description' => $description,
			'priority'    => 1,
		);

		// NOTE: You should filter in some custom values.
		$help_section_values = apply_filters( 'best_reloaded_filter_upsell_values', $help_section_values );

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
	 * Adds the settings, sets their defaults and sanitization callbacks.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param object $wp_customize the WordPress customizer object.
	 */
	public function settings( $wp_customize ) {
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
		wp_enqueue_script( 'pattonwebz-customize-controls-script', $this->customizer_uri . 'js/customize-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'pattonwebz-customize-controls-styles', $this->customizer_uri . 'css/customize-controls.css' );
	}
}
