<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Glamping_club
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function glamping_club_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'glamping_club_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function glamping_club_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'glamping_club_pingback_header' );

add_shortcode( 'glc-favorites-page', 'glamping_club_shortcode_page_favorites' );
function glamping_club_shortcode_page_favorites() {
    ob_start();
    get_template_part( 'template-parts/pages/favorites' );
	return ob_get_clean();
}

add_shortcode( 'glc-compare-page', 'glamping_club_shortcode_page_compare' );
function glamping_club_shortcode_page_compare() {
    ob_start();
    get_template_part( 'template-parts/pages/compare' );
	return ob_get_clean();
}

function glamping_single_thumbnail($post_id) {
	$media = get_attached_media( 'image', $post_id );
	$i = 1;
	echo '<div class="thumbnail-gallery__first">';
	foreach ( $media as $img ) {
		$url = wp_get_attachment_image_url( $img->ID, 'glamping-club-thumb' );
		$url_full = wp_get_attachment_image_url( $img->ID, 'full' );
		if ($i == 1) {
			echo '<a href="' . $url_full . '" class="item">';
			echo '<img src="' . $url . '" alt="" loading="lazy" /></a>';
		}
		$i++;
	}
	echo '</div>';
	$it = 0;
	echo '<div class="thumbnail-gallery__two">';
	foreach ( $media as $img ) {
		$url = wp_get_attachment_image_url( $img->ID, 'medium' );
		$url_full = wp_get_attachment_image_url( $img->ID, 'full' );
		if ($it > 0) {
			echo '<a href="' . $url_full . '" class="item">';
			echo '<img src="' . $url . '" alt="" loading="lazy" /></a>';
		}
		$it++;
	}
	echo '</div>';
	echo '<button id="js-gallery-count" class="thumbnail-gallery__btn" type="button" name="button">
		<span>Смотреть </span>
		<span id="gallery-item-count">' . $it . '</span>
		<span> фото</span>
	</button>';
}

function get_additionally_meta($meta) {
    global $post;
    $meta_object = get_post_meta($post->ID, 'additionally_field');
    if (isset($meta_object[0][0][$meta])) {
        return $meta_object[0][0][$meta];
    } else {
        return false;
    }
}

function get_additionally_content() {
    global $post;
    $meta_object = get_post_meta($post->ID, 'additionally_field');
    if (!empty($meta_object)) {
        $meta_obj = $meta_object[0][0];
    } else {
        return false;
    }
	if (isset($meta_obj['glc_notes'])) {
		$glc_notes = apply_filters( 'the_content', $meta_obj['glc_notes'] );
	}
	if (isset($meta_obj['checkin_glamping'])) {
		echo '<div class="conditions__item">';
		echo '<h5>Заезд: </h5><span>c ' . $meta_obj['checkin_glamping'] . ' ч.</span>';
		echo '</div>';
	}
	if (isset($meta_obj['checkout_glamping'])) {
		echo '<div class="conditions__item">';
		echo '<h5>Выезд: </h5><span>до ' . $meta_obj['checkout_glamping'] . ' ч.</span>';
		echo '</div>';
	}
	if (isset($meta_obj['cancel_reservation'])) {
		echo '<div class="conditions__item">';
		echo '<h5>Отмена бронирования: </h5><span>' . $meta_obj['cancel_reservation'] . '</span>';
		echo '</div>';
	}
	if (isset($meta_obj['prepayment'])) {
		echo '<div class="conditions__item">';
		echo '<h5>Предоплата: </h5><span>' . $meta_obj['prepayment'] . '</span>';
		echo '</div>';
	}
	if (isset($meta_obj['glc_notes'])) {
		echo '<div class="conditions__item">';
		echo '<h5>Примечания </h5>';
		echo '<div class="collapse-content">';
		echo $glc_notes;
		echo '</div>';
		echo '<div class="collapse-content-btn">';
		echo '<span>Развернуть</span>';
		echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
		    <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
		</svg>';
		echo '</div>';
		echo '</div>';
	}
}

