<?php
/**
 * The ACF template part for displaying Glassdoor reviews carousel.
 *
 * @package SWS
 */

$heading = get_sub_field( 'heading' );
$btn     = get_sub_field( 'button' );
$reviews = get_sub_field( 'select_reviews' );

if ( ! $heading && ! $btn && ! $reviews ) {
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
		echo '</div>';
	}

	// Reviews.
	$args = [
		'post_type'      => 'glassdoor',
		'posts_per_page' => '-1',
		'post__in'       => $glassdoor,
		'orderby'        => 'post__in',
	];

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		echo '<p>No reviews found.</p>';
	}

	echo '<div class="relative">';
	echo '<div class="testimonial-slider mt-10 lg:mt-14 relative">';

	while ( $query->have_posts() ) :
		$query->the_post();

		$glassdoor_image = '<a class="flex" href="https://www.glassdoor.co.uk/Reviews/Smart-Working-Reviews-E6476291.htm" target="_blank"><img class="h-[72px]" src="' . get_template_directory_uri() . '/images/glassdoor.png" alt="Glassdoor"></a>';

		printf(
			'<div class="space-y-5 bg-white text-text-color p-8 rounded-14">
				<div class="flex justify-between gap-4">
					<div class="grid gap-2.5">
						<h6 class="text-lg font-extrabold">%s</h6>
					</div>
				</div>
				%s
				<div class="text-22 line-clamp-6">%s</div>
				%s
			</div>',
			wp_kses_post( get_the_title() ),
			get_svg( 'icons/glassdoor-rating', false ), // phpcs:ignore
			html_entity_decode( wp_trim_words( htmlentities( wpautop( get_the_content() ) ), 60, '...' ) ), // phpcs:ignore
			wp_kses_post( $glassdoor_image )
		);

	endwhile;
	wp_reset_postdata();

	echo '</div>';
	echo '<div class="testimonial-arrows | flex justify-center gap-5 lg:absolute -top-[108px] right-0 mt-8 lg:mt-0"></div>';
	echo '</div>';
	?>

	</div>
</section>
