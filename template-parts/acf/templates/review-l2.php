<?php
/**
 * The ACF template part for displaying Reviews layout 2.
 *
 * @package SWS
 */

$count        = 1;
$rating_title = get_sub_field( 'title' );
$rating_text  = get_sub_field( 'rating_text' );
?>

<section classw-full>
	<div class="container">

	<div class="grid md:grid-cols-2 xl:grid-cols-4 gap-2.5">

		<?php
		// Lists.
		if ( have_rows( 'add_list' ) ) :

			echo '<ul class="grid gap-4 mb-8 md:mb-0">';

			// Loop through rows.
			while ( have_rows( 'add_list' ) ) :
				the_row();

				// Load sub field value.
				$list = get_sub_field( 'list' );

				printf(
					'<li class="w-max h-[50px] grid place-content-center text-22 font-medium border border-text-color rounded-full px-5 mx-auto md:mx-0">%s
					</li>',
					esc_html( $list )
				);

			endwhile;

			echo '</ul>';

		endif;

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
		if ( have_rows( 'add_reviews' ) ) :

			// Loop through rows.
			while ( have_rows( 'add_reviews' ) ) :
				the_row();

				// Load sub field value.
				$number = get_sub_field( 'number' );
				$text   = get_sub_field( 'text' );
				$url    = get_sub_field( 'link' );
				$color  = 1 === $count ? ' bg-blue-light' : ' bg-blue-medium';

				if ( $url ) {
					printf(
						'<a href="%s" target="_blank" class="w-full p-7 flex flex-col justify-between text-white rounded-20%s">
							<p class="text-white">%s</p>
							<div class="flex gap-2 items-center text-3xl sm:text-6xl font-bold">%s%s</div>
						</a>',
						esc_url( $url ),
						esc_html( $color ),
						wp_kses_post( $text ),
						esc_html( $number ),
						get_svg( 'icons/star', false ) // phpcs:ignore
					);
				} else {
					printf(
						'<div class="w-full p-7 flex flex-col justify-between text-white rounded-20%s">
							<p class="text-white">%s</p>
							<div class="flex gap-2 items-center text-3xl sm:text-6xl font-bold">%s%s</div>
						</div>',
						esc_html( $color ),
						wp_kses_post( $text ),
						esc_html( $number ),
						get_svg( 'icons/star', false ) // phpcs:ignore
					);
				}

				++$count;

			endwhile;

		endif;
		?>
	</div>

	</div>
</section>
