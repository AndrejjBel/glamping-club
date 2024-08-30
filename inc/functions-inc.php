<?php
// Adds a main styles and scripts within in Admin.
add_action('admin_enqueue_scripts', 'glamping_club_admin_style');
function glamping_club_admin_style() {
    $bundle_admin_obj = [
        'glOptions' => options_set_js() //get_option( 'glc_alloptions_page' )
    ];
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/functions/admin/css/admin.css',	array(),
        filemtime( get_stylesheet_directory() . '/functions/admin/css/admin.css' )
    );
    wp_enqueue_script('admin-script', get_stylesheet_directory_uri() . '/functions/admin/js/admin.js',	array('jquery'),
        filemtime( get_stylesheet_directory() . '/functions/admin/js/admin.js' ), [ 'strategy' => 'defer' ]
    );
    wp_add_inline_script( 'admin-script', 'const glamping_club_admin = ' . wp_json_encode( $bundle_admin_obj ), 'before' );
}

// Function for `body_class`
add_filter( 'body_class', 'glamping_club_body_class_add' );
function glamping_club_body_class_add( $classes ) {
    $theme_option = get_option( 'glc_options' );
    $page_class = '';
    if ($theme_option) {
        $color = ( $theme_option['theme_color'] )? $theme_option['theme_color'] : 'theme-color-defolt';
    } else {
        $color = 'theme-color-defolt';
    }
    if( PAGE_POST_EDIT ){
        if( is_page( PAGE_POST_EDIT ) ){
            $page_class = PAGE_POST_EDIT;
        }
    }
    foreach ( $classes as $index => $class ) {
        $classes[] = $color;
        $classes[] = $page_class;
    }
    return $classes;
}

