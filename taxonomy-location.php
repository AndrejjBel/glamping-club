<?php
/**
 * The template for displaying archive taxonomy location
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Glamping_club
 */

get_header();

global $query_string;
parse_str($query_string, $args);

$btn_map_mobile_id = 'mapClose';
$btn_map_mobile_text = 'Карта';
if (!empty($_COOKIE['glcTemp'])) {
	if ($_COOKIE['glcTemp'] == 'mapVision') {
		$btn_map_mobile_id = 'mapVision';
		$btn_map_mobile_text = 'Список';
	}
}

if (!empty($_COOKIE['glcSort'])) {
	if ($_COOKIE['glcSort'] == 'new_items') {
		$args['orderby'] = 'date';
		// $args['meta_key'] = 'glamping_recommended';
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

	<div id="btn-filtr-vision-mobile" class="btn-filtr-vision-mobile">
		<button id="all-filter-clear" class="btn-filter-clear primary-light fs10 lsm icon" type="button" name="button" title="Очистить все фильтры">
	        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	            <path d="M3.9 22.9C10.5 8.9 24.5 0 40 0L472 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L396.4 195.6C316.2 212.1 256 283 256 368c0 27.4 6.3 53.4 17.5 76.5c-1.6-.8-3.2-1.8-4.7-2.9l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 65.3C-.7 53.4-2.8 36.8 3.9 22.9zM432 224a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm59.3 107.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L432 345.4l-36.7-36.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L409.4 368l-36.7 36.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L432 390.6l36.7 36.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L454.6 368l36.7-36.7z"/>
	        </svg>
	        <span>Сбросить фильтры</span>
	    </button>
		<button class="btn-filtr-vision-mobile__button button-filtr-icon">
			<span class="btn-filtr-vision-mobile__button__icon">
				<svg width="16" height="16" class="mobile-nav-filtr-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" class="rotate-90">
					<path fill-rule="evenodd" d="M3.25 2.75V6h-.086C1.969 6 1 6.97 1 8.167v1.666C1 11.03 1.969 12 3.164 12h.086v1.25a.75.75 0 1 0 1.5 0V12h.086C6.031 12 7 11.03 7 9.833V8.167A2.165 2.165 0 0 0 4.836 6H4.75V2.75a.75.75 0 0 0-1.5 0m2.252 7.083a.666.666 0 0 1-.666.667H3.164a.666.666 0 0 1-.666-.667V8.167c0-.369.298-.667.666-.667h1.672c.368 0 .666.298.666.667zm5.748 3.417V10h-.082A2.165 2.165 0 0 1 9 7.838V6.162C9 4.968 9.97 4 11.168 4h.082V2.75a.75.75 0 0 1 1.5 0V4h.082C14.029 4 15 4.968 15 6.162v1.676C15 9.032 14.03 10 12.832 10h-.082v3.25a.75.75 0 0 1-1.5 0m2.249-5.412a.666.666 0 0 1-.667.665h-1.664a.666.666 0 0 1-.667-.665V6.162c0-.367.299-.665.667-.665h1.664c.368 0 .667.298.667.665z"></path>
				</svg>
				<!-- <span id="sup-filtr" class="mobile-nav__group__widget__count">0</span> -->
			</span>
			<span class="btn-filtr-vision-mobile__button__text">Фильтр</span>
		</button>
	</div>

	<main id="archive-glampings" class="archive-glampings container-ag">
		<div class="archive-glampings__left<?php echo template_cookie_value()['no_map']; ?>">
			<div class="glampings-filtr glcf-scroll custom-scroll<?php echo template_cookie_value()['glcf_scroll']; ?>">
				<?php get_template_part( 'template-parts/glampings/archive-filtr-location' ); ?>
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
		<div class="archive-glampings__btn-map-mobile">
			<button id="<?php echo $btn_map_mobile_id; ?>" class="primary lsm js-btn-map-mobile" type="button" name="button">
				<?php echo $btn_map_mobile_text; ?>
			</button>
		</div>
	</main><!-- #main -->

<?php
get_footer();
