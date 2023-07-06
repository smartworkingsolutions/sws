<?php
/**
 * The ACF template part for displaying Smart worker section.
 *
 * @package SWS
 */

$heading = get_sub_field( 'heading' );
$count   = 1;
?>

<section class="w-full">
	<div class="container">

		<?php
		if ( $heading ) {
			echo '<h2 class="text-32 lg:text-58 text-text-color font-medium leading-[1.1] text-center">' . wp_kses_post( $heading ) . '</h2>';
		}

		echo '<div class="columns-3 gap-8 mt-10 md:mt-14">';

		// Loop through cards.
		while ( have_rows( 'add_cards' ) ) :
			the_row();

			$card_title = get_sub_field( 'title' );
			$bg_colors  = get_colors( $count );

			echo '<div class="text-white rounded-10 py-5 px-8 mb-8 break-inside-avoid' . esc_html( $bg_colors ) . '">';

			echo '<h3 class="text-3xl">' . esc_html( $card_title ) . '</h3>';

			echo '<ul class="grid gap-3 mt-8">';

			// Loop through lists inside cards.
			while ( have_rows( 'lists' ) ) :
				the_row();

				$list = get_sub_field( 'list' );

				echo '<li class="flex gap-1.5 items-center"><span>#</span>' . esc_html( $list ) . '</li>';

			endwhile;

			echo '</ul>';

			echo '</div>';

			++$count;

		endwhile;

		echo '</div>';
		?>

	</div>
</section>
