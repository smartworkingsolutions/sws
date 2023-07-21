<?php
/**
 * The ACF template part for displaying Walk through section.
 *
 * @package SWS
 */

$heading    = get_sub_field( 'heading' );
$list_title = get_sub_field( 'list_title' );
$image      = get_sub_field( 'image' );
$caption    = get_sub_field( 'caption' );
$button     = get_sub_field( 'button' );
$pics       = get_sub_field( 'add_pics' );
$count      = 1;

if ( ! $heading && ! $image && ! $caption && ! $button && ! $pics && ! have_rows( 'add_lists' ) ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

		<div class="grid xl:grid-cols-12 gap-8 items-center">

			<div class="xl:col-span-6 grid gap-6">
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

				echo '<div>';
				// Lists.
				if ( have_rows( 'add_lists' ) ) {
					if ( $list_title ) {
						echo '<p class="font-medium mb-1.5">' . esc_html( $list_title ) . '</p>';
					}
					echo '<ul class="">';

					// Loop through rows.
					while ( have_rows( 'add_lists' ) ) :
						the_row();

						// Load sub field value.
						$list = get_sub_field( 'list' );

						if ( $list ) {
							printf(
								'<li class="flex items-center gap-2 text-lg font-medium opacity-70"><span class="text-sm">#</span>%s</li>',
								wp_kses_post( $list )
							);
						}

					endwhile;

					echo '</ul>';
				}
				?>
				</div>
			</div>
			<div class="xl:col-span-6 relative">
			<?php
			if ( $caption ) {
				printf(
					'<p class="w-full flex items-center gap-2.5 text-base lg:text-22 bg-white fill-text-color rounded-10 px-5 py-3 absolute top-0">%s%s</p>',
					get_svg( 'icons/location', false ), // phpcs:ignore
					esc_html( $caption )
				);
			}
			if ( $image ) {
				echo '<img class="w-full h-full lg:h-[450px] object-cover rounded-10" src="' . esc_url( $image ) . '">';
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

	</div>
</section>
