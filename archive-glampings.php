<?php
/**
 * The template for displaying archive glampings
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Glamping_club
 */

get_header();

global $query_string;
parse_str($query_string, $args);

if (!empty($_COOKIE['glcSort'])) {
	if ($_COOKIE['glcSort'] == 'new') {
		$args['orderby'] = 'meta_value date';
		$args['meta_key'] = 'glamping_recommended';
		$args['order'] = 'DESC';
	} elseif ($_COOKIE['glcSort'] == 'rating') {
		// $args['orderby'] = 'meta_value_num';
		// $args['meta_key'] = 'average_rating';
		// $args['order'] = 'DESC';

		$args['meta_query'] = [
			'relation' => 'AND',
			'recommend' => [
				'key' => 'average_rating',
				'type' => 'NUMERIC'
			],
			'rating' => [
				'key' => 'count_rating',
				'type' => 'NUMERIC'
			],
		];
		$args['orderby'] = [
			'recommend' => 'DESC',
			'rating' => 'DESC'
		];
	} elseif ($_COOKIE['glcSort'] == 'recommended') {
		$args['orderby'] = 'meta_value date';
		$args['meta_key'] = 'glamping_recommended';
		$args['order'] = 'DESC';
	} elseif ($_COOKIE['glcSort'] == 'popular') {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = 'views';
		$args['order'] = 'DESC';
	} elseif ($_COOKIE['glcSort'] == 'max_price') {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = 'glamping_price';
		$args['order'] = 'DESC';
	} elseif ($_COOKIE['glcSort'] == 'min_price') {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = 'glamping_price';
		$args['order'] = 'ASC';
	} else {
		$args['orderby'] = 'meta_value date';
		$args['meta_key'] = 'glamping_recommended';
		$args['order'] = 'DESC';
	}
} else {
	$args['orderby'] = 'meta_value date';
	$args['meta_key'] = 'glamping_recommended';
	$args['order'] = 'DESC';
}
query_posts($args);
?>

	<main id="archive-glampings" class="archive-glampings container-ag">
		<div class="archive-glampings__left<?php echo template_cookie_value()['no_map']; ?>">
			<div class="glampings-filtr glcf-scroll custom-scroll">
				<?php get_template_part( 'template-parts/glampings/archive-filtr' ); ?>
			</div>
			<?php if ( have_posts() ) : ?>
			<div class="glampings-items<?php echo template_cookie_value()['card_list']; ?> custom-scroll">
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
		<!-- <div class="overlay js-overlay-modal-archive"></div> -->
	</main><!-- #main -->

<?php
get_footer();

// echo '<pre>';
// var_dump(glampings_map_render());
// echo '</pre>';
