<?php
function glamping_club_dashboard_tabs() {
    if ( $_GET ) {
        if ( isset( $_GET["tab"] ) ) {
            $filename = get_parent_theme_file_path( '/functions/account/templates/tabs/tab-' . $_GET["tab"] . '.php' );
            if (file_exists($filename)) {
                get_template_part( 'functions/account/templates/tabs/tab-' . $_GET["tab"]);
            } else {
                get_template_part( 'functions/account/templates/tabs/tab-info');
            }
        } else {
            get_template_part( 'functions/account/templates/tabs/tab-info');
        }
    } else {
        get_template_part( 'functions/account/templates/tabs/tab-info');
    }
}

function glamping_club_dashboard_nav($item_id) {
    $class = '';
    if ( $_GET ) {
    	if ( isset( $_GET["tab"] ) ) {
            if( $item_id === $_GET["tab"] ){
        		$class = ' current-menu-item';
        	}
        }
    } elseif ($item_id === 'info') {
        $class = ' current-menu-item';
    }
    echo $class;
}

// add_filter( 'nav_menu_css_class', 'glamping_club_add_menu_item_css_classes', 10, 4 );
function glamping_club_add_menu_item_css_classes( $classes, $item, $args, $depth ) {
    if ( $_GET ) {
    	if ( isset( $_GET["tab"] ) ) {
            if( $item->url === '?tab='.$_GET["tab"]  && $args->theme_location === 'menu-4' ){
        		$classes[] = 'current-menu-item';
        	}
        }
    }
	return $classes;
}

