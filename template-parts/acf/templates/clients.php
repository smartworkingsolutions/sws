<?php
/**
 * The ACF template part for displaying Clients.
 *
 * @package SWS
 */

$heading    = get_sub_field( 'heading' );
$extra_link = get_sub_field( 'extra_link' );
$logos      = get_sub_field( 'add_logos' );
?>

<section class="w-full">
	<div class="container">

	<?php
	if ( $heading ) {
		echo '<h2 class="text-32 lg:text-58 text-text-color font-medium leading-[1.1]">' . wp_kses_post( $heading ) . '</h2>';
	}

	if ( $logos ) {
		echo '<div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 xl:grid-cols-9 gap-5 mt-10 lg:mt-14">';
		foreach ( $logos as $logo ) {
			printf(
				'<div class="w-full grid place-content-center aspect-square bg-white rounded-14 p-3">
					%s
				</div>',
				wp_get_attachment_image(
					$logo,
					'full',
					true,
					[ 'class' => 'w-full object-scale-down grayscale' ]
				)
			);
		}

		// Extra link in last item.
		if ( $extra_link ) {
			printf(
				'<a href="%s" class="col-span-2 w-full grid place-content-center text-center text-lg font-bold uppercase bg-white rounded-14 px-4" target="%s">%s</a>',
				esc_url( $extra_link['url'] ),
				esc_html( $extra_link['target'] ),
				esc_html( $extra_link['title'] )
			);
		}
		echo '</div>';
	}
	?>

	</div>
</section>
