<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Glamping_club
*/

if (is_page([PAGE_LOGIN, PAGE_REGISTRATION, PAGE_FORGOT_PASSWORD])) {
	get_template_part( 'template-parts/head-footer/footer-login' );
} elseif (is_page([PAGE_DASHBOARD])) {
	get_template_part( 'template-parts/head-footer/footer-dashboard' );
} else {
	get_template_part( 'template-parts/head-footer/footer' );
	get_template_part( 'template-parts/head-footer/aside-header' );
	get_template_part( 'template-parts/head-footer/nav-mobile' );
}
?>

</div><!-- #page -->

<div class="overlay js-overlay-modal"></div>

<?php wp_footer(); ?>

</body>
</html>
