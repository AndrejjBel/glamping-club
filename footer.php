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
	// get_template_part( 'template-parts/dashboard/footer-dashboard' );
	// get_template_part( 'template-parts/head-footer/nav-mobile' );
} elseif (is_post_type_archive('glampings')) {
	get_template_part( 'template-parts/head-footer/footer' );
	get_template_part( 'template-parts/head-footer/aside-header' );
	get_template_part( 'template-parts/head-footer/nav-mobile' );
} else {
	get_template_part( 'template-parts/head-footer/footer' );
	get_template_part( 'template-parts/head-footer/aside-header' );
	get_template_part( 'template-parts/head-footer/nav-mobile' );
}
?>

</div><!-- #page -->

<div class="cookie-bar">
    <span class="cookie-bar__message">
        <p>Этот веб-сайт использует файлы cookies, чтобы обеспечить удобную работу пользователей с ними и функциональные возможности сайта.</p>
        <p>Продолжив использование сайта, Вы соглашаетесь с условиями использования файлов cookies в соответствии с <a href="/privacy-policy/">"Политикой обработки и обеспечения безопасности персональных данных"</a></p>
    </span>
    <button id="cookie-yes" class="cookie-bar__btn" type="button" name="button">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289Z" fill="#FFFFFF"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#FFFFFF"></path>
        </svg>
    </button>
</div>

<div class="overlay js-overlay-modal"></div>

<?php wp_footer(); ?>

</body>
</html>
