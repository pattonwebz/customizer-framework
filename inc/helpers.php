<?php
/**
 * PattonWebz Customizer Class for helper functions.
 *
 * @package   PattonWebz_Customizer
 * @since     v2.0.0
 * @author    William Patton <will@pattonwebz.com>
 * @copyright Copyright (c) 2018, William Patton
 * @link      https://github.com/pattonwebz/customizer-framework/
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace PattonWebz\Customizer\Helpers;

/**
 * Class of helper functions.
 */
class Helpers {

	/**
	 * Sets up the helpers functions.
	 */
	public function __construct() {
		$this->require_helpers();
	}

	/**
	 * Does the require for helper functions.
	 */
	private function require_helpers() {
		require_once __dir__ . '/helpers/helpers.php';
	}

}
