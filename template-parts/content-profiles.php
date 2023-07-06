<?php
/**
 * The template part for displaying profiles.
 *
 * @package SWS
 */

?>

<section class="my-14">
	<div class="container">

		<?php
		echo '<div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">';

		if ( ! have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( have_posts() ) :
			the_post();

			$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			$experience       = get_field( 'experience' );

			$profiles = get_the_terms( get_the_id(), 'profile' );
			$skills   = get_the_terms( get_the_id(), 'skill' );
			$count    = 1;

			$sr = '';
			if ( 5 < $experience ) {
				$sr = 'Snr ';
			}
			?>

			<div class="flex flex-col justify-between bg-white rounded-xl">

				<div class="h-full flex flex-col justify-between">
					<div>
					<header class="grid gap-4 px-7 pt-7">
					<?php
					foreach ( $profiles as $profile ) {
						printf(
							'<a class="text-22 text-text-color font-medium hover:text-blue-medium" href="%s"><h3>%s%s</h3></a>',
							esc_url( get_term_link( $profile ) ),
							esc_html( $sr ),
							esc_html( $profile->name )
						);
					}
					?>
					<div class="grid gap-2">
						<span class="font-medium"><?php esc_html_e( 'Expertise: ', 'sws' ); ?></span>
						<ul class="flex flex-wrap items-center gap-2.5">
							<?php
							foreach ( $skills as $skill ) {

								$bg_colors = get_colors( $count );

								printf(
									'<li><a class="text-xs font-extrabold text-white px-3 py-1.5 rounded-md%s" href="%s">%s</a></li>',
									esc_html( $bg_colors ),
									esc_url( get_term_link( $skill ) ),
									esc_html( $skill->name )
								);
								++$count;
							}
							?>
						</ul>
					</div>
					</header>
					<div class="wysiwyg-editor exp | px-7 py-5 flex flex-col justify-between lg:min-h-[258px]">
						<?php the_content(); ?>
					</div>
					<div class="flex justify-between items-center px-7">
						<div class="flex items-center gap-2.5">
						<?php
						if ( $featured_img_url ) {
							echo '<img class="w-10 h-10 rounded-full" src="' . esc_url( $featured_img_url ) . '" alt="' . esc_html( get_the_title() ) . '">';
						}
						the_title( '<h3 class="text-lg font-semibold text-text-color">', '</h3>' );
						?>
						</div>
						<?php
						echo $experience ? '<div class="text-sm lg:text-base bg-blue-medium text-white font-extrabold rounded-20 px-3 py-1">' . esc_html( $experience ) . esc_html__( ' years experience', 'sws' ) . '</div>' : '';
						?>
					</div>
					</div>
					<?php
					printf(
						'<a class="flex justify-center items-center gap-5 text-text-color text-lg font-bold uppercase border-t border-border-color hover:bg-dark-color hover:text-white fill-text-color hover:fill-white rounded-b-20 px-7 py-5 mt-5" href="https://calendly.com/alexsmartworking">%s%s</a>',
						esc_html__( 'Get Started', 'sws' ),
						get_svg( 'icons/button-arrow', false ) // phpcs:ignore
					);
					?>
				</div>

			</div>
			<?php

		endwhile;

		wp_reset_postdata();

		echo '</div>';
		?>
		<?php Custom_Pagination::get_pagination(); ?>

	</div>
</section>
