<?php
/**
 * The ACF template part for displaying Content with image.
 *
 * @package SWS
 */

$heading = get_sub_field( 'heading' );
$image   = get_sub_field( 'image' );
$caption = get_sub_field( 'caption' );
$button  = get_sub_field( 'button' );
$count   = 1;

if ( ! $heading && ! $image && ! $caption && ! $button && ! have_rows( 'add_lists' ) ) {
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

		<div class="grid lg:grid-cols-12 mt-10 lg:mt-14">

			<div class="lg:col-span-7">
				<div class="relative">
				<?php
				if ( $caption ) {
					printf(
						'<p class="w-full flex items-center gap-2.5 text-base lg:text-22 bg-white fill-text-color rounded-10 px-5 py-3 absolute top-0">%s%s</p>',
						get_svg( 'icons/location', false ), // phpcs:ignore
						esc_html( $caption )
					);
				}
				if ( $image ) {
					echo '<img class="w-full h-full" src="' . esc_url( $image ) . '">';
				}
				if ( $button ) {
					printf(
						'<div><a href="%s" class="button absolute left-8 bottom-8" target="%s">%s%s</a></div>',
						esc_url( $button['url'] ),
						esc_html( $button['target'] ),
						esc_html( $button['title'] ),
						get_svg( 'icons/button-arrow', false ) // phpcs:ignore
					);
				}
				?>
				</div>
			</div>

			<?php
			// Lists.
			if ( have_rows( 'add_lists' ) ) :

				echo '<ul class="lg:col-span-5 flex flex-col lg:justify-items-stretch">';

				// Loop through rows.
				while ( have_rows( 'add_lists' ) ) :
					the_row();

					// Load sub field value.
					$list  = get_sub_field( 'list' );
					$color = ' bg-blue-dark';

					if ( 1 === $count ) {
						$color = ' bg-blue-light';
					}
					if ( 2 === $count ) {
						$color = ' bg-blue-medium';
					}

					printf(
						'<li class="w-full h-full flex items-center gap-5 text-xl sm:text-2xl font-medium rounded-20 p-7 text-white fill-white%s"><span class="shrink-0">%s</span>%s</li>',
						esc_html( $color ),
						get_svg( 'icons/button-arrow', false ), // phpcs:ignore
						esc_html( $list )
					);

					++$count;

				endwhile;

				echo '</ul>';

			endif;
			?>

		</div>

	</div>
</section>
