<?php
/**
 * The ACF template part for displaying Member cards.
 *
 * @package SWS
 */

if ( ! have_rows( 'add_members' ) ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

		<?php
		echo '<ul class="grid grid-cols-2 lg:grid-cols-5 gap-4">';

		// Loop through rows.
		while ( have_rows( 'add_members' ) ) :
			the_row();

			// Load sub field value.
			$pic  = get_sub_field( 'pic' );
			$name = get_sub_field( 'name' );

			if ( $pic && $name ) {
				printf(
					'<li class="relative">
						<img class="w-full h-48 object-cover rounded-xl" src="%s">
						<div class="h-11 grid place-content-center font-medium bg-white rounded-xl absolute bottom-0 left-0 right-0">%s</div>
					</li>',
					esc_url( $pic ),
					esc_html( $name )
				);
			}

		endwhile;

		echo '</ul>';
		?>

	</div>
</section>
