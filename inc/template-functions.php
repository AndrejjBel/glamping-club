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
	$media = array_unique(glamping_all_img($post_id), SORT_REGULAR);
	if (count($media) == 1) {
		echo '<div class="thumbnail-gallery__first">';
		$url = wp_get_attachment_image_url( $media[0], 'full' );
		$url_full = wp_get_attachment_image_url( $media[0], 'full' );
		echo '<a href="' . $url_full . '" class="item">';
		echo '<img src="' . $url . '" alt="" loading="lazy" /></a>';
		echo '</div>';
	} else {
		$i = 1;
		echo '<div class="thumbnail-gallery__first">';
		foreach ( $media as $img ) {
			$url = wp_get_attachment_image_url( $img, 'full' );
			$url_full = wp_get_attachment_image_url( $img, 'full' );
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
			$url = wp_get_attachment_image_url( $img, 'glamping-club-thumb' );
			$url_full = wp_get_attachment_image_url( $img, 'full' );
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
}

function get_additionally_meta($meta, $post_id=0) {
    global $post;
    $meta_object = get_post_meta($post->ID, 'additionally_field');
	if ($post_id) {
		$meta_object = get_post_meta($post_id, 'additionally_field');
	}
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
		if ($meta_obj['glc_notes']) {
			$glc_notes = apply_filters( 'the_content', $meta_obj['glc_notes'] );
		}
	}
	if (isset($meta_obj['checkin_glamping'])) {
		if ($meta_obj['checkin_glamping']) {
			echo '<div class="conditions__item">';
			echo '<h5>Заезд: </h5><span>c ' . $meta_obj['checkin_glamping'] . ' ч.</span>';
			echo '</div>';
		}
	}
	if (isset($meta_obj['checkout_glamping'])) {
		if ($meta_obj['checkout_glamping']) {
			echo '<div class="conditions__item">';
			echo '<h5>Выезд: </h5><span>до ' . $meta_obj['checkout_glamping'] . ' ч.</span>';
			echo '</div>';
		}
	}
	if (isset($meta_obj['cancel_reservation'])) {
		if ($meta_obj['cancel_reservation']) {
			echo '<div class="conditions__item">';
			echo '<h5>Отмена бронирования: </h5><span>' . $meta_obj['cancel_reservation'] . '</span>';
			echo '</div>';
		}
	}
	if (isset($meta_obj['prepayment'])) {
		if ($meta_obj['prepayment']) {
			echo '<div class="conditions__item">';
			echo '<h5>Предоплата: </h5><span>' . $meta_obj['prepayment'] . '</span>';
			echo '</div>';
		}
	}
	if (isset($meta_obj['glc_notes'])) {
		if ($meta_obj['glc_notes']) {
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
}

function get_accommodation_options() {
	global $post;
    $meta_object = get_post_meta($post->ID, 'acc_options');
	// $meta_obj = $meta_object[0];
	$is_meta = 0;
    if (!empty($meta_object)) {
        $meta_obj = $meta_object[0];

		$meta_object_n = $meta_object[0];
		$meta_object_nn = '';
		if (count($meta_object_n) > 1) {
			$is_meta = 1;
		} else {
		    $meta_object_nn = $meta_object[0][0];
		    foreach ($meta_object_nn as $key => $value) {
		        if (empty($value)) { //проверка на пустоту
		            unset($meta_object_nn[$key]); // Удаляем ключ массива
		        }
		    }
			if ($meta_object_nn) {
				$is_meta = 1;
			}
		}
    }

	if ($is_meta) {
	?>
	<div class="single-section acc-options">
        <div class="single-section__title">
            <h3>Варианты размещения</h3>
        </div>
        <div class="single-section__content">
	<?php
		$i = 1;
		foreach ($meta_obj as $option) {
			$media_gallery = '';
			if (array_key_exists('media_gallery', $option)) {
				$media_gallery = $option['media_gallery'];
			}
			$media = '';
			// foreach ($media_gallery as $key => $value) {
			// 	$media .= '<div class="acc-media" data-src="' . wp_get_attachment_image_url( $key, 'full' ) . '">';
			// 	$media .= '<img src="' . wp_get_attachment_image_url( $key, 'medium' ) . '" alt="">';
			// 	$media .= '</div>';
			// }

			if ($media_gallery) {
				$it = 0;
				$media .= '<div class="acc-gallery galery' . $i . '">';
				$media .= '<div id="sw-' . $i . '" class="swiper-wrapper">';
				foreach ( $media_gallery as $key => $value ) {
					$url = wp_get_attachment_image_url( $key, 'glamping-club-thumb' );
					$url_full = wp_get_attachment_image_url( $key, 'full' );
					$media .= '<div class="acc-gallery__item swiper-slide gallery-' . $i . '">';
					$media .= '<a href="' . $url_full . '" class="acc-media">';
					$media .= '<img src="' . $url . '" alt="" /></a>';
					$media .= '</div>';
					$it++;
				}
				// $media .= '<button id="js-gallery-count" class="thumbnail-gallery__btn" type="button" name="button">
				// 	<span>Смотреть </span>
				// 	<span id="gallery-item-count">' . $it . '</span>
				// 	<span> фото</span>
				// </button>';
				$media .= '</div>';
				$media .= '<div class="swiper-button-next"></div>
		    		<div class="swiper-button-prev"></div>';
				$media .= '</div>';
			}
		?>
			<div class="acc-options__item">
				<div class="acc-options__item__content acc-option custom-scroll">
					<?php echo $media; ?>
					<?php if (array_key_exists('title', $option)) { ?>
						<div class="acc-option__title">
							<?php echo $option['title']; ?>
						</div>
					<?php } ?>
					<div class="acc-option__options">
						<?php if (array_key_exists('area', $option)) {
							if ($option['area']) {
						?>
							<div class="acc-option__options__item">
								<!-- <div class="acc-option__options__item__title">Площадь</div> -->
								<svg class="acc-option__options__item__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
									<path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64L0 400c0 44.2 35.8 80 80 80l400 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L80 416c-8.8 0-16-7.2-16-16L64 64zm96 288l288 0c17.7 0 32-14.3 32-32l0-68.2c0-7.6-2.7-15-7.7-20.8l-65.8-76.8c-12.1-14.2-33.7-15-46.9-1.8l-21 21c-10 10-26.4 9.2-35.4-1.6l-39.2-47c-12.6-15.1-35.7-15.4-48.7-.6L135.9 215c-5.1 5.8-7.9 13.3-7.9 21.1l0 84c0 17.7 14.3 32 32 32z"/>
								</svg>
								<div class="acc-option__options__item__value">
									<?php echo $option['area']. 'м<sup>2</sup>'; ?>
								</div>
							</div>
						<?php }} ?>
						<?php if (array_key_exists('places', $option)) {
							if ($option['places']) {
						?>
							<div class="acc-option__options__item">
								<!-- <div class="acc-option__options__item__title">Мест</div> -->
								<svg class="acc-option__options__item__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
									<path d="M32 32c17.7 0 32 14.3 32 32l0 256 224 0 0-160c0-17.7 14.3-32 32-32l224 0c53 0 96 43 96 96l0 224c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-32-224 0-32 0L64 416l0 32c0 17.7-14.3 32-32 32s-32-14.3-32-32L0 64C0 46.3 14.3 32 32 32zm144 96a80 80 0 1 1 0 160 80 80 0 1 1 0-160z"/>
								</svg>
								<div class="acc-option__options__item__value">
									<?php echo $option['places']; ?>
								</div>
							</div>
						<?php }} ?>
					</div>
					<div class="acc-option__options__item__excerpt">
						<?php if (array_key_exists('facilities_options_home', $option)) {
							glamping_icons_facilities_options($option['facilities_options_home'], '', 3);
						}
						?>
						<button class="primary-light ls js-btndetails" type="button" name="button">Подробнее</button>
					</div>
					<div class="acc-option__options__item price-btn">
						<?php if (array_key_exists('price', $option)) {
							if ($option['price']) {
						?>
							<div class="acc-option__options__item item-price">
								<!-- <div class="acc-option__options__item__title">Стоимость</div> -->
								<div class="acc-option__options__item__value value-price">
									<?php echo 'от ' . number_format($option['price'], 0, ',', ' ') . 'р'; ?>
								</div>
							</div>
						<?php }} else { ?>
							<div class="acc-option__options__item item-price">
								<div class="acc-option__options__item__value value-price">Стоимость не установлена</div>
							</div>
						<?php } ?>
						<a href="<?php echo get_post_meta($post->ID, 'additionally_field')[0][0]['site_glamping']?>"
							class="primary ld btnvib"
							target="_blank"
							rel="nofollow">Выбрать</a>
					</div>
					<div class="collapse-height-content">
						<?php if (array_key_exists('description', $option)) { ?>
							<div class="acc-option__description">
								<?php echo $option['description']; ?>
							</div>
						<?php } ?>

						<div class="acc-option__facilities">
							<div class="acc-option__facilities__title">
								<h5>Удобства</h5>
							</div>
							<div class="facilities">
								<?php
								if (array_key_exists('facilities_options_home', $option)) {
									glamping_icons_facilities_options($option['facilities_options_home'], 'В доме');
								}
								if (array_key_exists('facilities_options_bathroom', $option)) {
									glamping_icons_facilities_options($option['facilities_options_bathroom'], 'В ванной');
								}
								if (array_key_exists('facilities_options_kitchen', $option)) {
									glamping_icons_facilities_options($option['facilities_options_kitchen'], 'На кухне');
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		$i++;
		}
		?>
	</div>
</div>
		<?php
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
		// return implode(", ", $nature_around);
		return '<div class="characteristics-glamping">
            <span class="characteristics-glamping__title">Окружение: </span>
            <span>' . implode(", ", $nature_around) . '</span>
        </div>';
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
			$value = explode(' - ', $value);
			if (count($value) >= 2) {
				if ($value[1] == 'бесплатно') {
					$value_text = $value[0] . ' <span class="icon-text-green"> ' . $value[1] . '</span>';
				} elseif ($value[1] == 'платно') {
					$value_text = $value[0] . ' <span class="icon-text-red"> ' . $value[1] . '</span>';
				}
			} else {
				$value_text = $value[0];
			}
			if (array_key_exists($value[0], $icons)) {
				$icon = $icons[ $value[0] ];
			} else {
				$icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
				<path d="M176 255.1C176 211.8 211.8 175.1 256 175.1C300.2 175.1 336 211.8 336 255.1C336 300.2 300.2 336 256 336C211.8 336 176 300.2 176 255.1zM256 191.1C220.7 191.1 192 220.7 192 255.1C192 291.3 220.7 319.1 256 319.1C291.3 319.1 320 291.3 320 255.1C320 220.7 291.3 191.1 256 191.1zM425.2 87.32C439.5 82.75 455.1 88.78 462.6 101.8L492.8 154.2C500.3 167.2 497.8 183.7 486.7 193.8L446.3 230.6C447.4 238.9 448 247.4 448 255.1C448 264.6 447.4 273.1 446.3 281.4L486.7 318.2C497.8 328.3 500.3 344.8 492.8 357.8L462.6 410.2C455.1 423.2 439.5 429.2 425.2 424.7L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L317.5 486.8C314.3 501.5 301.3 512 286.2 512H225.8C210.7 512 197.7 501.5 194.5 486.8L182.8 433.6C167 427 152.2 418.4 138.8 408.1L86.84 424.7C72.51 429.2 56.94 423.2 49.42 410.2L19.18 357.8C11.66 344.8 14.22 328.3 25.34 318.2L65.67 281.4C64.57 273.1 64 264.6 64 255.1C64 247.4 64.57 238.9 65.67 230.6L25.34 193.8C14.22 183.7 11.66 167.2 19.18 154.2L49.42 101.8C56.94 88.78 72.51 82.75 86.84 87.32L138.8 103.9C152.2 93.56 167 84.96 182.8 78.43L194.5 25.16C197.7 10.47 210.7 0 225.8 0H286.2C301.3 0 314.3 10.47 317.5 25.16L329.2 78.43C344.1 84.96 359.8 93.56 373.2 103.9L425.2 87.32zM148.6 116.5L141.1 121.7L81.99 102.6C74.82 100.3 67.04 103.3 63.28 109.8L33.03 162.2C29.27 168.7 30.55 176.1 36.11 182L82.62 224.4L81.53 232.7C80.52 240.3 80 248.1 80 256C80 263.9 80.52 271.7 81.53 279.3L82.62 287.6L36.11 329.1C30.56 335 29.27 343.3 33.03 349.8L63.28 402.2C67.04 408.7 74.82 411.7 81.99 409.4L141.1 390.3L148.6 395.5C160.9 404.9 174.4 412.8 188.9 418.8L196.7 421.1L210.1 483.4C211.7 490.8 218.2 496 225.8 496H286.2C293.8 496 300.3 490.8 301.9 483.4L315.3 421.1L323.1 418.8C337.6 412.8 351.1 404.9 363.4 395.5L370 390.3L430 409.4C437.2 411.7 444.1 408.7 448.7 402.2L478.1 349.8C482.7 343.3 481.4 335 475.9 329.1L429.4 287.6L430.5 279.3C431.5 271.7 432 263.9 432 256C432 248.1 431.5 240.3 430.5 232.7L429.4 224.4L475.9 182C481.4 176.1 482.7 168.7 478.1 162.2L448.7 109.8C444.1 103.3 437.2 100.3 430 102.6L370 121.7L363.4 116.5C351.1 107.1 337.6 99.21 323.1 93.22L315.3 90.03L301.9 28.58C300.3 21.23 293.8 15.1 286.2 15.1H225.8C218.2 15.1 211.7 21.23 210.1 28.58L196.7 90.03L188.9 93.22C174.4 99.21 160.9 107.1 148.6 116.5L148.6 116.5z"/>
				</svg>';
			}
			echo '<div class="facilities__item__content-item">';
			echo $icon;
			echo '<span>' . $value_text . '</span>';
			echo '</div>';
		}
		echo '</div>
		</div>';
	}
}

function glamping_icons_facilities_options($type_facilities, $title, $count=0) {
	global $post;
	require get_template_directory() . '/functions/icons.php';
	// $facilities = $post->$type_facilities;
	$ic = 1;
	if ($type_facilities) {
		echo '<div class="single-section facilities__item">
            <div class="single-section__title">
                <h6>' . $title . '</h6>
            </div>';
		if ($count) {
			echo '<div class="single-section__content number">';
			foreach ($type_facilities as $value) {
				if (array_key_exists($value, $icons)) {
					$icon = $icons[ $value ];
				} else {
					$icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path d="M176 255.1C176 211.8 211.8 175.1 256 175.1C300.2 175.1 336 211.8 336 255.1C336 300.2 300.2 336 256 336C211.8 336 176 300.2 176 255.1zM256 191.1C220.7 191.1 192 220.7 192 255.1C192 291.3 220.7 319.1 256 319.1C291.3 319.1 320 291.3 320 255.1C320 220.7 291.3 191.1 256 191.1zM425.2 87.32C439.5 82.75 455.1 88.78 462.6 101.8L492.8 154.2C500.3 167.2 497.8 183.7 486.7 193.8L446.3 230.6C447.4 238.9 448 247.4 448 255.1C448 264.6 447.4 273.1 446.3 281.4L486.7 318.2C497.8 328.3 500.3 344.8 492.8 357.8L462.6 410.2C455.1 423.2 439.5 429.2 425.2 424.7L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L317.5 486.8C314.3 501.5 301.3 512 286.2 512H225.8C210.7 512 197.7 501.5 194.5 486.8L182.8 433.6C167 427 152.2 418.4 138.8 408.1L86.84 424.7C72.51 429.2 56.94 423.2 49.42 410.2L19.18 357.8C11.66 344.8 14.22 328.3 25.34 318.2L65.67 281.4C64.57 273.1 64 264.6 64 255.1C64 247.4 64.57 238.9 65.67 230.6L25.34 193.8C14.22 183.7 11.66 167.2 19.18 154.2L49.42 101.8C56.94 88.78 72.51 82.75 86.84 87.32L138.8 103.9C152.2 93.56 167 84.96 182.8 78.43L194.5 25.16C197.7 10.47 210.7 0 225.8 0H286.2C301.3 0 314.3 10.47 317.5 25.16L329.2 78.43C344.1 84.96 359.8 93.56 373.2 103.9L425.2 87.32zM148.6 116.5L141.1 121.7L81.99 102.6C74.82 100.3 67.04 103.3 63.28 109.8L33.03 162.2C29.27 168.7 30.55 176.1 36.11 182L82.62 224.4L81.53 232.7C80.52 240.3 80 248.1 80 256C80 263.9 80.52 271.7 81.53 279.3L82.62 287.6L36.11 329.1C30.56 335 29.27 343.3 33.03 349.8L63.28 402.2C67.04 408.7 74.82 411.7 81.99 409.4L141.1 390.3L148.6 395.5C160.9 404.9 174.4 412.8 188.9 418.8L196.7 421.1L210.1 483.4C211.7 490.8 218.2 496 225.8 496H286.2C293.8 496 300.3 490.8 301.9 483.4L315.3 421.1L323.1 418.8C337.6 412.8 351.1 404.9 363.4 395.5L370 390.3L430 409.4C437.2 411.7 444.1 408.7 448.7 402.2L478.1 349.8C482.7 343.3 481.4 335 475.9 329.1L429.4 287.6L430.5 279.3C431.5 271.7 432 263.9 432 256C432 248.1 431.5 240.3 430.5 232.7L429.4 224.4L475.9 182C481.4 176.1 482.7 168.7 478.1 162.2L448.7 109.8C444.1 103.3 437.2 100.3 430 102.6L370 121.7L363.4 116.5C351.1 107.1 337.6 99.21 323.1 93.22L315.3 90.03L301.9 28.58C300.3 21.23 293.8 15.1 286.2 15.1H225.8C218.2 15.1 211.7 21.23 210.1 28.58L196.7 90.03L188.9 93.22C174.4 99.21 160.9 107.1 148.6 116.5L148.6 116.5z"/>
					</svg>';
				}
				if ($count >= $ic) {
					echo '<div class="facilities__item__content-item">';
					echo $icon;
					echo '<span>' . $value . '</span>';
					echo '</div>';
				}
				$ic++;
			}
		} else {
			echo '<div class="single-section__content">';
			foreach ($type_facilities as $value) {
				if (array_key_exists($value, $icons)) {
					$icon = $icons[ $value ];
				} else {
					$icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path d="M176 255.1C176 211.8 211.8 175.1 256 175.1C300.2 175.1 336 211.8 336 255.1C336 300.2 300.2 336 256 336C211.8 336 176 300.2 176 255.1zM256 191.1C220.7 191.1 192 220.7 192 255.1C192 291.3 220.7 319.1 256 319.1C291.3 319.1 320 291.3 320 255.1C320 220.7 291.3 191.1 256 191.1zM425.2 87.32C439.5 82.75 455.1 88.78 462.6 101.8L492.8 154.2C500.3 167.2 497.8 183.7 486.7 193.8L446.3 230.6C447.4 238.9 448 247.4 448 255.1C448 264.6 447.4 273.1 446.3 281.4L486.7 318.2C497.8 328.3 500.3 344.8 492.8 357.8L462.6 410.2C455.1 423.2 439.5 429.2 425.2 424.7L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L317.5 486.8C314.3 501.5 301.3 512 286.2 512H225.8C210.7 512 197.7 501.5 194.5 486.8L182.8 433.6C167 427 152.2 418.4 138.8 408.1L86.84 424.7C72.51 429.2 56.94 423.2 49.42 410.2L19.18 357.8C11.66 344.8 14.22 328.3 25.34 318.2L65.67 281.4C64.57 273.1 64 264.6 64 255.1C64 247.4 64.57 238.9 65.67 230.6L25.34 193.8C14.22 183.7 11.66 167.2 19.18 154.2L49.42 101.8C56.94 88.78 72.51 82.75 86.84 87.32L138.8 103.9C152.2 93.56 167 84.96 182.8 78.43L194.5 25.16C197.7 10.47 210.7 0 225.8 0H286.2C301.3 0 314.3 10.47 317.5 25.16L329.2 78.43C344.1 84.96 359.8 93.56 373.2 103.9L425.2 87.32zM148.6 116.5L141.1 121.7L81.99 102.6C74.82 100.3 67.04 103.3 63.28 109.8L33.03 162.2C29.27 168.7 30.55 176.1 36.11 182L82.62 224.4L81.53 232.7C80.52 240.3 80 248.1 80 256C80 263.9 80.52 271.7 81.53 279.3L82.62 287.6L36.11 329.1C30.56 335 29.27 343.3 33.03 349.8L63.28 402.2C67.04 408.7 74.82 411.7 81.99 409.4L141.1 390.3L148.6 395.5C160.9 404.9 174.4 412.8 188.9 418.8L196.7 421.1L210.1 483.4C211.7 490.8 218.2 496 225.8 496H286.2C293.8 496 300.3 490.8 301.9 483.4L315.3 421.1L323.1 418.8C337.6 412.8 351.1 404.9 363.4 395.5L370 390.3L430 409.4C437.2 411.7 444.1 408.7 448.7 402.2L478.1 349.8C482.7 343.3 481.4 335 475.9 329.1L429.4 287.6L430.5 279.3C431.5 271.7 432 263.9 432 256C432 248.1 431.5 240.3 430.5 232.7L429.4 224.4L475.9 182C481.4 176.1 482.7 168.7 478.1 162.2L448.7 109.8C444.1 103.3 437.2 100.3 430 102.6L370 121.7L363.4 116.5C351.1 107.1 337.6 99.21 323.1 93.22L315.3 90.03L301.9 28.58C300.3 21.23 293.8 15.1 286.2 15.1H225.8C218.2 15.1 211.7 21.23 210.1 28.58L196.7 90.03L188.9 93.22C174.4 99.21 160.9 107.1 148.6 116.5L148.6 116.5z"/>
					</svg>';
				}
				echo '<div class="facilities__item__content-item">';
				echo $icon;
				echo '<span>' . $value . '</span>';
				echo '</div>';
			}
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
	$whatsup_glamping = '';
	if (array_key_exists('whatsup_glamping', $meta_obj)) {
		$whatsup_glamping = $meta_obj['whatsup_glamping'];
	}
	$viber_glamping = '';
	if (array_key_exists('viber_glamping', $meta_obj)) {
		$viber_glamping = $meta_obj['viber_glamping'];
	}
	$telegram_glamping = '';
	if (array_key_exists('telegram_glamping', $meta_obj)) {
		$telegram_glamping = $meta_obj['telegram_glamping'];
	}
	?>
	<div class="single-aside__content__title mt20 mt-smail-10">
		<span>Контактная информация</span>
		<!-- <span>Есть вопросы по глэмпингу?</span>
		<span>Свяжитесь с координатором</span> -->
	</div>
	<?php if (array_key_exists('email_glamping', $meta_obj)) {
		if ($meta_obj['email_glamping']) {
	?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">E-mail:</div>
			<div class="single-aside__content__item__text">
				<a href="mailto:<?php echo $meta_obj['email_glamping']; ?>"><?php echo $meta_obj['email_glamping']; ?></a>
			</div>
		</div>
	<?php }} ?>
	<?php if (array_key_exists('site_glamping_ofic', $meta_obj)) {
		if ($meta_obj['site_glamping_ofic']) {
	?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">Официальный сайт:</div>
			<div class="single-aside__content__item__text">
				<a href="<?php echo $meta_obj['site_glamping_ofic']; ?>"><?php echo punycodeInCyrillic($meta_obj['site_glamping_ofic']); ?></a>
			</div>
		</div>
	<?php }} ?>
	<?php if ($whatsup_glamping || $viber_glamping || $telegram_glamping) { ?>
		<div class="single-aside__content__item">
			<span>Напишите нам в мессенджере:</span>
		</div>
		<?php if (array_key_exists('whatsup_glamping', $meta_obj)) {
			if ($meta_obj['whatsup_glamping']) {
		?>
			<div class="single-aside__content__item messenger">
				<div class="single-aside__content__item__text">
					<a href="https://wa.me/<?php echo $meta_obj['whatsup_glamping']; ?>" target="_blank" title="WhatsApp">
						<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" fill="#25d366"/>
						</svg>
					</a>
				</div>
			</div>
		<?php }} ?>
		<?php if (array_key_exists('viber_glamping', $meta_obj)) {
			if ($meta_obj['viber_glamping']) {
		?>
			<div class="single-aside__content__item messenger">
				<div class="single-aside__content__item__text">
					<a href="viber://chat?number=%2B<?php echo $meta_obj['viber_glamping']; ?>" target="_blank" title="Viber">
						<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
							<path d="M444 49.9C431.3 38.2 379.9 .9 265.3 .4c0 0-135.1-8.1-200.9 52.3C27.8 89.3 14.9 143 13.5 209.5c-1.4 66.5-3.1 191.1 117 224.9h.1l-.1 51.6s-.8 20.9 13 25.1c16.6 5.2 26.4-10.7 42.3-27.8 8.7-9.4 20.7-23.2 29.8-33.7 82.2 6.9 145.3-8.9 152.5-11.2 16.6-5.4 110.5-17.4 125.7-142 15.8-128.6-7.6-209.8-49.8-246.5zM457.9 287c-12.9 104-89 110.6-103 115.1-6 1.9-61.5 15.7-131.2 11.2 0 0-52 62.7-68.2 79-5.3 5.3-11.1 4.8-11-5.7 0-6.9 .4-85.7 .4-85.7-.1 0-.1 0 0 0-101.8-28.2-95.8-134.3-94.7-189.8 1.1-55.5 11.6-101 42.6-131.6 55.7-50.5 170.4-43 170.4-43 96.9 .4 143.3 29.6 154.1 39.4 35.7 30.6 53.9 103.8 40.6 211.1zm-139-80.8c.4 8.6-12.5 9.2-12.9 .6-1.1-22-11.4-32.7-32.6-33.9-8.6-.5-7.8-13.4 .7-12.9 27.9 1.5 43.4 17.5 44.8 46.2zm20.3 11.3c1-42.4-25.5-75.6-75.8-79.3-8.5-.6-7.6-13.5 .9-12.9 58 4.2 88.9 44.1 87.8 92.5-.1 8.6-13.1 8.2-12.9-.3zm47 13.4c.1 8.6-12.9 8.7-12.9 .1-.6-81.5-54.9-125.9-120.8-126.4-8.5-.1-8.5-12.9 0-12.9 73.7 .5 133 51.4 133.7 139.2zM374.9 329v.2c-10.8 19-31 40-51.8 33.3l-.2-.3c-21.1-5.9-70.8-31.5-102.2-56.5-16.2-12.8-31-27.9-42.4-42.4-10.3-12.9-20.7-28.2-30.8-46.6-21.3-38.5-26-55.7-26-55.7-6.7-20.8 14.2-41 33.3-51.8h.2c9.2-4.8 18-3.2 23.9 3.9 0 0 12.4 14.8 17.7 22.1 5 6.8 11.7 17.7 15.2 23.8 6.1 10.9 2.3 22-3.7 26.6l-12 9.6c-6.1 4.9-5.3 14-5.3 14s17.8 67.3 84.3 84.3c0 0 9.1 .8 14-5.3l9.6-12c4.6-6 15.7-9.8 26.6-3.7 14.7 8.3 33.4 21.2 45.8 32.9 7 5.7 8.6 14.4 3.8 23.6z" fill="#8f5db7"/>
						</svg>
					</a>
				</div>
			</div>
		<?php }} ?>
		<?php if (array_key_exists('telegram_glamping', $meta_obj)) {
			if ($meta_obj['telegram_glamping']) {
		?>
			<div class="single-aside__content__item messenger">
				<div class="single-aside__content__item__text">
					<a href="https://t.me/<?php echo $meta_obj['telegram_glamping']; ?>" target="_blank" title="Telegram">
						<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
							<path d="M29.919 6.163l-4.225 19.925c-0.319 1.406-1.15 1.756-2.331 1.094l-6.438-4.744-3.106 2.988c-0.344 0.344-0.631 0.631-1.294 0.631l0.463-6.556 11.931-10.781c0.519-0.462-0.113-0.719-0.806-0.256l-14.75 9.288-6.35-1.988c-1.381-0.431-1.406-1.381 0.288-2.044l24.837-9.569c1.15-0.431 2.156 0.256 1.781 2.013z" fill="#0088cc"/>
						</svg>
					</a>
				</div>
			</div>
		<?php }} ?>
	<?php } ?>
	<?php if (array_key_exists('phone_glamping', $meta_obj)) {
		if ($meta_obj['phone_glamping']) {
	?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">Или позвоните нам:</div>
			<div class="single-aside__content__item__text">
				<a href="tel:<?php echo $meta_obj['phone_glamping']; ?>"><?php echo $meta_obj['phone_glamping']; ?></a>
			</div>
		</div>
	<?php }} ?>
	<?php
}

function punycodeInCyrillic($url) {
    $host = parse_url($url, PHP_URL_HOST);
	$host_new = (stripos($host, 'xn--')!==false) ? str_replace($host, idn_to_utf8($host), $url) : $url;
    return $host_new;
}

function get_rating_post($rating_value=0, $count_otziv=0) {
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
			<span>/ <?php echo num_word($count_otziv, array('отзыв', 'отзыва', 'отзывов')); ?></span>
		</div>
	</div>
	<?php
}

// Формирование звезд отзывов
function reviews_stars_items_average( $average_rating, $count_otziv, $type=0 ) {
	$rating = $average_rating;
	$star_full = '<svg class="star-full" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path class="fa-secondary" fill="var(--reviews-color)" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
	</svg>';
	$star_aver = '<svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path class="fa-primary" fill="var(--reviews-color)" d="M288 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.995 275.8 .0131 287.1-.0391L288 439.8zM433.2 512C432.1 512.1 431 512.1 429.9 512H433.2z"/>
	<path class="fa-secondary" fill="#d7dbe3" d="M146.3 512C145.3 512.1 144.2 512.1 143.1 512H146.3zM288 439.8V-.0387L288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.1 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L288 439.8z"/>
	</svg>';
	$star_half = '<svg class="star-full" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path class="fa-secondary" fill="#d7dbe3" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
	</svg>';
	$content = '<div class="rating-stars">';
	//$full_stars = $doc_meta->rating/$doc_meta->raitcol;
	$empty_stars = floor( 5 - $average_rating );
	while ( $average_rating > 0 ) {
		if ( $average_rating > 0 && $average_rating - 1 >= 0 ) {
			$content .= $star_full;
		}
		if ( $average_rating > 0 && $average_rating - 1 < 0 ) {
			$content .= $star_aver;
		}
		$average_rating--;
	}
	while ( $empty_stars > 0 ) {
		$content .= $star_half;

		$empty_stars--;
	}
	$content .= '</div>
	<div class="rating-count">
		<div class="rating-count__rating">' . number_format(round($rating, 1), 1, '.', ' ') . '</div>
		<div class="rating-count__otziv">' . num_word($count_otziv, array('отзыв', 'отзыва', 'отзывов')) . '</div>
	</div>';

	if ($type) {
		return $content;
	} else {
		echo $content;
	}
}

// Формирование звезд отдельного отзыва
function reviews_stars_item_review( $average_rating, $type=0 ) {
	$rating = $average_rating;
	$star_full = '<svg class="star-full" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path class="fa-secondary" fill="var(--reviews-color)" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
	</svg>';
	$star_aver = '<svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path class="fa-primary" fill="var(--reviews-color)" d="M288 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.995 275.8 .0131 287.1-.0391L288 439.8zM433.2 512C432.1 512.1 431 512.1 429.9 512H433.2z"/>
	<path class="fa-secondary" fill="#d7dbe3" d="M146.3 512C145.3 512.1 144.2 512.1 143.1 512H146.3zM288 439.8V-.0387L288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.1 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L288 439.8z"/>
	</svg>';
	$star_half = '<svg class="star-full" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path class="fa-secondary" fill="#d7dbe3" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
	</svg>';
	$content = '<div class="rating-stars">';
	//$full_stars = $doc_meta->rating/$doc_meta->raitcol;
	$empty_stars = floor( 5 - $average_rating );
	while ( $average_rating > 0 ) {
		if ( $average_rating > 0 && $average_rating - 1 >= 0 ) {
			$content .= $star_full;
		}
		if ( $average_rating > 0 && $average_rating - 1 < 0 ) {
			$content .= $star_aver;
		}
		$average_rating--;
	}
	while ( $empty_stars > 0 ) {
		$content .= $star_half;

		$empty_stars--;
	}
	$content .= '</div>';
	// $content .= '<div class="rating-count">
	// 	<div class="rating-count__rating">' . number_format(round($rating, 1), 1, ',', ' ') . '</div>
	// </div>';

	if ($type) {
		return $content;
	} else {
		echo $content;
	}
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

function get_post_rating($post_id) {
	$posts_reviews = get_posts( [
		'posts_per_page' => -1,
		'post_type' => 'reviews',
		'meta_query' => [ [
			'key' => 'glempid',
			'value' => $post_id,
			'type'    => 'numeric'
		] ]
	] );
	$rating = 0;
	foreach ($posts_reviews as $post) {
		$rating += $post->rating;
	}
	wp_reset_postdata();
	return ['count' => count($posts_reviews), 'rating' => $rating];
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

function compares_render($posts, $type, $posts_per_page=-1) {
	// $posts_arr = explode(",", $postsf);
	global $post;
	$posts_arr = get_posts( [
		'posts_per_page' => $posts_per_page,
		'post_type' => 'glampings',
		'include' => $posts
		] );
	echo '<div class="slider-top">';
	echo '<div class="slick mySlick1">';
	foreach ($posts_arr as $post) {
		setup_postdata( $post );
		get_template_part( 'template-parts/pages/excerpt', 'compare' );
		// get_template_part( 'template-parts/pages/excerpt', 'compare-next' );
	}
	echo '</div>';
	echo '<div class="slider-compare-navigation"></div>';
	echo '</div>';
	echo '<div class="slider-bottom">';
	echo get_template_part( 'template-parts/pages/excerpt', 'compare-left' );
	echo '<div class="slick mySlick2">';
	foreach ($posts_arr as $post) {
		setup_postdata( $post );
		// get_template_part( 'template-parts/pages/excerpt', 'compare' );
		get_template_part( 'template-parts/pages/excerpt', 'compare-next' );
	}
	echo '</div>';
	echo '</div>';
	wp_reset_postdata();
}

function glamping_club_gl_thumbnail($size) {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	the_post_thumbnail($size);
}

function glamping_all_img($post_id) {
	$media_gallery = get_post_meta( $post_id, 'media_gallery', 1 );
	$acc_options = get_post_meta( $post_id, 'acc_options', 1 );
	$files = [];
	if ($media_gallery) {
		foreach ($media_gallery as $key => $value) {
			array_push($files, $key);
		}
	}
	if ($acc_options) {
		if (array_key_exists('media_gallery', $acc_options)) {
			foreach ($acc_options as $key => $acc_option) {
				foreach ($acc_option['media_gallery'] as $key => $value) {
					array_push($files, $key);
				}
			}
		}
	}
	if (has_post_thumbnail($post_id)) {
		array_unshift($files, get_post_thumbnail_id($post_id));
	}

	if (!$files) {
		$glc_options = get_option( 'glc_options' );
		$no_foto_id = '';
		if (array_key_exists('glamping_no_photo_id', $glc_options)) {
			$no_foto_id = $glc_options['glamping_no_photo_id'];
			array_push($files, $no_foto_id);
		}
	}
	return $files;
}

function glamping_club_gl_thumbnail_slider($post_id) {
	$media = array_unique(glamping_all_img($post_id));
	echo '<div id="slider-post-' . $post_id . '" class="swiper slider-post-' . $post_id . '">';
    echo '<div class="swiper-wrapper">';
	foreach ( $media as $key => $img ) {
		$url = wp_get_attachment_image_url( $img, 'glamping-club-thumb' );
		$url_medium = wp_get_attachment_image_url( $img, 'medium' );
		echo '<div class="swiper-slide"><img src="' . $url . '" alt="" loading="lazy" /></div>';
	}
	echo '</div>';
	echo '<div class="swiper-button-next"></div>';
    echo '<div class="swiper-button-prev"></div>';
	echo '<div class="swiper-pagination"></div>';
	echo '</div>';
}

function filtr_cookie_value($name='') {
	$title = 'Рекомендованные';
	$class = '';
	if ( !empty( $_COOKIE["glcSort"] ) ) {
		if ($_COOKIE["glcSort"] == $name) {
			$class = 'active';
		}
		$title = options_name($_COOKIE["glcSort"]);
	} elseif ($name == 'recommended') {
		$class = 'active';
	}
	return ['title' => $title, 'class' => $class];
}

function template_cookie_value() {
	$no_map = '';
	$glcf_scroll = '';
	$card_list = ' list';
	$map = ' active';
	$btn_vision = ' active';
	$btn_close = '';
	if ( !empty( $_COOKIE["glcTemp"] ) ) {
		if ($_COOKIE["glcTemp"] == 'mapClose') {
			$no_map = ' no-map';
			$glcf_scroll = ' height-auto';
			$card_list = ' card';
			$map = '';
			$btn_vision = '';
			$btn_close = ' active';
		}
		// elseif ($_COOKIE["glcTemp"] == 'mapVision') {
		// 	// code...
		// }
	}
	return ['no_map' => $no_map, 'glcf_scroll' => $glcf_scroll, 'card_list' => $card_list, 'map' => $map, 'btn_vision' => $btn_vision, 'btn_close' => $btn_close];
}

function options_name($name) {
    $options = [
		'new_items' => 'Новинки',
        'recommended' => 'Рекомендованные',
        'min_price' => 'Сначала дешевые',
        'max_price' => 'Сначала дорогие',
    ];
    return $options[$name];
}

function filtr_options_render($name) {
    $options = call_user_func($name);
	foreach ($options as $key => $value) {
	?>
	<li>
		<input type="checkbox" id="<?php echo $key; ?>" name="<?php echo $value; ?>" value="">
		<label for="<?php echo $key; ?>">
			<span class="checkmark fcheckbox">
				<svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
					<path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
				</svg>
			</span>
			<span class="name"><?php echo $value; ?></span>
			<span class="count">1</span>
		</label>
	</li>
	<?php
	}
	return $options;
}

function glampings_map_render($location=0) {
	// global $post;
	$args = [
		'posts_per_page' => -1,
		'post_type' => 'glampings'
	];
	if( $location ) {
        $term = $location;
        $args[ 'tax_query' ] = [
            [
                'taxonomy' => 'location',
                'field'    => 'id',
                'terms'    => $term
            ]
        ];
    }
	$glampings = get_posts( $args );
	foreach ($glampings as $post) {
		// setup_postdata( $post );

		$meta_object = get_post_meta($post->ID, 'additionally_field')[0][0];
		if (isset($meta_object['coordinates'])) {
	        $coordinates = $meta_object['coordinates'];
	    }
		if (isset($meta_object['address'])) {
	        $address = $meta_object['address'];
	    }
		$phone_glamping = '';
		$whatsup_glamping = '';
		if (isset($meta_object['phone_glamping'])) {
			if ($meta_object['phone_glamping']) {
				$phone_glamping = '<a href="tel:' . $meta_object['phone_glamping'] . '" class="glamp-phone">
					<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						<path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
					</svg>
				</a>';
			}
	    }
		if (isset($meta_object['whatsup_glamping'])) {
			if ($meta_object['whatsup_glamping']) {
				$whatsup_glamping = '<a href="https://wa.me/' . $meta_object['whatsup_glamping'] . '" class="glamp-wa">
					<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
						<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" fill="#25d366"></path>
					</svg>
				</a>';
			}
	    }
		$title = get_the_title( $post->ID );
		$url_link = get_permalink( $post->ID );
		$link_title = '<a href="' . $url_link . '">' . $title . '</a>';
		$thumbnail = get_the_post_thumbnail( $post->ID, [120, 120], ['class' => "attachment-map-image"] );
		$thumbnail_pan = get_the_post_thumbnail( $post->ID, [60, 60], ['class' => "attachment-map-image-pan"] );
		$statistics = glampings_reviews_statistic($post->ID);
		// $count_rating = $statistics['count'];
		// $average_rating = $statistics['average_rating'];
		$rating = reviews_stars_items_average( $statistics['average_rating'], $statistics['count'], 1 );
		// $rating = reviews_stars_items_average( 2.9, 4, 1 );
		$media = array_unique(glamping_all_img($post->ID));
		$media_urls = '';
		$thumbnail_new = '';
		if (count($media) > 0) {
			$media_urls = '<div class="swiper balloonPan">';
			$media_urls .= '<div class="swiper-wrapper">';
			$mi = 0;
	        foreach ( $media as $img ) {
				// if ($mi <=2 ) {
					$url = wp_get_attachment_image_url( $img, 'glamping-club-thumb' );
					$media_urls .= '<div class="swiper-slide">';
		            $media_urls .= '<img width="80" height="80" src="' . $url . '" class="attachment-map-image" alt="" decoding="async">';
					$media_urls .= '</div>';
					$mi++;
				// }
	    	}
			$media_urls .= '</div>';
			$media_urls .= '<div class="swiper-button-next"></div>';
	    	$media_urls .= '<div class="swiper-button-prev"></div>';
			$media_urls .= '</div>';

			$thumbnail_new = '<img width="120" height="120" src="' . wp_get_attachment_image_url( $media[0], 'glamping-club-thumb' ) . '" class="attachment-map-image" alt="" decoding="async">';
		}

		$coord = explode(',', str_replace(" ", "", $coordinates));
		// $coord = count($coord) > 1 ? [floatval($coord[0]), floatval($coord[1])] : [0.0, 0.0];
		// $title = str_replace(["'", "\"", "«"], '', get_the_title( $post->ID ));
		$balloonContentBody = '<div class="balloon-content-body">';
		// $balloonContentBody .= '<div class="ymaps-2-1-79-balloon-content__header balloon-content-body__content__title">' . $title . '</div>';
		$balloonContentBody .= '<div class="balloon-content-body__img">' . $thumbnail_new . '</div>';
		$balloonContentBody .= '<div class="balloon-content-body__content">';
		$balloonContentBody .= '<div class="balloon-content-body__content__title">' . $link_title . '</div>';
		$balloonContentBody .= '<div class="balloon-content-body__content__rating">' . $rating . '</div>';
		$balloonContentBody .= '<div class="balloon-content-body__content__price">от ' . $post->glamping_price . 'р.</div>';
		$balloonContentBody .= '<div class="balloon-content-body__content__address">' . $address . '</div>';
		$balloonContentBody .= '</div>';
		$balloonContentBody .= '<div class="balloon-content-body__btns">';
		$balloonContentBody .= '<div class="balloon-content-body__btns__fav-comp">';
		// $balloonContentBody .= $phone_glamping;
		// $balloonContentBody .= $whatsup_glamping;
		// $balloonContentBody .= '<button id="add-favorites" data-postid="' . $post->ID . '" class="btn-add-fav" type="button" name="button" title="Добавить в избранное">
		// 		<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
		// 			<path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/>
		// 		</svg>
		// 	</button>
		// 	<button id="add-comparison" data-postid="' . $post->ID . '" class="btn-add-comp" type="button" name="button" title="Добавить к сравнению">
		// 		<svg class="rotate90" width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
		// 			<path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
		// 		</svg>
		// 	</button>';
		$balloonContentBody .= '</div></div></div>';

		$balloonContentBodyPan = '<div class="balloon-content-body-pan">';
		$balloonContentBodyPan .= '<div class="balloon-content-body-pan__img">';
		// $balloonContentBodyPan .= '<a href="' . $url_link . '" class="balloon-content-body-pan__img__link"></a>';
		// $balloonContentBodyPan .= '<div class="balloon-content-body-pan__img__count">';
		// $balloonContentBodyPan .= count($media) . ' фото';
		// $balloonContentBodyPan .= '</div>';
		$balloonContentBodyPan .= $media_urls; //$thumbnail_pan;
		$balloonContentBodyPan .= '</div>';
		$balloonContentBodyPan .= '<div class="balloon-content-body-pan__content">';
		$balloonContentBodyPan .= '<div class="balloon-content-body-pan__content__info">';
		$balloonContentBodyPan .= '<div class="balloon-content-body-pan__content__info__title">' . $link_title . '</div>';
		$balloonContentBodyPan .= '<div class="balloon-content-body-pan__content__info__rating">' . $rating . '</div>';
		$balloonContentBodyPan .= '<div class="balloon-content-body-pan__content__info__price">от ' . $post->glamping_price . 'р.</div>';
		$balloonContentBodyPan .= '<div class="balloon-content-body-pan__content__info__address">' . $address . '</div>';
		$balloonContentBodyPan .= '</div>';
		$balloonContentBodyPan .= '<div class="balloon-content-body-pan__content__buttons">';
		$balloonContentBodyPan .= $phone_glamping;
		$balloonContentBodyPan .= $whatsup_glamping;
		$balloonContentBodyPan .= '<button id="add-favorites" data-postid="' . $post->ID . '" class="btn-add-fav" type="button" name="button" title="Добавить в избранное">
				<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/>
					<path class="full" d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"></path>
				</svg>
			</button>';
		// $balloonContentBodyPan .= '<button id="add-comparison" data-postid="' . $post->ID . '" class="btn-add-comp" type="button" name="button" title="Добавить к сравнению">
		// 		<svg class="rotate90" width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
		// 			<path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
		// 		</svg>
		// 	</button>';
		$balloonContentBodyPan .= '</div></div></div></div>';
		$points [] = (object) array(
			"type"		 => "Feature",
			"id"		 => $post->ID,
			"geometry"   => (object) array("type"=> "Point", "coordinates"=> $coord),
			"properties" => (object) array(
				"id"		 			=> $post->ID,
				"price" 			=> $post->glamping_price,
				// "balloonContentHeader"	=> $title,
				"balloonContentBody"	=> $balloonContentBody,
				"balloonContentBodyPan"	=> $balloonContentBodyPan,
				// "balloonContentFooter"	=> '<a href="'.$link.'">Подробнее</a>',
				"clusterCaption"		=> $title,
				// "link" 					=> $link,
				"hintContent"			=> '<span>' . get_the_title( $post->ID ) . '</span>',
				"iconContent"			=> '<span id="' . $post->ID . '" class="glc-icon-content">' . number_format($post->glamping_price, 0, ',', ' '). 'р</span>',
				"iconContentDef"			=> '<span id="' . $post->ID . '" class="glc-icon-content">' . number_format($post->glamping_price, 0, ',', ' '). 'р</span>',
				"iconContentHover"			=> '<span id="' . $post->ID . '" class="glc-icon-content active">' . number_format($post->glamping_price, 0, ',', ' '). 'р</span>',
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

function glamping_review_img($post_id, $i) {
	$media_gallery = get_post_meta( $post_id, 'photos', 1 );
	if ($media_gallery) {
		// foreach ($media_gallery as $key => $value) {
			$it = 0;
			$media = '<div class="acc-gallery galery-review' . $i . '">';
			$media .= '<div id="sw-review-' . $i . '" class="swiper-wrapper">';
			foreach ( $media_gallery as $key => $value ) {
				$url = wp_get_attachment_image_url( $key, 'medium' );
				$url_full = wp_get_attachment_image_url( $key, 'full' );
				$media .= '<div class="acc-gallery__item swiper-slide gallery-' . $i . '">';
				$media .= '<a href="' . $url_full . '" class="acc-media">';
				$media .= '<img src="' . $url . '" alt="" /></a>';
				$media .= '</div>';
				$it++;
			}
			$media .= '</div>';
			$media .= '<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>';
			$media .= '</div>';
		// }

		echo $media;
	}
}

// Формирование отзывов
function glampings_reviews_items() {
    $post_id = get_the_ID();
    $my_posts = get_posts( array(
    	'posts_per_page' => 5,
    	'post_type'   => 'reviews',
    	'suppress_filters' => true,
        'meta_query' => [
    		[
    			'key'   => 'glempid',
    			'value' => $post_id,
    		]
    	],
    ) );
    global $post;
    foreach( $my_posts as $i => $post ){
    	setup_postdata( $post );
		$user = get_user_by('id', $post->post_author);
		?>
        <div class="reviews-items__item">
            <div class="reviews-items__item-rating">
                <?php reviews_stars_item_review( $post->rating ); ?>
            </div>
            <div class="reviews-items__item-name">
                <span><?php echo $user->display_name; ?></span>
                <span class="reviews-items__item-name-date">
                    <?php echo get_the_date('j F Y', $post); ?>
                </span>
            </div>
			<div class="reviews-items__item-img">
				<?php glamping_review_img($post->ID, $i); ?>
			</div>
            <div class="reviews-items__item-text">
                <?php echo apply_filters( 'the_content', get_the_content($post) ); ?>
            </div>
        </div>
    <?php }
    wp_reset_postdata();
    //wp_die();
}

add_action('wp_ajax_reviews_more', 'glampings_reviews_items_more');
add_action('wp_ajax_nopriv_reviews_more', 'glampings_reviews_items_more');
function glampings_reviews_items_more() {
    $offset = $_POST['offset']*5;
    $post_id = $_POST['post_id'];
    $my_posts = get_posts( array(
    	'posts_per_page' => 5,
        'offset' => $offset,
    	'post_type'   => 'reviews',
    	'suppress_filters' => true,
        'meta_query' => [
    		[
    			'key'   => 'glempid',
    			'value' => $post_id,
    		]
    	],
    ) );
    global $post;
    $content = '';
	$i = $offset;
    foreach( $my_posts as $post ){
    	setup_postdata( $post );
		$user = get_user_by('id', $post->post_author);
		?>
        <div class="reviews-items__item">
            <div class="reviews-items__item-rating">
                <?php reviews_stars_item_review( $post->rating ); ?>
            </div>
            <div class="reviews-items__item-name">
                <span><?php echo $user->display_name; ?></span>
                <span class="reviews-items__item-name-date">
                    <?php echo get_the_date('j F Y', $post); ?>
                </span>
            </div>
			<div class="reviews-items__item-img">
				<?php glamping_review_img($post->ID, $i); ?>
			</div>
            <div class="reviews-items__item-text">
                <?php echo apply_filters( 'the_content', get_the_content($post) ); ?>
            </div>
        </div>
    <?php $i++; }
    wp_reset_postdata();
    echo $content;
    wp_die();
}

// Формирование статситки отзывов
function glampings_reviews_statistic($post_id) {
    $my_posts = get_posts( array(
    	'numberposts' => -1,
    	'post_type'   => 'reviews',
    	'suppress_filters' => true,
        'meta_query' => [
    		[
    			'key'   => 'glempid',
    			'value' => $post_id,
    		]
    	],
    ) );
    $star_all = 0;
    foreach( $my_posts as $post_gl ){
    	//setup_postdata( $post );
        $star_all += $post_gl->rating;
    }
    $star5 = 0;
    foreach( $my_posts as $post_gl ){
    	//setup_postdata( $post );
        if ( $post_gl->rating == 5 ) {
            ++$star5;
        }
    }
    $star4 = 0;
    foreach( $my_posts as $post_gl ){
    	//setup_postdata( $post );
        if ( $post_gl->rating == 4 ) {
            ++$star4;
        }
    }
    $star3 = 0;
    foreach( $my_posts as $post_gl ){
    	//setup_postdata( $post );
        if ( $post_gl->rating == 3 ) {
            ++$star3;
        }
    }
    $star2 = 0;
    foreach( $my_posts as $post_gl ){
    	//setup_postdata( $post );
        if ( $post_gl->rating == 2 ) {
            ++$star2;
        }
    }
    $star1 = 0;
    foreach( $my_posts as $post_gl ){
    	//setup_postdata( $post );
        if ( $post_gl->rating == 1 ) {
            ++$star1;
        }
    }
    wp_reset_postdata();

    if ( $my_posts ) {
        $average_rating = $star_all / count($my_posts);
    } else {
        $average_rating = 0;
    }

    return [
        'count' => count($my_posts),
        'star_all' => $star_all,
        'average_rating' => round($average_rating, 1),
        'r5' => $star5,
        'r4' => $star4,
        'r3' => $star3,
        'r2' => $star2,
        'r1' => $star1,
    ];
    wp_die();
}

function faq_item($faq_options, $title='Часто задаваемые вопросы', $templ=1) {
	if ($faq_options) {
		$content = '<div class="single-section faq-section">';
		$content .= '<div class="single-section__title">
			<h3>' . $title . '</h3>
		</div>';
		$content .= '<div class="single-section__content faq-section__content">';
		foreach ($faq_options as $key => $faq_option) {
			$active = '';
			if ($key == 0) {
				$active = ' active';
			}
			$content .= '<div class="faq-item">
		        <div class="faq-item__header' . $active . '">
		            <span class="faq-item__header__title">' . $faq_option["title"] . '</span>
		            <button aria-label="Раскрыть" class="faq-item__header__btn">
		            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
					</svg>
		            </button>
		        </div>
		        <div class="faq-item__panel' . $active . '">
		            <p>' . $faq_option["text"] . '</p>
		        </div>
		    </div>';
		}
		$content .= '</div>';
    	$content .= '</div>';

		if ($templ) {
			echo $content;
		} else {
			return $content;
		}
	}
}

function glampings_related_list($post_id) {
    $terms = get_the_terms( $post_id, 'location' );
    $term_id = $terms[0]->term_id;

    $my_posts = get_posts( array(
    	'post_type'   => 'glampings',
        'exclude' => $post_id,
    	'suppress_filters' => true,
        'tax_query' => [
    		[
    			'taxonomy'   => 'location',
                'field'    => 'id',
			    'terms'    => $term_id
    		]
    	],
        'orderby'	=> 'rand',
        'showposts' => 4,
    ) );

    if ( count($my_posts) < 4 ) {
        $my_posts = get_posts( array(
        	'post_type'   => 'glampings',
            'exclude' => $post_id,
        	'suppress_filters' => true,
            'orderby'	=> 'rand',
            'showposts' => 4,
        ) );
    }
    foreach( $my_posts as $post_rel ){
        // $statistics = tripinglamp_reviews_statistic($post_rel->ID);
        // $separator = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        // <path d="M8.99854 11.8577C8.99854 11.0248 9.26181 10.3403 9.78835 9.80418C10.3245 9.26806 11.0329 9 11.9137 9C12.7849 9 13.4933 9.26327 14.039 9.78982C14.5847 10.3068 14.8575 11.0104 14.8575 11.9008V12.4321C14.8575 13.265 14.5943 13.9447 14.0677 14.4713C13.5412 14.9978 12.8279 15.2611 11.928 15.2611C11.0377 15.2611 10.3245 14.9978 9.78835 14.4713C9.26181 13.9352 8.99854 13.2459 8.99854 12.4034V11.8577Z" fill="var(--separator-coror)"/>
        // </svg>';
        ?>
		<div id="post-<?php echo $post_rel->ID; ?>" class="glamping-item" title="<?php echo get_the_title($post_rel->ID); ?>">
			<a href="<?php echo esc_url( get_permalink($post_rel->ID) ); ?>" class="glamping-item__url" rel="bookmark"></a>
			<?php if ($post_rel->glamping_recommended == 'yes') { ?>
				<div class="glamping-item__recommended">Рекомендуем</div>
			<?php } ?>
			<div class="glamping-item__btns-fav-comp">
				<button id="add-favorites" data-postid="<?php echo $post_rel->ID; ?>" class="glamping-item__btns-fav-comp__btn-add-fav round-sup-red" type="button" name="button" title="Добавить в избранное">
					<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						<path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
					</svg>
				</button>
				<button id="add-comparison" data-postid="<?php echo $post_rel->ID; ?>" class="glamping-item__btns-fav-comp__btn-add-comp round-sup-red" type="button" name="button" title="Добавить к сравнению">
					<svg class="rotate90" width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
						<path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
					</svg>
				</button>
			</div>
			<div class="glamping-item__thumbnail">
				<?php glamping_club_gl_thumbnail_slider($post_rel->ID); ?>
			</div>

			<div class="glamping-item__content">
				<div class="glamping-item__content__left">
					<div class="glamping-item__content__title">
						<?php echo get_the_title($post_rel->ID); ?>
					</div>

					<div class="glamping-item__content__rating">
						<?php reviews_stars_items_average( 2.94, 4 ); ?>
					</div>

					<div class="glamping-item__content__bottom">
						<div class="glamping-item__content__bottom__type">
							<svg width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
		                        <path d="M394.3 3.745C401.1 9.425 401.9 19.52 396.3 26.29L308.9 130.4L532.8 397.2C540 405.8 544 416.7 544 428V464C544 490.5 522.5 512 496 512H80C53.49 512 32 490.5 32 464V428C32 416.7 35.98 405.8 43.23 397.2L267.1 130.4L179.7 26.29C174.1 19.52 174.9 9.425 181.7 3.745C188.5-1.936 198.6-1.054 204.3 5.715L287.1 105.5L371.7 5.715C377.4-1.054 387.5-1.936 394.3 3.745H394.3zM64 428V464C64 472.8 71.16 480 80 480H129.9L275.4 294.1C278.4 290.3 283.1 288 288 288C292.9 288 297.6 290.3 300.6 294.1L446.1 480H496C504.8 480 512 472.8 512 464V428C512 424.2 510.7 420.6 508.3 417.7L288 155.3L67.74 417.7C65.33 420.6 64 424.2 64 428zM170.6 480H405.4L288 329.1L170.6 480z"></path>
		                    </svg>
							<?php echo implode(', ', $post_rel->glamping_type); ?>
						</div>
						<div class="glamping-item__content__bottom__address">
				            <a href="#map-container" title="На карте">
				                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C9.87827 2 7.84344 2.84285 6.34315 4.34315C4.84285 5.84344 4 7.87827 4 10C4 13.0981 6.01574 16.1042 8.22595 18.4373C9.31061 19.5822 10.3987 20.5195 11.2167 21.1708C11.5211 21.4133 11.787 21.6152 12 21.7726C12.213 21.6152 12.4789 21.4133 12.7833 21.1708C13.6013 20.5195 14.6894 19.5822 15.774 18.4373C17.9843 16.1042 20 13.0981 20 10C20 7.87827 19.1571 5.84344 17.6569 4.34315C16.1566 2.84285 14.1217 2 12 2ZM12 23C11.4453 23.8321 11.445 23.8319 11.4448 23.8317L11.4419 23.8298L11.4352 23.8253L11.4123 23.8098C11.3928 23.7966 11.3651 23.7776 11.3296 23.753C11.2585 23.7038 11.1565 23.6321 11.0278 23.5392C10.7705 23.3534 10.4064 23.0822 9.97082 22.7354C9.10133 22.043 7.93939 21.0428 6.77405 19.8127C4.48426 17.3958 2 13.9019 2 10C2 7.34784 3.05357 4.8043 4.92893 2.92893C6.8043 1.05357 9.34784 0 12 0C14.6522 0 17.1957 1.05357 19.0711 2.92893C20.9464 4.8043 22 7.34784 22 10C22 13.9019 19.5157 17.3958 17.226 19.8127C16.0606 21.0428 14.8987 22.043 14.0292 22.7354C13.5936 23.0822 13.2295 23.3534 12.9722 23.5392C12.8435 23.6321 12.7415 23.7038 12.6704 23.753C12.6349 23.7776 12.6072 23.7966 12.5877 23.8098L12.5648 23.8253L12.5581 23.8298L12.556 23.8312C12.5557 23.8314 12.5547 23.8321 12 23ZM12 23L12.5547 23.8321C12.2188 24.056 11.7807 24.0556 11.4448 23.8317L12 23Z" fill="black"></path>
				                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8ZM8 10C8 7.79086 9.79086 6 12 6C14.2091 6 16 7.79086 16 10C16 12.2091 14.2091 14 12 14C9.79086 14 8 12.2091 8 10Z" fill="black"></path>
				                </svg>
				                <?php echo get_additionally_meta('address', $post_rel->ID); ?>
				            </a>
				        </div>
					</div>
				</div>

				<div class="glamping-item__content__right">
					<div class="glamping-item__content__right__price">
						<span class="price-number"><?php echo number_format(round($post_rel->glamping_price, 1), 0, ',', ' '); ?> ₽</span>
						<span class="price-text">за 1 ночь</span>
					</div>
					<div class="glamping-item__content__right__btn">
						<a href="<?php echo esc_url( get_permalink($post_rel->ID) ); ?>" class="primary ld w100 btnvib">выбрать</a>
					</div>
				</div>
			</div>
		</div>
        <?php
    }
    wp_reset_postdata();
}

function locations_list_filtr($exclude='') {
	$terms = get_terms( array(
		'hide_empty'  => 1,
		'orderby'     => 'name',
		'order'       => 'ASC',
		'taxonomy'    => 'location',
		'exclude'	  => $exclude,
		'count'  	  => true
	) );
	$content = '';
	if( $terms && ! is_wp_error( $terms ) ){
		foreach( $terms as $term ){
			$content .= '<li>';
			$content .= '<a href="/location/'. esc_html( $term->slug ) .'/"></a>';
			$content .= '<span>'. esc_html( $term->name ) .'</span>';
			$content .= '<span>'. esc_html( $term->count ) .'</span>';
			$content .= '</li>';
		}
	}
	echo $content;
}
