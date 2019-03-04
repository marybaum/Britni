<?php
/**
 * Cravings Pro
 *
 * This file adds the required WooCommerce setup functions to the Cravings Pro Theme.
 *
 * @package CravingsPro
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://studiopress.com
 */

defined( 'WPINC' ) || die;

add_filter( 'woocommerce_enqueue_styles', 'cravings_pro_wc_styles' );
/**
 * Enqueue the theme's custom WooCommerce styles to the WooCommerce plugin.
 *
 * @since 1.1.0
 *
 * @return array Required values for the theme's WooCommerce stylesheet.
 */
function cravings_pro_wc_styles( $enqueue_styles ) {
	$enqueue_styles['cravings-woocommerce-styles'] = array(
		'src'     => CRAVINGS_PRO_URI . 'css/woocommerce.css',
		'deps'    => '',
		'version' => CHILD_THEME_VERSION,
		'media'   => 'screen',
	);

	return $enqueue_styles;
}

add_filter( 'woocommerce_style_smallscreen_breakpoint', 'cravings_pro_wc_breakpoint' );
/**
 * Modify the WooCommerce breakpoints.
 *
 * @since 1.1.0
 */
function cravings_pro_wc_breakpoint() {
	$layouts = array(
		'content-sidebar',
		'sidebar-content',
	);

	if ( in_array( genesis_site_layout(), $layouts, true ) ) {
		return '1200px';
	}

	return '800px';
}

add_filter( 'genesiswooc_default_products_per_page', 'cravings_pro_wc_default_products_per_page' );
/**
 * Set the default products per page value.
 *
 * @since 1.1.0
 *
 * @return int Number of products to show per page.
 */
function cravings_pro_wc_default_products_per_page() {
	return 8;
}

add_filter( 'woocommerce_pagination_args', 	'cravings_pro_wc_pagination' );
/**
 * Update the next and previous arrows to the default Genesis style.
 *
 * @since 1.1.0
 *
 * @return string New next and previous text string.
 */
function cravings_pro_wc_pagination( $args ) {
	$args['prev_text'] = sprintf( '&laquo; %s', __( 'Previous Page', 'cravingspro' ) );
	$args['next_text'] = sprintf( '%s &raquo;', __( 'Next Page', 'cravingspro' ) );

	return $args;
}

add_action( 'after_switch_theme', 'cravings_pro_wc_after_switch_theme', 1 );
/**
 * Define WooCommerce image sizes on theme activation.
 *
 * @since 1.1.0
 */
function cravings_pro_wc_after_switch_theme() {
	global $pagenow;

	if ( isset( $_GET['activated'] ) && 'themes.php' === $pagenow ) {
		cravings_pro_wc_update_image_dimensions();
	}
}

add_action( 'activated_plugin', 'cravings_pro_wc_woo_activated', 10, 2 );
/**
 * Define the WooCommerce image sizes on WooCommerce activation.
 *
 * @since 1.1.0
 */
function cravings_pro_wc_woo_activated( $plugin ) {
	if ( 'woocommerce/woocommerce.php' === $plugin ) {
		cravings_pro_wc_update_image_dimensions();
	}
}

/**
 * Update WooCommerce image dimensions.
 *
 * @since 1.1.0
 */
function cravings_pro_wc_update_image_dimensions() {
	// Product category thumbs.
	update_option( 'shop_catalog_image_size', array(
		'width'  => '530',
		'height' => '530',
		'crop'   => 1,
	) );

	// Single product image.
	update_option( 'shop_single_image_size', array(
		'width'  => '720',
		'height' => '720',
		'crop'   => 1,
	) );

	// Image gallery thumbs.
	update_option( 'shop_thumbnail_image_size', array(
		'width'  => '180',
		'height' => '180',
		'crop'   => 1,
	) );
}
