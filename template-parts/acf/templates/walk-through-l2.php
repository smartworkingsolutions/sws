<?php
/**
 * The ACF template part for displaying Walk through section layout 2.
 *
 * @package SWS
 */

$heading    = get_sub_field( 'heading' );
$button     = get_sub_field( 'button' );
$pics       = get_sub_field( 'add_pics' );
$list_count = 1;

if ( ! $heading && ! $button && ! $pics && ! have_rows( 'add_lists' ) ) {
	return;
}
?>

<section class="w-full">
	<div class="container">

		<div class="grid xl:grid-cols-2 gap-8 items-stretch">

			<?php
			echo '<div class="grid gap-8">';
			if ( $heading ) {
				echo '<h3 class="text-4xl lg:text-5xl 3xl:text-6xl font-medium mb-2">' . esc_html( $heading ) . '</h3>';
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
							[ 'class' => 'w-[70px] h-[70px] bg-blue-light object-scale-down border-5 border-body rounded-full -ml-6' ]
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

			<?php
			// Lists.
			if ( have_rows( 'add_lists' ) ) {
				echo '<ul class="grid gap-6">';

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
			?>

		</div>

	</div>
</section>
