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
<p><span class="description"><?php esc_html_e( 'These settings apply only to this recipe archive page.', 'cravingspro' ); ?></span></p>
<table class="form-table">
<tbody>

	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Display Category', 'cravingspro' ); ?></th>
		<td>
			<p>
				<label for="_cravings_pro_recipe_options[cat]" class="screen-reader-text"><?php _e( 'Display which category:', 'cravingspro' ); ?></label>
				<?php
				wp_dropdown_categories( array(
					'selected'        => cravings_pro_get_recipe_index_option( 'cat', $post->ID ),
					'name'            => '_cravings_pro_recipe_options[cat]',
					'orderby'         => 'Name',
					'hierarchical'    => 1,
					'show_option_all' => __( 'All Categories', 'cravingspro' ),
					'hide_empty'      => '0',
				) );
				?>
			</p>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row"><label for="_cravings_pro_recipe_options[cat_exclude]"><?php esc_html_e( 'Exclude Categories', 'cravingspro' ); ?></label></th>
		<td>
			<p>
			<input type="text" name="_cravings_pro_recipe_options[cat_exclude]" class="regular-text" id="_cravings_pro_recipe_options[cat_exclude]" value="<?php echo esc_attr( cravings_pro_get_recipe_index_option( 'cat_exclude', $post->ID ) ); ?>" />
			<br /><small><strong><?php esc_html_e( 'Category IDs, comma separated - 1,2,3 for example', 'cravingspro' ); ?></strong></small>
			</p>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row"><label for="_cravings_pro_recipe_options[cat_num]"><?php esc_html_e( 'Posts per Page', 'cravingspro' ); ?></label></th>
		<td>
			<input type="text" name="_cravings_pro_recipe_options[cat_num]" id="_cravings_pro_recipe_options[cat_num]" value="<?php echo esc_attr( cravings_pro_get_recipe_index_option( 'cat_num', $post->ID ) ); ?>" size="2" />
		</td>
	</tr>

</tbody>
</table>
<?php wp_nonce_field( 'save_cravings_pro_metabox', 'cravings_pro_metabox_nonce' ); ?>
