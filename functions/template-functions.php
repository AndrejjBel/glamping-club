<?php
function glamping_club_user_dname() {
	if( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		echo '<a href="#" class="header-generale__left__user" title="В личный кабинет ' . $current_user->display_name . '">
				<span class="avatar">' . user_initials($current_user->display_name) . '</span>
				<span>' . wp_html_excerpt( $current_user->display_name, 10, '...' ) . '</span>
			</a>';
	} else {
		echo '<a href="/login" class="header-generale__left__user" title="Авторизоваться">
				<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path class="fa-primary" d="M256 272c39.77 0 72-32.24 72-72S295.8 128 256 128C216.2 128 184 160.2 184 200S216.2 272 256 272zM288 320H224c-47.54 0-87.54 29.88-103.7 71.71C155.1 426.5 203.1 448 256 448s100.9-21.53 135.7-56.29C375.5 349.9 335.5 320 288 320z"/>
					<path class="fa-secondary" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c39.77 0 72 32.24 72 72S295.8 272 256 272c-39.76 0-72-32.24-72-72S216.2 128 256 128zM256 448c-52.93 0-100.9-21.53-135.7-56.29C136.5 349.9 176.5 320 224 320h64c47.54 0 87.54 29.88 103.7 71.71C356.9 426.5 308.9 448 256 448z"/>
				</svg>
				<span>Войти</span>
			</a>';
	}
}

