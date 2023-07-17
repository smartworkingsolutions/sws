<?php
/**
 * Custom Pagination
 *
 * @package SWS
 */

defined( 'WPINC' ) || exit;

/**
 * Main class
 */
class Custom_Pagination {

	/**
	 * Prints HTML of pagination.
	 *
	 * @param array $args arguments to override.
	 */
	public static function get_pagination( $args = [] ) {

		$defaults = [
			'range'           => 4,
			'custom_query'    => false,
			'previous_string' => get_svg( 'icons/button-arrow', false ),
			'next_string'     => get_svg( 'icons/button-arrow', false ),
			'before_output'   => '<div class="pagination | mt-16">',
			'after_output'    => '</div>',
		];

		$args = wp_parse_args(
			$args,
			apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
		);

		$args['range'] = (int) $args['range'] - 1;
		if ( ! $args['custom_query'] ) {
			$args['custom_query'] = @$GLOBALS['wp_query']; // phpcs:ignore
		}
		$count = (int) $args['custom_query']->max_num_pages;
		$page  = intval( get_query_var( 'paged' ) );
		$ceil  = ceil( $args['range'] / 2 );

		if ( $count <= 1 ) {
			return false;
		}

		if ( ! $page ) {
			$page = 1;
		}

		if ( $count > $args['range'] ) {
			if ( $page <= $args['range'] ) {
				$min = 1;
				$max = $args['range'] + 1;
			} elseif ( $page >= ( $count - $ceil ) ) {
				$min = $count - $args['range'];
				$max = $count;
			} elseif ( $page >= $args['range'] && $page < ( $count - $ceil ) ) {
				$min = $page - $ceil;
				$max = $page + $ceil;
			}
		} else {
			$min = 1;
			$max = $count;
		}

		$echo     = '';
		$previous = intval( $page ) - 1;
		$previous = esc_attr( get_pagenum_link( $previous ) );

		$echo .= '<ul class="flex justify-center gap-2 font-bold">';
		if ( $previous && ( 1 !== $page ) ) {
			$echo .= '<a class="w-16 h-10 grid place-content-center bg-white hover:bg-blue-medium rounded-10 fill-text-color hover:fill-white rotate-180" href="' . $previous . '" title="' . __( 'previous', 'sws' ) . '" >' . $args['previous_string'] . '</a>';
		}
		if ( ! empty( $min ) && ! empty( $max ) ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				if ( $page === $i ) {
					$ac     = 'aria-current="page"';
					$active = ' bg-blue-medium text-white';
				} else {
					$ac     = '';
					$active = ' bg-white hover:bg-blue-medium text-text-color hover:text-white';
				}
				$echo .= sprintf( '<li><a class="w-10 h-10 grid place-content-center rounded-10' . $active . '" href="%s" ' . $ac . ' aria-label="Goto Page ' . $i . '">%s</a></li>', esc_attr( get_pagenum_link( $i ) ), $i );
			}
		}
		$next = intval( $page ) + 1;
		$next = esc_attr( get_pagenum_link( $next ) );

		if ( $next && ( $count !== $page ) ) {
			$echo .= '<a class="w-16 h-10 grid place-content-center bg-white hover:bg-blue-medium rounded-10 fill-text-color hover:fill-white" href="' . $next . '" title="' . __( 'next', 'sws' ) . '">' . $args['next_string'] . '</a>';
		}
		$echo .= '</ul>';

		if ( isset( $echo ) ) {
			echo $args['before_output'] . $echo . $args['after_output']; // phpcs:ignore
		}
	}

}
