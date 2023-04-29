<?php
/**
 * The template for displaying search form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SWS
 */

?>

<form id="searchform" class="search-form flex justify-between items-center" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" accept-charset="utf-8">
	<input type="text" class="search-input w-full border-none focus:border-none focus:outline-none focus:ring-0 bg-transparent px-0" name="s" autocomplete="off" placeholder="Search any services..." value="<?php echo get_search_query(); ?>">
	<input type="hidden" name="post_type" value="members" />
	<button class="search-submit text-text-color fill-text-color" type="submit"><?php get_svg( 'icons/search' ); ?></button>
</form>
