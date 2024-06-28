<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Glamping_club
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site<?php echo glamping_club_page_class(); ?>">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'glamping-club' ); ?></a>

<?php
if (is_page([PAGE_LOGIN, PAGE_REGISTRATION, PAGE_FORGOT_PASSWORD])) {
	get_template_part( 'template-parts/head-footer/header-login' );
} elseif (!is_page([PAGE_DASHBOARD])) {
	get_template_part( 'template-parts/head-footer/header' );
	get_template_part( 'template-parts/head-footer/filtr-items' );
}
// get_template_part( 'template-parts/head-footer/filtr-items' );
// if (is_post_type_archive('glampings')) {
// 	get_template_part( 'template-parts/head-footer/filtr-items' );
// }
?>
