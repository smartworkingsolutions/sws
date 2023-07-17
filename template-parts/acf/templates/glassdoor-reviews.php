<?php
/**
 * The ACF template part for displaying Glassdoor reviews.
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

	echo '<div class="grid lg:grid-cols-2 gap-8 mt-10 lg:mt-14">';

	while ( $query->have_posts() ) :
		$query->the_post();

		$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		$job              = get_field( 'job', get_the_ID() );
		$image_html       = '';

		if ( $featured_img_url ) {
			$image_html = '<img class="w-[60px] h-[60px] object-cover" src="' . $featured_img_url . '">';
		}
		$glassdoor_image = '<img class="h-[72px]" src="' . get_template_directory_uri() . '/images/glassdoor.png" alt="Glassdoor">';

		printf(
			'<div class="grid gap-5 justify-between bg-white text-text-color p-8 rounded-14">
				<div class="flex justify-between gap-4">
					<div class="grid gap-2.5">
						<h6 class="text-lg font-extrabold">%s</h6>
						<p class="text-base opacity-60">%s</p>
					</div>
					%s
				</div>
				%s
				<div class="text-22 line-clamp-6">%s</div>
				%s
			</div>',
			wp_kses_post( get_the_title() ),
			esc_html( $job ),
			wp_kses_post( $image_html ),
			get_svg( 'icons/glassdoor-rating', false ), // phpcs:ignore
			html_entity_decode( wp_trim_words( htmlentities( wpautop( get_the_content() ) ), 60, '...' ) ), // phpcs:ignore
			wp_kses_post( $glassdoor_image )
		);

	endwhile;
	wp_reset_postdata();

	echo '</div>';

	// Only visible on mobile screens.
	if ( $btn ) {
		printf(
			'<div class="block sm:hidden mt-8 text-center"><a href="%s" class="button" target="%s">%s%s</a></div>',
			esc_url( $btn['url'] ),
			esc_html( $btn['target'] ),
			esc_html( $btn['title'] ),
			get_svg( 'icons/button-arrow', false ) // phpcs:ignore
		);
	}
	?>

	</div>
</section>
