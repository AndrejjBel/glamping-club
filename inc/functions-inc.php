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
    $theme_color = get_option( 'glc_options' );
    $color = ( $theme_color['theme_color'] )? $theme_color['theme_color'] : 'theme-color-defolt';
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
    // $yand_zoom = get_option( '_yandex_zoom' );
    $bundle_obj = [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce('tripinglamp-nonce'),
        'action' => 'tripinglamp_form',
        'marker' => bin2hex('tripinglamp_current_user-' . $user_ID),
        // 'yand_zoom' => $yand_zoom,
        // 'glAll' => $glempings
    ];
    // css
    $theme_color = get_option( 'glc_options' );
    $color = ( $theme_color['theme_color'] )? $theme_color['theme_color'] : 'theme-color-defolt';
    wp_enqueue_style('theme-color', get_stylesheet_directory_uri() . '/css/color/' . $color . '.css', array(),
        filemtime( get_stylesheet_directory() . '/css/color/' . $color . '.css' )
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

    // js
    wp_enqueue_script('hystmodal', get_stylesheet_directory_uri() . '/assets/hystModal/hystmodal-custom.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/hystModal/hystmodal-custom.min.js' ), [ 'strategy' => 'defer' ]
    );
	wp_enqueue_script('toast', get_stylesheet_directory_uri() . '/assets/toast/toast.min.js',	array(),
        filemtime( get_stylesheet_directory() . '/assets/toast/toast.min.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('bundle', get_stylesheet_directory_uri() . '/dist/bundle.min.js',	array('jquery', 'hystmodal', 'toast'),
        filemtime( get_stylesheet_directory() . '/dist/bundle.min.js' ), [ 'strategy' => 'defer' ]
    );

    wp_add_inline_script( 'bundle', 'const glamping_club_ajax = ' . wp_json_encode( $bundle_obj ), 'before' );
}

require get_template_directory() . '/functions/post-types.php';
require get_template_directory() . '/functions/cmb2/init.php';
require get_template_directory() . '/functions/cmb-settings.php';
require get_template_directory() . '/functions/cmb-post-meta.php';
require get_template_directory() . '/functions/glampings-options.php';
require get_template_directory() . '/functions/template-functions.php';

require get_template_directory() . '/functions/account/functions-acc.php';
require get_template_directory() . '/functions/account/inc/shortcodes.php';

require get_template_directory() . '/functions/admin/inc/functions-admin.php';

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	return array_diff( $sizes, [
        'medium',
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
	] );
}

// add_image_size( 'glamping-club-thumb', 800, 520 );
