<?php
/**
 * Class to add a section and it's supporting styles/scripts to output a button
 * and some text in a top level panel of the customizer.
 *
 * @package PattonWebz_Customize
 * @since   1.0.0
 */

/**
 * Get help section.
 *
 * @since  1.0.0
 * @access public
 */
class PattonWebz_Help_Section extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * This is the name of the section type.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'pattonwebz-customizer-section-help';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $text = '';

	/**
	 * Custom button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $url = '';

	/**
	 * Custom description text.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $description = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function json() {
		$json = parent::json();

		$json['text']        = $this->text;
		$json['url']         = esc_url( $this->url );
		$json['description'] = $this->description;

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.text && data.url ) { #>
					<a href="{{ data.url }}" class="button button-primary alignright" target="_blank">{{ data.text }}</a>
				<# } #>
			</h3>
			<# if ( data.description ) { #>
			<div class="info" style="display:none;">
				{{ data.description }}
			</div>
			<# } #>
		</li>
		<?php
	}
}
