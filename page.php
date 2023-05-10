<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SWS
 */

get_header();
?>

	<section class="my-14">
		<div class="container">

			<?php
			while ( have_posts() ) :
				the_post();

				echo '<div class="wysiwyg-editor | w-full bg-white p-10 rounded-20 space-y-10">';
				the_content();
				echo '</div>';

			endwhile; // End of the loop.
			?>

		</div>
	</section>

<?php
get_footer();
