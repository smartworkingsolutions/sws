<?php
/**
 * The ACF template part for displaying USPs.
 *
 * @package SWS
 */

$rating_title  = get_sub_field( 'title' );
$rating_text   = get_sub_field( 'rating_text' );
$review_text   = get_sub_field( 'review_text' );
$review_number = get_sub_field( 'review_number' );
$review_link   = get_sub_field( 'review_link' );
?>

<section classw-full>
	<div class="container">

	<div class="grid lg:grid-cols-2 xl:grid-cols-12 gap-8">

		<?php
		// Lists.
		if ( have_rows( 'add_list' ) ) :

			echo '<ul class="xl:col-span-7 grid gap-4 mb-8 md:mb-0">';

			// Loop through rows.
			while ( have_rows( 'add_list' ) ) :
				the_row();

				// Load sub field value.
				$list = get_sub_field( 'list' );

				printf(
					'<li class="w-fit py-2 grid place-content-center sm:text-xl font-medium border border-text-color rounded-full px-5 mx-auto lg:mx-0">%s
					</li>',
					esc_html( $list )
				);

			endwhile;

			echo '</ul>';

		endif;

		echo '<div class="xl:col-span-5">';
		// Rating.
		if ( $rating_title || $rating_text ) {
			echo '<div class="bg-white p-7 flex flex-col justify-between gap-4 text-text-color rounded-20">';
			if ( $rating_title ) {
				echo '<h2 class="text-32 font-bold leading-none">' . wp_kses_post( $rating_title ) . '</h2>';
			}
			if ( $rating_text ) {
				echo '<p>' . wp_kses_post( $rating_text ) . '</p>';
			}
			echo '</div>';
		}

		// Reviews.
		if ( $review_text || $review_number || $review_link ) {
			if ( $review_link ) {
				printf(
					'<a href="%s" target="_blank" class="w-full p-7 flex flex-col justify-between gap-4 bg-blue-light text-white rounded-20">
						<p class="text-white">%s</p>
						<div class="flex gap-2 items-center text-3xl sm:text-6xl font-bold">%s%s</div>
					</a>',
					esc_url( $review_link ),
					wp_kses_post( $review_text ),
					esc_html( $review_number ),
					get_svg( 'icons/star', false ) // phpcs:ignore
				);
			} else {
				printf(
					'<div class="w-full p-7 flex flex-col justify-between gap-4 bg-blue-light text-white rounded-20">
						<p class="text-white">%s</p>
						<div class="flex gap-2 items-center text-3xl sm:text-6xl font-bold">%s%s</div>
					</div>',
					wp_kses_post( $review_text ),
					esc_html( $review_number ),
					get_svg( 'icons/star', false ) // phpcs:ignore
				);
			}
		}
		echo '</div>';
		?>
	</div>

	</div>
</section>
