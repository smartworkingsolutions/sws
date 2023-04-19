<?php
/**
 * SWS Theme Customizer
 *
 * @package SWS
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sws_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->add_setting( 'footer_logo' );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			[
				'selector'        => '.site-title a',
				'render_callback' => 'sws_customize_partial_blogname',
			]
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			[
				'selector'        => '.site-description',
				'render_callback' => 'sws_customize_partial_blogdescription',
			]
		);
	}

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'footer_logo',
			[
				'label'       => 'Footer Logo',
				'description' => 'This logo will show on Footer.',
				'section'     => 'title_tagline',
				'settings'    => 'footer_logo',
				'priority'    => 8,
			]
		)
	);

}
add_action( 'customize_register', 'sws_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function sws_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function sws_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sws_customize_preview_js() {
	wp_enqueue_script( 'sws-customizer', get_template_directory_uri() . '/js/customizer.js', [ 'customize-preview' ], THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'sws_customize_preview_js' );
