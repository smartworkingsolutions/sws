<?php
/**
 * The template for displaying error(404) page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SWS
 */

get_header();

$heading = get_field( 'error_heading', 'option' );
$text    = get_field( 'error_content', 'option' );
$btn     = get_field( 'error_button', 'option' );
?>

<section class="my-20">
	<div class="container">

		<div class="text-center">

			<svg xmlns="http://www.w3.org/2000/svg" class="stroke-dark-color h-40 w-40 mx-auto mb-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
				<path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
			</svg>

			<?php
			if ( $heading ) {
				echo '<h2 class="text-4xl font-medium text-blue-dark mb-4">' . esc_html( $heading ) . '</h2>';
			}
			if ( $text ) {
				echo '<p class="max-w-3xl mx-auto">' . wp_kses_post( $text ) . '</p>';
			}
			if ( $btn ) {
				printf(
					'<a href="%s" class="button mt-10" target="%s">%s%s</a>',
					esc_url( $btn['url'] ),
					esc_html( $btn['target'] ),
					esc_html( $btn['title'] ),
					get_svg( 'icons/button-arrow', false ) // phpcs:ignore
				);
			}
			?>

		</div>

	</div>
</section>

<?php
get_footer();
