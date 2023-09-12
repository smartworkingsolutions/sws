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
$list_count = 1;

if ( ! $heading && ! $image && ! $caption && ! $button && ! $pics && ! have_rows( 'add_lists' ) ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

		<div class="grid xl:grid-cols-12 gap-8 items-center">

			<?php
			echo '<div class="xl:col-span-6 grid gap-6">';
			// Lists.
			if ( have_rows( 'add_lists' ) ) {
				if ( $list_title ) {
					echo '<div class="text-3xl 3xl:text-5xl font-medium mb-2">' . esc_html( $list_title ) . '</div>';
				}
				echo '<ul class="grid gap-3">';

				// Loop through rows.
				while ( have_rows( 'add_lists' ) ) :
					the_row();

					// Load sub field value.
					$list = get_sub_field( 'list' );

					if ( $list ) {
						printf(
							'<li class="flex items-center gap-4 text-2xl 3xl:text-3xl font-medium">
								<span class="w-8 h-8 grid place-content-center bg-blue-light text-xl text-white rounded-full shrink-0">%s</span>
								%s
							</li>',
							esc_html( $list_count ),
							wp_kses_post( $list )
						);
					}
					++$list_count;

				endwhile;

				echo '</ul>';
			}
			if ( $pics ) {
				echo '<div class="flex ml-6">';
				foreach ( $pics as $pic ) {
					$bg_colors = get_colors( $count );
					printf(
						'%s',
						wp_get_attachment_image(
							$pic,
							'full',
							true,
							[ 'class' => 'w-[70px] h-[70px] object-scale-down border-5 border-body rounded-full -ml-6' . $bg_colors ]
						)
					);
					++$count;
				}
				echo '</div>';
			}
			?>
			</div>

			<div class="xl:col-span-6 relative">
				<?php
				if ( $caption ) {
					printf(
						'<p class="w-full flex items-center gap-2.5 text-xl bg-white fill-text-color rounded-10 px-5 py-3 absolute top-0">%s%s</p>',
						get_svg( 'icons/location', false ), // phpcs:ignore
						esc_html( $caption )
					);
				}
				if ( $image ) {
					echo '<img class="w-full h-full 3xl:h-[350px] object-cover rounded-10" src="' . esc_url( $image ) . '">';
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
