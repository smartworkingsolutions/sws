<?php
/**
 * The template part for displaying Widget 3 in footer.
 *
 * @package SWS
 */

$heading = get_field( 'fw3_heading', 'option' );

if ( ! $heading && ! have_rows( 'fw3_links', 'option' ) ) {
	return;
}
?>
<div class="xl:col-span-3 f-widget">
	<?php

	if ( $heading ) {
		echo '<h3 class="widget-title | grid justify-end md:justify-start font-bold mb-4">' . esc_html( $heading ) . '</h3>';
	}

	if ( have_rows( 'fw3_links', 'option' ) ) :

		echo '<div class="links"><ul class="grid justify-end md:justify-start text-right md:text-left gap-5">';

		while ( have_rows( 'fw3_links', 'option' ) ) :
			the_row();

			$links = get_sub_field( 'fw3_link' );

			if ( $links ) {
				printf(
					'<li>
						<a class="font-medium hover:text-blue-medium" href="%s" target="%s">%s</a>
					</li>',
					esc_url( $links['url'] ),
					esc_html( $links['target'] ),
					esc_html( $links['title'] )
				);
			}

		endwhile;

		echo '</ul></div>';

	endif;
	?>
</div>
