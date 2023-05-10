<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package SWS
 */

/**
 * Prints HTML of logo.
 *
 * @param string $loc location of logo.
 */
function theme_logo( $loc = '' ) {
	?>
	<div class="logo">
	<?php
	if ( has_custom_logo() ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		$image_url      = $image[0];
		$footer_logo    = get_theme_mod( 'footer_logo' );

		if ( 'footer' === $loc ) {
			$image_url = $footer_logo;
		}

		printf(
			'<a href="%s" class="navbar-brand">
				<img class="max-h-5" src="%s">
			</a>',
			esc_url( get_home_url() ),
			esc_url( $image_url )
		);
	} else {
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-3xl text-blue-dark font-bold" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php
	}
	?>
	</div>
	<?php
}

if ( ! function_exists( 'sws_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function sws_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on: %s', 'post date', 'sws' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'sws_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function sws_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'sws' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'sws_author_avatar' ) ) :
	/**
	 * Prints HTML with author image for the current author.
	 *
	 * @param string $size size of avatar image.
	 */
	function sws_author_avatar( $size = '100' ) {
		if ( function_exists( 'get_avatar' ) ) :
			echo get_avatar( get_the_author_meta( 'email' ), $size );
		endif;
	}
endif;

if ( ! function_exists( 'sws_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function sws_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'sws' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'sws' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'sws' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'sws' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'sws' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'sws' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'sws_post_title' ) ) {
	/**
	 * Displays an optional post title.
	 */
	function sws_post_title() {

		if ( is_singular() && ! is_front_page() ) :
			the_title( '<h1 class="text-blue-dark text-3xl md:text-4xl font-bold mb-10">', '</h1>' );
		else :
			the_title( '<h2 class="text-blue-dark text-3xl md:text-4xl font-bold mb-10"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

	}
}

if ( ! function_exists( 'sws_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @param string $thumb cuustom thumb size.
	 */
	function sws_post_thumbnail( $thumb = 'post-thumbnail' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail mb-10">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						$thumb,
						[
							'alt' => the_title_attribute(
								[
									'echo' => false,
								]
							),
						]
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Prints HTML of header.
 */
function theme_header_html() {
	?>

	<?php
	// Mobile nav.
	get_template_part( 'template-parts/header/mobile', 'nav' );
	?>

	<!-- Header start -->
	<header class="site-header | w-full relative">
		<div class="container">

			<div class="header-wrap | min-h-[85px] flex justify-between items-center relative z-10">

				<?php theme_logo(); ?>

				<div class="flex items-center gap-7">
				<!-- Nav bar -->
				<?php get_template_part( 'template-parts/header/primary', 'nav' ); ?>

				<!-- Icons -->
				<?php get_template_part( 'template-parts/header/icons' ); ?>
				</div>

				<!-- Buttons -->
				<?php get_template_part( 'template-parts/header/buttons' ); ?>

			</div>

		</div><!-- Container end -->

		<!-- Search Box -->
		<div class="search-overlay w-full h-full fixed inset-0 z-10 bg-black/40 hidden"></div>
		<div class="search-box w-full bg-white min-h-[84px] grid items-center transition">
			<div class="container relative">
				<?php get_search_form(); ?>
				<div class="close absolute top-4 right-8">
					<button class="stroke-text-color hover:stroke-red-500"><?php get_svg( 'icons/close' ); ?></button>
				</div>
			</div>
		</div>
	</header>

	<?php

}

/**
 * Prints HTML of footer.
 */
function theme_footer_html() {
	?>

	<footer class="site-footer">
		<div class="container">

			<div class="grid grid-cols-2 xl:grid-cols-12 gap-8 bg-white rounded-20 px-12 py-9">
				<?php
				/**
				 * Widgets here
				 */
				get_template_part( 'template-parts/footer/widget', '1' );
				get_template_part( 'template-parts/footer/widget', '2' );
				get_template_part( 'template-parts/footer/widget', '3' );
				?>

			</div>

		</div><!-- container end -->
	</footer>

	<?php
	theme_copyrights_html();
	theme_back_to_top();
}

/**
 * Prints HTML of Copyrights.
 */
function theme_copyrights_html() {
	$copyright_text = get_field( 'c_text', 'option' );
	?>

	<!-- Copyrights start -->
	<div class="mb-8">
		<div class="container">

			<div class="grid xl:grid-cols-12 gap-8 bg-white rounded-20 px-12 py-9">
				<?php
				if ( $copyright_text ) {
					echo '<div class="col-span-full xl:col-span-5 flex justify-center xl:justify-start">' . wp_kses_post( $copyright_text ) . '</div>';
				}
				if ( have_rows( 'c_links', 'option' ) ) :

					echo '<ul class="xl:col-span-7 grid sm:flex text-center justify-center sm:justify-between gap-5">';

					while ( have_rows( 'c_links', 'option' ) ) :
						the_row();

						$links = get_sub_field( 'link' );

						if ( $links ) {
							printf(
								'<li>
									<a class="font-medium opacity-50 hover:text-blue-medium hover:opacity-100" href="%s" target="%s">%s</a>
								</li>',
								esc_url( $links['url'] ),
								esc_html( $links['target'] ),
								esc_html( $links['title'] )
							);
						}

					endwhile;

					echo '</ul>';

				endif;
				?>
			</div>

		</div>
	</div>
	<!-- Copyrights end -->

	<?php
}

/**
 * Prints HTML of back to top button.
 */
function theme_back_to_top() {
	?>

	<!-- Back to top start -->
	<a href="#top" class="back-to-top | w-14 h-14 place-content-center bg-blue-light hover:bg-dark-color fill-white rounded-full -rotate-90 fixed right-4 bottom-12 hidden">
		<?php get_svg( 'icons/button-arrow' ); ?>
	</a>
	<!-- Back to top end -->

	<?php
}
