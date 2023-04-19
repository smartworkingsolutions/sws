<?php
/**
 * The ACF template part for displaying Custom HTML in 2 columns.
 *
 * @package SWS
 */

?>

<section>
	<div class="container">

		<div class="grid grid-cols-1 md:grid-cols-2 items-center gap-10">
			<div class="w-full wysiwyg-editor gap-7">
				<?php
				if ( get_sub_field( 'two_columns_text_1' ) ) {
					echo get_sub_field( 'two_columns_text_1' ); // phpcs:ignore
				}
				?>
			</div>
			<div class="w-full wysiwyg-editor gap-7">
				<?php
				if ( get_sub_field( 'two_columns_text_2' ) ) {
					echo get_sub_field( 'two_columns_text_2' ); // phpcs:ignore
				}
				?>
			</div>
		</div>

	</div>
</section>
