<?php
define( 'PAGE_LOGIN', 'login' );
define( 'PAGE_REGISTRATION', 'registration' );
define( 'PAGE_FORGOT_PASSWORD', 'forgot-password' );
define( 'PAGE_DASHBOARD', 'dashboard' );
define( 'PAGE_LOGIN_N', 'Log in' );
define( 'PAGE_REGISTRATION_N', 'Create an account' );
define( 'PAGE_FORGOT_PASSWORD_N', 'Reset password' );
define( 'PAGE_DASHBOARD_N', 'Dashboard' );

// require get_template_directory() . '/functions/account/inc/functions-inc.php';
require get_template_directory() . '/functions/account/inc/functions-auth.php';
// require get_template_directory() . '/functions/account/inc/dashboard.php';

add_action('wp', 'add_script_where_account');
function add_script_where_account(){
	if( is_page([PAGE_LOGIN, PAGE_REGISTRATION, PAGE_FORGOT_PASSWORD, PAGE_DASHBOARD]) )
		add_action( 'wp_enqueue_scripts', 'glamping_club_account_style_scripts', 99 );
        add_action('wp_enqueue_scripts', 'glamping_club_auth_reg_script', 99);
}
function glamping_club_account_style_scripts() {
    wp_enqueue_style('account', get_stylesheet_directory_uri() . '/functions/account/css/account.css',	array(),
        filemtime( get_stylesheet_directory() . '/functions/account/css/account.css' )
    );

    wp_enqueue_script('account', get_stylesheet_directory_uri() . '/functions/account/js/account.js',	array(),
        filemtime( get_stylesheet_directory() . '/functions/account/js/account.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('dashboard', get_stylesheet_directory_uri() . '/functions/account/js/dashboard.js',	array(),
        filemtime( get_stylesheet_directory() . '/functions/account/js/dashboard.js' ), [ 'strategy' => 'defer' ]
    );
}

function glamping_club_auth_reg_script() {
    $pwsl_obj = [
        'empty' => __( 'Strength indicator', 'tripinglamp' ),
        'short' => __( 'Very weak', 'tripinglamp' ),
        'bad' => __( 'Weak', 'tripinglamp' ),
        'good' => __( 'Medium', 'tripinglamp' ),
        'strong' => __( 'Strong', 'tripinglamp' ),
        'mismatch' => __( 'Mismatch', 'tripinglamp' )
    ];
    wp_enqueue_script( 'password-strength-meter' );
    wp_add_inline_script( 'zxcvbn-async', 'var tripinglamp_pwsl = ' . wp_json_encode( $pwsl_obj ), 'before' );
}

add_action( 'init', function(){
	if ( ! current_user_can( 'manage_options' ) ) {
		show_admin_bar( false );
	}
} );

// Create Page
add_action( 'after_switch_theme', 'create_page_on_theme_activation' );
function create_page_on_theme_activation() {
    create_page_login();
    create_page_registration();
    create_page_forgot_password();
    create_page_dashboard();
}

function create_page_login(){
    $new_page_title     = PAGE_LOGIN_N;
    $post_name          = PAGE_LOGIN;
    $new_page_content   = '[glc-login-page]';
    $page_check = url_to_postid('/' . $post_name);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => $post_name
    );
    if(!$page_check){
        $new_page_id = wp_insert_post($new_page);
    }
}

function create_page_registration(){
    $new_page_title     = PAGE_REGISTRATION_N;
    $post_name          = PAGE_REGISTRATION;
    $new_page_content   = '[glc-reg-page]';
    $page_check = url_to_postid('/' . $post_name);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => $post_name
    );
    if(!$page_check){
        $new_page_id = wp_insert_post($new_page);
    }
}

function create_page_forgot_password(){
    $new_page_title     = PAGE_FORGOT_PASSWORD_N;
    $post_name          = PAGE_FORGOT_PASSWORD;
    $new_page_content   = '[glc-forgot-password-page]';
    $page_check = url_to_postid('/' . $post_name);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => $post_name
    );
    if(!$page_check){
        $new_page_id = wp_insert_post($new_page);
    }
}

function create_page_dashboard(){
    $new_page_title     = PAGE_DASHBOARD_N;
    $post_name          = PAGE_DASHBOARD;
    $new_page_content   = '[glc-dashboard-page]';
    $page_check = url_to_postid('/' . $post_name);
    $new_page = array(
            'post_type'     => 'page',
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => $post_name
    );
    if(!$page_check){
        $new_page_id = wp_insert_post($new_page);
    }
}

// Page tags
add_filter( 'display_post_states', 'glamping_club_special_page_mark', 10, 2 );
function glamping_club_special_page_mark( $post_states, $post ){
	if( $post->post_type === 'page' ){
		if( $post->post_name === PAGE_LOGIN ){
			$post_states[] = PAGE_LOGIN_N . ' page';
		}
		if( $post->post_name === PAGE_REGISTRATION ){
			$post_states[] = PAGE_REGISTRATION_N . ' page';
		}
		if( $post->post_name === PAGE_FORGOT_PASSWORD ){
			$post_states[] = PAGE_FORGOT_PASSWORD_N . ' page';
		}
		if( $post->post_name === PAGE_DASHBOARD ){
			$post_states[] = PAGE_DASHBOARD_N . ' page';
		}
	}
	return $post_states;
}
