<?php
/**
 * The template for displaying archive glampings
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Glamping_club
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">Глэмпинги</h1>
			</header><!-- .page-header -->

			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/glampings/archive' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
