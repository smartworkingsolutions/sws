<?php
/**
 * Template Name: ACF Template - Landing Page
 * The template for displaying ACF templates on page.
 *
 * @package SWS
 */

get_header();

/**
 * Template loop
 */
$acfp = new acf_flexible_content_to_partials( get_the_ID(), 'templates' );
$acfp->render();

get_footer();
