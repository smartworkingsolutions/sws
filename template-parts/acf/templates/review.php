<?php
/**
 * The ACF template part for displaying Reviews.
 *
 * @package SWS
 */

$count        = 1;
$rating_title = get_sub_field( 'title' );
$rating_text  = get_sub_field( 'rating_text' );
?>

<section class="w-full">
	<div class="container">

		<div class="grid xl:grid-cols-12">

		<?php
		// Lists.
		if ( have_rows( 'add_list' ) ) :

			echo '<ul class="xl:col-span-5 bg-blue-dark px-5 md:px-12 py-7 md:py-8 xl:py-10 rounded-20">';

			// Loop through rows.
			while ( have_rows( 'add_list' ) ) :
				the_row();

				// Load sub field value.
				$list = get_sub_field( 'list' );

				printf(
					'<li class="flex justify-between items-center gap-4 fill-white py-4 first:pt-0 border-b border-white">
					<span>%s</span>
					<p class="text-white">%s</p>
					</li>',
					get_svg( 'icons/button-arrow', false ), // phpcs:ignore
					esc_html( $list )
				);

			endwhile;

			echo '</ul>';

		endif;

		// Rating.
		if ( $rating_title || $rating_text ) {
			echo '<div class="xl:col-span-3 bg-white px-7 py-8 flex flex-col justify-center gap-4 text-text-color rounded-20">';
			if ( $rating_title ) {
				echo '<h2 class="text-5xl xl:text-8xl font-bold leading-none">' . wp_kses_post( $rating_title ) . '</h2>';
			}
			if ( $rating_text ) {
				echo '<p>' . wp_kses_post( $rating_text ) . '</p>';
			}
			echo '</div>';
		}

		// Reviews.
		if ( have_rows( 'add_reviews' ) ) :

			echo '<div class="xl:col-span-4 sm:flex xl:flex-col xl:justify-items-stretch">';

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
						'<a href="%s" target="_blank" class="w-full flex sm:grid items-center justify-center gap-4 sm:gap-3 px-6 py-6 xl:py-8 rounded-20 text-white%s">
							<div class="text-3xl sm:text-6xl font-bold">%s</div>
							<p class="text-white">%s</p>
						</a>',
						esc_url( $url ),
						esc_html( $color ),
						esc_html( $number ),
						wp_kses_post( $text )
					);
				} else {
					printf(
						'<div class="w-full flex sm:grid items-center justify-center gap-4 sm:gap-3 px-6 py-6 xl:py-8 rounded-20 text-white%s">
							<div class="text-3xl sm:text-6xl font-bold">%s</div>
							<p class="text-white">%s</p>
						</div>',
						esc_html( $color ),
						esc_html( $number ),
						wp_kses_post( $text )
					);
				}

				++$count;

			endwhile;

			echo '</div>';

		endif;
		?>

		</div>

	</div>
</section>
