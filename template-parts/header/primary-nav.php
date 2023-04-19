<?php
/**
 * The template part for displaying Main menu in header.
 *
 * @package SWS
 */

$nav = new SWS_Menu_Walker( 'main-menu' );
?>

<nav class="hidden xl:block"><?php echo $nav->build_menu(); // phpcs:ignore ?></nav>
