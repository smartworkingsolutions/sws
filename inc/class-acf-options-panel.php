<?php
/**
 * ACF Options Panel
 *
 * @package SWS
 */

defined( 'WPINC' ) || exit;

/**
 * Main Class.
 */
class ACF_Options_Panel {

	/**
	 * The Constructor
	 */
	public function __construct() {
		add_action( 'acf/init', [ $this, 'acf_op_init' ] );
	}

	/**
	 * ACF Options panel init.
	 */
	public function acf_op_init() {

		// Check function exists.
		if ( function_exists( 'acf_add_options_page' ) ) {

			// Add parent.
			$parent = acf_add_options_page(
				[
					'page_title' => __( 'Theme Settings', 'sws' ),
					'menu_title' => __( 'Theme Settings', 'sws' ),
					'icon_url'   => 'dashicons-admin-settings',
					'position'   => '5.3',
				]
			);

			// Add sub page.
			$child = acf_add_options_page(
				[
					'page_title'  => __( 'General Settings', 'sws' ),
					'menu_title'  => __( 'General', 'sws' ),
					'parent_slug' => $parent['menu_slug'],
				]
			);

			// Add sub page.
			$child = acf_add_options_page(
				[
					'page_title'  => __( 'Header Settings', 'sws' ),
					'menu_title'  => __( 'Header', 'sws' ),
					'parent_slug' => $parent['menu_slug'],
				]
			);

			// Add sub page.
			$child = acf_add_options_page(
				[
					'page_title'  => __( 'Footer Settings', 'sws' ),
					'menu_title'  => __( 'Footer', 'sws' ),
					'parent_slug' => $parent['menu_slug'],
				]
			);

		}
	}

}

new ACF_Options_Panel();
