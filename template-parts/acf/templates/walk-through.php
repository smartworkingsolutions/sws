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
$pics    = get_sub_field( 'add_pics' );
$count   = 1;

if ( ! $heading && ! $image && ! $caption && ! $button && ! $pics ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

		<div class="grid xl:grid-cols-12 gap-8 items-center">

			<div class="xl:col-span-5 grid gap-6">
				<?php
				if ( $heading ) {
					echo '<h2 class="text-32 lg:text-[42px] text-text-color font-medium leading-[1.1]">' . wp_kses_post( $heading ) . '</h2>';
				}
				if ( $pics ) {
					echo '<div class="flex ml-6">';
					foreach ( $pics as $pic ) {
						printf(
							'%s',
							wp_get_attachment_image(
								$pic,
								'full',
								true,
								[ 'class' => 'w-[72px] h-[72px] object-cover border-5 border-body rounded-full -ml-6' ]
							)
						);
					}
					echo '</div>';
				}
				if ( $button ) {
					printf(
						'<div><a href="%s" class="button" target="%s">%s%s</a></div>',
						esc_url( $button['url'] ),
						esc_html( $button['target'] ),
						esc_html( $button['title'] ),
						get_svg( 'icons/button-arrow', false ) // phpcs:ignore
					);
				}
				?>
			</div>
			<div class="xl:col-span-7">
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
					echo '<img class="w-full h-full object-cover rounded-10" src="' . esc_url( $image ) . '">';
				}
				?>
				</div>
			</div>

		</div>

	</div>
</section>
