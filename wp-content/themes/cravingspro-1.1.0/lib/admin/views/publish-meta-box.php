<?php
/**
 * Template to display the WP Featherlight admin sidebar meta box.
 *
 * @package   CravingsPro\Views
 * @copyright Copyright (c) 2017, Feast Design Co
 * @license   GPL-2.0+
 * @since     1.0.0
 */

?>
<div id="cravings-pro-enable-wrap" class="misc-pub-section cravings-pro-enable" style="position:relative;">
	<label for="_cravings_pro_enable_grid">
		<input type="checkbox" name="_cravings_pro_enable_grid" id="_cravings_pro_enable_grid" value="yes"<?php checked( $enable, true ); ?> />
		<?php esc_html_e( 'Enable Grid Layout', 'cravingspro' ); ?>
	</label>
</div>
<?php wp_nonce_field( 'save_cravings_pro_metabox', 'cravings_pro_metabox_nonce' ); ?>
