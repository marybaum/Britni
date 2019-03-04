<?php
/**
 * Theme Customizer Fonts
 *
 * @package FeastcoCustomizer
 */

/**
 * Packages the font choices into value/label pairs for use with the customizer.
 *
 * @since  1.0.0.
 *
 * @return array    The fonts in value/label pairs.
 */
function feastco_customizer_get_all_fonts() {
	$heading1       = array( 1 => array( 'label' => sprintf( '--- %s ---', __( 'Standard Fonts', 'cravingspro' ) ) ) );
	$standard_fonts = feastco_customizer_get_standard_fonts();
	$heading2       = array( 2 => array( 'label' => sprintf( '--- %s ---', __( 'Google Fonts', 'cravingspro' ) ) ) );
	$google_fonts   = feastco_customizer_get_google_fonts();

	/**
	 * Allow for developers to modify the full list of fonts.
	 *
	 * @since 1.3.0.
	 *
	 * @param array    $fonts    The list of all fonts.
	 */
	return apply_filters( 'feastco_customizer_all_fonts', array_merge( $heading1, $standard_fonts, $heading2, $google_fonts ) );
}

/**
 * Packages the font choices into value/label pairs for use with the customizer.
 *
 * @since  1.0.0.
 *
 * @return array    The fonts in value/label pairs.
 */
function feastco_customizer_get_font_choices() {
	$fonts   = feastco_customizer_get_all_fonts();
	$choices = array();

	// Repackage the fonts into value/label pairs
	foreach ( $fonts as $key => $font ) {
		$choices[ $key ] = $font['label'];
	}

	return $choices;
}

/**
 * Build the HTTP request URL for Google Fonts.
 *
 * @since  1.0.0.
 *
 * @return string    The URL for including Google Fonts.
 */
function feastco_customizer_get_google_font_uri( $fonts ) {

	// De-dupe the fonts
	$fonts         = array_unique( $fonts );
	$allowed_fonts = feastco_customizer_get_google_fonts();
	$family        = array();

	// Validate each font and convert to URL format
	foreach ( $fonts as $font ) {
		$font = trim( $font );

		// Verify that the font exists
		if ( array_key_exists( $font, $allowed_fonts ) ) {
			// Build the family name and variant string (e.g., "Open+Sans:regular,italic,700")
			$family[] = urlencode( $font . ':' . join( ',', feastco_customizer_choose_google_font_variants( $font, $allowed_fonts[ $font ]['variants'] ) ) );
		}
	}

	// Convert from array to string
	if ( empty( $family ) ) {
		return '';
	}

	$request = '//fonts.googleapis.com/css?family=' . implode( '%7C', $family );

	// Load the font subset
	$subset = get_theme_mod( 'font-subset', feastco_customizer_get_default( 'font-subset' ) );

	if ( 'all' === $subset ) {
		$subsets_available = feastco_customizer_get_google_font_subsets();

		// Remove the all set
		unset( $subsets_available['all'] );

		// Build the array
		$subsets = array_keys( $subsets_available );
	} else {
		$subsets = array(
			'latin',
			$subset,
		);
	}

	// Append the subset string
	if ( ! empty( $subsets ) ) {
		$request .= urlencode( '&subset=' . join( ',', $subsets ) );
	}

	return esc_url( $request );
}

/**
 * Retrieve the list of available Google font subsets.
 *
 * @since  1.0.0.
 *
 * @return array    The available subsets.
 */
function feastco_customizer_get_google_font_subsets() {
	return array(
		'all'          => __( 'All', 'cravingspro' ),
		'cyrillic'     => __( 'Cyrillic', 'cravingspro' ),
		'cyrillic-ext' => __( 'Cyrillic Extended', 'cravingspro' ),
		'devanagari'   => __( 'Devanagari', 'cravingspro' ),
		'greek'        => __( 'Greek', 'cravingspro' ),
		'greek-ext'    => __( 'Greek Extended', 'cravingspro' ),
		'khmer'        => __( 'Khmer', 'cravingspro' ),
		'latin'        => __( 'Latin', 'cravingspro' ),
		'latin-ext'    => __( 'Latin Extended', 'cravingspro' ),
		'vietnamese'   => __( 'Vietnamese', 'cravingspro' ),
	);
}

