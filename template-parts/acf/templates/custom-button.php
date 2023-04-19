<?php
/**
 * The ACF template part for displaying Custom button.
 *
 * @package SWS
 */

$btn = get_sub_field( 'add_button' );

if ( $btn ) {
	printf(
		'<div class="container text-center">
			<a href="%s" class="button button-border w-full lg:w-96" target="%s">%s</a>
		</div>',
		esc_url( $btn['url'] ),
		esc_html( $btn['target'] ),
		esc_html( $btn['title'] )
	);
}
