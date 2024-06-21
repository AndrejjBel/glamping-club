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
        <div class="sidebar-nav__content__profile">
            <?php if ( function_exists( 'glamping_club_user_dname_sidebar' ) ) glamping_club_user_dname_sidebar(); ?>
            <!-- <a href="#" class="sidebar-avatar"><img src="images/avatar/01.jpg" alt="avatar"></a>
            <h4><a href="#" class="sidebar-name">Jackon Honson</a></h4>
            <a href="ad-post.html" class="btn btn-inline sidebar-post">
                <i class="fas fa-plus-circle"></i>
                <span>post your ad</span>
            </a> -->
        </div>
        <div class="sidebar-nav__content__menu">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'fallback_cb' => '__return_empty_string'
            ) );
            if ( function_exists( 'glamping_club_menu_admin' ) ) glamping_club_menu_admin();
            ?>
            <!-- <ul class="nav nav-tabs">
                <li><a href="#main-menu" class="nav-link active" data-toggle="tab">Main Menu</a></li>
                <li><a href="#author-menu" class="nav-link" data-toggle="tab">Author Menu</a></li>
            </ul>

            <div class="tab-pane active" id="main-menu">
                <ul class="navbar-list">
                    <li class="navbar-item"><a class="navbar-link" href="index.html">Home</a></li>
                    <li class="navbar-item navbar-dropdown">
                        <a class="navbar-link" href="#">
                            <span>Categories</span>
                            <i class="fas fa-plus"></i>
                        </a>
                        <ul class="dropdown-list">
                            <li><a class="dropdown-link" href="category-list.html">category list</a></li>
                            <li><a class="dropdown-link" href="category-details.html">category details</a></li>
                        </ul>
                    </li>
                    <li class="navbar-item navbar-dropdown">
                        <a class="navbar-link" href="#">
                            <span>Advertise List</span>
                            <i class="fas fa-plus"></i>
                        </a>
                        <ul class="dropdown-list">
                            <li><a class="dropdown-link" href="ad-list-column3.html">ad list column 3</a></li>
                            <li><a class="dropdown-link" href="ad-list-column2.html">ad list column 2</a></li>
                            <li><a class="dropdown-link" href="ad-list-column1.html">ad list column 1</a></li>
                        </ul>
                    </li>
                    <li class="navbar-item navbar-dropdown">
                        <a class="navbar-link" href="#">
                            <span>Advertise details</span>
                            <i class="fas fa-plus"></i>
                        </a>
                        <ul class="dropdown-list">
                            <li><a class="dropdown-link" href="ad-details-grid.html">ad details grid</a></li>
                            <li><a class="dropdown-link" href="ad-details-left.html">ad details left</a></li>
                            <li><a class="dropdown-link" href="ad-details-right.html">ad details right</a></li>
                        </ul>
                    </li>
                    <li class="navbar-item navbar-dropdown">
                        <a class="navbar-link" href="#">
                            <span>Pages</span>
                            <i class="fas fa-plus"></i>
                        </a>
                        <ul class="dropdown-list">
                            <li><a class="dropdown-link" href="about.html">About Us</a></li>
                            <li><a class="dropdown-link" href="compare.html">Ad Compare</a></li>
                            <li><a class="dropdown-link" href="cities.html">Ad by Cities</a></li>
                            <li><a class="dropdown-link" href="price.html">Pricing Plan</a></li>
                            <li><a class="dropdown-link" href="user-form.html">User Form</a></li>
                            <li><a class="dropdown-link" href="404.html">404</a></li>
                        </ul>
                    </li>
                    <li class="navbar-item navbar-dropdown">
                        <a class="navbar-link" href="#">
                            <span>blogs</span>
                            <i class="fas fa-plus"></i>
                        </a>
                        <ul class="dropdown-list">
                            <li><a class="dropdown-link" href="blog-list.html">Blog list</a></li>
                            <li><a class="dropdown-link" href="blog-details.html">blog details</a></li>
                        </ul>
                    </li>
                    <li class="navbar-item"><a class="navbar-link" href="contact.html">Contact</a></li>
                </ul>
            </div>

            <div class="tab-pane" id="author-menu">
                <ul class="navbar-list">
                    <li class="navbar-item"><a class="navbar-link" href="dashboard.html">Dashboard</a></li>
                    <li class="navbar-item"><a class="navbar-link" href="profile.html">Profile</a></li>
                    <li class="navbar-item"><a class="navbar-link" href="ad-post.html">Ad Post</a></li>
                    <li class="navbar-item"><a class="navbar-link" href="my-ads.html">My Ads</a></li>
                    <li class="navbar-item"><a class="navbar-link" href="setting.html">Settings</a></li>
                    <li class="navbar-item navbar-dropdown">
                        <a class="navbar-link" href="bookmark.html">
                            <span>bookmark</span>
                            <span>0</span>
                        </a>
                    </li>
                    <li class="navbar-item navbar-dropdown">
                        <a class="navbar-link" href="message.html">
                            <span>Message</span>
                            <span>0</span>
                        </a>
                    </li>
                    <li class="navbar-item navbar-dropdown">
                        <a class="navbar-link" href="notification.html">
                            <span>Notification</span>
                            <span>0</span>
                        </a>
                    </li>
                    <li class="navbar-item"><a class="navbar-link" href="user-form.html">Logout</a></li>
                </ul>
            </div> -->
        </div>

        <div class="sidebar-nav__content__footer">
            <?php if ( function_exists( 'glamping_club_footer_copiright' ) ) glamping_club_footer_copiright(); ?>
        </div>
    </div>
</div>
