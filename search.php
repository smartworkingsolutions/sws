<?php
/**
 * The template for displaying Team CPT.
 *
 * @package SWS
 */

get_header();
?>

<section class="my-14">
	<div class="container">

		<header>
			<h1 class="text-4xl font-bold text-blue-dark mb-14">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'sws' ), '<span>' . get_search_query() . '</span>' );
			?>
			</h1>
		</header>

		<?php
		echo '<div class="item-wrap grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">';

		if ( ! have_posts() ) {
			echo '<p>No posts found.</p>';
		}

		while ( have_posts() ) :
			the_post();

			// Load sub field value.
			$thumbnail    = '';
			$thumbnail_id = '';

			if ( has_post_thumbnail() ) {
				$thumbnail_id = get_post_thumbnail_id( get_the_id() );
				$image        = df_resize( $thumbnail_id, '', 410, 255, true, true );

				$thumbnail = sprintf(
					'<a href="%s">
						<img class="w-full drop-shadow-custom" src="%s" alt="%s">
					</a>',
					get_permalink(),
					$image['url'],
					get_the_title()
				);
			}

			printf(
				'<div class="flex flex-col">
					%s
					<div class="mt-11">
					<h3 class="text-2xl 3xl:text-3xl font-bold text-blue-dark">
						<a class="hover:text-blue-medium" href="%s">%s</a>
					</h3>
					<p class="mt-6">%s</p>
					</div>
				</div>',
				$thumbnail, // phpcs:ignore
				esc_url( get_permalink() ),
				wp_kses_post( get_the_title() ),
				wp_kses_post( wp_trim_words( apply_filters( 'the_content', get_the_content() ), 18 ) )
			);

		endwhile;

		wp_reset_postdata();

		echo '</div>';
		?>

		<?php bootstrap_pagination(); ?>

	</div>
</section>

<?php
get_footer();
