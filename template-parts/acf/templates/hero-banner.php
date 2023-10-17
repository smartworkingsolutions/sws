<?php
/**
 * The ACF template part for displaying Hero Banner.
 *
 * @package SWS
 */

$bg         = get_sub_field( 'background_image' );
$heading    = get_sub_field( 'heading' );
$subheading = get_sub_field( 'sub_heading' );
$text       = get_sub_field( 'text' );
$btn        = get_sub_field( 'button' );
$background = '';

if ( ! is_front_page() ) {
	$heading = __( 'Hire Best-in-Class Remote<br>', 'sws' ) . get_the_title();
}
if ( ! $bg ) {
	$background = ' bg-blue-dark';
}
?>

<section class="w-full min-h-[722px] grid place-content-center<?php echo esc_html( $background ); ?> text-center relative">
	<?php
	if ( $bg ) {
		echo '<img class="w-full h-full absolute inset-0 object-cover" src="' . esc_url( $bg ) . '" alt="Background Image">';
	}
	?>
	<div class="container">
	<?php
	if ( $heading || $subheading || $text || $btn ) {
		echo '<div class="grid gap-10 relative z-10">';

		if ( $heading ) {
			echo '<h1 class="text-3xl sm:text-5xl lg:text-7xl font-bold text-white leading-tight">' . wp_kses_post( $heading ) . '</h1>';
		}
		if ( $subheading ) {
			echo '<p class="md:text-3xl text-white/80">' . do_shortcode( $subheading ) . '</p>';
		}
		if ( $text ) {
			echo '<p class="text-white/80">' . do_shortcode( $text ) . '</p>';
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
