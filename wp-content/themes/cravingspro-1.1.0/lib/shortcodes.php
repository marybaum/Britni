<?php
/**
 * This file adds custom shortcodes for the Cravings Pro theme.
 *
 * @package CravingsPro
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://feastdesignco.com
 */

defined( 'WPINC' ) || die;

add_shortcode( 'primary_post_category', 'cravings_pro_primary_post_category_shortcode' );
/**
 * Produces the primary category link.
 *
 * Supported shortcode attributes are:
 *   after (output after link, default is empty string),
 *   before (output before link, default is 'Tagged With: '),
 *   sep (separator string between tags, default is ', ').
 *
 * Output passes through 'cravings_pro_primary_post_category_shortcode' filter before returning.
 *
 * @since 1.1.0
 *
 * @param array|string $atts Shortcode attributes. Empty string if no attributes.
 *
 * @return string Output for `primary_post_category` shortcode.
 */
function cravings_pro_primary_post_category_shortcode( $atts ) {

	$defaults = array(
		'sep'    => ', ',
		'before' => '',
		'after'  => '',
	);

	$atts = shortcode_atts( $defaults, $atts, 'primary_post_category' );

	if ( class_exists( 'WPSEO_Frontend' ) ) { // if Yoast SEO is active.
		$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_ID() ); // WPSEO_Primary_Term Object.
		$wpseo_primary_term = $wpseo_primary_term->get_primary_term(); // term_id.
		$term = get_term( $wpseo_primary_term ); // WP_Term Object.

		if ( $term && ! is_wp_error( $term ) ) { // if primary category term exists.
			$cat_name = get_cat_name( $wpseo_primary_term );

			$cat_link = get_category_link( $wpseo_primary_term );

			$cat = '<a class="category" href="' . $cat_link . '">' . $cat_name . '</a>';

			// output primary category link.
			$output = sprintf( '', genesis_attr( 'entry-category' ) ) . $atts['before'] . $cat . $atts['after'] . '';

			return apply_filters( 'cravings_pro_primary_post_category_shortcode', $output, $atts );
		}
	} else {
		$cats = get_the_category_list( trim( $atts['sep'] ) . ' ' );

		// Do nothing if there are no categories.
		if ( ! $cats ) {
			return '';
		}

		$output = sprintf( '<span %s>', genesis_attr( 'entry-categories' ) ) . $atts['before'] . $cats . $atts['after'] . '</span>';

		return apply_filters( 'genesis_post_categories_shortcode', $output, $atts );
	}

}
