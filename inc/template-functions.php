<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package SWS
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sws_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'sws_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function sws_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'sws_pingback_header' );

/**
 * Get svg file content.
 *
 * @param string $path path of the SVG file.
 * @param string $echo print|return.
 *
 * @return string
 */
function get_svg( $path, $echo = true ) {

	$file = get_template_directory() . '/images/' . $path . '.svg';

	if ( ! file_exists( $file ) ) {
		return;
	}

	$svg = file_get_contents( $file ); // phpcs:ignore

	if ( $echo ) {
		echo $svg; // phpcs:ignore
	} else {
		return $svg;
	}
}

/**
 * Get different color's background classes.
 *
 * @param string $count count items.
 *
 * @return string
 */
function get_colors( $count ) {
	$color = ' bg-dark-color';
	if ( 1 === $count || 5 === $count ) {
		$color = ' bg-blue-light';
	}
	if ( 2 === $count || 6 === $count ) {
		$color = ' bg-blue-medium';
	}
	if ( 3 === $count || 7 === $count ) {
		$color = ' bg-blue-dark';
	}
	return $color;
}
