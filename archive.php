<?php
/**
 * The template for displaying Archive pages.
 *
 * @package SWS
 */

get_header();
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

			// Load sub field value.
			$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			$experience       = get_field( 'experience' );

			$profiles = get_the_terms( get_the_id(), 'profile' );
			$skills   = get_the_terms( get_the_id(), 'skill' );

			?>
			<div class="flex flex-col justify-between border border-border-color">

				<div>
					<header class="flex items-center gap-5 p-6">
						<?php
						if ( $featured_img_url ) {
							echo '<img class="w-100 h-100 rounded-full" src="' . esc_url( $featured_img_url ) . '" alt="">';
						}
						?>
						<div class="grid text-text-color text-sm font-semibold gap-1">
							<?php the_title( '<h3 class="text-2xl font-bold text-blue-dark">', '</h3>' ); ?>
							<div class="flex items-center flex-wrap gap-2">
								<?php
								foreach ( $profiles as $profile ) {
									echo '<a class="hover:text-blue-medium" href="' . esc_url( get_term_link( $profile ) ) . '">' . esc_html( $profile->name ) . '</a>';
								}
								?>
								<div class="w-1.5 h-1.5 rounded-md bg-text-color"></div>
								<div>
									<?php echo $experience ? esc_html__( 'Exp. ', 'sws' ) . esc_html( $experience ) . esc_html__( ' years', 'sws' ) : ''; ?>
								</div>
							</div>
						</div>
					</header>

					<div class="flex items-center gap-2.5 px-6 py-2.5 bg-light-color text-text-color text-sm">
						<div class="text-blue-dark font-semibold">
							<?php esc_html_e( 'Skills:', 'sws' ); ?>
						</div>
						<ul class="flex items-center gap-2.5">
							<?php
							foreach ( $skills as $skill ) {
								echo '<li>#<a class="hover:text-blue-medium" href="' . esc_url( get_term_link( $skill ) ) . '">' . esc_html( $skill->name ) . '</a></li>';
							}
							?>
						</ul>
					</div>

					<div class="wysiwyg-editor exp p-6 flex flex-col justify-between">
						<?php the_content(); ?>
					</div>
				</div>

				<div class="px-6 pb-6">
					<a href="https://smartworking-solutions.com/book-a-chat/" class="button"><?php esc_html_e( 'Enquire for price', 'sws' ); ?></a>
				</div>

			</div>
			<?php

		endwhile;

		wp_reset_postdata();

		echo '</div>';
		?>

	</div>
</section>

<?php
get_footer();
