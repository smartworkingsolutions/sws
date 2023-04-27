<?php
/**
 * All custom actions here.
 *
 * @package SWS
 */

defined( 'WPINC' ) || exit;

/**
 * Main class for Actions
 */
class SWS_Actions {

	/**
	 * The Construct
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Hooks and Filters.
	 */
	public function hooks() {
		add_action( 'sws_after_header', [ $this, 'get_after_header' ], 10 );
	}

	/**
	 * Prints HTML of title section after header.
	 */
	public function get_after_header() {
		if ( is_front_page() || ( is_post_type_archive( 'testimonials' ) || is_singular( 'testimonials' ) ) || has_post_parent() ) {
			return;
		}

		?>
		<section class="w-full bg-text-color text-white py-10 text-center">
			<div class="container">
				<h1 class="text-5xl font-medium">
					<?php echo wp_kses_post( $this->get_custom_title() ); ?>
				</h1>
			</div>
		</section>
		<?php
	}

	/**
	 * Get titles according to pages.
	 */
	public function get_custom_title() {

		$output = wp_kses_post( get_the_title( get_the_id() ) );

		if ( is_archive() ) {
			$output = get_the_archive_title();
		}
		if ( is_page() ) {
			$output = wp_kses_post( get_the_title( get_the_id() ) );
		}
		if ( is_search() ) {
			// translators: Heading for search page.
			$output = sprintf( __( 'Search Results for: %s', 'sws' ), '<span>' . get_search_query() . '</span>' );

		}
		if ( is_404() ) {
			$output = __( '404: Page not found', 'sws' );
		}

		return $output;
	}

}

// Init.
new SWS_Actions();
