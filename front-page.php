<?php
/**
 * The template for displaying Front page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Glamping_club
 */

get_header();
?>

	<main id="primary" class="front-main">

		<?php get_template_part( 'template-parts/pages/front' ); ?>

	</main><!-- #main -->

<?php
get_footer();
