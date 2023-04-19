<?php
/**
 * The ACF template part for displaying How it works.
 *
 * @package SWS
 */

$heading = get_sub_field( 'heading' );
$btn     = get_sub_field( 'button' );
$count   = 1;

if ( ! $heading && ! $btn && ! have_rows( 'add_step' ) ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

	<?php
	if ( $heading || $btn ) {
		echo '<div class="flex justify-between items-center">';
		if ( $heading ) {
			echo '<h2 class="text-32 lg:text-58 text-text-color font-medium leading-[1.1]">' . wp_kses_post( $heading ) . '</h2>';
		}
		// Only visible on large screens.
		if ( $btn ) {
			printf(
				'<div class="hidden sm:block"><a href="%s" class="button" target="%s">%s%s</a></div>',
				esc_url( $btn['url'] ),
				esc_html( $btn['target'] ),
				esc_html( $btn['title'] ),
				get_svg( 'icons/button-arrow', false ) // phpcs:ignore
			);
		}
		echo '</div>';
	}

	if ( have_rows( 'add_step' ) ) :

		echo '<div class="grid mt-10 lg:mt-14">';

		// Loop through rows.
		while ( have_rows( 'add_step' ) ) :
			the_row();

			// Load sub field value.
			$subheading = get_sub_field( 'title' );
			$content    = get_sub_field( 'content' );

			$color = ' bg-blue-dark';
			if ( 1 === $count ) {
				$color = ' bg-blue-light';
			}
			if ( 2 === $count ) {
				$color = ' bg-blue-medium';
			}

			printf(
				'<div class="grid lg:flex justify-between items-center bg-white rounded-20">
					<h3 class="text-32 lg:text-58 text-text-color font-medium leading-[1.1] p-10">%s</h3>
					<div class="w-full h-full lg:max-w-lg flex items-center gap-5 text-2xl font-medium rounded-20 px-10 py-5 text-white fill-white%s">%s</div>
				</div>',
				wp_kses_post( $subheading ),
				esc_html( $color ),
				esc_html( $content )
			);

			++$count;

		endwhile;

		echo '</div>';

	endif;

	// Only visible on mobile screens.
	if ( $btn ) {
		printf(
			'<div class="block sm:hidden mt-8 text-center"><a href="%s" class="button" target="%s">%s%s</a></div>',
			esc_url( $btn['url'] ),
			esc_html( $btn['target'] ),
			esc_html( $btn['title'] ),
			get_svg( 'icons/button-arrow', false ) // phpcs:ignore
		);
	}
	?>

	</div>
</section>
