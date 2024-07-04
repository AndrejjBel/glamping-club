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
		echo '<h5>Примечания </h5>' . apply_filters( 'the_content', $meta_obj['glc_notes'] );
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
				<div class="acc-option__description">
					<?php echo $option['description']; ?>
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
	<?php if ($meta_obj['email_glamping']) { ?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">E-mail:</div>
			<div class="single-aside__content__item__text">
				<a href="mailto:<?php echo $meta_obj['email_glamping']; ?>"><?php echo $meta_obj['email_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php if ($meta_obj['site_glamping']) { ?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">Сайт для бронирования:</div>
			<div class="single-aside__content__item__text">
				<a href="<?php echo $meta_obj['site_glamping']; ?>"><?php echo $meta_obj['site_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php if ($meta_obj['whatsup_glamping'] || $meta_obj['telegram_glamping']) { ?>
		<div class="single-aside__content__item">
			<span>Напишите нам в мессенджере:</span>
		</div>
		<?php if ($meta_obj['whatsup_glamping']) { ?>
			<div class="single-aside__content__item messenger">
				<div class="single-aside__content__item__text">
					<a href="https://wa.me/<?php echo $meta_obj['whatsup_glamping']; ?>" target="_blank" title="WhatsApp">
						<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
						</svg>
					</a>
				</div>
			</div>
		<?php } ?>
		<?php if ($meta_obj['telegram_glamping']) { ?>
			<div class="single-aside__content__item messenger">
				<div class="single-aside__content__item__text">
					<a href="https://t.me/<?php echo $meta_obj['telegram_glamping']; ?>" target="_blank" title="Telegram">
						<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
							<path d="M29.919 6.163l-4.225 19.925c-0.319 1.406-1.15 1.756-2.331 1.094l-6.438-4.744-3.106 2.988c-0.344 0.344-0.631 0.631-1.294 0.631l0.463-6.556 11.931-10.781c0.519-0.462-0.113-0.719-0.806-0.256l-14.75 9.288-6.35-1.988c-1.381-0.431-1.406-1.381 0.288-2.044l24.837-9.569c1.15-0.431 2.156 0.256 1.781 2.013z"/>
						</svg>
					</a>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	<?php if ($meta_obj['phone_glamping']) { ?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">Или позвоните нам:</div>
			<div class="single-aside__content__item__text">
				<a href="tel:<?php echo $meta_obj['phone_glamping']; ?>"><?php echo $meta_obj['phone_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php
}
