<?php
/**
 * The ACF template part for displaying Categories.
 *
 * @package SWS
 */

$heading = get_sub_field( 'heading' );
$cats    = get_sub_field( 'select_category' );

if ( ! $heading && ! $cats ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

		<?php
		if ( $heading ) {
			echo '<h2 class="text-32 lg:text-58 text-text-color font-medium leading-[1.1]">' . wp_kses_post( $heading ) . '</h2>';
		}
		?>

		<div class="grid lg:grid-cols-2 xl:grid-cols-3 gap-8 mt-10 lg:mt-14">

		<?php
		foreach ( $cats as $category ) {

			$custom_url = get_field( 'custom_url', $category->taxonomy . '_' . $category->term_id );

			if ( ! $custom_url ) {
				$custom_url = '/services/' . $category->slug;
			}

			printf(
				'<a href="%s" class="button justify-between">
					%s%s
				</a>',
				esc_url( $custom_url ),
				esc_html( $category->name ),
				get_svg( 'icons/button-arrow', false ) // phpcs:ignore
			);
		}
		?>

		</div>

	</div>
</section>
