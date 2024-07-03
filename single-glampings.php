<?php
/**
 * The template for displaying all single glampings
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Glamping_club
 */

get_header();
?>

	<main id="primary" class="site-main single-glampings-main container">

		<?php get_template_part( 'template-parts/glampings/single'); ?>

	</main><!-- #main -->

<?php
get_footer();
