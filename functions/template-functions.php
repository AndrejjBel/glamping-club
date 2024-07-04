<?php
function glamping_club_user_dname($name=true) {
	if( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
        $url = '/dashboard/';
        $class = '';
        $user_name = '';
        $title = 'В личный кабинет ' . $current_user->display_name . '';
        if (is_page([PAGE_DASHBOARD])) {
            $url = '#';
            $class = ' dashboard';
            $title = 'Личный кабинет ' . $current_user->display_name . '';
        }
        if ($name) {
            $user_name = '<span>' . wp_html_excerpt( $current_user->display_name, 10, '...' ) . '</span>';
        }
		echo '<a href="' . $url . '" class="header-generale__left__user' . $class . '" title="' . $title . '">
				<span class="avatar">' . user_initials($current_user->display_name) . '</span>
				' . $user_name . '
			</a>';
	} else {
		echo '<a href="/login/" class="header-generale__left__user" title="Авторизоваться">
				<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path class="fa-primary" d="M256 272c39.77 0 72-32.24 72-72S295.8 128 256 128C216.2 128 184 160.2 184 200S216.2 272 256 272zM288 320H224c-47.54 0-87.54 29.88-103.7 71.71C155.1 426.5 203.1 448 256 448s100.9-21.53 135.7-56.29C375.5 349.9 335.5 320 288 320z"/>
					<path class="fa-secondary" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c39.77 0 72 32.24 72 72S295.8 272 256 272c-39.76 0-72-32.24-72-72S216.2 128 256 128zM256 448c-52.93 0-100.9-21.53-135.7-56.29C136.5 349.9 176.5 320 224 320h64c47.54 0 87.54 29.88 103.7 71.71C356.9 426.5 308.9 448 256 448z"/>
				</svg>
				<span>Войти</span>
			</a>';
	}
}

function glamping_club_user_dname_sidebar($name=true) {
    if( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
        $url = '/dashboard/';
        $class = '';
        $user_name = '';
        $title = 'В личный кабинет ' . $current_user->display_name . '';
        if (is_page([PAGE_DASHBOARD])) {
            $url = '#';
            $class = ' dashboard';
            $title = 'Личный кабинет ' . $current_user->display_name . '';
        }
        if ($name) {
            $user_name = '<span>' . wp_html_excerpt( $current_user->display_name, 10, '...' ) . '</span>';
        }
		echo '<a href="' . $url . '" class="header-generale__left__user user-aside' . $class . '" title="' . $title . '">
				<span class="avatar">' . user_initials($current_user->display_name) . '</span>
				' . $user_name . '
			</a>
            <a href="#" class="header-generale__right__add-btn add-btn-aside">
                <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/>
                </svg>
                <span>Добавить</span>
            </a>';
	} else {
		echo '<a href="/login/" class="header-generale__left__user user-aside" title="Авторизоваться">
				<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path class="fa-primary" d="M256 272c39.77 0 72-32.24 72-72S295.8 128 256 128C216.2 128 184 160.2 184 200S216.2 272 256 272zM288 320H224c-47.54 0-87.54 29.88-103.7 71.71C155.1 426.5 203.1 448 256 448s100.9-21.53 135.7-56.29C375.5 349.9 335.5 320 288 320z"/>
					<path class="fa-secondary" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c39.77 0 72 32.24 72 72S295.8 272 256 272c-39.76 0-72-32.24-72-72S216.2 128 256 128zM256 448c-52.93 0-100.9-21.53-135.7-56.29C136.5 349.9 176.5 320 224 320h64c47.54 0 87.54 29.88 103.7 71.71C356.9 426.5 308.9 448 256 448z"/>
				</svg>
				<span>Войти</span>
			</a>';
	}
}

function glamping_club_newsletter() {
	$subscr_title = get_option( '_subscr_title' );
	$subscr_subtitle = get_option( '_subscr_subtitle' );
	if ( $subscr_title ) {
		echo '<h2>' . $subscr_title . '</h2>';
	} else {
		echo '<h2>Подпишитесь на последние предложения</h2>';
	}
	if ( $subscr_subtitle ) {
		echo '<p>' . $subscr_subtitle . '</p>';
	} else {
		echo '<p>Подпишитесь на нашу рассылку и получайте новые сообщения на свой почтовый ящик</p>';
	}
}

function glamping_club_footer_copiright() {
	$site_options = get_option( 'glc_options' );
	$bloginfo_name = get_bloginfo('name');
	if ($site_options) {
		if ( array_key_exists('copiright_text', $site_options) ) {
			echo '<p>' . $site_options['copiright_text'] . '</p>';
		} else {
			echo '<p>Все права защищены © 2024 - ' . $bloginfo_name . '</p>';
		}
	}
}

function glamping_club_footer_emails() {
	$site_options = get_option( 'glc_options' );
	if ($site_options) {
		if ( array_key_exists('contact_emails', $site_options) ) {
			foreach ($site_options['contact_emails'] as $value) {
				echo '<span><a href="mailto:' . $value . '">' . $value . '</a></span>';
			}
		} else {
			echo '<span><a href="mailto:info@site.com">info@site.com</a></span>
				<span><a href="mailto:info1@site.com">info1@site.com</a></span>';
		}
	}
}

function glamping_club_footer_phones() {
	$site_options = get_option( 'glc_options' );
	if ($site_options) {
		if ( array_key_exists('contact_phone', $site_options) ) {
			foreach ($site_options['contact_phone'] as $value) {
				echo '<span><a href="tel:' . $value . '">' . $value . '</a></span>';
			}
		} else {
			echo '<span><a href="tel:+8801838288389">+8801838288389</a></span>
				<span><a href="tel:+8801941101915">+8801941101915</a></span>';
		}
	}
}

function glamping_club_menu_admin() {
	global $current_user;
	if ( in_array('administrator', $current_user->roles) ) {
		echo '<ul>
		    <li><a href="/wp-admin" class="sidebar-nav__content__menu__admin" title="В админку">В админку</a></li>
		    <li><a href="' . wp_logout_url() . '" title="Выход">Выход</a></li>
		</ul>';
	}
}
