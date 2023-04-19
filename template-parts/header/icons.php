<?php
/**
 * The template part for displaying icons in header.
 *
 * @package SWS
 */

?>

<div class="flex items-center gap-3">

	<div class="mobile-menu-wrapper | xl:hidden">
		<button class="mobile-menu-button grid gap-1.5">
			<span class="w-7 h-0.5 bg-dark-color"></span>
			<span class="w-7 h-0.5 bg-dark-color"></span>
			<span class="w-7 h-0.5 bg-dark-color"></span>
		</button>
	</div>

	<div class="search-icon hidden | xl:flex items-center">
		<button><?php get_svg( 'icons/search' ); ?></button>                        
	</div>

</div>