// add_filter( 'wp_nav_menu_objects', 'glamping_club_filter_wp_nav_menu_objects', 10, 2 );
function glamping_club_filter_wp_nav_menu_objects( $items, $args ) {
    $icon_lk = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
    <path d="M18 20V10M12 20V4M6 20V14" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>';
    $icon_glemps = '<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
    <path d="M394.3 3.745C401.1 9.425 401.9 19.52 396.3 26.29L308.9 130.4L532.8 397.2C540 405.8 544 416.7 544 428V464C544 490.5 522.5 512 496 512H80C53.49 512 32 490.5 32 464V428C32 416.7 35.98 405.8 43.23 397.2L267.1 130.4L179.7 26.29C174.1 19.52 174.9 9.425 181.7 3.745C188.5-1.936 198.6-1.054 204.3 5.715L287.1 105.5L371.7 5.715C377.4-1.054 387.5-1.936 394.3 3.745H394.3zM64 428V464C64 472.8 71.16 480 80 480H129.9L275.4 294.1C278.4 290.3 283.1 288 288 288C292.9 288 297.6 290.3 300.6 294.1L446.1 480H496C504.8 480 512 472.8 512 464V428C512 424.2 510.7 420.6 508.3 417.7L288 155.3L67.74 417.7C65.33 420.6 64 424.2 64 428zM170.6 480H405.4L288 329.1L170.6 480z"  stroke="var(--color-primary)"></path>
    </svg>';
    $icon_settings = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
    <g clip-path="url(#clip0_717_5928)">
    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
    <path d="M19.4 15C19.2669 15.3016 19.2272 15.6362 19.286 15.9606C19.3448 16.285 19.4995 16.5843 19.73 16.82L19.79 16.88C19.976 17.0657 20.1235 17.2863 20.2241 17.5291C20.3248 17.7719 20.3766 18.0322 20.3766 18.295C20.3766 18.5578 20.3248 18.8181 20.2241 19.0609C20.1235 19.3037 19.976 19.5243 19.79 19.71C19.6043 19.896 19.3837 20.0435 19.1409 20.1441C18.8981 20.2448 18.6378 20.2966 18.375 20.2966C18.1122 20.2966 17.8519 20.2448 17.6091 20.1441C17.3663 20.0435 17.1457 19.896 16.96 19.71L16.9 19.65C16.6643 19.4195 16.365 19.2648 16.0406 19.206C15.7162 19.1472 15.3816 19.1869 15.08 19.32C14.7842 19.4468 14.532 19.6572 14.3543 19.9255C14.1766 20.1938 14.0813 20.5082 14.08 20.83V21C14.08 21.5304 13.8693 22.0391 13.4942 22.4142C13.1191 22.7893 12.6104 23 12.08 23C11.5496 23 11.0409 22.7893 10.6658 22.4142C10.2907 22.0391 10.08 21.5304 10.08 21V20.91C10.0723 20.579 9.96512 20.258 9.77251 19.9887C9.5799 19.7194 9.31074 19.5143 9 19.4C8.69838 19.2669 8.36381 19.2272 8.03941 19.286C7.71502 19.3448 7.41568 19.4995 7.18 19.73L7.12 19.79C6.93425 19.976 6.71368 20.1235 6.47088 20.2241C6.22808 20.3248 5.96783 20.3766 5.705 20.3766C5.44217 20.3766 5.18192 20.3248 4.93912 20.2241C4.69632 20.1235 4.47575 19.976 4.29 19.79C4.10405 19.6043 3.95653 19.3837 3.85588 19.1409C3.75523 18.8981 3.70343 18.6378 3.70343 18.375C3.70343 18.1122 3.75523 17.8519 3.85588 17.6091C3.95653 17.3663 4.10405 17.1457 4.29 16.96L4.35 16.9C4.58054 16.6643 4.73519 16.365 4.794 16.0406C4.85282 15.7162 4.81312 15.3816 4.68 15.08C4.55324 14.7842 4.34276 14.532 4.07447 14.3543C3.80618 14.1766 3.49179 14.0813 3.17 14.08H3C2.46957 14.08 1.96086 13.8693 1.58579 13.4942C1.21071 13.1191 1 12.6104 1 12.08C1 11.5496 1.21071 11.0409 1.58579 10.6658C1.96086 10.2907 2.46957 10.08 3 10.08H3.09C3.42099 10.0723 3.742 9.96512 4.0113 9.77251C4.28059 9.5799 4.48572 9.31074 4.6 9C4.73312 8.69838 4.77282 8.36381 4.714 8.03941C4.65519 7.71502 4.50054 7.41568 4.27 7.18L4.21 7.12C4.02405 6.93425 3.87653 6.71368 3.77588 6.47088C3.67523 6.22808 3.62343 5.96783 3.62343 5.705C3.62343 5.44217 3.67523 5.18192 3.77588 4.93912C3.87653 4.69632 4.02405 4.47575 4.21 4.29C4.39575 4.10405 4.61632 3.95653 4.85912 3.85588C5.10192 3.75523 5.36217 3.70343 5.625 3.70343C5.88783 3.70343 6.14808 3.75523 6.39088 3.85588C6.63368 3.95653 6.85425 4.10405 7.04 4.29L7.1 4.35C7.33568 4.58054 7.63502 4.73519 7.95941 4.794C8.28381 4.85282 8.61838 4.81312 8.92 4.68H9C9.29577 4.55324 9.54802 4.34276 9.72569 4.07447C9.90337 3.80618 9.99872 3.49179 10 3.17V3C10 2.46957 10.2107 1.96086 10.5858 1.58579C10.9609 1.21071 11.4696 1 12 1C12.5304 1 13.0391 1.21071 13.4142 1.58579C13.7893 1.96086 14 2.46957 14 3V3.09C14.0013 3.41179 14.0966 3.72618 14.2743 3.99447C14.452 4.26276 14.7042 4.47324 15 4.6C15.3016 4.73312 15.6362 4.77282 15.9606 4.714C16.285 4.65519 16.5843 4.50054 16.82 4.27L16.88 4.21C17.0657 4.02405 17.2863 3.87653 17.5291 3.77588C17.7719 3.67523 18.0322 3.62343 18.295 3.62343C18.5578 3.62343 18.8181 3.67523 19.0609 3.77588C19.3037 3.87653 19.5243 4.02405 19.71 4.21C19.896 4.39575 20.0435 4.61632 20.1441 4.85912C20.2448 5.10192 20.2966 5.36217 20.2966 5.625C20.2966 5.88783 20.2448 6.14808 20.1441 6.39088C20.0435 6.63368 19.896 6.85425 19.71 7.04L19.65 7.1C19.4195 7.33568 19.2648 7.63502 19.206 7.95941C19.1472 8.28381 19.1869 8.61838 19.32 8.92V9C19.4468 9.29577 19.6572 9.54802 19.9255 9.72569C20.1938 9.90337 20.5082 9.99872 20.83 10H21C21.5304 10 22.0391 10.2107 22.4142 10.5858C22.7893 10.9609 23 11.4696 23 12C23 12.5304 22.7893 13.0391 22.4142 13.4142C22.0391 13.7893 21.5304 14 21 14H20.91C20.5882 14.0013 20.2738 14.0966 20.0055 14.2743C19.7372 14.452 19.5268 14.7042 19.4 15Z" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
    </g>
    <defs>
    <clipPath id="clip0_717_5928">
    <rect width="24" height="24" fill="white"></rect>
    </clipPath>
    </defs>
    </svg>';
    foreach ( $items as $key => $item ) {
        if( $args->theme_location === 'menu-4' ) {
            if ( $items[ $key ]->url === '/dashboard/' ) {
                $title = $items[ $key ]->title;
                $items[ $key ]->title = $icon_lk . '<span>' . $title .'</span>';
            } elseif ( $items[ $key ]->url === '?tab=glemps' ) {
                $title = $items[ $key ]->title;
                $items[ $key ]->title = $icon_glemps . '<span>' . $title .'</span>';
            } elseif ( $items[ $key ]->url === '?tab=settings' ) {
                $title = $items[ $key ]->title;
                $items[ $key ]->title = $icon_settings . '<span>' . $title .'</span>';
            }
        }
    }
    return $items;
}

