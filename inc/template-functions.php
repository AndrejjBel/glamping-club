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
		echo '<h4>Заезд: </h4><span>c ' . $meta_obj['checkin_glamping'] . ' ч.</span>';
		echo '</div>';
	}
	if (isset($meta_obj['checkout_glamping'])) {
		echo '<div class="conditions__item">';
		echo '<h4>Выезд: </h4><span>до ' . $meta_obj['checkout_glamping'] . ' ч.</span>';
		echo '</div>';
	}
	if (isset($meta_obj['cancel_reservation'])) {
		echo '<div class="conditions__item">';
		echo '<h4>Отмена бронирования: </h4><span>' . $meta_obj['cancel_reservation'] . '</span>';
		echo '</div>';
	}
	if (isset($meta_obj['prepayment'])) {
		echo '<div class="conditions__item">';
		echo '<h4>Предоплата: </h4><span>' . $meta_obj['prepayment'] . '</span>';
		echo '</div>';
	}
	if (isset($meta_obj['glc_notes'])) {
		echo '<div class="conditions__item">';
		echo '<h4>Примечания </h4>' . apply_filters( 'the_content', $meta_obj['glc_notes'] );
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

		$media .= '<div class="acc-gallery galery' . $i . '">
		<div id="sw-' . $i . '" class="swiper-wrapper">';
		foreach ( $media_gallery as $key => $value ) {
			$url = wp_get_attachment_image_url( $key, 'medium' );
			$url_full = wp_get_attachment_image_url( $key, 'full' );
			$media .= '<div class="acc-gallery__item swiper-slide gallery-' . $i . '">';
			$media .= '<a href="' . $url_full . '" class="acc-media">';
			$media .= '<img src="' . $url . '" alt="" /></a>';
			$media .= '</div>';
		}
		$media .= '</div></div>';
	?>
		<div class="acc-options__item acc-option">
			<!-- <div id="acc-gallery<?php //echo $i; ?>" class="acc-option__media"> -->
				<?php echo $media; ?>
			<!-- </div> -->
			<div class="acc-option__title">
				<?php echo $option['title']; ?>
			</div>
			<div class="acc-option__description">
				<?php echo $option['description']; ?>
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
	return implode(", ", $allocation);
}

function get_images_right_content() {
	global $post;
    $meta_object = get_post_meta($post->ID, 'additionally_field');
    if (!empty($meta_object)) {
        $meta_obj = $meta_object[0][0];
    } else {
        return false;
    }
	?>
	<div class="images__right__title">
		<h3>Контактная информация</h3>
	</div>
	<?php if ($meta_obj['email_glamping']) { ?>
		<div class="images__right__item">
			<div class="images__right__item__title">E-mail:</div>
			<div class="images__right__item__text">
				<a href="mailto:<?php echo $meta_obj['email_glamping']; ?>"><?php echo $meta_obj['email_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php if ($meta_obj['site_glamping']) { ?>
		<div class="images__right__item">
			<div class="images__right__item__title">Сайт для бронирования:</div>
			<div class="images__right__item__text">
				<a href="<?php echo $meta_obj['site_glamping']; ?>"><?php echo $meta_obj['site_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php if ($meta_obj['phone_glamping']) { ?>
		<div class="images__right__item">
			<div class="images__right__item__title">Телефон:</div>
			<div class="images__right__item__text">
				<a href="tel:<?php echo $meta_obj['phone_glamping']; ?>"><?php echo $meta_obj['phone_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php if ($meta_obj['whatsup_glamping']) { ?>
		<div class="images__right__item">
			<div class="images__right__item__title">Whatsup:</div>
			<div class="images__right__item__text">
				<a href="https://wa.me/<?php echo $meta_obj['whatsup_glamping']; ?>" target="_blank"><?php echo $meta_obj['whatsup_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php if ($meta_obj['telegram_glamping']) { ?>
		<div class="images__right__item">
			<div class="images__right__item__title">Telegram:</div>
			<div class="images__right__item__text">
				<a href="https://t.me/<?php echo $meta_obj['telegram_glamping']; ?>" target="_blank">@<?php echo $meta_obj['telegram_glamping']; ?></a>
			</div>
		</div>
	<?php } ?>
	<?php
}

function glamping_icons_facilities($type_facilities) {
	global $post;
	require get_template_directory() . '/functions/icons.php';
	$facilities = $post->$type_facilities;
	foreach ($facilities as $value) {
		echo '<div class="facilities__item__content-item">';
		echo $icons[ $value ];
		echo '<span>' . $value . '</span>';
		echo '</div>';
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
