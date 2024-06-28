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
		foreach ($media_gallery as $key => $value) {
			$media .= '<div class="acc-media" data-src="' . wp_get_attachment_image_url( $key, 'full' ) . '">';
			$media .= '<img src="' . wp_get_attachment_image_url( $key, 'medium' ) . '" alt="">';
			$media .= '</div>';
		}
	?>
		<div class="acc-options__item acc-option">
			<div id="acc-gallery<?php echo $i; ?>" class="acc-option__media">
				<?php echo $media; ?>
			</div>
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
