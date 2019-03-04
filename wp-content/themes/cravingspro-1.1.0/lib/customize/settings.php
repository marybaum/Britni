<?php
/**
 * Register Customizer settings.
 *
 * @package   CravingsPro\Functions\Customizer
 * @copyright Copyright (c) 2017, Feast Design Co.
 * @license   GPL-2.0+
 * @since     3.0.0
 */

defined( 'WPINC' ) || die;

add_action( 'customize_register', 'cravings_pro_register_customizer_archives' );
/**
 * Register custom sections for the Cravings Pro theme.
 *
 * @since  1.0.0
 * @return void
 */
function cravings_pro_register_customizer_archives() {
	$options = array(
		'sections' => array(),
	);

	$section = 'archive_grid_settings';

	$options['sections'][] = array(
		'id'          => $section,
		'title'       => __( 'Archive Grid', 'cravingspro' ),
		'description' => __( 'These settings control how the archive grid will display on category and tag pages as well as the Genesis blog page when it is enabled.', 'cravingspro' ),
		'priority'    => 180,
	);

	$options['cravings_pro_archive_grid'] = array(
		'id'      => 'cravings_pro_archive_grid',
		'label'   => __( 'Archive Grid Display:', 'cravingspro' ),
		'section' => $section,
		'type'    => 'select',
		'default' => 'full',
		'priority' => 0,
		'choices' => array(
			'full'       => __( 'Full Width', 'cravingspro' ),
			'one_half'   => __( 'One Half', 'cravingspro' ),
			'one_third'  => __( 'One Third', 'cravingspro' ),
			'one_fourth' => __( 'One Fourth', 'cravingspro' ),
			'one_sixth'  => __( 'One Sixth', 'cravingspro' ),
		),
	);

	$options['cravings_pro_archive_show_title'] = array(
		'id'       => 'cravings_pro_archive_show_title',
		'label'    => __( 'Display The Title?', 'cravingspro' ),
		'section'  => $section,
		'type'     => 'checkbox',
		'default'  => 1,
		'priority' => 5,
	);

	$options['cravings_pro_archive_show_info'] = array(
		'id'       => 'cravings_pro_archive_show_info',
		'label'    => __( 'Display The Entry Info?', 'cravingspro' ),
		'section'  => $section,
		'type'     => 'checkbox',
		'default'  => 1,
		'priority' => 6,
	);

	$options['cravings_pro_archive_show_content'] = array(
		'id'       => 'cravings_pro_archive_show_content',
		'label'    => __( 'Display The Content?', 'cravingspro' ),
		'section'  => $section,
		'type'     => 'checkbox',
		'default'  => 1,
		'priority' => 7,
	);

	$options['cravings_pro_archive_show_meta'] = array(
		'id'       => 'cravings_pro_archive_show_meta',
		'label'    => __( 'Display The Entry Meta?', 'cravingspro' ),
		'section'  => $section,
		'type'     => 'checkbox',
		'default'  => 1,
		'priority' => 8,
	);

	$options['cravings_pro_archive_image_placement'] = array(
		'id'      => 'cravings_pro_archive_image_placement',
		'label'   => __( 'Featured Image Placement:', 'cravingspro' ),
		'section' => $section,
		'type'    => 'select',
		'default' => 'after_title',
		'choices' => array(
			'after_title'   => __( 'After Title', 'cravingspro' ),
			'before_title'  => __( 'Before Title', 'cravingspro' ),
			'after_content' => __( 'After Content', 'cravingspro' ),
		),
	);

	Feastco_Customizer_Options::add_options( $options );
}

add_action( 'customize_register', 'cravings_pro_register_customizer_colors' );
/**
 * Register custom color sections for the Cravings Pro theme.
 *
 * @since  1.0.0
 * @param  object $api The customizer API object.
 * @return void
 */
