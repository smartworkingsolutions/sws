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

<section class="w-full aspect-[5/2.4] grid items-center relative px-10">
<!-- <section class="w-full min-h-[620px] xl:min-h-[700px] grid items-center relative px-10"> -->
	<?php
	if ( $bg ) {
		echo '<img class="w-full aspect-[5/2.4] absolute inset-0 object-cover" src="' . esc_url( $bg ) . '" alt="Background Image">';
		// echo '<img class="w-full h-full 2xl:h-auto absolute inset-0 object-cover" src="' . esc_url( $bg ) . '" alt="Background Image">';
	}
	?>
	<div class="container">
		<div class="grid lg:flex lg:justify-between gap-10 items-center">
			<div class="text-center lg:text-left lg:max-w-2xl">
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
					echo '<p class="text-white/80">' . do_shortcode( $content ) . '</p>';
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
			<div class="hidden lg:grid max-w-lg text-white bg-dark-color p-6 relative">
				<?php
				if ( $shortcode ) {
					echo do_shortcode( $shortcode );
				}
				?>
			</div>
		</div>
	</div>
	<div class="down-arrow | w-10 h-10 text-white absolute bottom-10 left-1/2 -ml-5 z-10"><?php get_svg( 'icons/arrow-down' ); ?></div>
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

<section class="w-full bg-white grid items-center relative py-10">
	<div class="container">
		<div class="grid lg:flex lg:justify-between gap-10 items-center">
			<div class="text-center lg:text-left lg:max-w-[800px]">
			<?php
			if ( $is_logo || $heading || $content || $btn ) {
				echo '<div class="grid gap-8 relative z-10">';

				if ( $is_logo ) {
					echo '<div class="mx-auto lg:mx-0">';
					theme_logo( 'landing' );
					echo '</div>';
				}
				if ( $heading ) {
					echo '<h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight">' . wp_kses_post( $heading ) . '</h1>';
				}
				if ( $content ) {
					echo '<p class="flex items-start gap-3"><span class="w-5 h-5 grid rounded-full bg-blue-light mt-1.5 shrink-0"></span>' . do_shortcode( $content ) . '</p>';
				}
				if ( $content2 ) {
					echo '<p class="flex items-start gap-3"><span class="w-5 h-5 grid rounded-full bg-blue-light mt-1.5 shrink-0"></span>' . do_shortcode( $content2 ) . '</p>';
				}
				if ( $bg ) {
					echo '<img class="w-2/5 aspect-video object-cover rounded-10 mx-auto lg:mx-0" src="' . esc_url( $bg ) . '" alt="Background Image">';
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
			<div class="light-form | hidden lg:grid max-w-sm bg-body border-2 border-blue-light p-10 rounded-10 relative shrink-0">
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
	<div class="light-form | w-full bg-body border-2 border-blue-light p-10 rounded-10 mt-10 shrink-0">
		<?php
		if ( $shortcode ) {
			echo do_shortcode( $shortcode );
		}
		?>
	</div>
</div>




<section class="w-full bg-blue-medium text-white grid items-center relative py-10">
	<div class="container">
		<div class="grid lg:flex lg:justify-between gap-10 items-center">
			<div class="text-center lg:text-left lg:max-w-[800px]">
			<?php
			if ( $is_logo || $heading || $content || $btn ) {
				echo '<div class="grid gap-8 relative z-10">';

				if ( $is_logo ) {
					echo '<div class="mx-auto lg:mx-0">';
					theme_logo( 'landing' );
					echo '</div>';
				}
				if ( $heading ) {
					echo '<h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight">' . wp_kses_post( $heading ) . '</h1>';
				}
				if ( $content ) {
					echo '<p class="flex items-start gap-3 text-white"><span class="w-5 h-5 grid rounded-full bg-white mt-1.5 shrink-0"></span>' . do_shortcode( $content ) . '</p>';
				}
				if ( $content2 ) {
					echo '<p class="flex items-start gap-3 text-white"><span class="w-5 h-5 grid rounded-full bg-white mt-1.5 shrink-0"></span>' . do_shortcode( $content2 ) . '</p>';
				}
				if ( $bg ) {
					echo '<img class="w-2/5 aspect-video object-cover rounded-10 mx-auto lg:mx-0" src="' . esc_url( $bg ) . '" alt="Background Image">';
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
			<div class="light-form | hidden lg:grid max-w-sm bg-body border-2 border-blue-light p-10 rounded-10 relative shrink-0">
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
	<div class="light-form | w-full bg-body border-2 border-blue-light p-10 rounded-10 mt-10 shrink-0">
		<?php
		if ( $shortcode ) {
			echo do_shortcode( $shortcode );
		}
		?>
	</div>
</div>
