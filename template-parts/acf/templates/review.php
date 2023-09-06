<?php
/**
 * The ACF template part for displaying Reviews.
 *
 * @package SWS
 */

if ( ! have_rows( 'add_review' ) ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

	<?php
	echo '<div class="grid lg:grid-cols-2 gap-8">';

	// Loop through rows.
	while ( have_rows( 'add_review' ) ) :
		the_row();

		// Load sub field value.
		$review_title   = get_sub_field( 'title' );
		$review_content = get_sub_field( 'content' );

		printf(
			'<div class="w-full p-7 grid gap-4 bg-blue-light text-white rounded-20">
				<h3 class="text-32 font-bold">%s</h3>
				<p class="text-white">%s</p>
			</div>',
			esc_html( $review_title ),
			wp_kses_post( $review_content )
		);

	endwhile;

	echo '</div>';
	?>

	</div>
</section>
