<?php
add_shortcode( 'glc-login-page', 'glamping_club_shortcode_page_login' );
function glamping_club_shortcode_page_login() {
    ob_start();
    get_template_part( 'functions/account/templates/login' );
	return ob_get_clean();
}

add_shortcode( 'glc-reg-page', 'glamping_club_shortcode_page_reg' );
function glamping_club_shortcode_page_reg() {
    ob_start();
    get_template_part( 'functions/account/templates/registration' );
	return ob_get_clean();
}

add_shortcode( 'glc-forgot-password-page', 'glamping_club_shortcode_page_forgot_password' );
function glamping_club_shortcode_page_forgot_password() {
    ob_start();
    get_template_part( 'functions/account/templates/forgot-password' );
	return ob_get_clean();
}

add_shortcode( 'glc-dashboard-page', 'glamping_club_shortcode_page_dashboard' );
function glamping_club_shortcode_page_dashboard() {
    ob_start();
    get_template_part( 'functions/account/templates/dashboard' );
	return ob_get_clean();
}
