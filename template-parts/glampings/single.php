<?php
$cur_user_id = get_current_user_id();
// $additionally_field = (object)$post->additionally_field[0];
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ($post->post_status != 'publish') { ?>
        <h3 class="post-pending">Глэмпинг находится на модерации</h3>
    <?php } ?>

    <div class="images">
        <div id="single-thumbnail" class="images__gallery thumbnail-gallery">
            <?php glamping_single_thumbnail($post->ID); ?>
        </div>

        <!-- <div class="images__right">
            <?php //get_images_right_content(); ?>
        </div> -->
    </div>

    <div class="meta mt10 mt-smail-10">
        <div class="meta__item item-rating">
            <?php get_rating_post(2.94, 4); // рейтинг / отзывы ?>
        </div>

        <div class="meta__item item-views" title="Просмотры">
            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path d="M160 256C160 185.3 217.3 128 288 128C358.7 128 416 185.3 416 256C416 326.7 358.7 384 288 384C217.3 384 160 326.7 160 256zM288 336C332.2 336 368 300.2 368 256C368 211.8 332.2 176 288 176C287.3 176 286.7 176 285.1 176C287.3 181.1 288 186.5 288 192C288 227.3 259.3 256 224 256C218.5 256 213.1 255.3 208 253.1C208 254.7 208 255.3 208 255.1C208 300.2 243.8 336 288 336L288 336zM95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6V112.6zM288 80C222.8 80 169.2 109.6 128.1 147.7C89.6 183.5 63.02 225.1 49.44 256C63.02 286 89.6 328.5 128.1 364.3C169.2 402.4 222.8 432 288 432C353.2 432 406.8 402.4 447.9 364.3C486.4 328.5 512.1 286 526.6 256C512.1 225.1 486.4 183.5 447.9 147.7C406.8 109.6 353.2 80 288 80V80z"/>
            </svg>
            <span><?php echo $post->views; ?></span>
        </div>
    </div>

    <div class="single-section title">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <div class="title__address mb10">
            <a href="#map-container" title="На карте">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C9.87827 2 7.84344 2.84285 6.34315 4.34315C4.84285 5.84344 4 7.87827 4 10C4 13.0981 6.01574 16.1042 8.22595 18.4373C9.31061 19.5822 10.3987 20.5195 11.2167 21.1708C11.5211 21.4133 11.787 21.6152 12 21.7726C12.213 21.6152 12.4789 21.4133 12.7833 21.1708C13.6013 20.5195 14.6894 19.5822 15.774 18.4373C17.9843 16.1042 20 13.0981 20 10C20 7.87827 19.1571 5.84344 17.6569 4.34315C16.1566 2.84285 14.1217 2 12 2ZM12 23C11.4453 23.8321 11.445 23.8319 11.4448 23.8317L11.4419 23.8298L11.4352 23.8253L11.4123 23.8098C11.3928 23.7966 11.3651 23.7776 11.3296 23.753C11.2585 23.7038 11.1565 23.6321 11.0278 23.5392C10.7705 23.3534 10.4064 23.0822 9.97082 22.7354C9.10133 22.043 7.93939 21.0428 6.77405 19.8127C4.48426 17.3958 2 13.9019 2 10C2 7.34784 3.05357 4.8043 4.92893 2.92893C6.8043 1.05357 9.34784 0 12 0C14.6522 0 17.1957 1.05357 19.0711 2.92893C20.9464 4.8043 22 7.34784 22 10C22 13.9019 19.5157 17.3958 17.226 19.8127C16.0606 21.0428 14.8987 22.043 14.0292 22.7354C13.5936 23.0822 13.2295 23.3534 12.9722 23.5392C12.8435 23.6321 12.7415 23.7038 12.6704 23.753C12.6349 23.7776 12.6072 23.7966 12.5877 23.8098L12.5648 23.8253L12.5581 23.8298L12.556 23.8312C12.5557 23.8314 12.5547 23.8321 12 23ZM12 23L12.5547 23.8321C12.2188 24.056 11.7807 24.0556 11.4448 23.8317L12 23Z" fill="black"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8ZM8 10C8 7.79086 9.79086 6 12 6C14.2091 6 16 7.79086 16 10C16 12.2091 14.2091 14 12 14C9.79086 14 8 12.2091 8 10Z" fill="black"></path>
                </svg>
                <?php echo get_additionally_meta('address'); ?>
            </a>
        </div>
        <div class="characteristics-glamping">
            <span class="characteristics-glamping__title">Тип глэмпинга: </span>
            <span><?php echo implode(', ', $post->glamping_type); //get_glamping_type_content(); ?></span>
        </div>
        <div class="characteristics-glamping">
            <span class="characteristics-glamping__title">Тип размещения: </span>
            <span><?php echo get_glamping_allocation_content(); ?></span>
        </div>
        <?php echo get_glamping_nature_around_content(); ?>

        <?php if ($post->glamping_number_houses) { ?>
            <div class="characteristics-glamping">
                <span class="characteristics-glamping__title">Количество домиков: </span>
                <span><?php echo $post->glamping_number_houses; ?></span>
            </div>
        <?php } ?>
        <!-- <div class="characteristics-glamping">
            <span class="characteristics-glamping__title">Вместимость: </span>
            <span><?php //echo $post->glamping_capacity; ?> чел.</span>
        </div> -->
        <div class="characteristics-glamping">
            <span class="characteristics-glamping__title">Стоимость: </span>
            <span>от <?php echo $post->glamping_price; ?>р.</span>
        </div>
        <!-- <div class="characteristics-glamping">
            <span>Бронирование онлайн: </span>
            <span><?php //echo glamping_book_online(); ?></span>
        </div> -->
    </div>

    <div class="single-section description">
        <div class="single-section__title">
            <h3>Описание - Или изменить текст или убрать совсем???</h3>
        </div>
        <div class="single-section__content collapse-content">
            <?php the_content(); ?>
        </div>
        <div class="collapse-content-btn">
            <span>Развернуть</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
            </svg>
        </div>
    </div>

    <div class="single-section facilities">
        <?php
        glamping_icons_facilities('glamping_facilities_general', 'Удобства общие');
        glamping_icons_facilities('facilities_general_kitchen', 'Кухня');
        glamping_icons_facilities('facilities_general_bathroom', 'Ванная комната');
        glamping_icons_facilities('facilities_options_children', 'Для детей');
        glamping_icons_facilities('glamping_nutrition', 'Питание');
        glamping_icons_facilities('glamping_territory', 'Территория');
        glamping_icons_facilities('glamping_facilities_safety', 'Безопасность');
        glamping_icons_facilities('glamping_entertainment', 'Развлечения');
        ?>
    </div>

    <div class="single-section conditions">
        <div class="single-section__title">
            <h3>Условия размещения</h3>
        </div>
        <div class="single-section__content">
            <?php get_additionally_content(); ?>
        </div>
    </div>

    <?php get_accommodation_options(); ?>

    <?php if ( get_additionally_meta('coordinates') ) { ?>
        <div id="map-container" class="single-section map">
            <div class="single-section__title">
                <h3>Карта</h3>
            </div>
            <div id="map" class="single-section__content"></div>
        </div>
    <?php } ?>

