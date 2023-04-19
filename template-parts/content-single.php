<?php
/**
 * The template part for displaying Content of single page.
 *
 * @package SWS
 */

?>

<div class="single-page my-100">
	<div class="container">

		<div class="grid lg:grid-cols-2 items-center gap-8">

			<div>
				<?php
				the_title( '<h1 class="text-4xl font-bold text-blue-dark mb-8">', '</h1>' );
				the_content();
				?>
			</div>

			<div>
				<?php
				if ( has_post_thumbnail() ) {
					?>
					<img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_id(), 'full' ) ); ?>" class="w-full object-scale-down" alt="<?php get_the_title(); ?>">
					<?php
				}
				?>
			</div>

		</div>

	</div>
</div>

<?php
/**
 * Loop Templates
 */
$acfp = new acf_flexible_content_to_partials( get_the_ID(), 'templates' );
$acfp->render();
