<?php
/**
 * The ACF template part for displaying Walk through section.
 *
 * @package SWS
 */

$heading = get_sub_field( 'heading' );
$image   = get_sub_field( 'image' );
$caption = get_sub_field( 'caption' );
$button  = get_sub_field( 'button' );
$count   = 1;

if ( ! $heading && ! $image && ! $caption && ! $button && ! have_rows( 'add_members' ) ) {
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

		<div class="grid lg:grid-cols-12 gap-4 mt-10 lg:mt-14">

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
					echo '<img class="w-full h-[414px] object-cover rounded-10" src="' . esc_url( $image ) . '">';
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
			if ( have_rows( 'add_members' ) ) :

				echo '<ul class="lg:col-span-5 grid grid-cols-4 items-stretch gap-4">';

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

					++$count;

				endwhile;

				echo '</ul>';

			endif;
			?>

		</div>

	</div>
</section>
