<?php
/**
 * The ACF template part for displaying Icon with content.
 *
 * @package SWS
 */

$columns     = get_sub_field( 'columns' );
$heading     = get_sub_field( 'heading' );
$classes     = ' xl:grid-cols-3';
$text_class  = '';
$title_class = ' 3xl:text-[50px] 3xl:leading-tight';

if ( '4' === $columns ) {
	$classes     = ' xl:grid-cols-4';
	$text_class  = ' text-base';
	$title_class = '';
}
?>

<section class="w-full">
	<div class="container">

	<?php
	if ( $heading ) {
		echo '<h2 class="text-32 lg:text-58 text-text-color font-medium leading-[1.1] text-center">' . wp_kses_post( $heading ) . '</h2>';
	}

	if ( have_rows( 'add_content' ) ) :

		echo '<div class="grid md:grid-cols-2' . esc_html( $classes ) . ' justify-center gap-8 mt-10 lg:mt-14">';

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
						<h3 class="text-32 lg:text-4xl font-medium text-text-color leading-tight%s">%s</h3>
						<p class="opacity-70%s">%s</p>
					</div>
					%s
				</div>',
				esc_html( $title_class ),
				wp_kses_post( $heading ),
				esc_html( $text_class ),
				wp_kses_post( $content ),
				wp_kses_post( $icon_html )
			);

		endwhile;

		echo '</div>';

	endif;
	?>

	</div>
</section>