function get_accommodation_options() {
	global $post;
    $meta_object = get_post_meta($post->ID, 'acc_options');
    if (!empty($meta_object)) {
        $meta_obj = $meta_object[0];
    } else {
        return false;
    }

	$i = 1;
	foreach ($meta_obj as $option) {
		$media_gallery = $option['media_gallery'];
		$media = '';
		// foreach ($media_gallery as $key => $value) {
		// 	$media .= '<div class="acc-media" data-src="' . wp_get_attachment_image_url( $key, 'full' ) . '">';
		// 	$media .= '<img src="' . wp_get_attachment_image_url( $key, 'medium' ) . '" alt="">';
		// 	$media .= '</div>';
		// }

		$it = 0;
		$media .= '<div class="acc-gallery galery' . $i . '">';
		// $media .= '<div id="sw-' . $i . '" class="swiper-wrapper">';
		foreach ( $media_gallery as $key => $value ) {
			$url = wp_get_attachment_image_url( $key, 'medium' );
			$url_full = wp_get_attachment_image_url( $key, 'full' );
			$media .= '<div class="acc-gallery__item swiper-slide gallery-' . $i . '">';
			$media .= '<a href="' . $url_full . '" class="acc-media">';
			$media .= '<img src="' . $url . '" alt="" /></a>';
			$media .= '</div>';
			$it++;
		}
		$media .= '<button id="js-gallery-count" class="thumbnail-gallery__btn" type="button" name="button">
			<span>Смотреть </span>
			<span id="gallery-item-count">' . $it . '</span>
			<span> фото</span>
		</button>';
		$media .= '</div>';
		// $media .= '</div>';
	?>
		<div class="acc-options__item">
			<div class="acc-options__item__content acc-option custom-scroll">
				<?php echo $media; ?>
				<div class="acc-option__title">
					<?php echo $option['title']; ?>
				</div>
				<div class="acc-option__options">
					<div class="acc-option__options__item">
						<div class="acc-option__options__item__title">Площадь</div>
						<div class="acc-option__options__item__value">
							<?php echo $option['area']. 'м<sup>2</sup>.'; ?>
						</div>
					</div>
					<div class="acc-option__options__item">
						<div class="acc-option__options__item__title">Мест</div>
						<div class="acc-option__options__item__value">
							<?php echo $option['places']; ?>
						</div>
					</div>
					<div class="acc-option__options__item">
						<div class="acc-option__options__item__title">Стоимость</div>
						<div class="acc-option__options__item__value">
							<?php echo $option['price']. 'р.'; ?>
						</div>
					</div>
				</div>
				<div class="acc-option__description collapse-content">
					<?php echo $option['description']; ?>
				</div>
				<div class="collapse-content-btn">
		            <span>Развернуть</span>
		            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
		                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
		            </svg>
		        </div>

				<div class="acc-option__facilities">
					<div class="acc-option__facilities__title">
						<h5>Удобства</h5>
					</div>
					<div class="facilities">
						<?php
						glamping_icons_facilities_options($option['facilities_options_home'], 'В доме');
						glamping_icons_facilities_options($option['facilities_options_bathroom'], 'В ванной');
						glamping_icons_facilities_options($option['facilities_options_kitchen'], 'На кухне');
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	$i++;
	}

	// return $meta_obj;
}

function get_glamping_type_content() {
	global $post;
	$type = $post->glamping_type;
	$type_text = '';
	if ($type == 'glamping') {
		$type_text = 'Глэмпинг';
	} elseif ($type == 'eco_hotel') {
		$type_text = 'Эко-отель';
	} elseif ($type == 'camp_site') {
		$type_text = 'Турбаза';
	} elseif ($type == 'private_sector') {
		$type_text = 'Частный сектор';
	}
	return $type_text;
}

function get_glamping_allocation_content() {
	global $post;
	$allocation = $post->glamping_allocation;
	if ($allocation) {
		return implode(", ", $allocation);
	}
}

function get_glamping_nature_around_content() {
	global $post;
	$nature_around = $post->glamping_nature_around;
	if ($nature_around) {
		return implode(", ", $nature_around);
	}
}

function glamping_icons_facilities($type_facilities, $title) {
	global $post;
	require get_template_directory() . '/functions/icons.php';
	$facilities = $post->$type_facilities;
	if ($facilities) {
		echo '<div class="single-section facilities__item">
            <div class="single-section__title">
                <h5>' . $title . '</h5>
            </div>
            <div class="single-section__content">';
		foreach ($facilities as $value) {
			echo '<div class="facilities__item__content-item">';
			echo $icons[ $value ];
			echo '<span>' . $value . '</span>';
			echo '</div>';
		}
		echo '</div>
		</div>';
	}
}

