<?php
/**
 * Menu Walker.
 *
 * @package SWS
 */

defined( 'WPINC' ) || exit;

/**
 * Main class
 */
class SWS_Menu_Walker {

	/**
	 * Menu id
	 *
	 * @var $menu_id
	 */
	public $menu_id = '';

	/**
	 * Menu data
	 *
	 * @var $data
	 */
	public $data = [];

	/**
	 * Default constructor.
	 *
	 * @param string $menu_id menu id.
	 */
	public function __construct( $menu_id ) {
		$this->menu_id = $menu_id;
		$cache         = new get_menu_cache( $this->menu_id );
		$this->data    = $cache->data;
	}

	/**
	 * Build the mega menu with one tier drop downs
	 * Needs to be wrapped in a container/nav tag when
	 * output in template
	 *
	 * @param string $loc menu location.
	 *
	 * @return $html
	 */
	public function build_menu( $loc = '' ) {

		global $options;
		global $wp;
		$current_url = home_url( add_query_arg( [], $wp->request ) ) . '/';

		$menu_html = '<ul class="parent | text-text-color font-medium flex items-center space-x-7">';

		if ( 'mobile' === $loc ) {
			$menu_html = '<ul class="flex flex-col space-y-6 text-22 font-medium mt-6">';
		}

		foreach ( $this->data as $link ) {

			$current        = ( $current_url === $link['url'] ) ? true : false;
			$mobile_submenu = 'sub-menu | w-60 bg-body p-5 space-y-7 absolute top-[34px] -left-5 hidden group-hover:block';
			$caret          = '';

			if ( $current && 'mobile' !== $loc ) {
				$classes = 'flex items-center text-blue-medium gap-2';
			}
			if ( ! $current ) {
				$classes = 'flex items-center hover:text-blue-medium gap-2 group-hover:text-blue-medium';
			}
			if ( 'mobile' === $loc ) {
				$classes        = 'flex items-center gap-5 relative';
				$mobile_submenu = 'text-base space-y-5';
			}
			if ( ! empty( $link['children'] ) && is_array( $link['children'] ) && 'mobile' !== $loc ) {
				$caret = '<span class="fill-text-color group-hover:fill-blue-medium group-hover:rotate-45 transition-all">' . get_svg( 'icons/menu-arrow', false ) . '</span>';
			}
			if ( ! empty( $link['children'] ) && is_array( $link['children'] ) && 'mobile' === $loc ) {
				$caret = '<span class="fill-text-color -rotate-90">' . get_svg( 'icons/menu-arrow', false ) . '</span>';
			}

			$target = '';
			if ( '' !== $link['target'] ) {
				$target = ' target="' . $link['target'] . '" ';
			}

			$menu_html .= '<li class="group relative">';

			$menu_html .= sprintf(
				'<a href="%s" %s class="%s">%s%s</a>',
				$link['url'],
				$target,
				$classes,
				$link['title'],
				$caret
			);

			if ( ! empty( $link['children'] ) && is_array( $link['children'] ) ) {
				$menu_html .= '<ul class="mt-5 ' . $mobile_submenu . '">';
			}

			foreach ( $link['children'] as $child ) {

				$menu_html .= '<li class="group relative">';

				if ( empty( $child['children'] ) ) {
					$menu_html .= sprintf(
						'<a href="%s" %s class="hover:text-blue-medium">%s</a>',
						$child['url'],
						$target,
						$child['title']
					);
				}

				$menu_html .= '</li>';

			}

			if ( ! empty( $link['children'] ) && is_array( $link['children'] ) ) {
				$menu_html .= '</ul>';
			}

			$menu_html .= '</li>';

		}

		$menu_html .= '</ul>';

		return $menu_html;

	}

}
