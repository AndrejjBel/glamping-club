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

	<main id="archive-glampings" class="archive-glampings container-ag">
		<div class="archive-glampings__left<?php echo template_cookie_value()['no_map']; ?>">
			<div class="glampings-filtr glcf-scroll custom-scroll">
				<?php get_template_part( 'template-parts/glampings/archive-filtr' ); ?>
			</div>
			<?php if ( have_posts() ) : ?>
			<div class="glampings-items<?php echo template_cookie_value()['card_list']; ?>  custom-scroll">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/glampings/archive' );

				endwhile;
				?>
				<div class="js-more-wrap"></div>
			</div>
				<?php
				// the_posts_navigation();
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
		<div class="glampings-map<?php echo template_cookie_value()['map']; ?>">
			<div id="mapYandex" class="glampings-map__content"></div>
		</div>
	</main><!-- #main -->

<?php
get_footer();

// echo '<pre>';
// var_dump(glampings_map_render());
// echo '</pre>';
