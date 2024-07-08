<?php
// Adds a main styles and scripts within in Admin.
add_action('admin_enqueue_scripts', 'glamping_club_admin_style');
function glamping_club_admin_style() {
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/functions/admin/css/admin.css',	array(),
        filemtime( get_stylesheet_directory() . '/functions/admin/css/admin.css' )
    );
    wp_enqueue_script('admin-script', get_stylesheet_directory_uri() . '/functions/admin/js/admin.js',	array('jquery'),
        filemtime( get_stylesheet_directory() . '/functions/admin/js/admin.js' ), [ 'strategy' => 'defer' ]
    );
}

// Function for `body_class`
add_filter( 'body_class', 'glamping_club_body_class_add' );
function glamping_club_body_class_add( $classes ) {
    $theme_option = get_option( 'glc_options' );
    if ($theme_option) {
        $color = ( $theme_option['theme_color'] )? $theme_option['theme_color'] : 'theme-color-defolt';
    } else {
        $color = 'theme-color-defolt';
    }
    foreach ( $classes as $index => $class ) {
        $classes[] = $color;
    }
    return $classes;
}

// Adds a main styles and scripts.
add_action( 'wp_enqueue_scripts', 'glamping_club_main_scripts_old', 99 );
function glamping_club_main_scripts_old() {
    global $user_ID;
    // $glempings = '';
    // if( is_front_page() ){
    //     $glempings = tripinglamp_home_location_list_json();
    // }
    // if( is_post_type_archive( 'glampings' ) ){
    //     $glempings = get_option('glampings_obj');
    // }
    // if( is_tax( 'location' ) ){
    //     $category = get_queried_object();
    //     $current_cat_id = $category->term_id;
    //     $glempings = get_option('glampings_obj_'.$category->term_id);
    // }
    // $yand_zoom = carbon_get_theme_option( 'yandex_zoom' );
    $yand_zoom = get_glc_option('glc_options', 'yand_zoom');
    $bundle_obj = [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce('glamping_club'),
        'action' => 'glamping_club',
        'user_id' => $user_ID,
        'marker' => bin2hex('current_user-' . $user_ID),
        'yand_zoom' => $yand_zoom,
        // 'glAll' => $glempings
    ];
    // css
    $theme_option = get_option( 'glc_options' );
    if ($theme_option) {
        $color = ( $theme_option['theme_color'] )? $theme_option['theme_color'] : 'theme-color-defolt';
    } else {
        $color = 'theme-color-defolt';
    }
    $yandex_map_key = ($theme_option['yandex_map_key'])? $theme_option['yandex_map_key'] : 1;
    wp_enqueue_style('theme-color', get_stylesheet_directory_uri() . '/css/color/' . $color . '.css', array(),
        filemtime( get_stylesheet_directory() . '/css/color/' . $color . '.css' )
    );
    wp_enqueue_style('theme-all-color', get_stylesheet_directory_uri() . '/css/color/all.css', array(),
        filemtime( get_stylesheet_directory() . '/css/color/all.css' )
    );

    wp_enqueue_style('lightgallery', get_stylesheet_directory_uri() . '/assets/lightGallery/css/lightgallery.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/lightGallery/css/lightgallery.css' )
    );
    wp_enqueue_style('lg-thumbnail', get_stylesheet_directory_uri() . '/assets/lightGallery/css/lg-thumbnail.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/lightGallery/css/lg-thumbnail.css' )
    );

    wp_enqueue_style('swiper', get_stylesheet_directory_uri() . '/assets/swiper/swiper-bundle.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/lightGallery/css/lg-thumbnail.css' )
    );
    wp_enqueue_style('hystmodal', get_stylesheet_directory_uri() . '/assets/hystModal/hystmodal.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/hystModal/hystmodal.min.css' )
    );
    wp_enqueue_style('toast', get_stylesheet_directory_uri() . '/assets/toast/toast.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/toast/toast.min.css' )
    );
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/dist/main.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/dist/main.min.css' )
    );
    wp_enqueue_style('custom', get_stylesheet_directory_uri() . '/css/custom.css', array(),
        filemtime( get_stylesheet_directory() . '/css/custom.css' )
    );

    // js
    wp_enqueue_script('lightgallery', get_stylesheet_directory_uri() . '/assets/lightGallery/lightgallery.umd.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/lightGallery/lightgallery.umd.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('lg-thumbnail', get_stylesheet_directory_uri() . '/assets/lightGallery/plugins/thumbnail/lg-thumbnail.umd.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/lightGallery/plugins/thumbnail/lg-thumbnail.umd.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('cookie', get_stylesheet_directory_uri() . '/assets/cookie/cookie.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/cookie/cookie.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_register_script( 'yandex-map', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=' . $yandex_map_key);
	wp_enqueue_script( 'yandex-map' );

    wp_enqueue_script('swiper', get_stylesheet_directory_uri() . '/assets/swiper/swiper-bundle.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/swiper/swiper-bundle.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('hystmodal', get_stylesheet_directory_uri() . '/assets/hystModal/hystmodal-custom.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/hystModal/hystmodal-custom.min.js' ), [ 'strategy' => 'defer' ]
    );
	wp_enqueue_script('toast', get_stylesheet_directory_uri() . '/assets/toast/toast.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/toast/toast.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('bundle', get_stylesheet_directory_uri() . '/dist/bundle.min.js',	array('jquery', 'hystmodal', 'toast', 'lightgallery', 'swiper'),
        filemtime( get_stylesheet_directory() . '/dist/bundle.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js',	array('jquery', 'swiper'),
        filemtime( get_stylesheet_directory() . '/js/custom.js' ), [ 'strategy' => 'defer' ]
    );

    wp_add_inline_script( 'bundle', 'const glamping_club_ajax = ' . wp_json_encode( $bundle_obj ), 'before' );
}

require get_template_directory() . '/functions/post-types.php';
require get_template_directory() . '/functions/cmb2/init.php';
require get_template_directory() . '/functions/cmb-settings.php';
require get_template_directory() . '/functions/cmb-post-meta.php';
require get_template_directory() . '/functions/glampings-options.php';
require get_template_directory() . '/functions/template-functions.php';
require get_template_directory() . '/functions/postviews.php';

require get_template_directory() . '/functions/account/functions-acc.php';
require get_template_directory() . '/functions/account/inc/shortcodes.php';

require get_template_directory() . '/functions/admin/inc/functions-admin.php';

require get_template_directory() . '/inc/breadcrumbs.php';

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	return array_diff( $sizes, [
        // 'medium',
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}

add_image_size( 'glamping-club-thumb', 800, 520 );

function glamping_club_page_class() {
    $class = '';
    if (is_page([PAGE_DASHBOARD])) {
        $class = ' dashboard';
    } elseif (is_page(['favorites'])) {
        $class = ' favorites';
    }
    return $class;
}

add_filter( 'post_class', 'glamping_club_add_class_post', 10, 3 );
function glamping_club_add_class_post( $classes, $class, $post_id ){
	if( is_page(['favorites']) ){
		$classes[] = 'favorites-article';
	}
	return $classes;
}

function get_glc_option($group, $option) {
    $site_options = get_option( $group );
    $value = '';
    if ($site_options) {
        if (array_key_exists($option, $site_options)) {
            $value = $site_options[$option];
        } else {
            $value = false;
        }
    } else {
        $value = false;
    }
    return $value;
}

function num_word($value, $words, $show = true) {
	$num = $value % 100;
	if ($num > 19) {
		$num = $num % 10;
	}
	$out = ($show) ?  $value . ' ' : '';
	switch ($num) {
		case 1:  $out .= $words[0]; break;
		case 2:
		case 3:
		case 4:  $out .= $words[1]; break;
		default: $out .= $words[2]; break;
	}
	return $out;
}
