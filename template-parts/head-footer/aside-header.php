<div class="sidebar-nav">
    <div class="sidebar-nav__header">
        <?php if ( is_front_page() ) : ?>
            <span class="sidebar-nav__header__logo">
                <?php if ( function_exists( 'glamping_club_logo' ) ) glamping_club_logo(); ?>Glamping club
            </span>
        <?php else : ?>
            <a href="/" class="sidebar-nav__header__logo">
                Glamping club
                <!-- <img src="<?php //echo get_template_directory_uri(); ?>/img/logo-def.png" alt=""> -->
            </a>
        <?php endif; ?>
        <button id="js-close" class="sidebar-nav__header__btn">
            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/>
            </svg>
        </button>
    </div>
    <div class="sidebar-nav__content">
        <div class="sidebar-nav__content__menu">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'fallback_cb' => '__return_empty_string'
            ) );
            if ( function_exists( 'glamping_club_menu_admin' ) ) glamping_club_menu_admin();
            ?>
        </div>
        
        <div class="sidebar-nav__content__profile">
            <?php if ( function_exists( 'glamping_club_user_dname_sidebar' ) ) glamping_club_user_dname_sidebar(); ?>
        </div>

        <div class="sidebar-nav__content__footer">
            <?php if ( function_exists( 'glamping_club_footer_copiright' ) ) glamping_club_footer_copiright(); ?>
        </div>
    </div>
</div>
