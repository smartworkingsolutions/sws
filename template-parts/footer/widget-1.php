<?php
/**
 * The template part for displaying Widget 1 in footer.
 *
 * @package SWS
 */

$address    = get_field( 'address', 'option' );
$email      = get_field( 'email', 'option' );
$phone      = get_field( 'phone_numbers', 'option' );
$other_info = get_field( 'other_info', 'option' );
?>

<div class="col-span-full xl:col-span-5 grid justify-center md:justify-start f-widget">

	<?php
	theme_logo( 'footer' );

	if ( $address ) {
		echo '<div class="wysiwyg-editor footer mt-4">' . wp_kses_post( $address ) . '</div>';
	}
	if ( $email ) {
		echo '<div class="wysiwyg-editor footer">' . wp_kses_post( $email ) . '</div>';
	}
	if ( $phone ) {
		echo '<div class="wysiwyg-editor footer">' . wp_kses_post( $phone ) . '</div>';
	}
	if ( $other_info ) {
		echo '<div class="wysiwyg-editor footer">' . wp_kses_post( $other_info ) . '</div>';
	}
	?>

</div>
