<?php
/**
 * The ACF template part for displaying Icon with title.
 *
 * @package SWS
 */

$heading = get_sub_field( 'heading' );

if ( ! is_front_page() ) {
	$heading = __( 'Best In Class ', 'sws' ) . get_the_title();
}
?>

<section class="w-full">
	<div class="container">

	<?php
	if ( $heading ) {
		echo '<h2 class="text-3xl 4xl:text-[32px] leading-tight font-bold text-text-color">' . wp_kses_post( $heading ) . '</h2>';
	}

	if ( have_rows( 'add_content' ) ) :

		echo '<div class="grid md:grid-cols-2 justify-center gap-x-10 gap-y-10 mt-6">';

		// Loop through rows.
		while ( have_rows( 'add_content' ) ) :
			the_row();

			// Load sub field value.
			$icon = get_sub_field( 'icon' );
			$text = get_sub_field( 'title' );

			$icon_html = '';

			if ( $icon ) {
				$icon_html = sprintf(
					'<div class="w-100 h-100 bg-blue-dark grid place-content-center shrink-0">
                        <img class="h-16" src="%s">
                    </div>',
					$icon
				);
			}

			printf(
				'<div class="flex items-center gap-5">
					%s
                    <div>
                        <h3 class="text-2xl font-bold text-text-color">%s</h3>
                    </div>
				</div>',
				wp_kses_post( $icon_html ),
				wp_kses_post( $text )
			);

		endwhile;

		echo '</div>';

	endif;
	?>

	</div>
</section>
