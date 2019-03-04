<?php
/**
 * Home Page Template
 *
 * @package   CravingsPro
 * @copyright Copyright (c) 2017, Shay Bocks
 * @license   GPL-2.0+
 * @link      http://www.feastdesignco.com/
 * @since     1.0.0
 */

add_action( 'genesis_before_loop', 'cravings_pro_home_maybe_remove_loop' );
add_action( 'genesis_before_content_sidebar_wrap', 'cravings_pro_home_top' );
add_action( 'genesis_loop', 'cravings_pro_home_middle', 10 );
add_action( 'genesis_loop', 'cravings_pro_home_bottom', 15 );

// Remove the default loop if the home bottom widget area is
function cravings_pro_home_maybe_remove_loop() {
	if ( is_active_sidebar( 'home-middle' ) || is_active_sidebar( 'home-bottom' ) ) {
		remove_action( 'genesis_loop', 'genesis_do_loop' );
	}
}

// Display the Home Top widgeted section.
function cravings_pro_home_top() {
	genesis_widget_area( 'home-top', array(
		'before' => '<div class="home-top">',
		'after'  => '</div> <!-- end .home-top -->',
	) );
}

// Display the Home Middle widgeted section.
function cravings_pro_home_middle() {
	genesis_widget_area( 'home-middle', array(
		'before' => '<div class="widget-area home-middle">',
		'after'  => '</div> <!-- end .home-middle -->',
	) );
}

// Display the Home Bottom widgeted section.
function cravings_pro_home_bottom() {
	genesis_widget_area( 'home-bottom', array(
		'before' => '<div class="widget-area home-bottom">',
		'after'  => '</div> <!-- end .home-bottom -->',
	) );
}

genesis();
