<?php
/**
 * Cravings Pro.
 *
 * This file adds the default theme settings to the Monochrome Pro Theme.
 *
 * @package CravingsPro
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://feastdesignco.com
 */

defined( 'WPINC' ) || die;

add_filter( 'genesis_theme_settings_defaults', 'cravings_pro_theme_defaults' );
/**
 * Updates theme settings on reset.
 *
 * @since 1.0.0
 */
function cravings_pro_theme_defaults( $defaults ) {
	$defaults['blog_cat_num']              = 5;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 0;
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';

	return $defaults;
}

add_action( 'after_switch_theme', 'cravings_pro_theme_setting_defaults' );
/**
 * Updates theme settings on activation.
 *
 * @since 1.0.0
 */
function cravings_pro_theme_setting_defaults() {
	// Prevent fatal errors on new installs by loading settings init first.
	if ( ! get_option( GENESIS_SETTINGS_FIELD ) ) {
		genesis_settings_sanitizer_init();
	}

	$custom_settings = array(
		'blog_cat_num'              => 5,
		'content_archive'           => 'full',
		'content_archive_limit'     => 0,
		'content_archive_thumbnail' => 0,
		'posts_nav'                 => 'numeric',
		'site_layout'               => 'content-sidebar',
	);

	if ( function_exists( 'genesis_update_settings' ) ) {
		genesis_update_settings( $custom_settings );
	} else {
		_genesis_update_settings( $custom_settings );
	}

	update_option( 'posts_per_page', 24 );
}

add_filter( 'simple_social_default_styles', 'cravings_pro_social_default_styles' );
/**
 * Updates Simple Social Icon settings on activation.
 *
 * @since 1.0.0
 */
function cravings_pro_social_default_styles( $defaults ) {
	$args = array(
		'alignment'              => 'aligncenter',
		'background_color'       => '#ffffff',
		'background_color_hover' => '#536ade',
		'border_radius'          => 27,
		'icon_color'             => '#323545',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 27,
	);

	$args = wp_parse_args( $args, $defaults );

	return $args;
}