</article><!-- #post-<?php the_ID(); ?> -->

<aside class="single-aside">
    <div id="aside-content" class="single-aside__content">
        <div class="single-aside__content__item aside-item">
            <!-- <div class="single-aside__content__title mb6">
                <span>Добавить:</span>
            </div> -->
            <div class="btn-group">
                <button id="add-favorites" data-postid="<?php the_ID(); ?>" class="round-sup-red" type="button" name="button" title="Добавить в избранное">
                    <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
                    </svg>
                </button>
                <button id="add-comparison" data-postid="<?php the_ID(); ?>" class="round-sup-red" type="button" name="button" title="Добавить к сравнению">
                    <svg class="rotate90" width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
                    </svg>
                </button>

                <script src="https://yastatic.net/share2/share.js"></script>
                <style media="screen">.ya-share2__link_more-button-type_short{display: flex;}</style>
                <div class="ya-share2" data-curtain data-shape="round" data-limit="0"
                    data-more-button-type="short"
                    data-services="vkontakte,odnoklassniki" title="Поделиться"></div>

                <?php if ($cur_user_id) { ?>
                    <button id="add-claim" data-postid="<?php the_ID(); ?>" data-userid="<?php echo $cur_user_id; ?>" class="round-sup-red" type="button" name="button" title="Это мой глэмпинг">
                        <svg class="add-claim" width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM256 304c13.25 0 24-10.75 24-24v-128C280 138.8 269.3 128 256 128S232 138.8 232 152v128C232 293.3 242.8 304 256 304zM256 337.1c-17.36 0-31.44 14.08-31.44 31.44C224.6 385.9 238.6 400 256 400s31.44-14.08 31.44-31.44C287.4 351.2 273.4 337.1 256 337.1z"/>
                        </svg>
                    </button>
                <?php } ?>
            </div>
        </div>

        <!-- <div class="single-aside__content__item aside-item mt20 mt-smail-10">
            <div class="single-aside__content__title mb6">
                <span>Поделиться</span>
            </div>
            <script src="https://yastatic.net/share2/share.js"></script>
            <style media="screen">.ya-share2__link_more-button-type_short{display: flex;}</style>
            <div class="ya-share2" data-curtain data-shape="round" data-limit="0"
                data-more-button-type="short"
                data-services="vkontakte,odnoklassniki"></div>
        </div> -->

        <div class="single-aside__content__item aside-item mt20 mt-smail-10">
            <div class="single-aside__content__title mb6">
                <span>Копировать ссылку</span>
            </div>
            <div class="aside-item__content copy-group">
                <div class="copy-group__text to-copy">
                    <?php the_permalink(); ?>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                    <path d="M3.33301 10.5H2.66634C2.31272 10.5 1.97358 10.3596 1.72353 10.1095C1.47348 9.85947 1.33301 9.52033 1.33301 9.16671V3.16671C1.33301 2.81309 1.47348 2.47395 1.72353 2.2239C1.97358 1.97385 2.31272 1.83337 2.66634 1.83337H8.66634C9.01996 1.83337 9.3591 1.97385 9.60915 2.2239C9.8592 2.47395 9.99967 2.81309 9.99967 3.16671V3.83337M7.33301 6.50004H13.333C14.0694 6.50004 14.6663 7.09699 14.6663 7.83337V13.8334C14.6663 14.5698 14.0694 15.1667 13.333 15.1667H7.33301C6.59663 15.1667 5.99967 14.5698 5.99967 13.8334V7.83337C5.99967 7.09699 6.59663 6.50004 7.33301 6.50004Z" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <button class="copy-group__btn copy-btns" type="button" name="button" title="Копировать ссылку"></button>
            </div>
        </div>

        <?php get_contact_information_content(); ?>

    </div>
