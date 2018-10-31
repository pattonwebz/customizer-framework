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
	 * Build an array of categories.
	 *
	 * @return array The site categories as a `term_id` => `name` keyed array.
	 */
	public static function get_categories() {
		// get all the categories.
		$categories       = get_categories();
		$categories_array = [];

		// Add a new entry to indicate all posts.
		$categories_array[0] = esc_html__( 'All Categories', 'pattonwebz' );
		// loop though categories and store key as `term_id` and value as `name`.
		foreach ( $categories as $category ) {
			$categories_array[ $category->term_id ] = $category->name;
		}
		// return an array of available categories.
		return apply_filters( 'pattonwebz_customize_filter_categories_list', $categories_array );
	}
}
