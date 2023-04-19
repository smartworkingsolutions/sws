<?php
/**
 * The ACF template part for displaying Icon with content.
 *
 * @package SWS
 */

$heading = get_sub_field( 'heading' );
?>

<section class="w-full">
	<div class="container">

	<?php
	if ( $heading ) {
		echo '<h2 class="text-32 lg:text-58 text-text-color font-medium leading-[1.1] text-center">' . wp_kses_post( $heading ) . '</h2>';
	}

	if ( have_rows( 'add_content' ) ) :

		echo '<div class="grid md:grid-cols-2 xl:grid-cols-3 justify-center gap-8 mt-10 lg:mt-14">';

		// Loop through rows.
		while ( have_rows( 'add_content' ) ) :
			the_row();

			// Load sub field value.
			$icon    = get_sub_field( 'icon' );
			$heading = get_sub_field( 'title' );
			$content = get_sub_field( 'content' );

			$icon_html = '';

			if ( $icon ) {
				$icon_html = '<img class="w-[82px] h-[82px] mx-auto" src="' . $icon . '">';
			}

			printf(
				'<div class="grid justify-center gap-7 bg-white px-8 py-12 rounded-14">
					<div class="grid justify-center text-center gap-7">
						<h3 class="text-32 lg:text-4xl 3xl:text-58 font-medium text-text-color leading-none">%s</h3>
						<p class="opacity-70">%s</p>
					</div>
					%s
				</div>',
				wp_kses_post( $heading ),
				wp_kses_post( $content ),
				wp_kses_post( $icon_html )
			);

		endwhile;

		echo '</div>';

	endif;
	?>

	</div>
</section>
