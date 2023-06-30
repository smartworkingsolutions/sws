<?php
/**
 * The ACF template part for displaying Bullets.
 *
 * @package SWS
 */

$heading = get_sub_field( 'heading' );
$count   = 1;

if ( ! $heading && ! have_rows( 'add_bullets' ) ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

		<?php
		if ( $heading ) {
			echo '<h2 class="text-32 lg:text-58 text-text-color font-medium leading-[1.1] text-center">' . wp_kses_post( $heading ) . '</h2>';
		}

		echo '<ul class="grid lg:grid-cols-2 gap-8 xl:gap-16 mt-10 md:mt-16">';

		// Loop through rows.
		while ( have_rows( 'add_bullets' ) ) :
			the_row();

			// Load sub field value.
			$text  = get_sub_field( 'content' );
			$color = ' bg-dark-color';

			if ( 1 === $count ) {
				$color = ' bg-blue-light';
			}
			if ( 2 === $count ) {
				$color = ' bg-blue-medium';
			}
			if ( 3 === $count ) {
				$color = ' bg-blue-dark';
			}

			if ( $text ) {
				printf(
					'<li class="flex items-center gap-5">
						<div class="w-24 h-20 grid place-content-center text-white text-3xl shrink-0 rounded-20%s">%s</div>
						<p class="text-xl">%s</p>
					</li>',
					esc_html( $color ),
					esc_html( $count ),
					wp_kses_post( $text )
				);
			}

			++$count;

		endwhile;

		echo '</ul>';
		?>

	</div>
</section>