function glamping_icons_facilities_options($type_facilities, $title) {
	global $post;
	require get_template_directory() . '/functions/icons.php';
	// $facilities = $post->$type_facilities;
	if ($type_facilities) {
		echo '<div class="single-section facilities__item">
            <div class="single-section__title">
                <h6>' . $title . '</h6>
            </div>
            <div class="single-section__content">';
		foreach ($type_facilities as $value) {
			echo '<div class="facilities__item__content-item">';
			echo $icons[ $value ];
			echo '<span>' . $value . '</span>';
			echo '</div>';
		}
		echo '</div>
		</div>';
	}
}

function glamping_book_online() {
	global $post;
	$book_online = $post->book_online;
	$text = '';
	if ($book_online == 'no') {
		$text = 'Нет';
	} elseif ($book_online == 'yes') {
		$text = 'Есть';
	}
	return $text;
}

function get_contact_information_content() {
	global $post;
    $meta_object = get_post_meta($post->ID, 'additionally_field');
    if (!empty($meta_object)) {
        $meta_obj = $meta_object[0][0];
    } else {
        return false;
    }
	?>
	<div class="single-aside__content__title mt20 mt-smail-10">
		<span>Контактная информация</span>
		<!-- <span>Есть вопросы по глэмпингу?</span>
		<span>Свяжитесь с координатором</span> -->
	</div>
	<?php if (array_key_exists('email_glamping', $meta_obj)) { ?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">E-mail:</div>
			<div class="single-aside__content__item__text">
				<a href="mailto:<?php echo $meta_obj['email_glamping']; ?>"><?php echo $meta_obj['email_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php if (array_key_exists('site_glamping', $meta_obj)) { ?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">Официальный сайт:</div>
			<div class="single-aside__content__item__text">
				<a href="<?php echo $meta_obj['site_glamping']; ?>"><?php echo $meta_obj['site_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php if (array_key_exists('whatsup_glamping', $meta_obj) || array_key_exists('viber_glamping', $meta_obj) || array_key_exists('telegram_glamping', $meta_obj)) { ?>
		<div class="single-aside__content__item">
			<span>Напишите нам в мессенджере:</span>
		</div>
		<?php if (array_key_exists('whatsup_glamping', $meta_obj)) { ?>
			<div class="single-aside__content__item messenger">
				<div class="single-aside__content__item__text">
					<a href="https://wa.me/<?php echo $meta_obj['whatsup_glamping']; ?>" target="_blank" title="WhatsApp">
						<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" fill="#25d366"/>
						</svg>
					</a>
				</div>
			</div>
		<?php } ?>
		<?php if (array_key_exists('viber_glamping', $meta_obj)) { ?>
			<div class="single-aside__content__item messenger">
				<div class="single-aside__content__item__text">
					<a href="viber://chat?number=%2B<?php echo $meta_obj['viber_glamping']; ?>" target="_blank" title="Viber">
						<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
							<path d="M444 49.9C431.3 38.2 379.9 .9 265.3 .4c0 0-135.1-8.1-200.9 52.3C27.8 89.3 14.9 143 13.5 209.5c-1.4 66.5-3.1 191.1 117 224.9h.1l-.1 51.6s-.8 20.9 13 25.1c16.6 5.2 26.4-10.7 42.3-27.8 8.7-9.4 20.7-23.2 29.8-33.7 82.2 6.9 145.3-8.9 152.5-11.2 16.6-5.4 110.5-17.4 125.7-142 15.8-128.6-7.6-209.8-49.8-246.5zM457.9 287c-12.9 104-89 110.6-103 115.1-6 1.9-61.5 15.7-131.2 11.2 0 0-52 62.7-68.2 79-5.3 5.3-11.1 4.8-11-5.7 0-6.9 .4-85.7 .4-85.7-.1 0-.1 0 0 0-101.8-28.2-95.8-134.3-94.7-189.8 1.1-55.5 11.6-101 42.6-131.6 55.7-50.5 170.4-43 170.4-43 96.9 .4 143.3 29.6 154.1 39.4 35.7 30.6 53.9 103.8 40.6 211.1zm-139-80.8c.4 8.6-12.5 9.2-12.9 .6-1.1-22-11.4-32.7-32.6-33.9-8.6-.5-7.8-13.4 .7-12.9 27.9 1.5 43.4 17.5 44.8 46.2zm20.3 11.3c1-42.4-25.5-75.6-75.8-79.3-8.5-.6-7.6-13.5 .9-12.9 58 4.2 88.9 44.1 87.8 92.5-.1 8.6-13.1 8.2-12.9-.3zm47 13.4c.1 8.6-12.9 8.7-12.9 .1-.6-81.5-54.9-125.9-120.8-126.4-8.5-.1-8.5-12.9 0-12.9 73.7 .5 133 51.4 133.7 139.2zM374.9 329v.2c-10.8 19-31 40-51.8 33.3l-.2-.3c-21.1-5.9-70.8-31.5-102.2-56.5-16.2-12.8-31-27.9-42.4-42.4-10.3-12.9-20.7-28.2-30.8-46.6-21.3-38.5-26-55.7-26-55.7-6.7-20.8 14.2-41 33.3-51.8h.2c9.2-4.8 18-3.2 23.9 3.9 0 0 12.4 14.8 17.7 22.1 5 6.8 11.7 17.7 15.2 23.8 6.1 10.9 2.3 22-3.7 26.6l-12 9.6c-6.1 4.9-5.3 14-5.3 14s17.8 67.3 84.3 84.3c0 0 9.1 .8 14-5.3l9.6-12c4.6-6 15.7-9.8 26.6-3.7 14.7 8.3 33.4 21.2 45.8 32.9 7 5.7 8.6 14.4 3.8 23.6z" fill="#8f5db7"/>
						</svg>
					</a>
				</div>
			</div>
		<?php } ?>
		<?php if (array_key_exists('telegram_glamping', $meta_obj)) { ?>
			<div class="single-aside__content__item messenger">
				<div class="single-aside__content__item__text">
					<a href="https://t.me/<?php echo $meta_obj['telegram_glamping']; ?>" target="_blank" title="Telegram">
						<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
							<path d="M29.919 6.163l-4.225 19.925c-0.319 1.406-1.15 1.756-2.331 1.094l-6.438-4.744-3.106 2.988c-0.344 0.344-0.631 0.631-1.294 0.631l0.463-6.556 11.931-10.781c0.519-0.462-0.113-0.719-0.806-0.256l-14.75 9.288-6.35-1.988c-1.381-0.431-1.406-1.381 0.288-2.044l24.837-9.569c1.15-0.431 2.156 0.256 1.781 2.013z" fill="#0088cc"/>
						</svg>
					</a>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	<?php if (array_key_exists('phone_glamping', $meta_obj)) { ?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">Или позвоните нам:</div>
			<div class="single-aside__content__item__text">
				<a href="tel:<?php echo $meta_obj['phone_glamping']; ?>"><?php echo $meta_obj['phone_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php
}

function get_rating_post($rating_value=0, $rating_otziv=0) {
	$checked_val = roundHalf($rating_value);
	?>
	<div class="rating-views half-stars">
		<div class="rating-group">
			<!-- по умолчанию 0 -->
			<input disabled checked name="hsr" value="0" type="radio">

			<!-- рейтинг 0.5 -->
			<label class="hsr" for="hsr-05">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 0c-11.4 0-22.8 5.9-28.7 17.8L194 150.2 47.9 171.4c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.1 23 46 46.4 33.7L288 439.6V0z"/></svg>
			</label>
			<input disabled <?php checked( $checked_val, 0.5 ); ?> name="hsr" id="hsr-05" value="0.5" type="radio">

			<!-- рейтинг 1 -->
			<label for="hsr-10">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
			</label>
			<input disabled <?php checked( $checked_val, 1 ); ?> name="hsr" id="hsr-10" value="1" type="radio">

			<!-- рейтинг 1.5 -->
			<label class="hsr" for="hsr-15">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 0c-11.4 0-22.8 5.9-28.7 17.8L194 150.2 47.9 171.4c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.1 23 46 46.4 33.7L288 439.6V0z"/></svg>
			</label>
			<input disabled <?php checked( $checked_val, 1.5 ); ?> name="hsr" id="hsr-15" value="1.5" type="radio">

			<!-- рейтинг 2 -->
			<label for="hsr-20">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
			</label>
			<input disabled <?php checked( $checked_val, 2 ); ?> name="hsr" id="hsr-20" value="2" type="radio">

			<!-- рейтинг 2.5 -->
			<label class="hsr" for="hsr-25">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 0c-11.4 0-22.8 5.9-28.7 17.8L194 150.2 47.9 171.4c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.1 23 46 46.4 33.7L288 439.6V0z"/></svg>
			</label>
			<input disabled <?php checked( $checked_val, 2.5 ); ?> name="hsr" id="hsr-25" value="2.5" type="radio">

			<!-- рейтинг 3 -->
			<label for="hsr-30">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
			</label>
			<input disabled <?php checked( $checked_val, 3 ); ?> name="hsr" id="hsr-30" value="3" type="radio">

			<!-- рейтинг 3.5 -->
			<label class="hsr" for="hsr-35">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 0c-11.4 0-22.8 5.9-28.7 17.8L194 150.2 47.9 171.4c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.1 23 46 46.4 33.7L288 439.6V0z"/></svg>
			</label>
			<input disabled <?php checked( $checked_val, 3.5 ); ?> name="hsr" id="hsr-35" value="3.5" type="radio">

			<!-- рейтинг 4 -->
			<label for="hsr-40">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
			</label>
			<input disabled <?php checked( $checked_val, 4 ); ?> name="hsr" id="hsr-40" value="4" type="radio">

			<!-- рейтинг 4.5 -->
			<label class="hsr" for="hsr-45">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 0c-11.4 0-22.8 5.9-28.7 17.8L194 150.2 47.9 171.4c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.1 23 46 46.4 33.7L288 439.6V0z"/></svg>
			</label>
			<input disabled <?php checked( $checked_val, 4.5 ); ?> name="hsr" id="hsr-45" value="4.5" type="radio">

			<!-- рейтинг 5 -->
			<label for="hsr-50">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
			</label>
			<input disabled <?php checked( $checked_val, 5 ); ?> name="hsr" id="hsr-50" value="5" type="radio">
		</div>
	</div>

	<div class="rating-count">
		<div class="rating-count__rating">
			<?php echo number_format(round($rating_value, 1), 1, ',', ' '); ?>
		</div>
		<div class="rating-count__otziv">
			<span>/ <?php echo num_word($rating_otziv, array('отзыв', 'отзыва', 'отзывов')); ?></span>
		</div>
	</div>
	<?php
}

function roundHalf($val) {
    $val = round($val, 1);
    $intVal = (int)$val;
    $fraction = $val - $intVal;
    if ($fraction < 0.1) {
        $res = $intVal;
    } elseif ($fraction < 1) {
        $res = $intVal + 0.5;
    } else {
        $res = $val > 0 ? ceil($val) : floor($val);
    }
    return (float)$res;
}

function favorites_render($posts, $type, $posts_per_page=-1) {
	// $posts_arr = explode(",", $postsf);
	global $post;
	$posts_arr = get_posts( [
		'posts_per_page' => $posts_per_page,
		'post_type' => 'glampings',
		'include' => $posts
		] );
	foreach ($posts_arr as $post) {
		setup_postdata( $post );
		get_template_part( 'template-parts/pages/excerpt', $type );
	}
	wp_reset_postdata();
}

function glampings_map_render() {
	global $post;
	$args = [
		'posts_per_page' => -1,
		'post_type' => 'glampings'
	];
	$glampings = get_posts( $args );
	foreach ($glampings as $post) {
		setup_postdata( $post );
		$meta_object = get_post_meta($post->ID, 'additionally_field')[0][0];
		if (isset($meta_object['coordinates'])) {
	        $coordinates = $meta_object['coordinates'];
	    }
		if (isset($meta_object['address'])) {
	        $address = $meta_object['address'];
	    }
		$link = get_permalink( $post->ID );
		$coord = explode(',', str_replace(" ", "", $coordinates));
		// $coord = count($coord) > 1 ? [floatval($coord[0]), floatval($coord[1])] : [0.0, 0.0];
		$title = str_replace(["'", "\"", "«"], '', get_the_title( $post->ID ));
		$title = get_the_title( $post->ID );
		$points [] = (object) array(
			"type"		 => "Feature",
			"id"		 => $post->ID,
			"geometry"   => (object) array("type"=> "Point", "coordinates"=> $coord),
			"properties" => (object) array(
				"id"		 => $post->ID,
				"balloonContentHeader"	=> $title,
				"balloonContentBody"	=> 'Адрес: ' . $address,
				"balloonContentFooter"	=> '<a href=\"'.$link.'\">Подробнее</a>',
				"clusterCaption"		=> $title,
				"link" 					=> $link,
				"hintContent"			=> '<span>' . get_the_title( $post->ID ) . '</span>',
				// "marker-color"			=> "#008887"
			)
		);
	}
	wp_reset_postdata();

	$geoData = [
		"type" => "FeatureCollection",
		"metadata" => (object) array(
			"name" => "Глэмпинги",
			"creator" => "creatsites.ru",
			"description" => "Глэмпинги Creatsites."
		),
		"features"=> $points
	];

	return json_encode($geoData, JSON_UNESCAPED_UNICODE);
}