function cravings_pro_register_customizer_colors( $api ) {
	$api->remove_section( 'colors' );

	if ( apply_filters( 'cravings_pro_disable_colors', false ) ) {
		return;
	}

	$options = array(
		'panels'   => array(),
		'sections' => array(),
	);

	$panel = 'colors';

	$options['panels'][] = array(
		'id'          => $panel,
		'title'       => __( 'Colors', 'cravingspro' ),
		'description' => __( 'You can customize your theme colors by changing any of the options within this panel.', 'cravingspro' ),
		'capability'  => 'edit_theme_options',
		'priority'    => 70,
	);

	$options['sections'][] = array(
		'id'          => "{$panel}_general",
		'title'       => __( 'General', 'cravingspro' ),
		'description' => __( 'Customize your general theme colors by changing the options below.', 'cravingspro' ),
		'capability'  => 'edit_theme_options',
		'panel'       => $panel,
		'priority'    => 10,
	);

	$options['sections'][] = array(
		'id'          => "{$panel}_menus",
		'title'       => __( 'Menus', 'cravingspro' ),
		'description' => __( 'Customize your menu colors by changing the options below.', 'cravingspro' ),
		'capability'  => 'edit_theme_options',
		'panel'       => $panel,
		'priority'    => 12,
	);

	$options['sections'][] = array(
		'id'          => "{$panel}_content",
		'title'       => __( 'Content', 'cravingspro' ),
		'description' => __( 'Customize your content colors by changing the options below.', 'cravingspro' ),
		'capability'  => 'edit_theme_options',
		'panel'       => $panel,
		'priority'    => 14,
	);

	$options['sections'][] = array(
		'id'          => "{$panel}_buttons",
		'title'       => __( 'Buttons', 'cravingspro' ),
		'description' => __( 'Customize your button colors by changing the options below.', 'cravingspro' ),
		'capability'  => 'edit_theme_options',
		'panel'       => $panel,
		'priority'    => 16,
	);

	$counter = 20;

	foreach ( cravings_pro_get_colors() as $color => $setting ) {
		$options[ $color ] = array(
			'id'       => $color,
			'label'    => $setting['label'],
			'section'  => "{$panel}_{$setting['section']}",
			'type'     => 'color',
			'default'  => $setting['default'],
			'priority' => $counter++,
		);
	}

	Feastco_Customizer_Options::add_options( $options );
}

add_action( 'customize_register', 'cravings_pro_register_customizer_fonts' );
/**
 * Register custom sections for the Cravings Pro theme.
 *
 * @since  1.0.0
 * @return void
 */
function cravings_pro_register_customizer_fonts() {
	if ( apply_filters( 'cravings_pro_disable_google_fonts', false ) ) {
		return;
	}

	$options = array(
		'panels'   => array(),
		'sections' => array(),
	);

	$panel = 'fonts';

	$options['panels'][] = array(
		'id'          => $panel,
		'title'       => __( 'Typography', 'cravingspro' ),
		'description' => __( 'You can customize your fonts here. For best results, we recommend using no more than two unique font families.', 'cravingspro' ),
		'capability'  => 'edit_theme_options',
		'priority'    => 75,
	);

	foreach ( cravings_pro_get_fonts() as $font => $setting ) {
		$options['sections'][] = array(
			'id'          => "{$panel}_{$font}",
			'title'       => $setting['label'],
			'description' => $setting['description'],
			'capability'  => 'edit_theme_options',
			'panel'       => $panel,
			'priority'    => 10,
		);

		$options[ "{$font}_family" ] = array(
			'id'      => "{$font}_family",
			'label'   => $setting['label'] . ' ' . __( 'Family', 'cravingspro' ),
			'section' => "{$panel}_{$font}",
			'type'    => 'select',
			'choices' => feastco_customizer_get_font_choices(),
			'default' => $setting['default_family'],
		);

		$options[ "{$font}_weight" ] = array(
			'id'      => "{$font}_weight",
			'label'   => $setting['label'] . ' ' . __( 'Weight', 'cravingspro' ),
			'section' => "{$panel}_{$font}",
			'type'    => 'select',
			'default' => $setting['default_weight'],
			'choices' => array(
				'300' => '300',
				'400' => '400',
				'500' => '500',
				'600' => '600',
				'700' => '700',
				'800' => '800',
				'900' => '900',
			),
		);

		if ( 'disabled' !== $setting['default_size'] ) {
			$options[ "{$font}_size" ] = array(
				'id'      => "{$font}_size",
				'label'   => $setting['label'] . ' ' . __( 'Size', 'cravingspro' ),
				'section' => "{$panel}_{$font}",
				'type'    => 'select',
				'default' => $setting['default_size'],
				'choices' => array(
					'13px' => '13px',
					'15px' => '15px',
					'17px' => '17px',
					'19px' => '19px',
					'21px' => '21px',
					'27px' => '27px',
					'37px' => '37px',
					'47px' => '47px',
					'57px' => '57px',
				),
			);
		}

		if ( 'disabled' !== $setting['default_style'] ) {
			$options[ "{$font}_style" ] = array(
				'id'      => "{$font}_style",
				'label'   => $setting['label'] . ' ' . __( 'Style', 'cravingspro' ),
				'section' => "{$panel}_{$font}",
				'type'    => 'select',
				'default' => $setting['default_style'],
				'choices' => array(
					'normal' => 'Normal',
					'italic' => 'Italic',
				),
			);
		}
	}

	Feastco_Customizer_Options::add_options( $options );
}
