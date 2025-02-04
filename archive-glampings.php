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

$glc_per_page = get_glc_option('glc_options', 'posts_per_page_all');

// $width = "<script>document.write(window.innerWidth);</script>";
// if ((int)$width > 1649) {
// 	$args['posts_per_page'] = 5;
// }

// $args['posts_per_page'] = $glc_per_page_arr[0];

$btn_map_mobile_id = 'mapVision';
$btn_map_mobile_text = 'Список';
if (!empty($_COOKIE['glcTemp'])) {
	if ($_COOKIE['glcTemp'] == 'mapClose') {
		$btn_map_mobile_id = 'mapClose';
		$btn_map_mobile_text = 'Карта';
	} elseif ($_COOKIE['glcTemp'] == 'mapVision') {
		$btn_map_mobile_id = 'mapVision';
		$btn_map_mobile_text = 'Список';
	}
}

$filtr_hidden = '';
if ( !empty( $_COOKIE["mediaQuery"] ) ) {
	if ($_COOKIE["mediaQuery"] < 1440) {
		$filtr_hidden = ' visible-hidden';
	}
}

if (!empty($_COOKIE['glcSort'])) {
	if ($_COOKIE['glcSort'] == 'new_items') {
		$args['orderby'] = 'date';
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
		$args['orderby'] = 'date';
		$args['order'] = 'DESC';
	}
} else {
	$args['orderby'] = 'date';
	$args['order'] = 'DESC';
}
query_posts($args);
?>
<style media="screen">
.archive-glampings .scrollbar-thumb {
	width: 5px;
	background: rgb(70, 122, 60);
	cursor: pointer;
}
.archive-glampings .scrollbar-track {
	background: transparent;
}
.archive-glampings .scrollbar-track-y {
	width: 5px;
}
@media (max-width: 1199px) {
    .glampings-filtr {
        display: none;
    }
}
</style>

	<div id="btn-filtr-vision-mobile" class="btn-filtr-vision-mobile-wrap">
		<div class="container-ag">
			<div class="btn-filtr-vision-mobile">
				<div class="btn-group-mobile btn-group-map js-btn-map">
		            <button id="mapClose" class="secondary color-text fs12 w100 map-close<?php echo template_cookie_value()['btn_close']; ?>" type="button" name="button">Список</button>
		            <button id="mapVision" class="secondary color-text fs12 w100 map-vision<?php echo template_cookie_value()['btn_vision']; ?>" type="button" name="button">Карта</button>
		        </div>

				<button class="glampings-filtr-btns__item button-filtr-icon">
					<span class="btn-filtr-vision-mobile__button__icon">
						<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M0.75 10.0714H4V10.1451C4 11.1694 4.97 12 6.167 12H7.833C9.03 12 10 11.1694 10 10.1451V10.0714H11.25C11.4489 10.0714 11.6397 10.0037 11.7803 9.88314C11.921 9.76258 12 9.59907 12 9.42857C12 9.25808 11.921 9.09456 11.7803 8.974C11.6397 8.85344 11.4489 8.78571 11.25 8.78571H10V8.712C10 7.68771 9.03 6.85714 7.833 6.85714L6.167 6.85714C5.8826 6.85692 5.60094 6.90472 5.33811 6.99783C5.07527 7.09093 4.83641 7.22751 4.63517 7.39976C4.43394 7.57201 4.27426 7.77656 4.16528 8.00172C4.05629 8.22687 4.00013 8.46823 4 8.712V8.78571H0.75C0.551088 8.78571 0.360322 8.85344 0.21967 8.974C0.0790175 9.09456 0 9.25808 0 9.42857C0 9.59907 0.0790175 9.76258 0.21967 9.88314C0.360322 10.0037 0.551088 10.0714 0.75 10.0714ZM7.833 8.14114C7.92055 8.14103 8.00726 8.15571 8.08817 8.18435C8.16909 8.21299 8.24263 8.25502 8.30458 8.30804C8.36653 8.36106 8.41568 8.42403 8.44921 8.49334C8.48274 8.56266 8.5 8.63696 8.5 8.712V10.1451C8.5 10.2202 8.48274 10.2945 8.44921 10.3638C8.41568 10.4331 8.36653 10.4961 8.30458 10.5491C8.24263 10.6021 8.16909 10.6442 8.08817 10.6728C8.00726 10.7014 7.92055 10.7161 7.833 10.716H6.167C5.798 10.716 5.5 10.4606 5.5 10.1451V8.712C5.5 8.39657 5.798 8.14114 6.167 8.14114H7.833ZM11.25 3.21429H8V3.28457C8.00039 3.52827 7.94479 3.76964 7.83635 3.99492C7.72791 4.22019 7.56877 4.42496 7.36801 4.59751C7.16725 4.77007 6.9288 4.90705 6.66628 5.00062C6.40376 5.09419 6.12231 5.14252 5.838 5.14286H4.162C2.968 5.14286 2 4.31143 2 3.28457V3.21429H0.75C0.551088 3.21429 0.360322 3.14656 0.21967 3.026C0.0790175 2.90544 0 2.74192 0 2.57143C0 2.40093 0.0790175 2.23742 0.21967 2.11686C0.360322 1.9963 0.551088 1.92857 0.75 1.92857H2V1.85829C2 0.832286 2.968 0 4.162 0H5.838C7.032 0 8 0.831429 8 1.85829V1.92857H11.25C11.4489 1.92857 11.6397 1.9963 11.7803 2.11686C11.921 2.23742 12 2.40093 12 2.57143C12 2.74192 11.921 2.90544 11.7803 3.026C11.6397 3.14656 11.4489 3.21429 11.25 3.21429ZM5.838 1.28657C5.92546 1.28668 6.01204 1.30156 6.09279 1.33035C6.17354 1.35915 6.24689 1.40129 6.30864 1.45438C6.37039 1.50747 6.41934 1.57046 6.45269 1.63976C6.48603 1.70907 6.50313 1.78332 6.503 1.85829V3.28457C6.50313 3.35954 6.48603 3.43379 6.45269 3.50309C6.41934 3.5724 6.37039 3.63539 6.30864 3.68848C6.24689 3.74157 6.17354 3.78371 6.09279 3.8125C6.01204 3.8413 5.92546 3.85617 5.838 3.85629H4.162C3.795 3.85629 3.497 3.6 3.497 3.28457V1.85829C3.497 1.54286 3.795 1.28657 4.162 1.28657H5.838Z" fill="#5E6D77"/>
						</svg>
					</span>
					<span class="btn-filtr-vision-mobile__button__text">Фильтр</span>
				</button>
			</div>
		</div>
		<!-- <button id="all-filter-clears" class="btn-filter-clear primary-light fs10 lsm icon" type="button" name="button" title="Очистить все фильтры">
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
				<span id="sup-filtr" class="mobile-nav__group__widget__count">0</span>
			</span>
			<span class="btn-filtr-vision-mobile__button__text">Фильтр</span>
		</button> -->
	</div>

	<div class="container-ag glampings-wrap-count gl-count-mobile">Найдено: <span class="all-gl-count"></span> глэмпингов</div>

	<main id="archive-glampings" class="archive-glampings container-ag<?php echo template_cookie_value()['no_map']; ?>">
		<div class="archive-glampings__left<?php echo template_cookie_value()['no_map']; ?>">
			<div class="glampings-filtr custom-scroll my-scrollbar<?php echo template_cookie_value()['glcf_scroll']; ?>">
				<div class="glampings-filtr-btns">
					<button id="filtr-btn-filtr" class="glampings-filtr-btns__item btn-filtr js-btn-filtr" type="button" name="button">
						<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M0.75 10.0714H4V10.1451C4 11.1694 4.97 12 6.167 12H7.833C9.03 12 10 11.1694 10 10.1451V10.0714H11.25C11.4489 10.0714 11.6397 10.0037 11.7803 9.88314C11.921 9.76258 12 9.59907 12 9.42857C12 9.25808 11.921 9.09456 11.7803 8.974C11.6397 8.85344 11.4489 8.78571 11.25 8.78571H10V8.712C10 7.68771 9.03 6.85714 7.833 6.85714L6.167 6.85714C5.8826 6.85692 5.60094 6.90472 5.33811 6.99783C5.07527 7.09093 4.83641 7.22751 4.63517 7.39976C4.43394 7.57201 4.27426 7.77656 4.16528 8.00172C4.05629 8.22687 4.00013 8.46823 4 8.712V8.78571H0.75C0.551088 8.78571 0.360322 8.85344 0.21967 8.974C0.0790175 9.09456 0 9.25808 0 9.42857C0 9.59907 0.0790175 9.76258 0.21967 9.88314C0.360322 10.0037 0.551088 10.0714 0.75 10.0714ZM7.833 8.14114C7.92055 8.14103 8.00726 8.15571 8.08817 8.18435C8.16909 8.21299 8.24263 8.25502 8.30458 8.30804C8.36653 8.36106 8.41568 8.42403 8.44921 8.49334C8.48274 8.56266 8.5 8.63696 8.5 8.712V10.1451C8.5 10.2202 8.48274 10.2945 8.44921 10.3638C8.41568 10.4331 8.36653 10.4961 8.30458 10.5491C8.24263 10.6021 8.16909 10.6442 8.08817 10.6728C8.00726 10.7014 7.92055 10.7161 7.833 10.716H6.167C5.798 10.716 5.5 10.4606 5.5 10.1451V8.712C5.5 8.39657 5.798 8.14114 6.167 8.14114H7.833ZM11.25 3.21429H8V3.28457C8.00039 3.52827 7.94479 3.76964 7.83635 3.99492C7.72791 4.22019 7.56877 4.42496 7.36801 4.59751C7.16725 4.77007 6.9288 4.90705 6.66628 5.00062C6.40376 5.09419 6.12231 5.14252 5.838 5.14286H4.162C2.968 5.14286 2 4.31143 2 3.28457V3.21429H0.75C0.551088 3.21429 0.360322 3.14656 0.21967 3.026C0.0790175 2.90544 0 2.74192 0 2.57143C0 2.40093 0.0790175 2.23742 0.21967 2.11686C0.360322 1.9963 0.551088 1.92857 0.75 1.92857H2V1.85829C2 0.832286 2.968 0 4.162 0H5.838C7.032 0 8 0.831429 8 1.85829V1.92857H11.25C11.4489 1.92857 11.6397 1.9963 11.7803 2.11686C11.921 2.23742 12 2.40093 12 2.57143C12 2.74192 11.921 2.90544 11.7803 3.026C11.6397 3.14656 11.4489 3.21429 11.25 3.21429ZM5.838 1.28657C5.92546 1.28668 6.01204 1.30156 6.09279 1.33035C6.17354 1.35915 6.24689 1.40129 6.30864 1.45438C6.37039 1.50747 6.41934 1.57046 6.45269 1.63976C6.48603 1.70907 6.50313 1.78332 6.503 1.85829V3.28457C6.50313 3.35954 6.48603 3.43379 6.45269 3.50309C6.41934 3.5724 6.37039 3.63539 6.30864 3.68848C6.24689 3.74157 6.17354 3.78371 6.09279 3.8125C6.01204 3.8413 5.92546 3.85617 5.838 3.85629H4.162C3.795 3.85629 3.497 3.6 3.497 3.28457V1.85829C3.497 1.54286 3.795 1.28657 4.162 1.28657H5.838Z" fill="#5E6D77"/>
						</svg>
						<span>Фильтры</span>
					</button>
					<button id="all-filter-clear" class="glampings-filtr-btns__item btn-clear" type="button" name="button">
						<svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0.0811419 0.447266C0.218643 0.173828 0.510312 0 0.833232 0H9.83331C10.1562 0 10.4479 0.173828 10.5854 0.447266C10.7229 0.720703 10.6812 1.04297 10.4771 1.27734L8.2583 3.82031C6.58745 4.14258 5.33327 5.52734 5.33327 7.1875C5.33327 7.72266 5.46452 8.23047 5.69786 8.68164C5.66453 8.66602 5.63119 8.64648 5.59994 8.625L4.2666 7.6875C4.09785 7.57031 3.99993 7.38477 3.99993 7.1875V5.64258L0.187393 1.27539C-0.0146923 1.04297 -0.0584427 0.71875 0.0811419 0.447266ZM8.99997 4.375C9.79563 4.375 10.5587 4.67132 11.1213 5.19876C11.6839 5.72621 12 6.44158 12 7.1875C12 7.93342 11.6839 8.64879 11.1213 9.17624C10.5587 9.70368 9.79563 10 8.99997 10C8.20432 10 7.44125 9.70368 6.87863 9.17624C6.31602 8.64879 5.99995 7.93342 5.99995 7.1875C5.99995 6.44158 6.31602 5.72621 6.87863 5.19876C7.44125 4.67132 8.20432 4.375 8.99997 4.375ZM10.2354 6.4707C10.3646 6.34961 10.3646 6.15039 10.2354 6.0293C10.1062 5.9082 9.89373 5.9082 9.76456 6.0293L8.99997 6.74609L8.23538 6.0293C8.10622 5.9082 7.89371 5.9082 7.76455 6.0293C7.63538 6.15039 7.63538 6.34961 7.76455 6.4707L8.52914 7.1875L7.76455 7.9043C7.63538 8.02539 7.63538 8.22461 7.76455 8.3457C7.89371 8.4668 8.10622 8.4668 8.23538 8.3457L8.99997 7.62891L9.76456 8.3457C9.89373 8.4668 10.1062 8.4668 10.2354 8.3457C10.3646 8.22461 10.3646 8.02539 10.2354 7.9043L9.47081 7.1875L10.2354 6.4707Z" fill="rgba(94, 109, 119, 0.6)"/>
						</svg>
						<span>Сбросить</span>
					</button>
				</div>
				<?php get_template_part( 'template-parts/glampings/archive-filtr' ); ?>
			</div>

			<div class="archive-glampings__left__glampings<?php echo template_cookie_value()['no_map']; ?>">
				<div class="archive-glampings__left__top">
					<div class="glampings-filtr-hidden<?php //echo $filtr_hidden; ?>">
						<button id="filtr-btn-filtr" class="glampings-filtr-btns__item btn-filtr js-btn-filtr" type="button" name="button">
							<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M0.75 10.0714H4V10.1451C4 11.1694 4.97 12 6.167 12H7.833C9.03 12 10 11.1694 10 10.1451V10.0714H11.25C11.4489 10.0714 11.6397 10.0037 11.7803 9.88314C11.921 9.76258 12 9.59907 12 9.42857C12 9.25808 11.921 9.09456 11.7803 8.974C11.6397 8.85344 11.4489 8.78571 11.25 8.78571H10V8.712C10 7.68771 9.03 6.85714 7.833 6.85714L6.167 6.85714C5.8826 6.85692 5.60094 6.90472 5.33811 6.99783C5.07527 7.09093 4.83641 7.22751 4.63517 7.39976C4.43394 7.57201 4.27426 7.77656 4.16528 8.00172C4.05629 8.22687 4.00013 8.46823 4 8.712V8.78571H0.75C0.551088 8.78571 0.360322 8.85344 0.21967 8.974C0.0790175 9.09456 0 9.25808 0 9.42857C0 9.59907 0.0790175 9.76258 0.21967 9.88314C0.360322 10.0037 0.551088 10.0714 0.75 10.0714ZM7.833 8.14114C7.92055 8.14103 8.00726 8.15571 8.08817 8.18435C8.16909 8.21299 8.24263 8.25502 8.30458 8.30804C8.36653 8.36106 8.41568 8.42403 8.44921 8.49334C8.48274 8.56266 8.5 8.63696 8.5 8.712V10.1451C8.5 10.2202 8.48274 10.2945 8.44921 10.3638C8.41568 10.4331 8.36653 10.4961 8.30458 10.5491C8.24263 10.6021 8.16909 10.6442 8.08817 10.6728C8.00726 10.7014 7.92055 10.7161 7.833 10.716H6.167C5.798 10.716 5.5 10.4606 5.5 10.1451V8.712C5.5 8.39657 5.798 8.14114 6.167 8.14114H7.833ZM11.25 3.21429H8V3.28457C8.00039 3.52827 7.94479 3.76964 7.83635 3.99492C7.72791 4.22019 7.56877 4.42496 7.36801 4.59751C7.16725 4.77007 6.9288 4.90705 6.66628 5.00062C6.40376 5.09419 6.12231 5.14252 5.838 5.14286H4.162C2.968 5.14286 2 4.31143 2 3.28457V3.21429H0.75C0.551088 3.21429 0.360322 3.14656 0.21967 3.026C0.0790175 2.90544 0 2.74192 0 2.57143C0 2.40093 0.0790175 2.23742 0.21967 2.11686C0.360322 1.9963 0.551088 1.92857 0.75 1.92857H2V1.85829C2 0.832286 2.968 0 4.162 0H5.838C7.032 0 8 0.831429 8 1.85829V1.92857H11.25C11.4489 1.92857 11.6397 1.9963 11.7803 2.11686C11.921 2.23742 12 2.40093 12 2.57143C12 2.74192 11.921 2.90544 11.7803 3.026C11.6397 3.14656 11.4489 3.21429 11.25 3.21429ZM5.838 1.28657C5.92546 1.28668 6.01204 1.30156 6.09279 1.33035C6.17354 1.35915 6.24689 1.40129 6.30864 1.45438C6.37039 1.50747 6.41934 1.57046 6.45269 1.63976C6.48603 1.70907 6.50313 1.78332 6.503 1.85829V3.28457C6.50313 3.35954 6.48603 3.43379 6.45269 3.50309C6.41934 3.5724 6.37039 3.63539 6.30864 3.68848C6.24689 3.74157 6.17354 3.78371 6.09279 3.8125C6.01204 3.8413 5.92546 3.85617 5.838 3.85629H4.162C3.795 3.85629 3.497 3.6 3.497 3.28457V1.85829C3.497 1.54286 3.795 1.28657 4.162 1.28657H5.838Z" fill="#5E6D77"/>
							</svg>
							<span>Фильтры</span>
						</button>
					</div>
					<div class="glampings-wrap-count">Найдено: <span class="all-gl-count"></span> глэмпингов</div>
				</div>
				<div class="glampings-wrap<?php echo template_cookie_value()['no_map'] . template_cookie_value()['gwrap_scroll']; ?>">
					<?php if ( have_posts() ) : ?>
					<div class="glampings-items card<?php echo template_cookie_value()['no_map']; ?>">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/glampings/archive' );
						endwhile;
						?>
						<!-- <div class="js-more-wrap"></div> -->
					</div>
						<?php
						// the_posts_navigation();
						echo posts_pagination_site();
						echo '<nav class="navigation filtr-pagination" role="navigation">
							<div class="nav-links"></div>
							</nav>';
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif;
					?>
				</div>
			</div>
		</div>
		<div class="glampings-map<?php echo template_cookie_value()['map']; ?>">
			<div id="mapYandex" class="glampings-map__content"></div>
		</div>
		<!-- <div class="archive-glampings__btn-map-mobile">
			<button id="<?php //echo $btn_map_mobile_id; ?>" class="primary lsm js-btn-map-mobile" type="button" name="button">
				<?php //echo $btn_map_mobile_text; ?>
			</button>
		</div> -->
	</main><!-- #main -->

<?php
get_footer();

// echo '<pre>';
// var_dump($glc_per_page);
// echo '</pre>';
