<?php
/**
 * Template helper functions.
 *
 * @package   CravingsPro
 * @copyright Copyright (c) 2017, Feast Design Co.
 * @license   GPL-2.0+
 * @since     2.0.0
 */

/**
 * Check to see if the current blog page has the blog grid layout enabled.
 *
 * @since  1.0.0
 * @param  int $post_id The post ID to check.
 * @return bool true if the grid is enabled, false otherwise.
 */
function cravings_pro_is_grid_enabled( $post_id = false ) {
	static $enabled;

	if ( null === $enabled ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$enabled = get_post_meta( $post_id, '_cravings_pro_enable_grid', true );

		if ( empty( $enabled ) ) {
			$enabled = 'yes';
		}
	}

	return 'yes' === $enabled;
}

/**
 * Determine if we're viewing a "plural" page.
 *
 * Note that this is similar to, but not quite the same as `! is_singular()`,
 * which wouldn't account for the 404 page.
 *
 * @since  1.0.0
 * @access public
 * @return bool True if we're on any page which displays multiple entries.
 */
function cravings_pro_is_plural() {
	if ( genesis_is_blog_template() ) {
		return cravings_pro_is_grid_enabled();
	}

	return is_archive() || is_search();
}

/**
 * Determine if we're within a blog section archive.
 *
 * @since  1.0.0
 * @access public
 * @return bool True if we're on a blog archive page.
 */
function cravings_pro_is_blog_archive() {
	return cravings_pro_is_plural() && ! ( is_post_type_archive() || is_tax() );
}

/**
 * Determine if we're anywhere within the blog section of a Genesis site.
 *
 * @since  1.0.0
 * @access public
 * @return bool True if we're on any section of the blog.
 */
function cravings_pro_is_blog() {
	return cravings_pro_is_blog_archive() || is_singular( 'post' );
}

/**
 * Add post classes for a simple grid loop.
 *
 * @since  1.0.0
 * @access public
 * @param  int $columns The number of grid items desired.
 * @return array $classes The grid classes
 */
function cravings_pro_grid( $columns ) {
	if ( ! in_array( $columns, array( 2, 3, 4, 6 ), true ) ) {
		return array();
	}

	global $wp_query;

	$classes = array( 'simple-grid' );

	$column_classes = array(
		2 => 'one-half',
		3 => 'one-third',
		4 => 'one-fourth',
		6 => 'one-sixth',
	);

	$classes[] = $column_classes[ absint( $columns ) ];

	if ( ( $wp_query->current_post + 1 ) % 2 ) {
		$classes[] = 'odd';
	}

	if ( 0 === $wp_query->current_post || 0 === $wp_query->current_post % $columns ) {
		$classes[] = 'first';
	}

	return $classes;
}

/**
 * Set up a grid of one-half elements for use in a post_class filter.
 *
 * @since  1.0.0
 * @access public
 * @param  array $class An array of the current post classes.
 * @return array $class The post classes with the grid appended.
 */
function cravings_pro_grid_one_half( $class ) {
	return array_merge( cravings_pro_grid( 2 ), $class );
}

/**
 * Set up a grid of one-third elements for use in a post_class filter.
 *
 * @since  1.0.0
 * @access public
 * @param  array $class An array of the current post classes.
 * @return array $class The post classes with the grid appended.
 */
function cravings_pro_grid_one_third( $class ) {
	return array_merge( cravings_pro_grid( 3 ), $class );
}

/**
 * Set up a grid of one-fourth elements for use in a post_class filter.
 *
 * @since  1.0.0
 * @access public
 * @param  array $class An array of the current post classes.
 * @return array $class The post classes with the grid appended.
 */
function cravings_pro_grid_one_fourth( $class ) {
	return array_merge( cravings_pro_grid( 4 ), $class );
}

/**
 * Set up a grid of one-sixth elements for use in a post_class filter.
 *
 * @since  1.0.0
 * @access public
 * @param  array $class An array of the current post classes.
 * @return array $class The post classes with the grid appended.
 */
function cravings_pro_grid_one_sixth( $class ) {
	return array_merge( cravings_pro_grid( 6 ), $class );
}

/**
 * Helper function to determine if the requested grid function exists.
 *
 * @since  1.0.0
 * @access public
 * @param  string $grid the grid type to check.
 * @return bool|string false if no grid function exists, grid name otherwise.
 */
function cravings_pro_grid_exists( $grid ) {
	return function_exists( "cravings_pro_grid_{$grid}" ) ? $grid : false;
}

/**
 * Helper function to determine if we should use a grid archive filter.
 *
 * @since   2.0.0
 *
 * @return  bool $grid true if the archive grid is enabled
 */
function cravings_pro_archive_grid() {
	if ( ! cravings_pro_is_blog_archive() ) {
		return false;
	}

	$grid = cravings_pro_grid_exists( get_theme_mod( 'cravings_pro_archive_grid', 'full' ) );

	if ( ! $grid ) {
		return false;
	}

	return $grid;
}

/**
 * Get the default recipe index options.
 *
 * @since  1.0.0
 * @return array $options An array of default recipe index options.
 */
function cravings_pro_get_recipe_index_defaults() {
	return array(
		'cat'         => '',
		'cat_exclude' => '',
		'cat_num'     => 9,
	);
}

/**
 * Get the recipe index options for a given page.
 *
 * @since  1.0.0
 * @param  int $post_id The post ID to check.
 * @return array $options An array of recipe index options.
 */
function cravings_pro_get_recipe_index_options( $post_id ) {
	static $options;

	if ( null === $options ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$options = get_post_meta( $post_id, '_cravings_pro_recipe_options', true );
	}

	return $options;
}

/**
 * Get a recipe index option for a given page.
 *
 * @since  1.0.0
 * @param  string $key The key for the option to be retrieved.
 * @param  int    $post_id The post ID to check.
 * @return mixed $option The value of the option key provided.
 */
function cravings_pro_get_recipe_index_option( $key, $post_id = false ) {
	$options = cravings_pro_get_recipe_index_options( $post_id );
	$defaults = cravings_pro_get_recipe_index_defaults();

	return empty( $options[ $key ] ) ? $defaults[ $key ] : $options[ $key ];
}

/**
 * Add a button to toggle the filters on mobile.
 *
 * @since  1.1.0
 * @return void
 */
function cravings_pro_filter_toggle() {
	echo '<button class="filter-toggle">' . esc_html__( 'Filter', 'cravingspro' ) . '</button>';
}

/**
 * Add an opening wrapper around the sidebar widgets to make show/hiding them easier.
 *
 * @since  1.1.0
 * @return void
 */
function cravings_pro_filter_wrap_open() {
	echo '<div class="filter-wrap">';
}

/**
 * Add a closing wrapper around the sidebar widgets to make show/hiding them easier.
 *
 * @since  1.1.0
 * @return void
 */
function cravings_pro_filter_wrap_close() {
	echo '</div>';
}

/**
 * Displays a paginated navigation to next/previous set of posts, when applicable.
 *
 * @since  1.1.0
 * @access public
 * @return void
 */
function cravings_pro_posts_pagination() {
	echo get_the_posts_pagination( array(
		'prev_text' => apply_filters( 'genesis_prev_link_text', '&#x000AB; ' . __( 'Previous Page', 'cravingspro' ) ),
		'next_text' => apply_filters( 'genesis_next_link_text', __( 'Next Page', 'cravingspro' ) . ' &#x000BB;' ),
	) );
}