function user_initials($fullName) {
    $arName = explode(' ', $fullName);
    $arFirstLetters = array_map(function ($item){
        return mb_substr($item, 0, 1);
    }, $arName);
    // $strFirstLetter = implode('', $arFirstLetters);
    $strFirstLetter = $arFirstLetters[0];
    return $strFirstLetter;
}

function dashboard_glamp_user() {
    $glamps = get_posts( [
        'posts_per_page' => -1,
        'post_type' => 'glampings',
        'author' => get_current_user_id(),
        'post_status' => ['publish', 'pending', 'draft']
    ] );
    global $post;
    foreach( $glamps as $post ){
        setup_postdata( $post );
        $post_status = '';
        if ($post->post_status == 'publish') {
            $post_status = '<span class="post-status">Опубликован</span>';
        } else {
            $post_status = '<span class="post-status pending">На модерации</span>';
        }
        ?>
        <div class="user-glamps__item">
            <div class="user-glamps__item__img">
                <?php
                if( has_post_thumbnail() ) {
                    the_post_thumbnail(array(60, 60));
                } else {
                    $glc_options = get_option( 'glc_options' );
                    if (array_key_exists('glamping_no_photo_id', $glc_options)) {
            			$url = wp_get_attachment_image_url( $glc_options['glamping_no_photo_id'], [60, 60] );
                        echo '<img src="' . $url . '" />';
            		} else {
                        echo '<img src="' . get_template_part( 'assets/img' ) . '/no-foto.jpg" />';
                    }
                }
                ?>
            </div>
            <div class="user-glamps__item__info">
                <span class="user-glamps__item__info__title"><?php the_title(); ?></span>
                <div class="user-glamps__item__info__options">
                    <div class="user-glamps__item__info__options__item">
        				<?php reviews_stars_items_average( 2.94, 4 ); ?>
        			</div>
                    <div class="user-glamps__item__info__options__item">
                        <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M160 256C160 185.3 217.3 128 288 128C358.7 128 416 185.3 416 256C416 326.7 358.7 384 288 384C217.3 384 160 326.7 160 256zM288 336C332.2 336 368 300.2 368 256C368 211.8 332.2 176 288 176C287.3 176 286.7 176 285.1 176C287.3 181.1 288 186.5 288 192C288 227.3 259.3 256 224 256C218.5 256 213.1 255.3 208 253.1C208 254.7 208 255.3 208 255.1C208 300.2 243.8 336 288 336L288 336zM95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6V112.6zM288 80C222.8 80 169.2 109.6 128.1 147.7C89.6 183.5 63.02 225.1 49.44 256C63.02 286 89.6 328.5 128.1 364.3C169.2 402.4 222.8 432 288 432C353.2 432 406.8 402.4 447.9 364.3C486.4 328.5 512.1 286 526.6 256C512.1 225.1 486.4 183.5 447.9 147.7C406.8 109.6 353.2 80 288 80V80z"/>
                        </svg>
                        <?php echo $post->views; ?>
                    </div>
                    <div class="user-glamps__item__info__options__item item-date" title="Создан">
                        <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M112 0C120.8 0 128 7.164 128 16V64H320V16C320 7.164 327.2 0 336 0C344.8 0 352 7.164 352 16V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H96V16C96 7.164 103.2 0 112 0zM416 192H312V264H416V192zM416 296H312V376H416V296zM416 408H312V480H384C401.7 480 416 465.7 416 448V408zM280 376V296H168V376H280zM168 480H280V408H168V480zM136 376V296H32V376H136zM32 408V448C32 465.7 46.33 480 64 480H136V408H32zM32 264H136V192H32V264zM168 264H280V192H168V264zM384 96H64C46.33 96 32 110.3 32 128V160H416V128C416 110.3 401.7 96 384 96z"/>
                        </svg>
                        <?php echo get_the_date(); ?>
                    </div>
                    <div class="user-glamps__item__info__options__item" title="Изменен">
                        <svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M128 64H320V16C320 7.164 327.2 0 336 0C344.8 0 352 7.164 352 16V64H384C419.3 64 448 92.65 448 128V192H32V448C32 465.7 46.33 480 64 480H258.5L257.4 484.2C255.1 493.6 255.7 503.2 258.8 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H96V16C96 7.164 103.2 0 112 0C120.8 0 128 7.164 128 16V64zM32 128V160H416V128C416 110.3 401.7 96 384 96H64C46.33 96 32 110.3 32 128zM240 352C248.8 352 256 359.2 256 368C256 376.8 248.8 384 240 384H112C103.2 384 96 376.8 96 368C96 359.2 103.2 352 112 352H240zM96 272C96 263.2 103.2 256 112 256H336C344.8 256 352 263.2 352 272C352 280.8 344.8 288 336 288H112C103.2 288 96 280.8 96 272zM473.5 241.4C492.3 222.6 522.7 222.6 541.4 241.4L558.8 258.7C577.5 277.5 577.5 307.9 558.8 326.6L405.1 480.3C398.9 486.5 391.2 490.8 382.8 492.1L307.9 511.7C302.4 513 296.7 511.4 292.7 507.5C288.7 503.5 287.1 497.7 288.5 492.3L307.2 417.4C309.3 408.9 313.7 401.2 319.8 395.1L473.5 241.4zM518.8 264C512.5 257.8 502.4 257.8 496.2 264L471.3 288.8L511.3 328.8L536.2 303.1C542.4 297.7 542.4 287.6 536.2 281.4L518.8 264zM338.2 425.1L325.1 474.2L375 461.9C377.8 461.2 380.4 459.8 382.4 457.7L488.7 351.4L448.7 311.5L342.5 417.7C340.4 419.8 338.9 422.3 338.2 425.1H338.2z"/>
                        </svg>
                        <?php echo get_the_modified_date(); ?>
                    </div>
                    <div class="user-glamps__item__info__options__item">
                        <?php echo $post_status; ?>
                    </div>
                </div>
            </div>
            <div class="user-glamps__item__links">
                <a href="<?php the_permalink(); ?>" title="Смотреть">
                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                        <path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/>
                    </svg>
                </a>
                <?php if ($post->post_status == 'publish') { ?>
                    <a href="/glc-postedit/?glc-postid=<?php echo $post->ID; ?>" title="Редактировать">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                        </svg>
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php
    }
    wp_reset_postdata();
}

function glamping_club_post_list_identification($template=0) {
    global $post;
	$args = [
		'posts_per_page' => -1,
		'post_type' => 'glampings'
	];
	$glampings = get_posts( $args );
    $content = '<form id="glamping-identification" class="glamping-identification">';
    $content .= '<select name="glamping_id" class="post-list-identification">';
    $content .= '<option value="0">Выберите свой глэмпинг</option>';
	foreach ($glampings as $post) {
		setup_postdata( $post );
        $content .= '<option value="' . $post->ID . '">' . $post->post_title . '</option>';
    }
    $content .= '</select>';
    $content .= '<div class="glamping-identification__btn">
        <button id="user-glamping-identification" class="primary"type="button" name="button">Отправить заявку на глэмпинг</button>
    </div>';
    $content .= '</form>';
    wp_reset_postdata();
    if ($template) {
        return $content;
    } else {
        echo $content;
    }
}

add_action('wp_ajax_owner_identification', 'glamping_club_owner_identification');
add_action('wp_ajax_nopriv_owner_identification', 'glamping_club_owner_identification');
function glamping_club_owner_identification() {
    $error = array();
    if ( !wp_verify_nonce( $_POST['nonce'], 'glamping_club' ) ) {
        $error['empty_nonce'] = __( 'Error nonce', 'glamping-club' );
    }

    if ( !$_POST['user_id'] ) {
        $error['empty_user_id'] = __( 'Error user', 'glamping-club' );
    }

    if ( count( $error ) > 0 ) {
        $error['type'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $post = get_post( $_POST['glamping_id'] );
        $mailTo = $post->additionally_field[0]['email_glamping'];
        if ($mailTo) {
            $from_email = get_glc_option('glc_options', 'from_email');
            $user = get_user_by( 'id', $_POST['user_id'] );
            $key = get_password_reset_key( $user );
            $user_hex = rawurlencode(encryptStringGlc($user->user_login));
            $url = get_site_url( null, 'owner-identification/?key=' . $key . '&owner=' . $user_hex . '&glamp=' . $_POST['glamping_id'] );
            $site_name = get_bloginfo('name');
            $admin_email = get_bloginfo('admin_email');
            // $mailTo = $_POST['user_email'];
            $subject = 'Подтверждение владения глэмпингом ' . $site_name;
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=utf-8\r\n";
            $headers .= "From: " . $from_email . " <" . $from_email . ">\r\n";
            $message = '<p>Подтверждение владения глэмпингом на сайте ' . $site_name . '.</p>';
            $message .= '<p>Чтобы подтвердить, перейдите по ссылке ниже: <a href="' . $url . '" target="blank">Подтвердить владение глэмпингом</a></p>';
            $message .= '<p>Если Вы не запрашивали подтверждение владения глэмпингом на сайте ' . $site_name . ', просто проигнорируйте это письмо.</p>';
            wp_mail($mailTo, $subject, $message, $headers);

            $error['type'] = 'success';
            // $error['POST'] = $_POST;
            // $error['post'] = $post;
            // $error['email_glamping'] = $post->additionally_field[0]['email_glamping'];
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
            wp_die();
        } else {
            $error['type'] = 'errors';
            $error['no_email'] = 'No E-mail in glamping';
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
            wp_die();
        }
    }
}

function glamping_club_owner_identif_action($key, $owner, $glamp) {
    if ( isset( $key ) && isset( $owner ) && isset( $glamp ) ) {
        $user_login = decryptStringGlc(rawurldecode($owner));
        $user = check_password_reset_key( $key, $user_login );
        if ( !is_wp_error($user) ) {
            $update_post = [
                'ID' => (int)$glamp,
                'post_author' => $user->ID
            ];
            wp_update_post( wp_slash( $update_post ) );
            return true;
        } else {
            // echo $user->get_error_message();
            return false;
        }
    } else {
        return false;
    }
}

define('ENCR_GLC_METHOD', 'AES-256-CBC');
define('ENCR_GLC_KEY', 'glamping_club');
define('ENCR_GLC_OPTIONS', 0);
define('ENCR_GLC_IV', '1234567891011121');

function encryptStringGlc($data) {
    $encryptedData = openssl_encrypt($data, ENCR_GLC_METHOD, ENCR_GLC_KEY, ENCR_GLC_OPTIONS, ENCR_GLC_IV);
    return $encryptedData;
}

function decryptStringGlc($encryptedData) {
    $decryptedData = openssl_decrypt($encryptedData, ENCR_GLC_METHOD, ENCR_GLC_KEY, ENCR_GLC_OPTIONS, ENCR_GLC_IV);
    return $decryptedData;
}
