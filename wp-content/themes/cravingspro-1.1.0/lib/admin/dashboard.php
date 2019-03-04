<?php
/**
 * The Theme Dashboard.
 *
 * @package   CravingsPro\Functions\Admin
 * @copyright Copyright (c) 2017, Feast Design Co.
 * @license   GPL-2.0+
 * @since     3.0.0
 */

defined( 'WPINC' ) || die;

add_action( 'after_switch_theme', 'cravings_pro_dashboard_setup', 10 );
/**
 * Set up the dashboard options.
 *
 * @since   1.0.0
 * @access  public
 * @return  void
 */
function cravings_pro_dashboard_setup() {
	if ( ! is_network_admin() ) {
		add_option( 'cravings_pro_dashboard_redirect', true, '', 'no' );
	}
}

add_action( 'after_switch_theme', 'cravings_pro_dashboard_redirect', 12 );
/**
 * Add options and fire a redirect when the theme is first activated.
 *
 * @since   1.0.0
 * @access  public
 * @return  void
 */
function cravings_pro_dashboard_redirect() {
	// Bail if we've already been redirected.
	if ( is_network_admin() || ! get_option( 'cravings_pro_dashboard_redirect' ) ) {
		return;
	}

	// Make sure this doesn't go into a redirect loop.
	update_option( 'cravings_pro_dashboard_redirect', false );

	wp_safe_redirect( admin_url( 'admin.php?page=cravings-pro-dashboard' ) );
	exit;
}

add_action( 'switch_theme', 'cravings_pro_dashboard_cleanup', 10 );
/**
 * Remove our redirect option so we will be redirected again on the next activation.
 *
 * @since   1.0.0
 * @access  public
 * @return  void
 */
function cravings_pro_dashboard_cleanup() {
	delete_option( 'cravings_pro_dashboard_redirect' );
}

/**
 * Return the theme's SVG icon.
 *
 * @since  1.0.0
 * @access public
 * @return string A base64 encoded SVG icon for the theme.
 */
function cravings_pro_get_svg_icon() {
	$icon = 'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgMjAgMTguMyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAgMTguMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxnPjxwYXRoIGQ9Ik0xMCwxOC4zTDkuNiwxOEM5LjIsMTcuNywwLDExLjEsMCw1LjZDMCwyLjIsMi4xLDAsNS4yLDBDNi44LDAsOC42LDAuOCwxMCwyLjNDMTEuNCwwLjgsMTMuMiwwLDE0LjgsMEMxNy45LDAsMjAsMi4yLDIwLDUuNmMwLDUuNS05LjIsMTIuMi05LjYsMTIuNUwxMCwxOC4zeiBNNS4yLDEuNWMtMi43LDAtMy43LDIuMS0zLjcsNC4xYzAsMy43LDUuOCw4LjksOC41LDEwLjljMi43LTIuMSw4LjUtNy4yLDguNS0xMC45YzAtMi0xLTQuMS0zLjctNC4xYy0xLjMsMC0yLjcsMC43LTMuOSwyYzEsMS40LDEuNiwzLDEuNiw0LjNjMCwwLjgtMC4zLDEuNy0wLjksMi4yYy0wLjUsMC41LTEuMSwwLjgtMS43LDAuOFM4LjcsMTAuNSw4LjMsMTBDNy43LDkuNCw3LjQsOC42LDcuNCw3LjhDNy40LDYuNCw4LDQuOSw5LDMuNUM3LjksMi4yLDYuNSwxLjUsNS4yLDEuNXogTTEwLDQuN2MtMC43LDEtMS4xLDIuMi0xLjEsMy4xQzguOSw4LjIsOSw4LjcsOS4zLDljMC40LDAuNCwxLDAuNCwxLjQsMGMwLjMtMC4zLDAuNC0wLjcsMC40LTEuMkMxMS4xLDYuOSwxMC43LDUuOCwxMCw0Ljd6Ii8+PC9nPjwvZz48L3N2Zz4=';

	return "data:image/svg+xml;base64,{$icon}";
}

add_action( 'admin_menu', 'cravings_pro_dashboard_menu', 0 );
/**
 * Add the theme dashboard to the main WordPress dashboard menu.
 *
 * @since   1.0.0
 * @access  public
 * @return  void
 */
function cravings_pro_dashboard_menu() {
	add_menu_page(
		'Cravings Pro',
		'Cravings Pro',
		'edit_theme_options',
		'cravings-pro-dashboard',
		'cravings_pro_dashboard_page',
		cravings_pro_get_svg_icon(),
		'58.997'
	);
}

/**
 * Include the base template for our dashboard page.
 *
 * @since   1.0.0
 * @access  public
 * @return  void
 */
function cravings_pro_dashboard_page() {
	require_once CRAVINGS_PRO_DIR . 'lib/admin/views/dashboard.php';
}

add_action( 'admin_enqueue_scripts', 'cravings_pro_dashboard_scripts', 10 );
/**
 * Load scripts and styles for the dashboard.
 *
 * @since   1.0.0
 * @access  public
 * @param   object $screen The current screen object.
 * @return  void
 */
function cravings_pro_dashboard_scripts( $screen ) {
	if ( 'toplevel_page_cravings-pro-dashboard' === $screen ) {
		wp_enqueue_style(
			'cravings-pro-dashboard',
			CRAVINGS_PRO_URI . 'css/dashboard.css',
			array(),
			CHILD_THEME_VERSION
		);
	}
}
