<?php
/**
 * PattonWebz Customizer Class for helper functions.
 *
 * @package PattonWebz_Customizer
 * @since   v1.2.0
 */

/**
 * Class of helper functions.
 */
class PattonWebz_Customizer_Helpers {
	/**
	 * Build an array of categories.
	 *
	 * @return array of site categories as a `term_id` => `name` array.
	 */
	public static function get_categories() {
		// get all the categories.
		$categories       = get_categories();
		$categories_array = array();

		// Add entry for all posts.
		$categories_array[0] = esc_html__( 'All Categories', 'pattonwebz' );
		// loop though categories and store key as `term_id` and value as `name`.
		foreach ( $categories as $category ) {
			$categories_array[ $category->term_id ] = $category->name;
		}
		// return an array of categories, otherwise empty array.
		return $categories_array;
	}
}
