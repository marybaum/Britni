<?php
/**
 * Register customizer defaults.
 *
 * @package   CravingsPro\Functions\Customizer
 * @copyright Copyright (c) 2017, Feast Design Co.
 * @license   GPL-2.0+
 * @since     3.0.0
 */

defined( 'WPINC' ) || die;

add_filter( 'feastco_customizer_font_variants', 'cravings_pro_font_variants', 10, 3 );
/**
 * Filters the allowed Google Font variants for the Brunch Pro theme.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $chosen_variants The chosen variants.
 * @param  string $font The font to load variants for.
 * @param  array  $variants The variants for the font.
 * @return array $chosen_variants The chosen variants.
 */
function cravings_pro_font_variants( $chosen_variants, $font, $variants ) {
	$allowed = array(
		'300',
		'400',
		'500',
		'600',
		'700',
		'800',
		'900',
	);

	foreach ( $allowed as $variant ) {
		if ( in_array( $variant, $variants, true ) ) {
			$chosen_variants[] = $variant;
		}
	}

	return array_unique( $chosen_variants );
}

add_filter( 'feastco_customizer_all_fonts', 'feastco_customizer_get_google_fonts' );
add_filter( 'feastco_customizer_get_google_fonts', 'cravings_pro_get_google_fonts' );
/**
 * Filters the allowed Google Fonts for the Cravings Pro theme.
 *
 * @since  1.0.0
 *
 * @param  array $fonts
 * @return array $fonts
 */
function cravings_pro_get_google_fonts( $fonts ) {
	$fonts = array(
		'Cardo' => array(
			'label'    => 'Cardo',
			'variants' => array(
				'400',
				'700',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		'Crimson Text' => array(
			'label'    => 'Crimson Text',
			'variants' => array(
				'400',
				'600',
				'700',
			),
			'subsets' => array(
				'latin',
			),
		),
		'Fira Sans' => array(
			'label'    => 'Fira Sans',
			'variants' => array(
				'300',
				'400',
				'500',
				'600',
				'700',
				'800',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		'Libre Franklin' => array(
			'label'    => 'Libre Franklin',
			'variants' => array(
				'300',
				'400',
				'500',
				'600',
				'700',
				'800',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		'Karma' => array(
			'label'    => 'Karma',
			'variants' => array(
				'300',
				'400',
				'500',
				'600',
				'700',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		'Martel' => array(
			'label'    => 'Martel',
			'variants' => array(
				'300',
				'400',
				'500',
				'600',
				'700',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		'Poppins' => array(
			'label'    => 'Poppins',
			'variants' => array(
				'300',
				'400',
				'500',
				'600',
				'700',
				'800',
				'900',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		'Rubik' => array(
			'label'    => 'Rubik',
			'variants' => array(
				'300',
				'400',
				'500',
				'700',
				'900',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
				'hebrew',
			),
		),
		'Vidaloka' => array(
			'label'    => 'Vidaloka',
			'variants' => array(
				'400',
			),
			'subsets' => array(
				'latin',
			),
		),
		'Work Sans' => array(
			'label'    => 'Work Sans',
			'variants' => array(
				'300',
				'400',
				'500',
				'600',
				'700',
				'800',
				'900',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
		'Zilla Slab' => array(
			'label'    => 'Zilla Slab',
			'variants' => array(
				'300',
				'400',
				'500',
				'600',
				'700',
			),
			'subsets' => array(
				'latin',
				'latin-ext',
			),
		),
	);

	return $fonts;
}
