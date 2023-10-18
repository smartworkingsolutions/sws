<?php
/**
 * The ACF template part for displaying Banner with form.
 *
 * @package SWS
 */

$bg        = get_sub_field( 'background_image' );
$is_logo   = get_sub_field( 'logo' );
$heading   = get_sub_field( 'heading' );
$content   = get_sub_field( 'content' );
$content2  = get_sub_field( 'content_2' );
$btn       = get_sub_field( 'button' );
$shortcode = get_sub_field( 'form_shortcode' );
?>

<section class="w-full bg-gradient-to-r from-blue-dark to-blue-light text-white grid items-center relative py-10 md:py-28">
	<div class="container">
		<?php
		if ( $is_logo ) {
			echo '<div class="mb-6 lg:absolute">';
			theme_logo( 'landing' );
			echo '</div>';
		}
		?>
		<div class="grid lg:flex lg:justify-between gap-10 lg:gap-20 items-center">
			<div class="w-full lg:pr-20">
			<?php
			if ( $heading || $content || $btn ) {
				echo '<div class="grid gap-8 relative z-10">';
				if ( $heading ) {
					echo '<h1 class="text-3xl sm:text-4xl lg:text-5xl 3xl:text-6xl font-semibold leading-tight">' . wp_kses_post( $heading ) . '</h1>';
				}
				if ( $content ) {
					echo '<p class="flex items-start gap-3 text-white"><span class="w-5 h-5 text-blue-light mt-1 shrink-0">' . get_svg( 'icons/tick', false ) . '</span>' . do_shortcode( $content ) . '</p>'; //phpcs:ignore
				}
				if ( $content2 ) {
					echo '<p class="flex items-start gap-3 text-white"><span class="w-5 h-5 text-blue-light mt-1 shrink-0">' . get_svg( 'icons/tick', false ) . '</span>' . do_shortcode( $content2 ) . '</p>'; //phpcs:ignore
				}
				if ( $btn ) {
					printf(
						'<div><a href="%s" class="button button-white" target="%s">%s%s</a></div>',
						esc_url( $btn['url'] ),
						esc_html( $btn['target'] ),
						esc_html( $btn['title'] ),
						get_svg( 'icons/button-arrow', false ) // phpcs:ignore
					);
				}
				echo '</div>';
			}
			?>
			</div>

			<div class="w-full relative">
				<?php
				if ( $bg ) {
					echo '<img class="w-full h-96 md:h-[600px] object-cover object-[70%_50%] rounded-10 mx-auto lg:mx-0 relative z-10 lg:-translate-x-28" src="' . esc_url( $bg ) . '" alt="Landing Image">';
				}
				?>
				<!-- Form only show on large screens -->
				<div class="light-form | hidden lg:grid max-w-sm bg-body border-2 border-blue-light p-10 rounded-10 shrink-0 absolute top-1/2 right-0 -translate-y-1/2 z-10">
					<?php
					if ( $shortcode ) {
						echo do_shortcode( $shortcode );
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="down-arrow | w-10 h-10 text-text-color absolute bottom-10 left-1/2 -ml-5 z-10"><?php get_svg( 'icons/arrow-down' ); ?></div>
	<div class="w-[200%] h-40 bg-body absolute bottom-0 -rotate-3"></div>
</section>

<div class="container lg:hidden">
	<!-- Form only show on small screens -->
	<div class="light-form | w-full bg-body border-2 border-blue-light p-10 rounded-10 mt-10 shrink-0">
		<?php
		if ( $shortcode ) {
			echo do_shortcode( $shortcode );
		}
		?>
	</div>
</div>

