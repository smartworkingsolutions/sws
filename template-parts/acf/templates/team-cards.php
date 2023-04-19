<?php
/**
 * The ACF template part for displaying Cards with Person image.
 *
 * @package SWS
 */

if ( ! have_rows( 'add_cards' ) ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

		<?php
		// Lists.
		if ( have_rows( 'add_cards' ) ) :

			echo '<div class="grid xl:grid-cols-2 gap-8">';

			// Loop through rows.
			while ( have_rows( 'add_cards' ) ) :
				the_row();

				// Load sub field value.
				$image      = get_sub_field( 'image' );
				$name       = get_sub_field( 'name' );
				$job        = get_sub_field( 'job' );
				$linkedin   = get_sub_field( 'linkedin_url' );
				$image_html = '';

				if ( $image && $name ) {
					$image_html = sprintf(
						'<img class="w-64 h-full object-cover rounded-l-20" src="%1$s" alt="%2$s">',
						$image,
						$name,
					);
				}

				printf(
					'<div class="flex items-center bg-white rounded-20">
						%1$s
						<div class="grid items-start gap-2 p-6">
							<h3 class="text-4xl font-medium">%2$s</h3>
							<h4 class="text-xl font-medium">%3$s</h4>
							<a class="w-max bg-blue-light hover:bg-blue-dark rounded-full p-3 fill-white mt-2 transition-all" href="%4$s">%5$s</a>
						</div>
					</div>',
					wp_kses_post( $image_html ),
					esc_html( $name ),
					esc_html( $job ),
					esc_url( $linkedin ),
					get_svg( 'icons/linkedin', false ) // phpcs:ignore
				);

			endwhile;

			echo '</div>';

		endif;
		?>

	</div>
</section>
