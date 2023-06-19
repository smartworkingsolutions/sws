<?php
/**
 * The ACF template part for displaying Cards with Person image and some content.
 *
 * @package SWS
 */

$columns = get_sub_field( 'columns' );
$heading = get_sub_field( 'heading' );
$class   = '';
$width   = 'max-w-6xl mx-auto';

if ( 'two' === $columns ) {
	$class = ' xl:grid-cols-2';
	$width = 'w-full';
}
if ( ! have_rows( 'add_cards' ) ) {
	return;
}
?>

<section class="<?php echo $width ? esc_html( $width ) : ''; ?>">
	<div class="container">

		<?php
		if ( $heading ) {
			echo '<h2 class="text-32 lg:text-58 text-text-color font-medium leading-[1.1] text-center mb-10 lg:mb-14">' . wp_kses_post( $heading ) . '</h2>';
		}

		// Lists.
		if ( have_rows( 'add_cards' ) ) :

			echo '<div class="grid' . esc_html( $class ) . ' gap-8">';

			// Loop through rows.
			while ( have_rows( 'add_cards' ) ) :
				the_row();

				// Load sub field value.
				$image      = get_sub_field( 'image' );
				$card_title = get_sub_field( 'title' );
				$text       = get_sub_field( 'text' );
				$linkedin   = get_sub_field( 'linkedin_url' );

				$image_html    = '';
				$linkedin_html = '';

				if ( $image ) {
					$image_html = sprintf(
						'<img class="w-full lg:w-1/3 h-full object-cover lg:rounded-l-20 lg:shrink-0" src="%1$s" alt="%2$s">',
						$image,
						$card_title,
					);
				}
				if ( $linkedin ) {
					$linkedin_html = sprintf(
						'<a class="w-max bg-blue-light hover:bg-blue-dark rounded-full p-3 fill-white mt-2 transition-all" href="%s">%s</a>',
						$linkedin,
						get_svg( 'icons/linkedin', false )
					);
				}

				printf(
					'<div class="grid lg:flex items-center bg-white rounded-20">
						%1$s
						<div class="grid items-start gap-6 p-8">
							<h3 class="text-4xl font-medium">%2$s</h3>
							<h4 class="text-xl font-medium">%3$s</h4>
							%4$s
						</div>
					</div>',
					wp_kses_post( $image_html ),
					esc_html( $card_title ),
					wp_kses_post( $text ),
					$linkedin_html // phpcs:ignore
				);

			endwhile;

			echo '</div>';

		endif;
		?>

	</div>
</section>
