<?php
/**
 * Template Name: Recipe Filter Index
 *
 * @package   CravingsPro\Templates
 * @copyright Copyright (c) 2017, Feast Design Co
 * @license   GPL-2.0+
 * @since     1.0.0
 */

add_filter( 'post_class', 'cravings_pro_grid_one_third', 10 );

add_filter( 'genesis_pre_get_option_image_size', 'cravings_pro_recipe_index_change_image_size', 10 );
/**
 * Use the grid image size on pages where the grid layout is enabled.
 *
 * @since  1.0.0
 * @return string $setting The modified setting.
 */
function cravings_pro_recipe_index_change_image_size() {
	return 'square-thumbnail';
}

if ( is_active_sidebar( 'recipes-filter-sidebar' ) ) {
	add_action( 'genesis_before_sidebar_widget_area', 'cravings_pro_filter_toggle', -1 );
	add_action( 'genesis_before_sidebar_alt_widget_area', 'cravings_pro_filter_toggle', -1 );

	add_action( 'genesis_before_sidebar_widget_area', 'cravings_pro_filter_wrap_open', 0 );
	add_action( 'genesis_before_sidebar_alt_widget_area', 'cravings_pro_filter_wrap_open', 0 );

	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
	remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );
	add_action( 'genesis_sidebar', 'cravings_pro_recipe_index_sidebar' );
	add_action( 'genesis_sidebar_alt', 'cravings_pro_recipe_index_sidebar' );

	add_action( 'genesis_after_sidebar_widget_area', 'cravings_pro_filter_wrap_close', 0 );
	add_action( 'genesis_after_sidebar_alt_widget_area', 'cravings_pro_filter_wrap_close', 0 );
}

/**
 * Output the recipe index sidebar.
 *
 * @since  1.0.0
 * @return void
 */
function cravings_pro_recipe_index_sidebar() {
	genesis_widget_area( 'recipes-filter-sidebar', array(
		'before' => '',
		'after'  => '',
	));
}

remove_action( 'genesis_loop', 'genesis_do_loop', 10 );
add_action( 'genesis_loop', 'cravings_pro_recipe_index_loop', 10 );
/**
 * Display the recipe index sidebar.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function cravings_pro_recipe_index_loop() {
	$args = array(
		'post_type'        => 'post',
		'posts_per_page'   => cravings_pro_get_recipe_index_option( 'cat_num' ),
		'facetwp'          => true,
		'paged'            => get_query_var( 'paged' ),
	);

	$cat = cravings_pro_get_recipe_index_option( 'cat' );

	if ( ! empty( $cat ) ) {
		$args['cat'] = $cat;
	}

	$exclude = cravings_pro_get_recipe_index_option( 'cat_exclude' );

	if ( ! empty( $exclude ) ) {
		$args['category__not_in'] = explode( ',', $exclude );
	}

	remove_action( 'genesis_entry_content', 'genesis_do_post_content', 10 );
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

	echo '<div class="facetwp-template recipe-index">';

	genesis_custom_loop( $args );

	echo '</div>';

	add_action( 'genesis_entry_content', 'genesis_do_post_content', 10 );
	add_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	add_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	add_action( 'genesis_entry_footer', 'genesis_post_meta' );
	add_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
}

remove_action( 'genesis_after_endwhile', 'genesis_posts_nav', 10 );
add_action( 'genesis_after_endwhile', 'cravings_pro_posts_pagination', 10 );

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 5 );

genesis();
