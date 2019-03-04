<?php
/**
 * Template Name: Recipe Index
 *
 * @package   CravingsPro
 * @copyright Copyright (c) 2017, Feast Design Co.
 * @license   GPL-2.0+
 * @since     1.0.0
 */

if ( is_active_sidebar( 'recipes-top' ) || is_active_sidebar( 'recipes-bottom' ) ) {
	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_loop', 'cravings_pro_recipes_loop_helper' );
}

if ( is_active_sidebar( 'recipes-sidebar' ) ) {
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
	remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );
	add_action( 'genesis_sidebar', 'cravings_pro_widget_recipes_sidebar' );
	add_action( 'genesis_sidebar_alt', 'cravings_pro_widget_recipes_sidebar' );
}

/**
 * Output the recipe index sidebar.
 *
 * @since  1.0.0
 * @return void
 */
function cravings_pro_widget_recipes_sidebar() {
	genesis_widget_area( 'recipes-sidebar', array(
		'before' => '',
		'after'  => '',
	));
}

/**
 * Display the recipe page widgeted sections.
 *
 * @since 1.0.0
 */
function cravings_pro_recipes_loop_helper() {
	genesis_widget_area( 'recipes-top',  array(
		'before' => '<div class="widget-area recipes-top">',
		'after'  => '</div> <!-- end .recipes-top -->',
	) );

	genesis_widget_area( 'recipes-bottom', array(
		'before' => '<div class="widget-area recipes-bottom">',
		'after'  => '</div> <!-- end .recipes-bottom -->',
	) );
}

genesis();
