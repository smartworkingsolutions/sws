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
		add_action( 'sws_after_header', [ $this, 'set_modal' ], 10 );
		add_action( 'sws_after_header', [ $this, 'get_after_header' ], 20 );
	}

	/**
	 * Prints HTML of Modal.
	 */
	public function set_modal() {
		$form_shortcode = get_field( 'contact_form_shortcode', 'option' );
		if ( is_page_template( 'page-acf-landing.php' ) ) {
			$form_shortcode = get_field( 'contact_form_shortcode_landing', 'option' );
		}
		if ( $form_shortcode ) {
			echo '<div class="contact-form | w-11/12 md:w-1/2 lg:w-1/3 bg-dark-color text-white p-10 fixed left-1/2 -translate-x-1/2 -top-full z-40"><div class="close | w-8 h-8 bg-white text-dark-color stroke-black grid place-content-center absolute top-1 right-1 cursor-pointer">' . get_svg( 'icons/close', false ) . '</div>' . do_shortcode( $form_shortcode ) . '</div>'; // phpcs:ignore
			echo '<div class="modal-overlay | w-full h-full fixed inset-0 z-20 bg-black/30 hidden"></div>';
		}
	}

	/**
	 * Prints HTML of title section after header.
	 */
	public function get_after_header() {
		if ( is_page_template( 'page-acf-no-title.php' ) || is_page_template( 'page-acf-landing.php' ) || is_front_page() || is_singular( 'testimonials' ) || has_post_parent() ) {
			return;
		}

		?>
		<section class="w-full text-text-color pt-9 pb-14 text-center">
			<div class="container">
				<h1 class="text-5xl lg:text-58 font-medium leading-tight">
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

		$output = get_the_title( get_the_id() );

		if ( is_archive() ) {
			$output = get_the_archive_title();

			if ( is_post_type_archive( 'testimonials' ) ) {
				$output = __( 'Testimonials', 'sws' );
			}
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
