<?php
$style = '';
$style_search = '';
$container = 'container';
if (is_post_type_archive('glampings') || is_tax('location')) {
    $style = ' header-archive-glampings';
    $style_search = ' top-search-archive-glampings';
    $container = 'container-ag';
}
?>
<header id="masthead" class="gen-header<?php echo $style;?>">
    <div class="gen-header__top">
        <div class="gen-header__top__logo">
            <?php if ( is_front_page() ) : ?>
                <img class="full" src="<?php echo get_option('glc_options')['glamping_logo']; ?>" alt="">
                <img class="smail" src="<?php echo get_option('glc_options')['glamping_logo_smail']; ?>" alt="">
            <?php else : ?>
                <a href="/">
                    <img class="full" src="<?php echo get_option('glc_options')['glamping_logo']; ?>" alt="">
                    <img class="smail" src="<?php echo get_option('glc_options')['glamping_logo_smail']; ?>" alt="">
                </a>
            <?php endif; ?>
        </div>

        <form role="search" method="get" class="gen-header__top__search<?php echo $style_search;?>" action="<?php echo home_url( '/' ); ?>">
            <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Поиск', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Поиск', 'label' ) ?>" />
            <button type="submit" name="button" class="gen-header__top__search__search-btn">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M504.1 471l-134-134C399.1 301.5 415.1 256.8 415.1 208c0-114.9-93.13-208-208-208S-.0002 93.13-.0002 208S93.12 416 207.1 416c48.79 0 93.55-16.91 129-45.04l134 134C475.7 509.7 481.9 512 488 512s12.28-2.344 16.97-7.031C514.3 495.6 514.3 480.4 504.1 471zM48 208c0-88.22 71.78-160 160-160s160 71.78 160 160s-71.78 160-160 160S48 296.2 48 208z"/>
                </svg>
            </button>
            <button id="search-btn-close" class="gen-header__top__search__search-btn-close">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 1L1 17M17 17L1 1" stroke="#5E6D77" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
            <input type="hidden" value="glampings" name="post_type" />
        </form>

        <div class="gen-header__top__btns">
            <a href="/favorites/" class="" title="Избранное">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
                </svg>
                <sup id="sup-favorites">0</sup>
            </a>
            <a href="/compare/" title="Сравнение">
                <svg width="20" height="20" class="rotate90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
                </svg>
                <sup id="sup-comparison">0</sup>
            </a>
        </div>

        <div class="gen-header__top__contact-btn">
            <button class="primary golden nxl ntext w-160" data-hystmodal="#contact">Связаться</button>
        </div>

        <div class="gen-header__top__mobile-btn">
            <button id="header-mobile-search" class="search" type="button" name="button">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M504.1 471l-134-134C399.1 301.5 415.1 256.8 415.1 208c0-114.9-93.13-208-208-208S-.0002 93.13-.0002 208S93.12 416 207.1 416c48.79 0 93.55-16.91 129-45.04l134 134C475.7 509.7 481.9 512 488 512s12.28-2.344 16.97-7.031C514.3 495.6 514.3 480.4 504.1 471zM48 208c0-88.22 71.78-160 160-160s160 71.78 160 160s-71.78 160-160 160S48 296.2 48 208z"/>
                </svg>
            </button>
            <button id="header-mobile-toggle" class="toggle" type="button" name="button">
                <svg width="22" height="10" viewBox="0 0 22 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="22" height="2" rx="1" fill="#467A3C"/>
                    <rect x="5" y="4" width="17" height="2" rx="1" fill="#467A3C"/>
                    <rect y="8" width="22" height="2" rx="1" fill="#467A3C"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="gen-header__bottom">
        <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'container' => false,
                'menu_class' => 'gen-header__bottom__nav',
                'fallback_cb' => '__return_empty_string'
            ) );
            // if ( function_exists( 'glamping_club_menu_admin' ) ) glamping_club_menu_admin();
        ?>
    </div>
</header>


<?php
    if ( !is_front_page() && function_exists( 'breadcrumbs' )  ) {
?>
<div class="<?php echo $container;?> breadcrumbs-wrap">
<?php
        breadcrumbs();
    //}
    if ( !is_search() && is_post_type_archive('glampings') || is_tax('location') ) {
?>
<button id="all-filter-clear" class="btn-filter-clear decstop primary-light fs10 lsm icon" type="button" name="button" title="Очистить все фильтры">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path d="M3.9 22.9C10.5 8.9 24.5 0 40 0L472 0c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L396.4 195.6C316.2 212.1 256 283 256 368c0 27.4 6.3 53.4 17.5 76.5c-1.6-.8-3.2-1.8-4.7-2.9l-64-48c-8.1-6-12.8-15.5-12.8-25.6l0-79.1L9 65.3C-.7 53.4-2.8 36.8 3.9 22.9zM432 224a144 144 0 1 1 0 288 144 144 0 1 1 0-288zm59.3 107.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L432 345.4l-36.7-36.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L409.4 368l-36.7 36.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L432 390.6l36.7 36.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L454.6 368l36.7-36.7z"/>
    </svg>
    <span>Сбросить фильтры</span>
</button>

<?php } ?>
</div>
<?php
}
