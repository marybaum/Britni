<?php
/**
 * Set up and include all necessary customizer files.
 *
 * @package   CravingsPro\Functions\Customizer
 * @copyright Copyright (c) 2017, Feast Design Co.
 * @license   GPL-2.0+
 * @since     3.0.0
 */

defined( 'WPINC' ) || die;

/**
 * An array of the color settings used in Cravings Pro.
 *
 * @since  2.0.3
 * @return array $colors
 */
function cravings_pro_get_colors() {
	$colors = array(
		'cravings_bg_color' => array(
			'default'  => '#ffffff',
			'label'    => __( 'Main Background Color', 'cravingspro' ),
			'section'  => 'general',
			'selector' => 'body, .site-header',
			'rule'     => 'background',
		),
		'cravings_container_bg_color' => array(
			'default'  => '#ffffff',
			'label'    => __( 'Container Background Color', 'cravingspro' ),
			'section'  => 'general',
			'selector' => '.site-inner',
			'rule'     => 'background',
		),
		'cravings_accent_color' => array(
			'default'  => '#f7f9fc',
			'label'    => __( 'Accent Background Color', 'cravingspro' ),
			'section'  => 'general',
			'selector' => '.before-header, .footer-widgets, .form-allowed-tags, .more-from-category',
			'rule'     => 'background',
		),
		'cravings_site_title_color' => array(
			'default'  => '#323545',
			'label'    => __( 'Site Title Color', 'cravingspro' ),
			'section'  => 'general',
			'selector' => '.site-title a, .site-title a:hover',
			'rule'     => 'color',
		),
		'cravings_text_color' => array(
			'default'  => '#323545',
			'label'    => __( 'Text Color', 'cravingspro' ),
			'section'  => 'content',
			'selector' => 'body, .site-description, .sidebar a, .entry-meta a:hover .site-footer a:hover, .entry-categories a:hover, .entry-tags a:hover',
			'rule'     => 'color',
		),
		'cravings_entry_title_color' => array(
			'default'  => '#323545',
			'label'    => __( 'Title Color', 'cravingspro' ),
			'section'  => 'content',
			'selector' => 'h1.entry-title, .entry-title a, .widgettitle, .recipes-top .widgettitle, .footer-widgets .widgettitle',
			'rule'     => 'color',
		),
		'cravings_secondary_text_color' => array(
			'default'  => '#aaaaaa',
			'label'    => __( 'Secondary Text Color', 'cravingspro' ),
			'section'  => 'content',
			'selector' => '.entry-meta, .entry-meta a, .post-info, .post-info a, .post-meta, .post-meta a, .site-footer, .site-footer a, .entry-categories a, .entry-tags a',
			'rule'     => 'color',
		),
		'cravings_link_color' => array(
			'default'  => '#536ade',
			'label'    => __( 'Link Color', 'cravingspro' ),
			'section'  => 'content',
			'selector' => 'a, .entry-title a:hover, .entry-title a:focus, .site-title a:hover',
			'rule'     => 'color',
		),
		'cravings_link_hover_color' => array(
			'default'  => '#bbbbb',
			'label'    => __( 'Link Hover Color', 'cravingspro' ),
			'section'  => 'content',
			'selector' => 'a:hover, .entry-meta a:hover, .post-info a:hover, .post-info a:focus, .post-meta a:hover, .post-meta a:focus, .site-footer a:hover, site0footer a:focus',
			'rule'     => 'color',
		),
		'cravings_menu_link_color' => array(
			'default'  => '#979599',
			'label'    => __( 'Menu Link Color', 'cravingspro' ),
			'section'  => 'menus',
			'selector' => '.genesis-nav-menu a',
			'rule'     => 'color',
		),
		'cravings_menu_link_hover_color' => array(
			'default'  => '#536ade',
			'label'    => __( 'Menu Link Hover Color', 'cravingspro' ),
			'section'  => 'menus',
			'selector' => '.genesis-nav-menu a:hover, .genesis-nav-menu a:focus, .genesis-nav-menu .current-menu-item > a, .nav-primary .genesis-nav-menu .sub-menu a:focus, .nav-primary .genesis-nav-menu .sub-menu a:hover',
			'rule'     => 'color',
		),
		'cravings_button_color' => array(
			'default'  => '#ffffff',
			'label'    => __( 'Button Color', 'cravingspro' ),
			'section'  => 'buttons',
			'selector' => '.button, button, .content .enews-widget input[type="submit"], .sidebar .enews-widget input[type="submit"], a.more-link, .sidebar .button, input[type="submit"], input[type="button"]',
			'rule'     => 'background',
		),
		'cravings_button_border_color' => array(
			'default'  => '#536ade',
			'label'    => __( 'Button Border Color', 'cravingspro' ),
			'section'  => 'buttons',
			'selector' => '.button, button, .enews-widget input[type="submit"], a.more-link, input[type="submit"], input[type="button"]',
			'rule'     => 'border-color',
		),
		'cravings_button_hover_color' => array(
			'default'  => '#536ade',
			'label'    => __( 'Button Hover Color', 'cravingspro' ),
			'section'  => 'buttons',
			'selector' => '.button:hover, button:hover, .button:focus, .button:active, button:focus, button:active, .enews-widget input[type="submit"]:hover, .enews-widget input[type="submit"]:focus, a.more-link:hover, a.more-link:focus, .before-header .enews-widget input[type="submit"], .content .enews-widget input[type="submit"]:hover, .content .enews-widget input[type="submit"]:focus, .sidebar .enews-widget input[type="submit"]:hover, .sidebar .enews-widget input[type="submit"]:focus, input[type="submit"]:hover, input[type="submit"]:focus, input[type="submit"]:active, input[type="button"]:hover, input[type="button"]:focus, input[type="button"]:active',
			'rule'     => 'background',
		),
		'cravings_button_text_color' => array(
			'default'  => '#536ade',
			'label'    => __( 'Button Text Color', 'cravingspro' ),
			'section'  => 'buttons',
			'selector' => '.button, button, .enews-widget input[type="submit"], a.more-link, input[type="submit"], input[type="button"]',
			'rule'     => 'color',
		),
		'cravings_button_text_hover_color' => array(
			'default'  => '#ffffff',
			'label'    => __( 'Button Hover Text Color', 'cravingspro' ),
			'section'  => 'buttons',
			'selector' => '.button:hover, button:hover, .enews-widget input[type="submit"]:hover, a.more-link:hover, input[type="submit"]:hover, input[type="submit"]:focus, input[type="submit"]:active, input[type="button"]:hover, input[type="button"]:focus, input[type="button"]:active',
			'rule'     => 'color',
		),
	);
	return apply_filters( 'cravings_pro_get_colors', $colors );
}

