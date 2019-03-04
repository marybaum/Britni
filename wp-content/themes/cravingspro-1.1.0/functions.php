<?php
/**
 * Custom amendments for the theme.
 *
 * @package   CravingsPro
 * @copyright Copyright (c) 2018, Feast Design Co.
 * @license   GPL-2.0+
 * @since     1.0.0
 */

defined( 'WPINC' ) || die;

require_once trailingslashit( get_template_directory() ) . 'lib/init.php';

define( 'CHILD_THEME_NAME', 'Cravings Pro Theme' );
define( 'CHILD_THEME_VERSION', '1.1.0' );
define( 'CHILD_THEME_URL', 'https://feastdesignco.com/product/cravings-pro/' );
define( 'CHILD_THEME_DEVELOPER', 'Feast Design Co.' );
define( 'CRAVINGS_PRO_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'CRAVINGS_PRO_URI', trailingslashit( get_stylesheet_directory_uri() ) );

// Load the child theme textdomain.
add_action( 'after_setup_theme', 'cravings_pro_load_textdomain' );
function cravings_pro_load_textdomain() {
	load_child_theme_textdomain( 'cravingspro', CRAVINGS_PRO_DIR . 'languages' );
}

// Add HTML5 markup structure.
add_theme_support( 'html5', array(
	'caption',
	'comment-form',
	'comment-list',
	'gallery',
	'search-form',
) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 430,
	'height'          => 110,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
	'flex-width'      => true,
) );

