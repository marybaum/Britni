<?php
/**
 * Admin functions.
 *
 * @package   CravingsPro\Functions\Admin
 * @copyright Copyright (c) 2017, Feast Design Co.
 * @license   GPL-2.0+
 * @since     3.0.0
 */

defined( 'WPINC' ) || die;

require_once CRAVINGS_PRO_DIR . 'lib/admin/metaboxes.php';

if ( (bool) apply_filters( 'cravings_pro_enable_theme_dashboard', true ) ) {
	require_once CRAVINGS_PRO_DIR . 'lib/admin/dashboard.php';
}

add_action( 'admin_enqueue_scripts', 'cravings_pro_load_admin_styles' );
/**
 * Enqueue Cravings Pro admin styles.
 *
 * @since   2.0.0
 * @uses   CHILD_THEME_VERSION
 * @return void
 */
function cravings_pro_load_admin_styles() {
	wp_enqueue_style(
		'cravings-pro-admin',
		CRAVINGS_PRO_URI . 'css/admin.css',
		array(),
		CHILD_THEME_VERSION
	);
}
