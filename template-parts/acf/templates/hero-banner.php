<?php
/**
 * The ACF template part for displaying Hero Banner.
 *
 * @package SWS
 */

$bg         = get_sub_field( 'background_image' );
$heading    = get_sub_field( 'heading' );
$subheading = get_sub_field( 'sub_heading' );
$btn        = get_sub_field( 'button' );

if ( ! is_front_page() ) {
	$heading = __( 'Hire Best-in-Class Remote<br>', 'sws' ) . get_the_title();
}
?>

<section class="w-full min-h-[722px] grid place-content-center bg-blue-dark text-center relative">
	<?php
	if ( $bg ) {
		echo '<img class="w-full h-full absolute inset-0 object-cover" src="' . esc_url( $bg ) . '" alt="Background Image">';
	}
	?>
	<div class="container">
	<?php
	if ( $heading || $subheading || $btn ) {
		echo '<div class="grid gap-10 relative z-10">';

		if ( $heading ) {
			echo '<h1 class="text-3xl sm:text-5xl lg:text-7xl font-bold text-white leading-tight">' . wp_kses_post( $heading ) . '</h1>';
		}
		if ( $subheading ) {
			echo '<p class="text-white/80">' . wp_kses_post( $subheading ) . '</p>';
		}
		if ( $btn ) {
			printf(
				'<div><a href="%s" class="button" target="%s">%s%s</a></div>',
				esc_url( $btn['url'] ),
				esc_html( $btn['target'] ),
				esc_html( $btn['title'] ),
				get_svg( 'icons/button-arrow', false ) // phpcs:ignore
			);
		}
		echo '</div>';
	}
	?>

	</div>
</section>
