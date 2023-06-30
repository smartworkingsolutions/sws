<?php
/**
 * The ACF template part for displaying Hiring process.
 *
 * @package SWS
 */

$heading = get_sub_field( 'heading' );
$button  = get_sub_field( 'button' );
$count   = 1;

if ( ! $heading && ! have_rows( 'add_steps' ) ) {
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

		echo '<ul class="grid mt-10 md:mt-16">';

		// Loop through rows.
		while ( have_rows( 'add_steps' ) ) :
			the_row();

			// Load sub field value.
			$text  = get_sub_field( 'content' );
			$color = ' bg-dark-color';

			if ( 1 === $count ) {
				$color = ' bg-blue-light';
			}
			if ( 2 === $count ) {
				$color = ' bg-blue-medium';
			}
			if ( 3 === $count ) {
				$color = ' bg-blue-dark';
			}

			if ( $text ) {
				printf(
					'<li class="flex items-center gap-6 xl:gap-0 bg-white rounded-20">
						<div class="w-[378px] h-[104px] flex items-center px-10 text-white text-58 font-medium shrink-0 rounded-20%s">Step %s</div>
						<p class="text-2xl xl:pl-40 pr-6 xl:pr-16">%s</p>
					</li>',
					esc_html( $color ),
					esc_html( $count ),
					wp_kses_post( $text )
				);
			}

			++$count;

		endwhile;

		echo '</ul>';
		?>

	</div>
</section>
