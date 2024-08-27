<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Glamping_club
 */

get_header();
?>

	<main id="primary" class="site-main-search container">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Результаты поиска по запросу: %s', 'glamping-club' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="archive-glampings">

				<div class="glampings-items card no-sidebar custom-scroll">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/glampings/archive' );

					endwhile;
					?>
					<div class="js-more-wrap"></div>
				</div>
				<?php

				the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

			</div>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
