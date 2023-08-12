<?php
/**
 * The template part for displaying Testimonials.
 *
 * @package SWS
 */

?>

<section class="mb-10 md:mb-28">
	<div class="container">

		<?php
		if ( ! have_posts() ) {
			echo '<p>No testimonials found.</p>';
		}

		echo '<div class="grid gap-5">';

		while ( have_posts() ) :
			the_post();

			$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			$linkedin         = get_field( 'linkedin', get_the_ID() );
			$image_html       = '';
			$linkedin_html    = '';

			if ( $featured_img_url ) {
				$image_html = '<img class="h-10 mt-2.5" src="' . $featured_img_url . '">';
			}
			if ( $linkedin ) {
				$linkedin_html = sprintf(
					'<a href="%s">%s</a>',
					$linkedin,
					get_svg( 'icons/linkedin-blue', false )
				);
			}

			printf(
				'<div class="grid md:grid-cols-12 gap-6 md:gap-4 justify-between bg-white text-text-color p-5 md:p-8 rounded-14">
					<div class="md:col-span-4 xl:col-span-3 flex gap-5">
						<div class="grid justify-between gap-2.5">
							<div>
								<h6 class="text-lg font-extrabold">%1$s</h6>
								%2$s
							</div>
							<span class="hidden md:block">%3$s</span>
						</div>
						<span class="md:hidden ml-auto">%3$s</span>
					</div>
					<div class="md:col-span-8 xl:col-span-9 grid gap-4">
						%4$s
						<div class="blue-on-link testi">%5$s</div>
					</div>
				</div>',
				wp_kses_post( get_the_title() ),
				wp_kses_post( $image_html ),
				$linkedin_html, // phpcs:ignore
				get_svg( 'icons/glassdoor-rating', false ), // phpcs:ignore
				html_entity_decode( wp_trim_words( htmlentities( wpautop( get_the_content() ) ), 60, '...' ) ) // phpcs:ignore
			);

		endwhile;

		wp_reset_postdata();

		echo '</div>';
		?>
		<?php Custom_Pagination::get_pagination(); ?>

	</div>
</section>
