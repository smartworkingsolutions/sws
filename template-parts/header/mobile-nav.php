<?php
/**
 * The template part for displaying Mobile menu in header.
 *
 * @package SWS
 */

$nav = new SWS_Menu_Walker( 'main-menu' );
?>

<!-- Mobile menu -->
<div class="mobile-menu slide-close | flex flex-col bg-body text-text-color w-96 h-screen overflow-y-scroll px-10 py-2 fixed right-0 top-0 z-30 transition-all duration-200">

	<div class="flex justify-between items-center mt-10">

		<?php theme_logo(); ?>

		<div class="close | grid stroke-text-color">
			<button><?php get_svg( 'icons/close' ); ?></button>
		</div>
	</div>

	<nav><?php echo $nav->build_menu( 'mobile' ); // phpcs:ignore ?></nav>

	<div class="clone | mt-8"></div>

</div>
<div class="overlay | w-full h-full fixed inset-0 z-20 bg-black/30 hidden"></div>
