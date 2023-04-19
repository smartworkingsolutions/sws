<?php
/**
 * The template part for displaying Widget 2 in footer.
 *
 * @package SWS
 */

$heading = get_field( 'fw2_heading', 'option' );

if ( ! $heading && ! have_rows( 'fw2_links', 'option' ) ) {
	return;
}
?>
<div class="xl:col-span-4 f-widget text-text-color">
	<?php

	if ( $heading ) {
		echo '<h3 class="widget-title font-bold mb-4">' . esc_html( $heading ) . '</h3>';
	}

	if ( have_rows( 'fw2_links', 'option' ) ) :

		echo '<div class="links"><ul class="grid gap-5">';

		while ( have_rows( 'fw2_links', 'option' ) ) :
			the_row();

			$links = get_sub_field( 'fw2_link' );

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
