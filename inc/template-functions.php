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
			<span>Все фото</span>
		</button>';
		// echo '<button id="js-gallery-count" class="thumbnail-gallery__btn" type="button" name="button">
		// 	<span>Смотреть </span>
		// 	<span id="gallery-item-count">' . $it . '</span>
		// 	<span> фото</span>
		// </button>';
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

function get_additionally_meta_map($meta, $post_id) {
    // global $post;
    $meta_object = get_post_meta($post_id, 'additionally_field');
	// if ($post_id) {
	// 	$meta_object = get_post_meta($post_id, 'additionally_field');
	// }
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
	if (isset($meta_obj['prepayment'])) {
		if ($meta_obj['prepayment']) {
			echo '<div class="conditions__item">';
			echo '<h5>Предоплата: </h5><span>' . $meta_obj['prepayment'] . '</span>';
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
	// if (isset($meta_obj['glc_notes'])) {
	// 	if ($meta_obj['glc_notes']) {
	// 		echo '<div class="conditions__item">';
	// 		echo '<h5>Примечания </h5>';
	// 		echo '<div class="collapse-content">';
	// 		echo $glc_notes;
	// 		echo '</div>';
	// 		echo '<div class="collapse-content-btn">';
	// 		echo '<span>Развернуть</span>';
	// 		echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
	// 		    <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
	// 		</svg>';
	// 		echo '</div>';
	// 		echo '</div>';
	// 	}
	// }
}

function get_accommodation_options() {
	global $post;
    $meta_object = get_post_meta($post->ID, 'acc_options');
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
		        if (empty($value)) {
		            unset($meta_object_nn[$key]);
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
        <div class="single-section__content acc-options__content">
	<?php
		$i = 1;
		foreach ($meta_obj as $option) {
			$media_gallery = '';
			if (array_key_exists('media_gallery', $option)) {
				$media_gallery = $option['media_gallery'];
			}
			$media = '';

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
				$media .= '</div>';
				$media .= '<div class="swiper-button-next"></div>
		    		<div class="swiper-button-prev"></div>';
				$media .= '</div>';
			}
		?>
			<div class="acc-options__item">
				<div class="acc-options__item__content acc-option custom-scroll">
					<?php echo $media; ?>
					<div class="acc-options__item__content__info"></div>
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

function get_accommodation_options_new() {
	global $post;
    $meta_object = get_post_meta($post->ID, 'acc_options');
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
		        if (empty($value)) {
		            unset($meta_object_nn[$key]);
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
        <div class="single-section__content acc-options__content">
	<?php
		$i = 1;
		foreach ($meta_obj as $option) {
			$media_gallery = '';
			if (array_key_exists('media_gallery', $option)) {
				$media_gallery = $option['media_gallery'];
			}
			$media = '';

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
				$media .= '</div>';
				$media .= '<div class="swiper-pagination"></div>';
				$media .= '<div class="swiper-button-next"></div>
		    		<div class="swiper-button-prev"></div>';
				$media .= '</div>';
			}
		?>
			<div class="acc-options__item">
				<div class="acc-options__item__content acc-option">
					<?php echo $media; ?>
					<div class="acc-options__item__content__info">
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
								<div class="acc-option__options__item__value">
									<?php echo $option['area']. 'м<sup>2</sup>'; ?>
								</div>
							</div>
						<?php }} ?>
						<?php if (array_key_exists('places', $option)) {
							if ($option['places']) {
						?>
						<svg width="2.000000" height="1.992126" viewBox="0 0 2 1.99213" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
							<path id="Vector" d="M2 0.99C2 1.54 1.55 1.99 1 1.99C0.44 1.99 0 1.54 0 0.99C0 0.44 0.44 0 1 0C1.55 0 2 0.44 2 0.99Z" fill="#5E6D77" fill-opacity="1.000000" fill-rule="evenodd"/>
						</svg>
							<div class="acc-option__options__item">
								<div class="acc-option__options__item__value">
									<?php echo $option['places'] . ' кровати'; ?>
								</div>
							</div>
						<?php }} ?>
					</div>
					<div class="acc-option__options__item__excerpt">
						<?php if (array_key_exists('facilities_options_home', $option)) {
							glamping_icons_facilities_options($option['facilities_options_home'], '', 4);
						}
						?>
					</div>
					<!-- <button class="link js-btndetails-acc js-open-modal" type="button"  data-modal="acc-details<?php //echo $i;?>">Подробнее</button> -->
					<div class="acc-option__options__item price-btn">
						<?php if (array_key_exists('price', $option)) {
							if ($option['price']) {
						?>
							<div class="acc-option__options__item item-price">
								<div class="acc-option__options__item__value value-price">
									<?php echo 'От ' . number_format($option['price'], 0, ',', ' ') . ' р. <span>за ночь</span>'; ?>
								</div>
							</div>
						<?php }} else { ?>
							<div class="acc-option__options__item item-price">
								<div class="acc-option__options__item__value value-price">Стоимость не установлена</div>
							</div>
						<?php } ?>
						<!-- <a href="<?php //echo get_post_meta($post->ID, 'additionally_field')[0][0]['site_glamping']?>"
							class="primary golden nxl ntext w-200 btnvib"
							target="_blank"
							rel="nofollow">Забронировать</a> -->
						<button class="primary-light green bg-none nxl ntext w-200 js-btndetails-acc js-open-modal" type="button"  data-modal="acc-details<?php echo $i;?>">Подробнее</button>
					</div>

					</div>
				</div>
				<div class="modal modal-based-theme acc-details custom-scroll" data-modal="acc-details<?php echo $i;?>">
				    <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				        <path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"></path>
				    </svg>
					<div class="modal-content">
					    <div class="acc-details__title">Описание</div>
					    <div class="acc-details__description">
							<?php if (array_key_exists('description', $option)) { ?>
								<div class="acc-option__description">
									<?php echo $option['description']; ?>
								</div>
							<?php } ?>
					    </div>
						<div class="acc-details__facilities">
							<div class="acc-option__facilities__title">
								<div class="acc-details__title">Все удобства</div>
							</div>
							<div class="facilities acc-details-facilities">
								<?php
								if (array_key_exists('facilities_options_home', $option)) {
									glamping_list_facilities_options($option['facilities_options_home'], 'В доме');
								}
								if (array_key_exists('facilities_options_bathroom', $option)) {
									glamping_list_facilities_options($option['facilities_options_bathroom'], 'В ванной');
								}
								if (array_key_exists('facilities_options_kitchen', $option)) {
									glamping_list_facilities_options($option['facilities_options_kitchen'], 'На кухне');
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
		if ($i > 3) {
			$btn_mobile = ' btn-views';
		} else {
			$btn_mobile = '';
		}
		?>
	</div>
	<div class="acc-options__btn-mobile<?php echo $btn_mobile;?>">
		<button class="js-acc-more-all" type="button" name="button">Все варианты</button>
	</div>
</div>
		<?php
	}
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
            <div class="facilities__item__title">
                <h5>' . $title . '</h5>
            </div>
            <div class="single-section__content facilities__content">';
		foreach ($facilities as $value) {
			$value = explode(' - ', $value);
			if (count($value) >= 2) {
				// if ($value[1] == 'бесплатно') {
				// 	$value_text = '<span>' . $value[0] . ' </span> <span class="icon-text-green">₽</span>';
				// } elseif ($value[1] == 'платно') {
				// 	$value_text = '<span>' . $value[0] . '</span> <span class="icon-text-red">₽</span>';
				// }

				if ($value[1] == 'платно') {
					$value_pl = explode(' ', $value[0]);
					if (count($value_pl) > 1) {
						$num_el = count($value_pl)-1;
						$end_el = $value_pl[$num_el];
						array_pop($value_pl);
						$value_text = '<span>';
						$value_text .= implode(" ", $value_pl) . ' <span class="text-no-wrap">' . $end_el . '&nbsp;&nbsp;<span class="icon-text-red">₽</span></span>';
						$value_text .= '</span>';

						// foreach ($value_pl as $key => $value) {
						// 	$value_text .= $value;
						// }
						// $value_text = '<span>' . $value[0] . '</span> <span class="icon-text-red">₽</span>';
					} else {
						$value_text = '<span>' . $value[0] . '&nbsp;&nbsp;</span><span class="icon-text-red">₽</span>';
					}
				} else {
					$value_text = '<span>' . $value[0] . '</span>';
				}
			} else {
				$value_text = '<span>' . $value[0] . '</span>';
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
			// echo $value_text;
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
		echo '<div class="single-section facilities__item">';
		if ($title) {
			echo '<div class="single-section__title">
	                <h6>' . $title . '</h6>
	            </div>';
		}
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

function glamping_list_facilities_options($type_facilities, $title, $count=0) {
	global $post;
	$ic = 1;
	if ($type_facilities) {
		echo '<div class="single-section facilities-modal">';
		if ($title) {
			echo '<div class="facilities-modal__title">' . $title . '</div>';
		}
		echo '<ul class="facilities-modal__content">';
		foreach ($type_facilities as $value) {
			echo '<li class="facilities-modal__content__item">';
			echo '<span>' . $value . '</span>';
			echo '</li>';
		}
		echo '</ul>
		</div>';
		$ic++;
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

function get_contact_information_content($title='Контактная информация') {
	global $post;
    $meta_object = get_post_meta($post->ID, 'additionally_field');
    if (!empty($meta_object)) {
        $meta_obj = $meta_object[0][0];
    } else {
        return false;
    }
	$whatsup_glamping = '';
	if (array_key_exists('whatsup_glamping', $meta_obj)) {
		// $whatsup_glamping = str_replace(' ', '', $meta_obj['whatsup_glamping']);
		$whatsup_glamping = preg_replace('![^0-9]+!', '', $meta_obj['whatsup_glamping']);
	}
	$viber_glamping = '';
	if (array_key_exists('viber_glamping', $meta_obj)) {
		// $viber_glamping = str_replace(' ', '', $meta_obj['viber_glamping']);
		$viber_glamping = preg_replace('![^0-9]+!', '', $meta_obj['viber_glamping']);
	}
	$telegram_glamping = '';
	if (array_key_exists('telegram_glamping', $meta_obj)) {
		$telegram_glamping = $meta_obj['telegram_glamping'];
	}
	?>
	<div class="single-aside__content__title">
		<span><?php echo $title; ?></span>
	</div>
	<?php if (array_key_exists('phone_glamping', $meta_obj)) {
		if ($meta_obj['phone_glamping']) {
	?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">Телефон:</div>
			<div class="single-aside__content__item__text">
				<a href="tel:<?php echo preg_replace('![^0-9]+!', '', $meta_obj['phone_glamping']); ?>"><?php echo $meta_obj['phone_glamping']; ?></a>
			</div>
		</div>
	<?php }} ?>
	<?php if (array_key_exists('email_glamping', $meta_obj)) {
		if ($meta_obj['email_glamping']) {
	?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">Почта:</div>
			<div class="single-aside__content__item__text">
				<a href="mailto:<?php echo $meta_obj['email_glamping']; ?>"><?php echo $meta_obj['email_glamping']; ?></a>
			</div>
		</div>
	<?php }} ?>
	<?php if (array_key_exists('site_glamping_ofic', $meta_obj)) {
		if ($meta_obj['site_glamping_ofic']) {
	?>
		<div class="single-aside__content__item">
			<div class="single-aside__content__item__title">Сайт:</div>
			<div class="single-aside__content__item__text">
				<a href="<?php echo $meta_obj['site_glamping_ofic']; ?>"><?php echo punycodeInCyrillic($meta_obj['site_glamping_ofic']); ?></a>
			</div>
		</div>
	<?php }} ?>
	<?php if ($whatsup_glamping || $viber_glamping || $telegram_glamping) { ?>
		<div class="single-aside__content__item messengers">
			<div class="single-aside__content__item__title">Мессенджеры:</div>
		</div>
		<div class="messengers-items">
			<?php if (array_key_exists('whatsup_glamping', $meta_obj)) {
				if ($meta_obj['whatsup_glamping']) {
			?>
				<div class="single-aside__content__item messenger">
					<div class="single-aside__content__item__text">
						<a href="https://wa.me/<?php echo $whatsup_glamping; ?>" class="whatsapp-link" target="_blank" title="WhatsApp">
							<svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
								<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
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
						<a href="viber://chat?number=%2B<?php echo $viber_glamping; ?>" target="_blank" class="viber-link" title="Viber">
							<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
								<path d="M 44.78125 13.15625 C 44 10.367188 42.453125 8.164063 40.1875 6.605469 C 37.328125 4.632813 34.039063 3.9375 31.199219 3.511719 C 27.269531 2.925781 23.710938 2.84375 20.316406 3.257813 C 17.136719 3.648438 14.742188 4.269531 12.558594 5.273438 C 8.277344 7.242188 5.707031 10.425781 4.921875 14.734375 C 4.539063 16.828125 4.28125 18.71875 4.132813 20.523438 C 3.789063 24.695313 4.101563 28.386719 5.085938 31.808594 C 6.046875 35.144531 7.722656 37.527344 10.210938 39.09375 C 10.84375 39.492188 11.65625 39.78125 12.441406 40.058594 C 12.886719 40.214844 13.320313 40.367188 13.675781 40.535156 C 14.003906 40.6875 14.003906 40.714844 14 40.988281 C 13.972656 43.359375 14 48.007813 14 48.007813 L 14.007813 49 L 15.789063 49 L 16.078125 48.71875 C 16.269531 48.539063 20.683594 44.273438 22.257813 42.554688 L 22.472656 42.316406 C 22.742188 42.003906 22.742188 42.003906 23.019531 42 C 25.144531 41.957031 27.316406 41.875 29.472656 41.757813 C 32.085938 41.617188 35.113281 41.363281 37.964844 40.175781 C 40.574219 39.085938 42.480469 37.355469 43.625 35.035156 C 44.820313 32.613281 45.527344 29.992188 45.792969 27.019531 C 46.261719 21.792969 45.929688 17.257813 44.78125 13.15625 Z M 35.382813 33.480469 C 34.726563 34.546875 33.75 35.289063 32.597656 35.769531 C 31.753906 36.121094 30.894531 36.046875 30.0625 35.695313 C 23.097656 32.746094 17.632813 28.101563 14.023438 21.421875 C 13.277344 20.046875 12.761719 18.546875 12.167969 17.09375 C 12.046875 16.796875 12.054688 16.445313 12 16.117188 C 12.050781 13.769531 13.851563 12.445313 15.671875 12.046875 C 16.367188 11.890625 16.984375 12.136719 17.5 12.632813 C 18.929688 13.992188 20.058594 15.574219 20.910156 17.347656 C 21.28125 18.125 21.113281 18.8125 20.480469 19.390625 C 20.347656 19.511719 20.210938 19.621094 20.066406 19.730469 C 18.621094 20.816406 18.410156 21.640625 19.179688 23.277344 C 20.492188 26.0625 22.671875 27.933594 25.488281 29.09375 C 26.230469 29.398438 26.929688 29.246094 27.496094 28.644531 C 27.574219 28.566406 27.660156 28.488281 27.714844 28.394531 C 28.824219 26.542969 30.4375 26.726563 31.925781 27.78125 C 32.902344 28.476563 33.851563 29.210938 34.816406 29.917969 C 36.289063 31 36.277344 32.015625 35.382813 33.480469 Z M 26.144531 15 C 25.816406 15 25.488281 15.027344 25.164063 15.082031 C 24.617188 15.171875 24.105469 14.804688 24.011719 14.257813 C 23.921875 13.714844 24.289063 13.199219 24.835938 13.109375 C 25.265625 13.035156 25.707031 13 26.144531 13 C 30.476563 13 34 16.523438 34 20.855469 C 34 21.296875 33.964844 21.738281 33.890625 22.164063 C 33.808594 22.652344 33.386719 23 32.90625 23 C 32.851563 23 32.796875 22.996094 32.738281 22.984375 C 32.195313 22.894531 31.828125 22.378906 31.917969 21.835938 C 31.972656 21.515625 32 21.1875 32 20.855469 C 32 17.628906 29.371094 15 26.144531 15 Z M 31 21 C 31 21.550781 30.550781 22 30 22 C 29.449219 22 29 21.550781 29 21 C 29 19.347656 27.652344 18 26 18 C 25.449219 18 25 17.550781 25 17 C 25 16.449219 25.449219 16 26 16 C 28.757813 16 31 18.242188 31 21 Z M 36.710938 23.222656 C 36.605469 23.6875 36.191406 24 35.734375 24 C 35.660156 24 35.585938 23.992188 35.511719 23.976563 C 34.972656 23.851563 34.636719 23.316406 34.757813 22.777344 C 34.902344 22.140625 34.976563 21.480469 34.976563 20.816406 C 34.976563 15.957031 31.019531 12 26.160156 12 C 25.496094 12 24.835938 12.074219 24.199219 12.21875 C 23.660156 12.34375 23.125 12.003906 23.003906 11.464844 C 22.878906 10.925781 23.21875 10.390625 23.757813 10.269531 C 24.539063 10.089844 25.347656 10 26.160156 10 C 32.125 10 36.976563 14.851563 36.976563 20.816406 C 36.976563 21.628906 36.886719 22.4375 36.710938 23.222656 Z"></path>
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
						<a href="https://t.me/<?php echo $meta_obj['telegram_glamping']; ?>" class="telegram-link" target="_blank" title="Telegram">
							<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
								<path d="M29.919 6.163l-4.225 19.925c-0.319 1.406-1.15 1.756-2.331 1.094l-6.438-4.744-3.106 2.988c-0.344 0.344-0.631 0.631-1.294 0.631l0.463-6.556 11.931-10.781c0.519-0.462-0.113-0.719-0.806-0.256l-14.75 9.288-6.35-1.988c-1.381-0.431-1.406-1.381 0.288-2.044l24.837-9.569c1.15-0.431 2.156 0.256 1.781 2.013z" fill="#0088cc"/>
							</svg>
						</a>
					</div>
				</div>
			<?php }} ?>
		</div>
		<div class="single-aside__content__item address-item">
			<div class="single-aside__content__item__title">Адрес:</div>
			<div class="single-aside__content__item__text address">
				<?php echo get_additionally_meta('address'); ?>
			</div>
		</div>
		<div class="single-aside__content__item buttons">
			<!-- <button class="primary-light green nxl ntext w-200 js-reviews-more mb-10">Построить маршрут</button> -->
			<a href="https://yandex.ru/maps/?rtext=~<?php echo get_additionally_meta('coordinates'); ?>"
				class="primary-light green nxl ntext w-200"
				target="_blank"
				rel="nofollow">Построить маршрут</a>
			<a href="<?php echo get_post_meta($post->ID, 'additionally_field')[0][0]['site_glamping']?>"
				class="primary golden nxl ntext w-200 btnvib mt-10 book-link"
				target="_blank"
				rel="nofollow">Забронировать</a>
		</div>
	<?php } ?>
	<?php
}

function get_messages_icons() {
	global $post;
    $meta_object = get_post_meta($post->ID, 'additionally_field');
    if (!empty($meta_object)) {
        $meta_obj = $meta_object[0][0];
    } else {
        return false;
    }
	$whatsup_glamping = '';
	if (array_key_exists('whatsup_glamping', $meta_obj)) {
		// $whatsup_glamping = str_replace(' ', '', $meta_obj['whatsup_glamping']);
		$whatsup_glamping = preg_replace('![^0-9]+!', '', $meta_obj['whatsup_glamping']);
	}
	$viber_glamping = '';
	if (array_key_exists('viber_glamping', $meta_obj)) {
		// $viber_glamping = str_replace(' ', '', $meta_obj['viber_glamping']);
		$viber_glamping = preg_replace('![^0-9]+!', '', $meta_obj['viber_glamping']);
	}
	$telegram_glamping = '';
	if (array_key_exists('telegram_glamping', $meta_obj)) {
		$telegram_glamping = $meta_obj['telegram_glamping'];
	}
	?>
	<?php if (array_key_exists('whatsup_glamping', $meta_obj)) {
		if ($meta_obj['whatsup_glamping']) {
	?>
		<div class="mobile-nav__left__icons__item">
			<a href="https://wa.me/<?php echo $whatsup_glamping; ?>" class="whatsapp-link" target="_blank" title="WhatsApp">
				<svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
					<path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
				</svg>
			</a>
		</div>
	<?php }}
	if (array_key_exists('viber_glampingNO', $meta_obj)) {
		if ($meta_obj['viber_glamping']) {
	?>
		<div class="mobile-nav__left__icons__item">
			<a href="viber://chat?number=%2B<?php echo $viber_glamping; ?>" target="_blank" class="viber-link" title="Viber">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
					<path d="M 44.78125 13.15625 C 44 10.367188 42.453125 8.164063 40.1875 6.605469 C 37.328125 4.632813 34.039063 3.9375 31.199219 3.511719 C 27.269531 2.925781 23.710938 2.84375 20.316406 3.257813 C 17.136719 3.648438 14.742188 4.269531 12.558594 5.273438 C 8.277344 7.242188 5.707031 10.425781 4.921875 14.734375 C 4.539063 16.828125 4.28125 18.71875 4.132813 20.523438 C 3.789063 24.695313 4.101563 28.386719 5.085938 31.808594 C 6.046875 35.144531 7.722656 37.527344 10.210938 39.09375 C 10.84375 39.492188 11.65625 39.78125 12.441406 40.058594 C 12.886719 40.214844 13.320313 40.367188 13.675781 40.535156 C 14.003906 40.6875 14.003906 40.714844 14 40.988281 C 13.972656 43.359375 14 48.007813 14 48.007813 L 14.007813 49 L 15.789063 49 L 16.078125 48.71875 C 16.269531 48.539063 20.683594 44.273438 22.257813 42.554688 L 22.472656 42.316406 C 22.742188 42.003906 22.742188 42.003906 23.019531 42 C 25.144531 41.957031 27.316406 41.875 29.472656 41.757813 C 32.085938 41.617188 35.113281 41.363281 37.964844 40.175781 C 40.574219 39.085938 42.480469 37.355469 43.625 35.035156 C 44.820313 32.613281 45.527344 29.992188 45.792969 27.019531 C 46.261719 21.792969 45.929688 17.257813 44.78125 13.15625 Z M 35.382813 33.480469 C 34.726563 34.546875 33.75 35.289063 32.597656 35.769531 C 31.753906 36.121094 30.894531 36.046875 30.0625 35.695313 C 23.097656 32.746094 17.632813 28.101563 14.023438 21.421875 C 13.277344 20.046875 12.761719 18.546875 12.167969 17.09375 C 12.046875 16.796875 12.054688 16.445313 12 16.117188 C 12.050781 13.769531 13.851563 12.445313 15.671875 12.046875 C 16.367188 11.890625 16.984375 12.136719 17.5 12.632813 C 18.929688 13.992188 20.058594 15.574219 20.910156 17.347656 C 21.28125 18.125 21.113281 18.8125 20.480469 19.390625 C 20.347656 19.511719 20.210938 19.621094 20.066406 19.730469 C 18.621094 20.816406 18.410156 21.640625 19.179688 23.277344 C 20.492188 26.0625 22.671875 27.933594 25.488281 29.09375 C 26.230469 29.398438 26.929688 29.246094 27.496094 28.644531 C 27.574219 28.566406 27.660156 28.488281 27.714844 28.394531 C 28.824219 26.542969 30.4375 26.726563 31.925781 27.78125 C 32.902344 28.476563 33.851563 29.210938 34.816406 29.917969 C 36.289063 31 36.277344 32.015625 35.382813 33.480469 Z M 26.144531 15 C 25.816406 15 25.488281 15.027344 25.164063 15.082031 C 24.617188 15.171875 24.105469 14.804688 24.011719 14.257813 C 23.921875 13.714844 24.289063 13.199219 24.835938 13.109375 C 25.265625 13.035156 25.707031 13 26.144531 13 C 30.476563 13 34 16.523438 34 20.855469 C 34 21.296875 33.964844 21.738281 33.890625 22.164063 C 33.808594 22.652344 33.386719 23 32.90625 23 C 32.851563 23 32.796875 22.996094 32.738281 22.984375 C 32.195313 22.894531 31.828125 22.378906 31.917969 21.835938 C 31.972656 21.515625 32 21.1875 32 20.855469 C 32 17.628906 29.371094 15 26.144531 15 Z M 31 21 C 31 21.550781 30.550781 22 30 22 C 29.449219 22 29 21.550781 29 21 C 29 19.347656 27.652344 18 26 18 C 25.449219 18 25 17.550781 25 17 C 25 16.449219 25.449219 16 26 16 C 28.757813 16 31 18.242188 31 21 Z M 36.710938 23.222656 C 36.605469 23.6875 36.191406 24 35.734375 24 C 35.660156 24 35.585938 23.992188 35.511719 23.976563 C 34.972656 23.851563 34.636719 23.316406 34.757813 22.777344 C 34.902344 22.140625 34.976563 21.480469 34.976563 20.816406 C 34.976563 15.957031 31.019531 12 26.160156 12 C 25.496094 12 24.835938 12.074219 24.199219 12.21875 C 23.660156 12.34375 23.125 12.003906 23.003906 11.464844 C 22.878906 10.925781 23.21875 10.390625 23.757813 10.269531 C 24.539063 10.089844 25.347656 10 26.160156 10 C 32.125 10 36.976563 14.851563 36.976563 20.816406 C 36.976563 21.628906 36.886719 22.4375 36.710938 23.222656 Z"></path>
				</svg>
			</a>
		</div>
	<?php }} ?>
	<?php if (array_key_exists('telegram_glamping', $meta_obj)) {
		if ($meta_obj['telegram_glamping']) {
	?>
		<div class="mobile-nav__left__icons__item">
			<a href="https://t.me/<?php echo $meta_obj['telegram_glamping']; ?>" class="telegram-link" target="_blank" title="Telegram">
				<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
					<path d="M29.919 6.163l-4.225 19.925c-0.319 1.406-1.15 1.756-2.331 1.094l-6.438-4.744-3.106 2.988c-0.344 0.344-0.631 0.631-1.294 0.631l0.463-6.556 11.931-10.781c0.519-0.462-0.113-0.719-0.806-0.256l-14.75 9.288-6.35-1.988c-1.381-0.431-1.406-1.381 0.288-2.044l24.837-9.569c1.15-0.431 2.156 0.256 1.781 2.013z" fill="#0088cc"/>
				</svg>
			</a>
		</div>
	<?php }} ?>
	<?php if (array_key_exists('phone_glamping', $meta_obj)) {
		if ($meta_obj['phone_glamping']) {
	?>
		<div class="mobile-nav__left__icons__item">
			<a href="tel:<?php echo preg_replace('![^0-9]+!', '', $meta_obj['phone_glamping']); ?>" title="Позвонить">
				<svg class="phone-svg" width="35.000000" height="35.000000" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<path id="phone-path" d="M17.5 35C27.16 35 35 27.16 35 17.5C35 7.83 27.16 0 17.5 0C7.83 0 0 7.83 0 17.5C0 27.16 7.83 35 17.5 35ZM17.5 10.15L18.06 10.15C19.77 10.15 21.4 10.83 22.61 12.03C23.81 13.24 24.49 14.87 24.49 16.58L24.49 17.14C24.47 17.34 24.38 17.53 24.23 17.67C24.08 17.8 23.89 17.88 23.68 17.88L23.62 17.88C23.41 17.86 23.21 17.76 23.08 17.59C22.94 17.43 22.87 17.22 22.89 17.01L22.89 16.58C22.89 15.95 22.76 15.32 22.52 14.73C22.28 14.15 21.92 13.62 21.48 13.17C21.03 12.72 20.5 12.36 19.91 12.12C19.32 11.88 18.7 11.75 18.06 11.75L17.64 11.75C17.42 11.76 17.22 11.69 17.06 11.56C16.9 11.42 16.81 11.22 16.79 11.02C16.77 10.81 16.83 10.6 16.97 10.44C17.1 10.27 17.29 10.17 17.5 10.15ZM19.91 17.15C19.83 17.08 19.77 16.99 19.73 16.89C19.69 16.79 19.67 16.69 19.67 16.58C19.67 16.37 19.63 16.16 19.55 15.96C19.47 15.77 19.35 15.59 19.2 15.44C19.05 15.29 18.87 15.17 18.68 15.09C18.48 15.01 18.27 14.97 18.06 14.97C17.95 14.97 17.85 14.96 17.75 14.92C17.65 14.88 17.56 14.82 17.48 14.74C17.41 14.67 17.34 14.58 17.3 14.48C17.26 14.38 17.24 14.27 17.24 14.17C17.24 14.06 17.26 13.95 17.3 13.86C17.34 13.76 17.41 13.67 17.48 13.59C17.56 13.52 17.65 13.46 17.75 13.42C17.85 13.38 17.95 13.36 18.06 13.36C18.91 13.36 19.73 13.7 20.34 14.31C20.94 14.91 21.28 15.73 21.28 16.58C21.28 16.74 21.23 16.9 21.14 17.03C21.06 17.16 20.93 17.26 20.78 17.32C20.64 17.39 20.47 17.4 20.32 17.37C20.16 17.34 20.02 17.26 19.91 17.15ZM23.24 24.17L23.24 24.17C23.24 24.35 23.2 24.51 23.13 24.67C23.06 24.83 22.96 24.96 22.83 25.08C22.7 25.2 22.55 25.29 22.38 25.34C22.21 25.39 22.04 25.41 21.86 25.39C20.38 25.38 18.69 24.68 17.21 23.86C15.71 23.02 14.36 22.02 13.58 21.34L13.56 21.33L13.55 21.32C11.31 19.08 9.87 16.16 9.46 13.01C9.43 12.83 9.45 12.65 9.5 12.48C9.55 12.3 9.64 12.14 9.76 12.01C9.88 11.88 10.02 11.78 10.18 11.71C10.33 11.64 10.51 11.61 10.68 11.61L13.12 11.61C13.4 11.6 13.68 11.69 13.9 11.87C14.12 12.04 14.27 12.29 14.34 12.56L14.35 12.61L14.35 12.65C14.35 12.77 14.37 12.87 14.41 13.02C14.42 13.09 14.44 13.15 14.46 13.23L14.46 13.23C14.55 13.64 14.67 14.04 14.82 14.43L14.95 14.79L13.47 15.49L13.47 15.49C13.37 15.53 13.29 15.61 13.25 15.72L13.25 15.72L13.25 15.73C13.21 15.83 13.21 15.94 13.25 16.04L13.26 16.08L13.27 16.13C13.32 16.43 13.49 16.83 13.79 17.29C14.08 17.75 14.48 18.25 14.98 18.75C15.96 19.76 17.28 20.77 18.75 21.53C18.84 21.57 18.95 21.57 19.04 21.53L19.05 21.53L19.06 21.52C19.16 21.49 19.24 21.41 19.28 21.31L19.29 21.31L19.95 19.83L20.31 19.96C20.71 20.1 21.13 20.22 21.55 20.32L21.55 20.32L21.55 20.32C21.76 20.36 21.97 20.4 22.18 20.43L22.19 20.44L22.21 20.44C22.48 20.5 22.73 20.65 22.9 20.87C23.07 21.1 23.17 21.37 23.16 21.65L23.24 24.17Z" fill="#323232" fill-opacity="1.000000" fill-rule="evenodd"/>
				</svg>
			</a>
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
			<?php echo number_format(round($rating_value, 1), 1, '.', ' '); ?>
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
	$rating_html = ($rating)? number_format(round($rating, 1), 1, '.', ' ') : 0;
	$content .= '</div>
	<div class="rating-count">
		<div class="rating-count__rating">' . $rating_html . '</div>
		<div class="rating-count__otziv"> / ' . num_word($count_otziv, array('отзыв', 'отзыва', 'отзывов')) . '</div>
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
	$title = 'Новинки';
	$class = '';
	if ( !empty( $_COOKIE["glcSort"] ) ) {
		if ($_COOKIE["glcSort"] == $name) {
			$class = 'active';
		}
		$title = options_name($_COOKIE["glcSort"]);
	} elseif ($name == 'new_items') {
		$class = 'active';
	}
	return ['title' => $title, 'class' => $class];
}

function template_cookie_value() {
	$no_map = '';
	$gwrap_scroll = ' my-scrollbar-gc';
	$glcf_scroll = ' height-auto';
	$card_list = ' list';
	$map = ' active';
	$btn_vision = ' active';
	$btn_close = '';
	$mediaQuery = '';
	if ( !empty( $_COOKIE["glcTemp"] ) ) {
		if ($_COOKIE["glcTemp"] == 'mapClose') {
			$no_map = ' no-map';
			$gwrap_scroll = '';
			$glcf_scroll = '';
			$card_list = ' card';
			$map = '';
			$btn_vision = '';
			$btn_close = ' active';
		}
		// elseif ($_COOKIE["glcTemp"] == 'mapVision') {
		// 	// code...
		// }
	}

	if ( !empty( $_COOKIE["mediaQuery"] ) ) {
		$mediaQuery = $_COOKIE["mediaQuery"];
	}
	return [
			'no_map' => $no_map,
			'gwrap_scroll' => $gwrap_scroll,
			'glcf_scroll' => $glcf_scroll,
			'card_list' => $card_list,
			'map' => $map,
			'btn_vision' => $btn_vision,
			'btn_close' => $btn_close,
			'mediaQuery' => $mediaQuery
		];
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
		'nopaging'  => true,
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

		$meta_object_af = get_post_meta($post->ID, 'additionally_field');
		$meta_object = [];

		if ($meta_object_af) {
			$meta_object = get_post_meta($post->ID, 'additionally_field')[0][0];
		}
		if (isset($meta_object['coordinates'])) {
	        $coordinates = $meta_object['coordinates'];

			if (isset($meta_object['address'])) {
		        $address = $meta_object['address'];
		    }
			$phone_glamping = '';
			$whatsup_glamping = '';
			if (isset($meta_object['phone_glamping'])) {
				if ($meta_object['phone_glamping']) {
					$phone_glamping = '<a href="tel:' . preg_replace('![^0-9]+!', '', $meta_object['phone_glamping']) . '" class="glamp-phone">
						<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
							<path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
						</svg>
					</a>';
				}
		    }
			if (isset($meta_object['whatsup_glamping'])) {
				if ($meta_object['whatsup_glamping']) {
					$whatsup_glamping = '<a href="https://wa.me/' . preg_replace('![^0-9]+!', '', $meta_object['whatsup_glamping']) . '" class="glamp-wa">
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
			// $balloonContentBodyPan .= $phone_glamping;
			// $balloonContentBodyPan .= $whatsup_glamping;
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

		return $media;
	}
}

function glamping_review_img_list($post_id, $i) {
	$media = get_post_meta( $post_id, 'photos', 1 );
	$media_wievs_count = 5;
	$media_count = 0;
	if ($media) {
		$media_count = count($media)-$media_wievs_count;
		if ($media_count) {
			$content_count_style = ' active';
		} else {
			$content_count_style = '';
		}
		$content_count = '<div class="galery-review-list__count' . $content_count_style . '">';
		$content_count .= '<span>+</span>';
		$content_count .= '<span class="galery-review-list__count__value">' . $media_count . '</span>';
		$content_count .= '</div>';
		$it = 0;
		$content = '<div class="galery-review-list list-' . $i . '">';
		foreach ( $media as $key => $value ) {
			$url = wp_get_attachment_image_url( $key, 'medium' );
			$url_full = wp_get_attachment_image_url( $key, 'full' );
			$content .= '<div class="galery-review-list__item gallery-' . $i . '">';
			$content .= '<a href="' . $url_full . '" class="acc-media">';
			$content .= '<img src="' . $url . '" alt="" /></a>';
			$content .= '</div>';
			$it++;
		}
		$content .= $content_count;
		$content .= '</div>';

		return $content;
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
		$review_author = $user->display_name;
		if ($post->review_author) {
			$review_author = $post->review_author;
		}
		// $images = glamping_review_img($post->ID, $i);
		$images = glamping_review_img_list($post->ID, $i);
		$is_images = '';
		if ($images) {
			$is_images = ' is-images';
		}
		?>
        <div class="reviews-items__item">
			<div class="reviews-items__item-name">
                <span class="reviews-items__item-name__initials" <?php colorInitial(user_initials($review_author)); ?>><?php echo user_initials($review_author); ?></span>
				<span><?php echo $review_author; ?></span>
            </div>
            <div class="reviews-items__item-rating">
                <?php reviews_stars_item_review( $post->rating ); ?>
				<span class="reviews-items__item-name-date">
                    <?php echo get_the_date('j F Y', $post); ?>
                </span>
            </div>
			<div class="reviews-items__item-img">
				<?php echo $images; ?>
			</div>
            <div class="reviews-items__item-text<?php echo $is_images;?>">
                <?php echo apply_filters( 'the_content', get_the_content($post) ); ?>
            </div>
			<div class="reviews-items__item-btn">
				<button type="button" name="button" onclick="collapseReviews(this)">
					<span>Показать полностью</span>
					<svg width="12" height="6" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L8 8L15 1" stroke="#161616" stroke-width="1.5"></path>
					</svg>
				</button>
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
		$review_author = $user->display_name;
		if ($post->review_author) {
			$review_author = $post->review_author;
		}
		// $images = glamping_review_img($post->ID, $i);
		$images = glamping_review_img_list($post->ID, $i);
		$is_images = '';
		if ($images) {
			$is_images = ' is-images';
		}
		?>
		<div class="reviews-items__item">
			<div class="reviews-items__item-name">
                <span class="reviews-items__item-name__initials" <?php colorInitial(user_initials($review_author)); ?>><?php echo user_initials($review_author); ?></span>
				<span><?php echo $review_author; ?></span>
            </div>
            <div class="reviews-items__item-rating">
                <?php reviews_stars_item_review( $post->rating ); ?>
				<span class="reviews-items__item-name-date">
                    <?php echo get_the_date('j F Y', $post); ?>
                </span>
            </div>
			<div class="reviews-items__item-img">
				<?php echo $images; ?>
			</div>
            <div class="reviews-items__item-text<?php echo $is_images;?>">
                <?php echo apply_filters( 'the_content', get_the_content($post) ); ?>
            </div>
			<div class="reviews-items__item-btn">
				<button type="button" name="button" onclick="collapseReviews(this)">
					<span>Показать полностью</span>
					<svg width="12" height="6" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L8 8L15 1" stroke="#161616" stroke-width="1.5"></path>
					</svg>
				</button>
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

function faq_item($faq_options, $title='Частые вопросы и ответы', $first=0, $templ=1) {
	if ($faq_options) {
		$content = '<div class="single-section faq-section">';
		$content .= '<div class="single-section__title">
			<h3>' . $title . '</h3>
		</div>';
		$content .= '<div class="single-section__content faq-section__content">';
		foreach ($faq_options as $key => $faq_option) {
			$active = '';
			if ($first && $key == 0) {
				$active = ' active';
			}
			$content .= '<div class="faq-item">
		        <div class="faq-item__header' . $active . '">
		            <span class="faq-item__header__title">' . $faq_option["title"] . '</span>
		            <button aria-label="Раскрыть" class="faq-item__header__btn">
					<svg width="14" height="7" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L8 8L15 1" stroke="#161616" stroke-width="1.5"/>
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

function wtd_item($wtd_options, $title='Чем заняться', $templ=1) {
	if ($wtd_options) {
		$content = '<div class="single-section wtd-section">';
		$content .= '<div class="single-section__title">
			<h3>' . $title . '</h3>
		</div>';
		$content .= '<div class="swiper wtdSwiper">';
		$content .= '<div class="swiper-wrapper">';
		foreach ($wtd_options as $key => $wtd_option) {
			if (isset($wtd_option["title"])) {
				if (isset($wtd_option["wtd_img"])) {
					if ($wtd_option["wtd_img"]) {
						$img_wrap = '<div class="wtd-item__img">
							<img src="' . $wtd_option["wtd_img"] . '" alt="">
						</div>';
						$text_class = '';
					} else {
						$img_wrap = '';
						$text_class = ' no-img';
					}
				} else {
					$img_wrap = '';
					$text_class = ' no-img';
				}
				$content .= '<div class="wtd-item swiper-slide">';
	            $content .= $img_wrap;
	            $content .= '<div class="wtd-item__text">
	                    <div class="wtd-item__text__type-price">' . $wtd_option["type_price"] . '</div>
	                    <div class="wtd-item__text__title">' . $wtd_option["title"] . '</div>
	                    <div class="wtd-item__text__text' . $text_class . '">' . $wtd_option["text"] . '</div>
	                    <button class="link js-btndetails-wtd js-open-modal" type="button"  data-modal="wtd-details' . $key . '">Подробнее</button>
	                </div>
	            </div>';
			}
		}
		$content .= '</div>';
    	$content .= '<div class="sw-pag-wrap">
	            <div class="swiper-button-next"></div>
	            <div class="swiper-button-prev"></div>
	        </div>';
		$content .= '<div class="swiper-pagination"></div>';
    	$content .= '</div>';
		$content .= '</div>';

		$it_count = 0;
		foreach ($wtd_options as $key => $wtd_option) {
			if (isset($wtd_option["title"])) {
				if (isset($wtd_option["wtd_img"])) {
					if ($wtd_option["wtd_img"]) {
						$img_wrap = '<div class="wtd-item__img">
							<img src="' . $wtd_option["wtd_img"] . '" alt="">
						</div>';
					} else {
						$img_wrap = '';
					}
				} else {
					$img_wrap = '';
				}
				$content .= '<div class="modal modal-based-theme acc-details custom-scroll" data-modal="wtd-details' . $key . '">
					<svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						<path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"></path>
					</svg>
					<div class="modal-content">
						<div class="acc-details__title">' . $wtd_option["title"] . '</div>
						<div class="acc-details__description wtd-description">
							<div class="acc-option__description">' . $wtd_option["text"] . '</div>
						</div>
						' . $img_wrap . '
					</div>
				</div>';
				$it_count++;
			}
		}

		if ($it_count) {
			if ($templ) {
				echo $content;
			} else {
				return $content;
			}
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
        'posts_per_page' => -1,
    ) );

    if ( count($my_posts) < 4 ) {
        $my_posts = get_posts( array(
        	'post_type'   => 'glampings',
            'exclude' => $post_id,
        	'suppress_filters' => true,
            'orderby'	=> 'rand',
            'posts_per_page' => -1,
        ) );
    }
    foreach( $my_posts as $post_rel ){
		$statistics = glampings_reviews_statistic($post_rel->ID);
		$count_rating = $statistics['count'];
		$average_rating = $statistics['average_rating'];
        ?>
		<div id="post-<?php echo $post_rel->ID; ?>" class="glamping-item swiper-slide" title="<?php echo get_the_title($post_rel->ID); ?>">
			<a href="<?php echo esc_url( get_permalink($post_rel->ID) ); ?>" class="glamping-item__url" rel="bookmark"></a>
			<div class="glamping-item__sr">
				<?php if ($post_rel->glamping_recommended == 'yes') { ?>
					<div class="glamping-item__sr__item recommended">Рекомендуем</div>
				<?php } ?>
				<?php if ($post_rel->stocks) { ?>
					<div class="glamping-item__sr__item stocks"><?php echo stocks_title($post_rel->stocks, 1);?></div>
				<?php } ?>
			</div>
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
						<?php reviews_stars_items_average( $average_rating, $count_rating ); ?>
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
						<span class="price-number">От <?php echo number_format(round($post_rel->glamping_price, 1), 0, ',', ' '); ?> р.</span>
						<span class="price-text">за 1 ночь</span>
					</div>
					<div class="glamping-item__content__right__btn">
						<a href="<?php echo esc_url( get_permalink($post_rel->ID) ); ?>" class="primary-light green nxl ntext w100 btnvib">Подробнее</a>
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

function colorInitial($initial) {
	require get_template_directory() . '/functions/inic-colors.php';
	if (isset($colors[$initial])) {
		echo 'style="background: ' . $colors[$initial] . ';"';
	} else {
		echo 'style="background: ' . $colors['Z'] . ';"';
	}
}

function glemp_stocs($glemp_id, $title='Акции', $templ=1) {
	$args = array(
        'post_type' => 'stocks',
        'post_status' => 'publish',
        'posts_per_page' => -1,
		'meta_query' => [ [
			'key' => 'parent_glemp',
			'value' => $glemp_id,
		] ],
        // 'orderby' => 'meta_value date', //meta_value_num, title
        // 'meta_key' => 'glamping_recommended',
        // 'order' => 'DESC',
    );
    $stocks = get_posts( $args );
	$stocks_item = '';
	if ($stocks) {
		foreach ($stocks as $stock) {
			$description = '';
			$button = '';
			if ($stock->post_content) {
				$description = '<div class="stocks__items__item__left__description">' . wpautop($stock->post_content) . '</div>';
				$button = '<div class="stocks__items__item__btn">
					<button class="primary-light green bg-none nxl ntext w-160 js-stocks-more">Подробнее</button>
				</div>';
			}
			$stocks_item .= '<div class="stocks__items__item">';
			$stocks_item .= '<div class="stocks__items__item__left">';
			$stocks_item .= '<div class="stocks__items__item__left__title">' . $stock->post_title . '</div>';
			$stocks_item .= '<div class="stocks__items__item__left__validity-period">';
			// $stocks_item .= '<div class="stocks__items__item__left__validity-period__label">Срок действия:</div>';
			$stocks_item .= '<div class="stocks__items__item__left__validity-period__text">Срок действия: ' . $stock->validity_period . '</div>';
			$stocks_item .= '</div>';
			$stocks_item .= $description;
			$stocks_item .= '</div>';
			$stocks_item .= $button;
			$stocks_item .= '</div>';
		}
		wp_reset_postdata();
		$content = '<div class="single-section stocks-section">';
		$content .= '<div class="single-section__title">
			<h3>' . $title . '</h3>
		</div>';
		$content .= '<div class="stocks__items">';
		$content .= $stocks_item;
		$content .= '</div>';
		$content .= '</div>';
		if ($templ) {
			echo $content;
		} else {
			return $content;
		}
	}
}

function term_glemp($post_id) {
	$term_obj = get_the_terms( $post_id, 'location' );
    if ($term_obj) {
        $term = $term_obj[0]->slug;
    } else {
        $term = '';
    }
	return $term;
}

function glampings_recommendated_list() {
    $args = [
    	'post_type'   => 'glampings',
    	'suppress_filters' => true,
        'posts_per_page' => 8,
    ];

	$my_posts = get_posts($args);

    foreach( $my_posts as $post_rec ){
		$statistics = glampings_reviews_statistic($post_rec->ID);
		$count_rating = $statistics['count'];
		$average_rating = $statistics['average_rating'];
		?>
		<div id="post-<?php echo $post_rec->ID; ?>" class="glamping-item" title="<?php echo get_the_title($post_rec->ID); ?>">
			<a href="<?php echo esc_url( get_permalink($post_rec->ID) ); ?>" class="glamping-item__url" rel="bookmark"></a>
			<div class="glamping-item__sr">
				<?php if ($post_rec->glamping_recommended == 'yes') { ?>
					<div class="glamping-item__sr__item recommended">Рекомендуем</div>
				<?php } ?>
				<?php if ($post_rec->stocks) { ?>
					<div class="glamping-item__sr__item stocks"><?php echo stocks_title($post_rec->stocks, 1);?></div>
				<?php } ?>
			</div>
			<div class="glamping-item__btns-fav-comp">
				<button id="add-favorites" data-postid="<?php echo $post_rec->ID; ?>" class="glamping-item__btns-fav-comp__btn-add-fav round-sup-red" type="button" name="button" title="Добавить в избранное">
					<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						<path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
					</svg>
				</button>
				<button id="add-comparison" data-postid="<?php echo $post_rec->ID; ?>" class="glamping-item__btns-fav-comp__btn-add-comp round-sup-red" type="button" name="button" title="Добавить к сравнению">
					<svg class="rotate90" width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
						<path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
					</svg>
				</button>
			</div>
			<div class="glamping-item__thumbnail">
				<?php glamping_club_gl_thumbnail_slider($post_rec->ID); ?>
			</div>

			<div class="glamping-item__content">
				<div class="glamping-item__content__left">
					<div class="glamping-item__content__title">
						<?php echo get_the_title($post_rec->ID); ?>
					</div>

					<div class="glamping-item__content__rating">
						<?php reviews_stars_items_average( $average_rating, $count_rating ); ?>
					</div>

					<div class="glamping-item__content__bottom">
						<div class="glamping-item__content__bottom__type">
							<svg width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
		                        <path d="M394.3 3.745C401.1 9.425 401.9 19.52 396.3 26.29L308.9 130.4L532.8 397.2C540 405.8 544 416.7 544 428V464C544 490.5 522.5 512 496 512H80C53.49 512 32 490.5 32 464V428C32 416.7 35.98 405.8 43.23 397.2L267.1 130.4L179.7 26.29C174.1 19.52 174.9 9.425 181.7 3.745C188.5-1.936 198.6-1.054 204.3 5.715L287.1 105.5L371.7 5.715C377.4-1.054 387.5-1.936 394.3 3.745H394.3zM64 428V464C64 472.8 71.16 480 80 480H129.9L275.4 294.1C278.4 290.3 283.1 288 288 288C292.9 288 297.6 290.3 300.6 294.1L446.1 480H496C504.8 480 512 472.8 512 464V428C512 424.2 510.7 420.6 508.3 417.7L288 155.3L67.74 417.7C65.33 420.6 64 424.2 64 428zM170.6 480H405.4L288 329.1L170.6 480z"></path>
		                    </svg>
							<?php echo implode(', ', $post_rec->glamping_type); ?>
						</div>
						<div class="glamping-item__content__bottom__address">
				            <a href="#map-container" title="На карте">
				                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C9.87827 2 7.84344 2.84285 6.34315 4.34315C4.84285 5.84344 4 7.87827 4 10C4 13.0981 6.01574 16.1042 8.22595 18.4373C9.31061 19.5822 10.3987 20.5195 11.2167 21.1708C11.5211 21.4133 11.787 21.6152 12 21.7726C12.213 21.6152 12.4789 21.4133 12.7833 21.1708C13.6013 20.5195 14.6894 19.5822 15.774 18.4373C17.9843 16.1042 20 13.0981 20 10C20 7.87827 19.1571 5.84344 17.6569 4.34315C16.1566 2.84285 14.1217 2 12 2ZM12 23C11.4453 23.8321 11.445 23.8319 11.4448 23.8317L11.4419 23.8298L11.4352 23.8253L11.4123 23.8098C11.3928 23.7966 11.3651 23.7776 11.3296 23.753C11.2585 23.7038 11.1565 23.6321 11.0278 23.5392C10.7705 23.3534 10.4064 23.0822 9.97082 22.7354C9.10133 22.043 7.93939 21.0428 6.77405 19.8127C4.48426 17.3958 2 13.9019 2 10C2 7.34784 3.05357 4.8043 4.92893 2.92893C6.8043 1.05357 9.34784 0 12 0C14.6522 0 17.1957 1.05357 19.0711 2.92893C20.9464 4.8043 22 7.34784 22 10C22 13.9019 19.5157 17.3958 17.226 19.8127C16.0606 21.0428 14.8987 22.043 14.0292 22.7354C13.5936 23.0822 13.2295 23.3534 12.9722 23.5392C12.8435 23.6321 12.7415 23.7038 12.6704 23.753C12.6349 23.7776 12.6072 23.7966 12.5877 23.8098L12.5648 23.8253L12.5581 23.8298L12.556 23.8312C12.5557 23.8314 12.5547 23.8321 12 23ZM12 23L12.5547 23.8321C12.2188 24.056 11.7807 24.0556 11.4448 23.8317L12 23Z" fill="black"></path>
				                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8ZM8 10C8 7.79086 9.79086 6 12 6C14.2091 6 16 7.79086 16 10C16 12.2091 14.2091 14 12 14C9.79086 14 8 12.2091 8 10Z" fill="black"></path>
				                </svg>
				                <?php echo get_additionally_meta('address'); ?>
				            </a>
				        </div>
					</div>
				</div>

				<div class="glamping-item__content__right">
					<div class="glamping-item__content__right__price">
						<span class="price-number">От <?php echo number_format(round($post_rec->glamping_price, 1), 0, ',', ' '); ?> р.</span>
						<span class="price-text">за 1 ночь</span>
					</div>
					<div class="glamping-item__content__right__btn">
						<a href="<?php echo esc_url( get_permalink($post_rec->ID) ); ?>" class="primary golden nxl ntext w100 btnvib">Подробнее</a>
					</div>
				</div>
			</div>
		</div>
        <?php
    }
    wp_reset_postdata();
}

function glampings_recommendated_list_slider() {
	$args = [
    	'post_type'   => 'glampings',
    	'suppress_filters' => true,
        'posts_per_page' => 8,
    ];

	$my_posts = get_posts($args);

    foreach( $my_posts as $post_rel ){
		$statistics = glampings_reviews_statistic($post_rel->ID);
		$count_rating = $statistics['count'];
		$average_rating = $statistics['average_rating'];
        ?>
		<div id="post-<?php echo $post_rel->ID; ?>" class="glamping-item swiper-slide" title="<?php echo get_the_title($post_rel->ID); ?>">
			<a href="<?php echo esc_url( get_permalink($post_rel->ID) ); ?>" class="glamping-item__url" rel="bookmark"></a>
			<div class="glamping-item__sr">
				<?php if ($post_rel->glamping_recommended == 'yes') { ?>
					<div class="glamping-item__sr__item recommended">Рекомендуем</div>
				<?php } ?>
				<?php if ($post_rel->stocks) { ?>
					<div class="glamping-item__sr__item stocks"><?php echo stocks_title($post_rel->stocks, 1);?></div>
				<?php } ?>
			</div>
			<div class="glamping-item__btns-fav-comp">
				<button id="add-favorites" data-postid="<?php echo $post_rel->ID; ?>" class="glamping-item__btns-fav-comp__btn-add-fav round-sup-red" onclick="addFavNew(this)" title="Добавить в избранное">
					<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						<path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
					</svg>
				</button>
				<button id="add-comparison" data-postid="<?php echo $post_rel->ID; ?>" class="glamping-item__btns-fav-comp__btn-add-comp round-sup-red" onclick="addCompNew(this)" title="Добавить к сравнению">
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
						<?php reviews_stars_items_average( $average_rating, $count_rating ); ?>
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
						<span class="price-number">От <?php echo number_format(round($post_rel->glamping_price, 1), 0, ',', ' '); ?> р.</span>
						<span class="price-text">за 1 ночь</span>
					</div>
					<div class="glamping-item__content__right__btn">
						<a href="<?php echo esc_url( get_permalink($post_rel->ID) ); ?>" class="primary golden nxl ntext w100 btnvib">Подробнее</a>
					</div>
				</div>
			</div>
		</div>
        <?php
    }
    wp_reset_postdata();
}

function glampings_regions_slider_swiper() {
	$content = '<div class="swiper-container-top">';
	$content .= '<div class="swiper-wrapper">';
	for ($n = 1; $n <= 18; $n++) {
		$content .= '<div class="swiper-slide">';
		$content .= '<img src="' . get_template_directory_uri() . '/src/img/regioni/Frame61-' . $n . '.jpg" alt="">';
		$content .= '</div>';
	}
	$content .= '</div>';
	$content .= '</div>';

	$content .= '<div class="swiper-container-bottom">';
	$content .= '<div class="swiper-wrapper">';
	for ($n = 1; $n <= 55; $n++) {
		$content .= '<div class="swiper-slide">';
		$content .= '<img src="' . get_template_directory_uri() . '/src/img/regioni/Frame62-' . $n . '.jpg" alt="">';
		$content .= '</div>';
	}
	$content .= '</div>';
	$content .= '</div>';

	echo $content;
}

function glampings_regions_slider_splide() {
	$site_options = get_option( 'glc_options' );
	$orderby = 'name';
	if ($site_options) {
		if ( array_key_exists('order_regions_slider_front', $site_options) ) {
			$orderby = $site_options['order_regions_slider_front'];
		}
	}
	$terms = get_terms( [
		'taxonomy'   => 'location',
		'hide_empty' => false,
		'orderby' => $orderby
	] );

	$end_top = ceil(count($terms)/2);
	$start_bottom = ceil(count($terms)/2)+1;

	$content = '<div id="splide-top" class="splide spl-top js-splide-slider">';
	$content .= '<div class="splide__track top">';
	$content .= '<div class="splide__list">';
	foreach( $terms as $key => $term ) {
		$image_url = get_template_directory_uri() . '/src/img/regioni/top.jpeg';
		$image_id = get_term_meta( $term->term_id, '_thumbnail_id', 1 );
		if ($image_id) {
			$image_url = wp_get_attachment_image_url( $image_id, 'full' );
		}
		if ($key <= $end_top) {
			$content .= '<div class="splide__slide">';
			$content .= '<a href="/location/' . $term->slug . '/">';
			$content .= '<img src="' . $image_url . '" alt="">';
			$content .= '<span class="region-name">' . $term->name . '</span>';
			$content .= '</a>';
			$content .= '</div>';
		}
	}
	$content .= '</div>';
	$content .= '</div>';
	$content .= '</div>';

	$content .= '<div id="splide-bottom" class="splide spl-bottom js-splide-slider">';
	$content .= '<div class="splide__track bottom">';
	$content .= '<div class="splide__list">';
	foreach( $terms as $key => $term ) {
		$image_url = get_template_directory_uri() . '/src/img/regioni/bottom.jpeg';
		$image_id = get_term_meta( $term->term_id, '_thumbnail_id', 1 );
		if ($image_id) {
			$image_url = wp_get_attachment_image_url( $image_id, 'full' );
		}
		if ($key >= $start_bottom) {
			$content .= '<div class="splide__slide">';
			$content .= '<a href="/location/' . $term->slug . '/">';
			$content .= '<img src="' . $image_url . '" alt="">';
			$content .= '<span class="region-name">' . $term->name . '</span>';
			$content .= '</a>';
			$content .= '</div>';
		}
	}
	$content .= '</div>';
	$content .= '</div>';
	$content .= '</div>';

	echo $content;
}

function glampings_hot_deals_list() {
	$args = [
    	'post_type'   => 'glampings',
    	'suppress_filters' => true,
        'posts_per_page' => 4,
    ];

	$my_posts = get_posts($args);

    foreach( $my_posts as $post_rec ){
		$statistics = glampings_reviews_statistic($post_rec->ID);
		$count_rating = $statistics['count'];
		$average_rating = $statistics['average_rating'];
		?>
		<div id="post-<?php echo $post_rec->ID; ?>" class="glamping-item" title="<?php echo get_the_title($post_rec->ID); ?>">
			<a href="<?php echo esc_url( get_permalink($post_rec->ID) ); ?>" class="glamping-item__url" rel="bookmark"></a>
			<div class="glamping-item__sr">
				<?php if ($post_rec->glamping_recommended == 'yes') { ?>
					<div class="glamping-item__sr__item recommended">Рекомендуем</div>
				<?php } ?>
				<?php if ($post_rec->stocks) { ?>
					<div class="glamping-item__sr__item stocks"><?php echo stocks_title($post_rec->stocks, 1);?></div>
				<?php } ?>
			</div>
			<div class="glamping-item__btns-fav-comp">
				<button id="add-favorites" data-postid="<?php echo $post_rec->ID; ?>" class="glamping-item__btns-fav-comp__btn-add-fav round-sup-red" onclick="addFavNew(this)" title="Добавить в избранное">
					<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
						<path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
					</svg>
				</button>
				<button id="add-comparison" data-postid="<?php echo $post_rec->ID; ?>" class="glamping-item__btns-fav-comp__btn-add-comp round-sup-red"  onclick="addCompNew(this)" title="Добавить к сравнению">
					<svg class="rotate90" width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
						<path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
					</svg>
				</button>
			</div>
			<div class="glamping-item__thumbnail">
				<?php glamping_club_gl_thumbnail_slider($post_rec->ID); ?>
			</div>

			<div class="glamping-item__content">
				<div class="glamping-item__content__left">
					<div class="glamping-item__content__title">
						<?php echo get_the_title($post_rec->ID); ?>
					</div>

					<div class="glamping-item__content__rating">
						<?php reviews_stars_items_average( $average_rating, $count_rating ); ?>
					</div>

					<div class="glamping-item__content__bottom">
						<div class="glamping-item__content__bottom__type">
							<svg width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
		                        <path d="M394.3 3.745C401.1 9.425 401.9 19.52 396.3 26.29L308.9 130.4L532.8 397.2C540 405.8 544 416.7 544 428V464C544 490.5 522.5 512 496 512H80C53.49 512 32 490.5 32 464V428C32 416.7 35.98 405.8 43.23 397.2L267.1 130.4L179.7 26.29C174.1 19.52 174.9 9.425 181.7 3.745C188.5-1.936 198.6-1.054 204.3 5.715L287.1 105.5L371.7 5.715C377.4-1.054 387.5-1.936 394.3 3.745H394.3zM64 428V464C64 472.8 71.16 480 80 480H129.9L275.4 294.1C278.4 290.3 283.1 288 288 288C292.9 288 297.6 290.3 300.6 294.1L446.1 480H496C504.8 480 512 472.8 512 464V428C512 424.2 510.7 420.6 508.3 417.7L288 155.3L67.74 417.7C65.33 420.6 64 424.2 64 428zM170.6 480H405.4L288 329.1L170.6 480z"></path>
		                    </svg>
							<?php echo implode(', ', $post_rec->glamping_type); ?>
						</div>
						<div class="glamping-item__content__bottom__address">
				            <a href="#map-container" title="На карте">
				                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C9.87827 2 7.84344 2.84285 6.34315 4.34315C4.84285 5.84344 4 7.87827 4 10C4 13.0981 6.01574 16.1042 8.22595 18.4373C9.31061 19.5822 10.3987 20.5195 11.2167 21.1708C11.5211 21.4133 11.787 21.6152 12 21.7726C12.213 21.6152 12.4789 21.4133 12.7833 21.1708C13.6013 20.5195 14.6894 19.5822 15.774 18.4373C17.9843 16.1042 20 13.0981 20 10C20 7.87827 19.1571 5.84344 17.6569 4.34315C16.1566 2.84285 14.1217 2 12 2ZM12 23C11.4453 23.8321 11.445 23.8319 11.4448 23.8317L11.4419 23.8298L11.4352 23.8253L11.4123 23.8098C11.3928 23.7966 11.3651 23.7776 11.3296 23.753C11.2585 23.7038 11.1565 23.6321 11.0278 23.5392C10.7705 23.3534 10.4064 23.0822 9.97082 22.7354C9.10133 22.043 7.93939 21.0428 6.77405 19.8127C4.48426 17.3958 2 13.9019 2 10C2 7.34784 3.05357 4.8043 4.92893 2.92893C6.8043 1.05357 9.34784 0 12 0C14.6522 0 17.1957 1.05357 19.0711 2.92893C20.9464 4.8043 22 7.34784 22 10C22 13.9019 19.5157 17.3958 17.226 19.8127C16.0606 21.0428 14.8987 22.043 14.0292 22.7354C13.5936 23.0822 13.2295 23.3534 12.9722 23.5392C12.8435 23.6321 12.7415 23.7038 12.6704 23.753C12.6349 23.7776 12.6072 23.7966 12.5877 23.8098L12.5648 23.8253L12.5581 23.8298L12.556 23.8312C12.5557 23.8314 12.5547 23.8321 12 23ZM12 23L12.5547 23.8321C12.2188 24.056 11.7807 24.0556 11.4448 23.8317L12 23Z" fill="black"></path>
				                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8ZM8 10C8 7.79086 9.79086 6 12 6C14.2091 6 16 7.79086 16 10C16 12.2091 14.2091 14 12 14C9.79086 14 8 12.2091 8 10Z" fill="black"></path>
				                </svg>
				                <?php echo get_additionally_meta('address'); ?>
				            </a>
				        </div>
					</div>
				</div>

				<div class="glamping-item__content__right">
					<div class="glamping-item__content__right__price">
						<span class="price-number">От <?php echo number_format(round($post_rec->glamping_price, 1), 0, ',', ' '); ?> р.</span>
						<span class="price-text">за 1 ночь</span>
					</div>
					<div class="glamping-item__content__right__btn">
						<a href="<?php echo esc_url( get_permalink($post_rec->ID) ); ?>" class="primary golden nxl ntext w100 btnvib">Подробнее</a>
					</div>
				</div>
			</div>
		</div>
        <?php
    }
    wp_reset_postdata();
}