/**
 * An array of the font settings used in Cravings Pro.
 *
 * @since  2.0.0
 *
 * @return array $fonts
 */
function cravings_pro_get_fonts() {
	$fonts = array(
		'cravings_body_font' => array(
			'default_family' => 'Karma',
			'default_size'   => '17px',
			'default_style'  => 'disabled',
			'default_weight' => '400',
			'label'          => __( 'Body Font', 'cravingspro' ),
			'description'    => __( 'Customize your body font by changing the options below.', 'cravingspro' ),
			'selector'       => 'body, .site-description, .sidebar .featured-content .entry-title ',
		),
		'cravings_accent_font' => array(
			'default_family' => 'Work Sans',
			'default_size'   => 'disabled',
			'default_style'  => 'normal',
			'default_weight' => '400',
			'label'          => __( 'Menu & Widget Title Font', 'cravingspro' ),
			'description'    => __( 'Customize your menu & widget title font by changing the options below.', 'cravingspro' ),
			'selector'       => '.genesis-nav-menu a, .widgettitle, .sidebar .featured-content .entry-title, .site-footer',
		),
		'cravings_heading_font' => array(
			'default_family' => 'Work Sans',
			'default_size'   => 'disabled',
			'default_style'  => 'normal',
			'default_weight' => '400',
			'label'          => __( 'Headings Font', 'cravingspro' ),
			'description'    => __( 'Customize your headings--h1,h2,h3,h4--font by changing the options below.', 'cravingspro' ),
			'selector'       => 'h1, h2, h3, h4, h5, h6, .site-title, .entry-title',
		),
		'cravings_entry_title_font' => array(
			'default_family' => 'Work Sans',
			'default_size'   => '27px',
			'default_style'  => 'normal',
			'default_weight' => '400',
			'label'          => __( 'Entry Title Font', 'cravingspro' ),
			'description'    => __( 'Customize your entry title font by changing the options below.', 'cravingspro' ),
			'selector'       => '.entry-title',
		),
		'cravings_button_font' => array(
			'default_family' => 'Work Sans',
			'default_size'   => '13px',
			'default_style'  => 'normal',
			'default_weight' => '400',
			'label'          => __( 'Button Font', 'cravingspro' ),
			'description'    => __( 'Customize your button font by changing the options below.', 'cravingspro' ),
			'selector'       => '.button, .button-secondary, button, input[type="button"], input[type="reset"], input[type="submit"], a.more-link, .more-from-category a',
		),
	);
	return apply_filters( 'cravings_pro_get_fonts', $fonts );
}