</aside>

<?php if ( get_additionally_meta('coordinates') ) { ?>
    <script type="text/javascript">
        var coords = '<?php echo get_additionally_meta('coordinates'); ?>';
        var title = '<?php the_title(); ?>';
        var adress = '<?php echo get_additionally_meta('address'); ?>';
        var zoomNum = (glamping_club_ajax.yand_zoom) ? glamping_club_ajax.yand_zoom : 12;
        coords = coords.split(',');
        ymaps.ready(init);
        function init() {
        	var myMap = new ymaps.Map("map", {
        		center: coords,
        		zoom: zoomNum,
                controls: ['zoomControl', 'geolocationControl', 'routeButtonControl', 'fullscreenControl']
        	}, {
        		searchControlProvider: 'yandex#search'
        	});

            var myPlacemark = new ymaps.Placemark(coords, {
                balloonContentHeader: title,
            	balloonContentBody: adress,
    	        //iconCaption: title
                hintContent: title
            }, {
                preset: 'islands#greenMountainIcon',
            });
            myMap.geoObjects.add(myPlacemark);
            myMap.behaviors.disable(['scrollZoom']);
        }
    </script>
<?php } ?>

<?php
// $media = get_attached_media( 'image', $post->ID );
// foreach ($media as $key => $value) {
//     echo wp_get_attachment_image_url( $key, 'glamping-club-thumb' );
//     echo '<br>';
// }
// $meta_object = get_post_meta($post->ID, 'acc_options');
// $meta_object_n = $meta_object[0];
// $meta_object_nn = '';
// if (count($meta_object_n) > 1) {
//
// } else {
//     $meta_object_nn = $meta_object[0][0];
//     foreach ($meta_object_nn as $key => $value) {
//         if (empty($value)) { //проверка на пустоту
//             unset($meta_object_nn[$key]); // Удаляем ключ массива
//         }
//     }
// }
//

// $media = array_unique(glamping_all_img($post->ID), SORT_REGULAR);

// $imgs = glamping_all_img($post->ID);
// $glc_options = get_option( 'glc_options' );

// echo '<pre>';
// var_dump($media);
// echo '<pre>';

// $args = array(
//     'post_type' => 'glampings',
//     'post_status' => 'publish',
//     'posts_per_page' => -1,
//     // 'nopaging'  => true,
//     'orderby' => 'date', //meta_value, meta_value_num, title
//     // 'meta_key' => 'glamping_recommended',
//     'order' => 'DESC',
// );
//
// $gl_posts = get_posts( $args );
//
// $glampings = [];
// $cur_terms = [];
// foreach ($gl_posts as $post_gl) {
//     // setup_postdata( $post );
//     $cur_terms[] = get_the_terms( $post_gl->ID, 'location' );
// }
// wp_reset_postdata();
//
// echo '<pre>';
// var_dump($gl_posts);
// echo '<pre>';

// $data = "owner-12";
// $encryptedData = encryptStringGlc($data);
// $decryptedData = decryptStringGlc($encryptedData);
//
// echo "Encrypted Data: ". $encryptedData. "\n";
// echo '<br>';
// echo "Decrypted Data: ". $decryptedData;

// $data = 'Andrej';
// echo rawurlencode(encryptStringGlc($data));
// echo '<br>';
//
// $owner = rawurldecode('Rvnt6%2Bt8UefMoOG0izHK8Q%3D%3D');
// $user_login = decryptStringGlc($owner);
// echo $user_login;

// $encryptedData = 'iaT8mRQTPe2AktypCFQ1sQ==';
// echo decryptStringGlc($encryptedData);
// explode('-', $date);
//
// echo '<pre>';
// var_dump(explode('-', decryptStringGlc($encryptedData)));
// echo '<pre>';
