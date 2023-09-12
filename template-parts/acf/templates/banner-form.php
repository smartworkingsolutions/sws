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
$btn       = get_sub_field( 'button' );
$shortcode = get_sub_field( 'form_shortcode' );
?>

<section class="w-full min-h-[722px] grid items-center relative">
	<?php
	if ( $bg ) {
		echo '<img class="w-full h-full absolute inset-0 object-cover" src="' . esc_url( $bg ) . '" alt="Background Image">';
	}
	?>
	<div class="container">
		<div class="grid lg:grid-cols-12 gap-10 items-center">
			<div class="lg:col-span-7 text-center lg:text-left">
			<?php
			if ( $is_logo || $heading || $content || $btn ) {
				if ( $is_logo ) {
					echo '<div class="absolute top-10 left-1/2 lg:left-auto -translate-x-1/2 lg:translate-x-0">';
					theme_logo( 'landing' );
					echo '</div>';
				}
				echo '<div class="grid gap-10 relative z-10">';

				if ( $heading ) {
					echo '<h1 class="text-3xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight">' . wp_kses_post( $heading ) . '</h1>';
				}
				if ( $content ) {
					echo '<p class="text-white/80">' . wp_kses_post( $content ) . '</p>';
				}
				if ( $btn ) {
					printf(
						'<div><a href="%s" class="button" target="%s">%s%s</a></div>',
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

			<!-- Form only show on large screens -->
			<div class="lg:col-span-5 hidden lg:grid text-white bg-dark-color p-6 relative">
				<?php
				if ( $shortcode ) {
					echo do_shortcode( $shortcode );
				}
				?>
			</div>
		</div>
	</div>
</section>

<div class="container lg:hidden">
	<!-- Form only show on small screens -->
	<div class="w-full text-white bg-dark-color p-6 mt-10">
		<?php
		if ( $shortcode ) {
			echo do_shortcode( $shortcode );
		}
		?>
	</div>
</div>