// Adds a main styles and scripts.
add_action( 'wp_enqueue_scripts', 'glamping_club_main_scripts_old', 99 );
function glamping_club_main_scripts_old() {
    global $user_ID;
    // $glempings = get_option('glampings_obj');
    $glempings_f = glamping_club_result_render();
    $glempings_map = glampings_map_render();
    $glempings = get_option('glampings_obj');
    // if( is_front_page() ){
    //     $glempings = tripinglamp_home_location_list_json();
    // }
    if( is_post_type_archive( 'glampings' ) ){
        $glempings = get_option('glampings_obj');
    }
    if( is_tax( 'location' ) ){
        $category = get_queried_object();
        $current_cat_id = $category->term_id;
        $glempings_loc = glamping_club_result_render($category->term_id);
        $glempings = get_option('glampings_obj_'.$category->term_id);
        $glempings_map = glampings_map_render($category->term_id);
    }
    $yand_zoom = get_glc_option('glc_options', 'yand_zoom');
    $bundle_obj = [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce('glamping_club'),
        'action' => 'glamping_club',
        'user_id' => $user_ID,
        'marker' => bin2hex('current_user-' . $user_ID),
        'yand_zoom' => $yand_zoom,
        'glAll' => $glempings,
        'glAllMap' => $glempings_map
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
    wp_enqueue_style('swiper', get_stylesheet_directory_uri() . '/assets/swiper/swiper-bundle-11.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/swiper/swiper-bundle-11.min.css' )
    );

    wp_enqueue_style('hystmodal', get_stylesheet_directory_uri() . '/assets/hystModal/hystmodal.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/hystModal/hystmodal.min.css' )
    );
    wp_enqueue_style('toast', get_stylesheet_directory_uri() . '/assets/toast/toast.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/toast/toast.min.css' )
    );
    wp_enqueue_style('nouislider', get_stylesheet_directory_uri() . '/assets/noUiSlider/nouislider.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/noUiSlider/nouislider.min.css' )
    );
    wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/assets/slick/slick.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/slick/slick.css' )
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

    wp_enqueue_script('swiper', get_stylesheet_directory_uri() . '/assets/swiper/swiper-bundle-11.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/swiper/swiper-bundle-11.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('hystmodal', get_stylesheet_directory_uri() . '/assets/hystModal/hystmodal-custom.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/hystModal/hystmodal-custom.min.js' ), [ 'strategy' => 'defer' ]
    );
	wp_enqueue_script('toast', get_stylesheet_directory_uri() . '/assets/toast/toast.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/toast/toast.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('noUiSlider', get_stylesheet_directory_uri() . '/assets/noUiSlider/nouislider.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/noUiSlider/nouislider.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/assets/slick/slick.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/slick/slick.min.js' ), [ 'strategy' => 'defer' ]
    );
    // wp_enqueue_script('accordion', get_stylesheet_directory_uri() . '/assets/accordion/js/accordion.js',	array(),
    //     filemtime( get_stylesheet_directory() . '/assets/accordion/js/accordion.js' ), [ 'strategy' => 'defer' ]
    // );

    wp_enqueue_script('swiped-events', get_stylesheet_directory_uri() . '/assets/swiped-events.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/swiped-events.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('bundle', get_stylesheet_directory_uri() . '/dist/bundle.min.js',	array('jquery', 'hystmodal', 'toast', 'lightgallery', 'swiper'),
        filemtime( get_stylesheet_directory() . '/dist/bundle.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js',	array('jquery', 'swiper'),
        filemtime( get_stylesheet_directory() . '/js/custom.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('test', get_stylesheet_directory_uri() . '/js/test.js',	array('jquery', 'swiper'),
        filemtime( get_stylesheet_directory() . '/js/test.js' ), [ 'strategy' => 'defer' ]
    );

    wp_add_inline_script( 'bundle', 'const glamping_club_ajax = ' . wp_json_encode( $bundle_obj ), 'before' );
}

// add_action('wp', 'add_my_script_where_it_glamping_single');
function add_my_script_where_it_glamping_single(){
	if( is_singular('glampings') )
		add_action( 'wp_enqueue_scripts', 'scripts_glamping_single' );
}
function scripts_glamping_single() {
    wp_enqueue_style('filepond', get_stylesheet_directory_uri() . '/assets/filepond/filepond.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/assets/filepond/filepond.min.css' )
    );
    wp_enqueue_script('filepond-esm', get_stylesheet_directory_uri() . '/assets/filepond/filepond.esm.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/filepond/filepond.esm.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('filepond', get_stylesheet_directory_uri() . '/assets/filepond/filepond.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/filepond/filepond.min.js' ), [ 'strategy' => 'defer' ]
    );
}

require get_template_directory() . '/functions/post-types.php';
require get_template_directory() . '/functions/cmb2/init.php';
require get_template_directory() . '/functions/cmb-settings.php';
require get_template_directory() . '/functions/cmb-post-meta.php';
require get_template_directory() . '/functions/cmb-post-meta-reviews.php';
require get_template_directory() . '/functions/cmb-glempedit.php';
require get_template_directory() . '/functions/glamping-add-edit.php';
require get_template_directory() . '/functions/glampings-options.php';
require get_template_directory() . '/functions/template-functions.php';
require get_template_directory() . '/functions/postviews.php';
require get_template_directory() . '/functions/gl-json.php';

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

// add_action( 'before_delete_post', 'delete_postmeta_before_delete_post' );
function delete_postmeta_before_delete_post( $postid ){
	// Проверяем наш ли это тип записи удаляется
	$post = get_post( $postid );
	// если нет, выходим.
	if( ! $post || $post->post_type !== 'glampings' )
		return;
    global $wpdb;
    $wpdb->delete( $wpdb->postmeta, [ 'post_id'=>$postid ] );
    clean_post_cache( $post_id );
}

//Отправка в Телеграм
define('TELEGRAM_TOKEN', '7361610914:AAFGZrr2JaYQEhBZxR6A2L3R1QEC_w7TnDE');
// сюда нужно вписать ваш внутренний айдишник
define('TELEGRAM_CHATID', '477875115');
//message_to_telegram($msgotpravtel);

function message_to_telegram($text, $chatid) {
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => $chatid, // TELEGRAM_CHATID
                'text' => $text,
            ),
        )
    );
    curl_exec($ch);
}