/**
 * Given a font, chose the variants to load for the theme.
 *
 * Attempts to load regular, italic, and 700. If regular is not found, the first variant in the family is chosen. italic
 * and 700 are only loaded if found. No fallbacks are loaded for those fonts.
 *
 * @since  1.0.0.
 *
 * @param  string    $font        The font to load variants for.
 * @param  array     $variants    The variants for the font.
 * @return array                  The chosen variants.
 */
function feastco_customizer_choose_google_font_variants( $font, $variants = array() ) {
	$chosen_variants = array();
	if ( empty( $variants ) ) {
		$fonts = feastco_customizer_get_google_fonts();

		if ( array_key_exists( $font, $fonts ) ) {
			$variants = $fonts[ $font ]['variants'];
		}
	}

	// If a "regular" variant is not found, get the first variant
	if ( ! in_array( 'regular', $variants ) ) {
		$chosen_variants[] = $variants[0];
	} else {
		$chosen_variants[] = 'regular';
	}

	// Only add "italic" if it exists
	if ( in_array( 'italic', $variants ) ) {
		$chosen_variants[] = 'italic';
	}

	// Only add "700" if it exists
	if ( in_array( '700', $variants ) ) {
		$chosen_variants[] = '700';
	}

	return apply_filters( 'feastco_customizer_font_variants', array_unique( $chosen_variants ), $font, $variants );
}

/**
 * Return an array of standard websafe fonts.
 *
 * @since  1.0.0.
 *
 * @return array    Standard websafe fonts.
 */
function feastco_customizer_get_standard_fonts() {
	return array(
		'serif' => array(
			'label' => _x( 'Serif', 'font style', 'cravingspro' ),
			'stack' => 'Georgia,Times,"Times New Roman",serif'
		),
		'sans-serif' => array(
			'label' => _x( 'Sans Serif', 'font style', 'cravingspro' ),
			'stack' => '"Helvetica Neue",Helvetica,Arial,sans-serif'
		),
		'monospace' => array(
			'label' => _x( 'Monospaced', 'font style', 'cravingspro' ),
			'stack' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace'
		)
	);
}

/**
 * Validate the font choice and get a font stack for it.
 *
 * @since  1.0.0.
 *
 * @param  string    $font    The 1st font in the stack.
 * @return string             The full font stack.
 */
function feastco_customizer_get_font_stack( $font ) {

	$all_fonts = feastco_customizer_get_all_fonts();

	// Sanitize font choice
	$font = feastco_customizer_sanitize_font_choice( $font );

	$sans = '"Helvetica Neue",sans-serif';
	$serif = 'Georgia, serif';

	// Use stack if one is identified
	if ( isset( $all_fonts[ $font ]['stack'] ) && ! empty( $all_fonts[ $font ]['stack'] ) ) {
		$stack = $all_fonts[ $font ]['stack'];
	} else {
		$stack = '"' . $font . '",' . $sans;
	}

	return $stack;
}

/**
 * Sanitize a font choice.
 *
 * @since  1.0.0.
 *
 * @param  string    $value    The font choice.
 * @return string              The sanitized font choice.
 */
function feastco_customizer_sanitize_font_choice( $value ) {
	// The array key is an integer, so the chosen option is a heading, not a real choice
	if ( is_int( $value ) ) {
		return '';
	}

	if ( array_key_exists( $value, feastco_customizer_get_font_choices() ) ) {
		return $value;
	}

	return '';
}

/**
 * Return an array of selected Google Fonts.
 *
 * @since  1.0.0.
 *
 * @return array    Selected Google Fonts.
 */
function feastco_customizer_get_google_fonts() {
	return apply_filters( 'feastco_customizer_get_google_fonts', array(
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
	) );
}