// Add support for WooCommerce features.
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
add_theme_support( 'wc-product-gallery-zoom' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Load theme support for footer widgets.
add_theme_support( 'genesis-footer-widgets', 4 );

// Add image sizes.
add_image_size( 'featured', 645, 650, true );
add_image_size( 'featured-retina', 970, 978, true );
add_image_size( 'square-thumbnail', 360, 361, true );
add_image_size( 'square-thumbnail-retina', 720, 722, true );
add_image_size( 'vertical-thumbnail', 360, 495, true );
add_image_size( 'vertical-thumbnail-retina', 720, 991, true );

// Remove header right widget area.
unregister_sidebar( 'header-right' );

// Remove secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Remove site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Register Widget Areas
genesis_register_sidebar( array(
	'id'			=> 'before-header',
	'name'			=> __( 'Before Header', 'cravingspro' ),
	'description'	=> __( 'This is the section before the header.', 'cravingspro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-top',
	'name'			=> __( 'Home Top', 'cravingspro' ),
	'description'	=> __( 'This is the home top section.', 'cravingspro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle',
	'name'			=> __( 'Home Middle', 'cravingspro' ),
	'description'	=> __( 'This is the home middle section.', 'cravingspro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom',
	'name'			=> __( 'Home Bottom', 'cravingspro' ),
	'description'	=> __( 'This is the home bottom section.', 'cravingspro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'recipes-top',
	'name'			=> __( 'Recipes Top', 'cravingspro' ),
	'description'	=> __( 'This is the recipes top section.', 'cravingspro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'recipes-bottom',
	'name'			=> __( 'Recipes Bottom', 'cravingspro' ),
	'description'	=> __( 'This is the recipes bottom section.', 'cravingspro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'recipes-sidebar',
	'name'			=> __( 'Recipes Sidebar', 'cravingspro' ),
	'description'	=> __( 'This is the primary sidebar for the widgeted recipe index page templates.', 'cravingspro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'recipes-filter-sidebar',
	'name'			=> __( 'Recipes Filter Sidebar', 'cravingspro' ),
	'description'	=> __( 'This is the primary sidebar for the filter recipe index page templates.', 'cravingspro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'nav-social-menu',
	'name'        => __( 'Nav Social Menu', 'cravingspro' ),
	'description' => __( 'This is the nav social menu section.', 'cravingspro' ),
) );

require_once CRAVINGS_PRO_DIR . 'lib/customize/init.php';
require_once CRAVINGS_PRO_DIR . 'lib/theme-defaults.php';
require_once CRAVINGS_PRO_DIR . 'lib/helpers.php';
require_once CRAVINGS_PRO_DIR . 'lib/shortcodes.php';

if ( class_exists( 'WooCommerce', false ) ) {
	require_once CRAVINGS_PRO_DIR . 'lib/woocommerce.php';
}

if ( function_exists( 'FWP' ) ) {
	require_once CRAVINGS_PRO_DIR . 'lib/facetwp.php';
}

if ( is_admin() ) {
	require_once CRAVINGS_PRO_DIR . 'lib/admin/register-plugins.php';
	require_once CRAVINGS_PRO_DIR . 'lib/admin/functions.php';
}

// Set the content width and allow it to be filtered directly.
add_action( 'after_setup_theme', 'cravings_pro_content_width', 0 );
function cravings_pro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cravings_pro_content_width', 720 );
}

// Unregister the default Genesis Featured Posts widget and register custom Cravings Pro widgets.
add_action( 'widgets_init', 'cravings_pro_register_widgets', 11 );
function cravings_pro_register_widgets() {
	require_once CRAVINGS_PRO_DIR . 'lib/widgets/featured-posts/widget.php';

	unregister_widget( 'Genesis_Featured_Post' );
	register_widget( 'Cravings_Pro_Featured_Posts' );
}

// Load all required JavaScript for the Cravings theme.
add_action( 'wp_enqueue_scripts', 'cravings_pro_enqueue_js' );
function cravings_pro_enqueue_js() {
	wp_enqueue_script(
		'cravings-pro-general',
		CRAVINGS_PRO_URI . 'js/general.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);
}

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Reposition secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 12 );

// Reduce secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'cravings_pro_secondary_menu_args' );
function cravings_pro_secondary_menu_args( $args ) {
	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;
}

// Remove output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

// Append a social widget area to the primary menu.
add_filter( 'wp_nav_menu_items', 'cravings_pro_primary_nav_menu_social', 10, 2 );
function cravings_pro_primary_nav_menu_social( $menu, $args ) {
	if ( 'primary' !== $args->theme_location || ! is_active_sidebar( 'nav-social-menu' ) ) {
		return $menu;
	}

	ob_start();
	genesis_widget_area( 'nav-social-menu' );
	$widget_area = ob_get_clean();

	$menu .= sprintf( '<li id="cravings-social" class="cravings-social menu-item">%s</li>',
		$widget_area
	);

	return $menu;
}

// Append a search box to the primary menu.
add_filter( 'wp_nav_menu_items', 'cravings_pro_primary_nav_menu_search', 12, 2 );
function cravings_pro_primary_nav_menu_search( $menu, $args ) {
	if ( 'primary' !== $args->theme_location || genesis_get_option( 'nav_extras' ) ) {
		return $menu;
	}

	$menu .= sprintf( '<li id="cravings-search" class="cravings-search menu-item">%s</li>',
		genesis_search_form( false )
	);

	return $menu;
}

// Customize search form input box text
add_filter( 'genesis_search_text', 'cravings_pro_search_text' );
function cravings_pro_search_text( $text ) {
	return esc_attr__( 'search...', 'cravingspro' );
}

// Modify Gravatar size in author box.
add_filter( 'genesis_author_box_gravatar_size', 'cravings_pro_author_box_gravatar' );
function cravings_pro_author_box_gravatar( $size ) {
	return 90;
}

// Customize entry meta in entry header.
add_filter( 'genesis_post_info', 'cravings_pro_entry_meta_header' );
function cravings_pro_entry_meta_header( $post_info ) {
	return '[heart_this] <span class="dot">&middot;</span> [post_date format="M j, Y"] <span class="dot">&middot;</span> [post_comments] [post_edit]';
}

// Customize entry meta in entry footer.
add_filter( 'genesis_post_meta', 'cravings_pro_entry_meta_footer' );
function cravings_pro_entry_meta_footer( $post_meta ) {
	return '[post_categories before=""] [post_tags before=""]';
}

// Modify the Genesis read more link.
add_filter( 'excerpt_more', 'cravings_pro_read_more_link' );
add_filter( 'get_the_content_more_link', 'cravings_pro_read_more_link' );
add_filter( 'the_content_more_link', 'cravings_pro_read_more_link' );
function cravings_pro_read_more_link() {
	return sprintf( '...</p><p><a class="more-link" href="%s">%s</a></p>',
		get_permalink(),
		esc_html__( 'Read More', 'cravingspro' )
	);
}

// Add the theme name class to the body element.
add_filter( 'body_class', 'cravings_pro_add_body_class' );
function cravings_pro_add_body_class( $classes ) {
	$classes[] = 'cravings-pro';
	return $classes;
}

//  Load an ad section before .site-inner.
add_action( 'genesis_before', 'cravings_pro_before_header' );
function cravings_pro_before_header() {
	genesis_widget_area( 'before-header', array(
		'before' => '<div id="before-header" class="before-header">',
		'after'  => '</div> <!-- end .before-header -->',
	) );
}

// Give Feast Design Co. credit in the footer.
add_filter( 'genesis_footer_creds_text', 'cravings_pro_footer_creds_text' );
function cravings_pro_footer_creds_text( $creds ) {
	return '[footer_copyright before="Copyright "] &middot; <a href="https://feastdesignco.com/product/cravings-pro/">Cravings Pro</a>';
}