function glamping_club_user_dname_sidebar() {
	$no_foto = '<svg width="120" height="120" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle cx="40" cy="40" r="39.5" fill="#C4CDD4" stroke="#C4CDD4"/>
				<path d="M49.8566 48.2852L49.8566 48.2853L49.8612 48.2868L55.4612 50.1768L55.4621 50.1771C58.0547 51.0413 59.2541 53.7495 59.7849 56.3597C60.048 57.654 60.1411 58.8987 60.1638 59.8292C60.1752 60.2941 60.1689 60.6791 60.1578 60.9509C60.1522 61.0869 60.1455 61.1935 60.1393 61.2668C60.1366 61.2983 60.1341 61.3222 60.1321 61.3389L60.1283 61.3464L60.123 61.3889C60.0317 62.1194 60.5892 62.6354 61.2501 62.718L61.2655 62.7199H61.2811H61.3511C61.985 62.7199 62.4939 62.1881 62.5786 61.5953L62.5811 61.5777V61.5599C62.5811 61.5439 62.5821 61.5108 62.5837 61.4618C62.6012 60.9047 62.6829 58.2985 62.0321 55.4922C61.3262 52.4478 59.7375 49.0806 56.1809 47.883L56.1802 47.8827L46.6911 44.7197V41.3999V41.3995V41.3991V41.3987V41.3983V41.3979V41.3975V41.3971V41.3966V41.3962V41.3958V41.3954V41.395V41.3946V41.3942V41.3938V41.3934V41.393V41.3925V41.3921V41.3917V41.3913V41.3909V41.3905V41.3901V41.3897V41.3893V41.3889V41.3885V41.388V41.3876V41.3872V41.3868V41.3864V41.386V41.3856V41.3852V41.3848V41.3844V41.384V41.3836V41.3831V41.3827V41.3823V41.3819V41.3815V41.3811V41.3807V41.3803V41.3799V41.3795V41.3791V41.3787V41.3783V41.3779V41.3775V41.377V41.3766V41.3762V41.3758V41.3754V41.375V41.3746V41.3742V41.3738V41.3734V41.373V41.3726V41.3722V41.3718V41.3714V41.371V41.3706V41.3702V41.3698V41.3694V41.369V41.3686V41.3682V41.3678V41.3674V41.367V41.3666V41.3662V41.3658V41.3654V41.365V41.3646V41.3644C49.4989 38.5593 50.0539 34.1743 50.3993 30.7903L50.4686 30.3053L50.4687 30.3053L50.4694 30.2991C50.7496 27.917 50.9012 25.1177 49.6026 22.664C48.5186 20.5689 46.5027 18.9203 43.9302 18.0628C41.3588 17.2056 38.5034 17.2056 35.932 18.0627L35.93 18.0634C33.4268 18.9217 31.4149 20.57 30.2622 22.6592L30.2622 22.6591L30.2602 22.663C28.961 25.117 29.1125 27.9866 29.3929 30.3L29.3929 30.3L29.3936 30.3053L29.4632 30.7925C29.4671 30.8251 29.4711 30.8578 29.475 30.8905C29.6813 32.6112 29.912 34.5344 30.4331 36.3671C30.9557 38.2048 31.775 39.9697 33.1711 41.3644V41.3645V41.3647V41.365V41.3653V41.3656V41.3659V41.3661V41.3664V41.3667V41.367V41.3673V41.3675V41.3678V41.3681V41.3683V41.3686V41.3689V41.3692V41.3694V41.3697V41.37V41.3702V41.3705V41.3708V41.371V41.3713V41.3715V41.3718V41.3721V41.3723V41.3726V41.3728V41.3731V41.3733V41.3736V41.3738V41.3741V41.3743V41.3746V41.3748V41.3751V41.3753V41.3756V41.3758V41.3761V41.3763V41.3765V41.3768V41.377V41.3772V41.3775V41.3777V41.378V41.3782V41.3784V41.3786V41.3789V41.3791V41.3793V41.3796V41.3798V41.38V41.3802V41.3805V41.3807V41.3809V41.3811V41.3813V41.3816V41.3818V41.382V41.3822V41.3824V41.3826V41.3828V41.383V41.3832V41.3835V41.3837V41.3839V41.3841V41.3843V41.3845V41.3847V41.3849V41.3851V41.3853V41.3855V41.3857V41.3858V41.386V41.3862V41.3864V41.3866V41.3868V41.387V41.3872V41.3873V41.3875V41.3877V41.3879V41.3881V41.3882V41.3884V41.3886V41.3888V41.3889V41.3891V41.3893V41.3895V41.3896V41.3898V41.39V41.3901V41.3903V41.3904V41.3906V41.3908V41.3909V41.3911V41.3912V41.3914V41.3915V41.3917V41.3918V41.392V41.3921V41.3923V41.3924V41.3926V41.3927V41.3929V41.393V41.3931V41.3933V41.3934V41.3935V41.3937V41.3938V41.3939V41.3941V41.3942V41.3943V41.3945V41.3946V41.3947V41.3948V41.3949V41.3951V41.3952V41.3953V41.3954V41.3955V41.3956V41.3957V41.3959V41.396V41.3961V41.3962V41.3963V41.3964V41.3965V41.3966V41.3967V41.3968V41.3969V41.397V41.3971V41.3972V41.3972V41.3973V41.3974V41.3975V41.3976V41.3977V41.3978V41.3978V41.3979V41.398V41.3981V41.3981V41.3982V41.3983V41.3983V41.3984V41.3985V41.3985V41.3986V41.3987V41.3987V41.3988V41.3989V41.3989V41.399V41.399V41.3991V41.3991V41.3992V41.3992V41.3993V41.3993V41.3993V41.3994V41.3994V41.3995V41.3995V41.3995V41.3996V41.3996V41.3996V41.3997V41.3997V41.3997V41.3997V41.3998V41.3998V41.3998V41.3998V41.3998V41.3999V41.3999V41.3999V41.3999V44.6501L23.7515 47.8129L23.7513 47.813C20.1947 49.0106 18.606 52.3778 17.9001 55.4222C17.2493 58.2285 17.3311 60.8347 17.3485 61.3918C17.3501 61.4408 17.3511 61.4739 17.3511 61.4899V61.5077L17.3536 61.5253C17.4383 62.1181 17.9472 62.6499 18.5811 62.6499H18.6511H18.6667L18.6821 62.648C19.3736 62.5616 19.8111 62.0295 19.8111 61.3499C19.8111 61.3474 19.8107 61.3381 19.81 61.3224C19.7981 61.0458 19.7007 58.7791 20.1999 56.3158C20.7312 53.694 21.9142 50.9701 24.4711 50.1068L24.472 50.1065L29.7918 48.2866L29.792 48.2865L32.8718 47.2365L32.8718 47.2366L32.8765 47.2349L33.3859 47.0496C33.9166 48.9999 35.2893 50.69 36.5549 51.9134C37.8253 53.1416 39.0148 53.9246 39.2115 54.0541C39.2178 54.0582 39.223 54.0617 39.2273 54.0645C39.6041 54.3427 40.1333 54.3242 40.5497 54.0743L40.5499 54.0745L40.5598 54.0679C40.5656 54.064 40.575 54.0579 40.5878 54.0495C40.8052 53.9076 41.9986 53.1282 43.263 51.914C44.5362 50.6914 45.9102 49.0011 46.4108 47.0496L47.1266 47.3052L47.127 47.3054L49.8566 48.2852ZM42.3131 41.5413L42.2945 41.5691L42.2839 41.6009C42.195 41.8678 42.2005 42.1982 42.2786 42.5106L42.2827 42.527L42.289 42.5428C42.4737 43.0045 42.9283 43.2599 43.4311 43.2599H43.4387C43.5033 43.2599 43.5886 43.26 43.6677 43.2487C43.7402 43.2383 43.8458 43.2139 43.9343 43.1385C44.0139 43.0879 44.11 43.046 44.2296 42.9947L44.2311 42.9941V45.5299C44.2311 46.8739 43.4568 48.1986 42.4892 49.3217C41.5985 50.3556 40.5723 51.1861 39.9311 51.6603C39.2899 51.1861 38.2637 50.3556 37.373 49.3217C36.4054 48.1986 35.6311 46.8739 35.6311 45.5299V43.0071C35.6337 43.0085 35.6363 43.0099 35.6388 43.0113C35.7515 43.0719 35.8691 43.1317 35.9922 43.1738C36.5944 43.426 37.2899 43.1735 37.5619 42.5688C37.7477 42.2733 37.7305 41.9099 37.5722 41.5834C37.4716 41.303 37.2132 41.0609 36.9898 40.9119L36.9703 40.8989L36.9486 40.8897C34.9677 40.0503 33.8155 38.4379 33.0952 36.5171C32.3724 34.5897 32.0949 32.3798 31.8492 30.3794L31.8493 30.3794L31.8486 30.3746L31.7789 29.8869C31.7789 29.8865 31.7788 29.8861 31.7788 29.8857C31.5002 27.7957 31.4405 25.5518 32.3838 23.6636C33.1898 22.1201 34.6723 20.901 36.6452 20.2887L36.6452 20.2888L36.6526 20.2863C38.6298 19.6045 41.0924 19.6045 43.0696 20.2863C45.0484 20.9686 46.5333 22.1904 47.3395 23.6657C48.2818 25.5537 48.2219 27.8669 47.9435 29.8851C47.9435 29.8853 47.9435 29.8856 47.9435 29.8858L47.8736 30.3746L47.8736 30.3746L47.873 30.3794C47.6273 32.3798 47.3498 34.5897 46.627 36.5171C45.9068 38.4379 44.7546 40.0503 42.7736 40.8897L42.6887 40.9257L42.6475 41.0081C42.5862 41.1306 42.4574 41.3248 42.3131 41.5413Z" fill="white" stroke="white" stroke-width="0.5"/>
			</svg>';
	$foto = '<img src="images/avatar/01.jpg" alt="avatar">';
	if( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		echo '<a href="#" class="header-generale__left__user avatar" title="В личный кабинет ' . $current_user->display_name . '">' . $no_foto . '</a>
			<a href="#" class="header-generale__left__user link-lk" title="В личный кабинет ' . $current_user->display_name . '"><h4>' . wp_html_excerpt( $current_user->display_name, 10, '...' ) . '</h4></a>
			<a href="#" class="header-generale__right__add-btn">
                <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/>
                </svg>
                <span>Добавить</span>
            </a>';
	} else {
		echo '<a href="/signin" class="header-generale__left__user link-lk" title="Авторизоваться">
				<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path class="fa-primary" d="M256 272c39.77 0 72-32.24 72-72S295.8 128 256 128C216.2 128 184 160.2 184 200S216.2 272 256 272zM288 320H224c-47.54 0-87.54 29.88-103.7 71.71C155.1 426.5 203.1 448 256 448s100.9-21.53 135.7-56.29C375.5 349.9 335.5 320 288 320z"/>
					<path class="fa-secondary" d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c39.77 0 72 32.24 72 72S295.8 272 256 272c-39.76 0-72-32.24-72-72S216.2 128 256 128zM256 448c-52.93 0-100.9-21.53-135.7-56.29C136.5 349.9 176.5 320 224 320h64c47.54 0 87.54 29.88 103.7 71.71C356.9 426.5 308.9 448 256 448z"/>
				</svg>
				<span>Войти</span>
			</a>
			<a href="#" class="header-generale__right__add-btn">
                <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM256 368C269.3 368 280 357.3 280 344V280H344C357.3 280 368 269.3 368 256C368 242.7 357.3 232 344 232H280V168C280 154.7 269.3 144 256 144C242.7 144 232 154.7 232 168V232H168C154.7 232 144 242.7 144 256C144 269.3 154.7 280 168 280H232V344C232 357.3 242.7 368 256 368z"/>
                </svg>
                <span>Добавить</span>
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
	if ( array_key_exists('copiright_text', $site_options) ) {
		echo '<p>' . $site_options['copiright_text'] . '</p>';
	} else {
		echo '<p>Все права защищены © 2024 - ' . $bloginfo_name . '</p>';
	}
}

function glamping_club_footer_emails() {
	$site_options = get_option( 'glc_options' );
	if ( array_key_exists('contact_emails', $site_options) ) {
		foreach ($site_options['contact_emails'] as $value) {
			echo '<span><a href="mailto:' . $value . '">' . $value . '</a></span>';
		}
	} else {
		echo '<span><a href="mailto:info@site.com">info@site.com</a></span>
			<span><a href="mailto:info1@site.com">info1@site.com</a></span>';
	}
}

function glamping_club_footer_phones() {
	$site_options = get_option( 'glc_options' );
	if ( array_key_exists('contact_phone', $site_options) ) {
		foreach ($site_options['contact_phone'] as $value) {
			echo '<span><a href="tel:' . $value . '">' . $value . '</a></span>';
		}
	} else {
		echo '<span><a href="tel:+8801838288389">+8801838288389</a></span>
			<span><a href="tel:+8801941101915">+8801941101915</a></span>';
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
