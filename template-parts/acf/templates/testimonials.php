<?php
/**
 * The ACF template part for displaying Testimonials.
 *
 * @package SWS
 */

$heading      = get_sub_field( 'heading' );
$testimonials = get_sub_field( 'select_testimonials' );

if ( ! $testimonials ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

	<?php
	if ( $heading ) {
		echo '<h2 class="text-32 lg:text-58 text-text-color font-medium leading-[1.1]">' . wp_kses_post( $heading ) . '</h2>';
	}

	// Testimonials.
	$args = [
		'post_type'      => 'testimonials',
		'posts_per_page' => '-1',
		'post__in'       => $testimonials,
		'orderby'        => 'post__in',
	];

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		echo '<p>No testimonial found.</p>';
	}

	echo '<div class="relative">';
	echo '<div class="testimonial-slider mt-10 lg:mt-14 relative">';

	while ( $query->have_posts() ) :
		$query->the_post();

		$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		$job              = get_field( 'job', get_the_ID() );
		$pic              = get_field( 'pic', get_the_ID() );
		$image_html       = '';
		$linkedin         = get_field( 'linkedin', get_the_ID() );
		$linkedin_html    = '';

		if ( $featured_img_url ) {
			$image_html = '<img class="h-14" src="' . $featured_img_url . '">';
		}
		if ( $pic ) {
			$pic = '<img class="w-16 h-16 object-cover rounded-full border border-neutral-200 grayscale" src="' . $pic . '" alt="Author pic">';
		}
		if ( $linkedin ) {
			$linkedin_html = sprintf(
				'<a href="%s" target="_blank" class="text-[#0a66c2]">%s</a>',
				$linkedin,
				get_svg( 'icons/linkedin-blue', false )
			);
		}
		?>

		<div class="flex flex-col justify-between bg-white p-8 rounded-14">

			<?php
			printf(
				'<div class="text-text-color">
					<div class="flex justify-between items-center gap-4 mb-6">
						%1$s
						<span class="flex items-center gap-1">%2$s</span>
					</div>
					<div class="blue-on-link | text-22 line-clamp-6">%3$s</div>
					<div class="w-full border-t border-border-color mt-2.5"></div>
					<div class="flex justify-between items-center gap-4 mt-9">
						<div class="grid gap-2.5">
							<h3 class="text-lg font-extrabold">%4$s</h3>
							%5$s
						</div>
						%6$s
					</div>
				</div>',
				get_svg( 'icons/glassdoor-rating', false ), // phpcs:ignore
				wp_kses_post( $pic ),
				html_entity_decode( wp_trim_words( htmlentities( wpautop( get_the_content() ) ), 60, '...' ) ), // phpcs:ignore
				wp_kses_post( get_the_title() ),
				$linkedin_html, // phpcs:ignore
				wp_kses_post( $image_html )
			);
			?>

		</div>

		<?php
	endwhile;
	wp_reset_postdata();

	echo '</div>';
	echo '<div class="testimonial-arrows | flex justify-center gap-5 lg:absolute -top-[108px] right-0 mt-8 lg:mt-0"></div>';
	echo '</div>';
	?>

	</div>
</section>
