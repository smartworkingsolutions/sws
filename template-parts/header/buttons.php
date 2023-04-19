<?php
/**
 * The template part for displaying buttons in header.
 *
 * @package SWS
 */

$btn1 = get_field( 'header_button_1', 'options' );
$btn2 = get_field( 'header_button_2', 'options' );

if ( ! $btn1 && ! $btn2 ) {
	return;
}
?>

<div class="header-buttons | hidden xl:flex justify-center gap-5">
	<?php
	if ( $btn1 ) {
		printf(
			'<a href="%s" class="button button-small" target="%s">%s</a>',
			esc_url( $btn1['url'] ),
			esc_html( $btn1['target'] ),
			esc_html( $btn1['title'] )
		);
	}
	if ( $btn2 ) {
		printf(
			'<a href="%s" class="button button-small button-white" target="%s">%s</a>',
			esc_url( $btn2['url'] ),
			esc_html( $btn2['target'] ),
			esc_html( $btn2['title'] )
		);
	}
	?>
</div>
