<?php
$maxchar = 180;
if (!empty($_COOKIE['mediaQuery'])) {
    if ($_COOKIE['mediaQuery'] > 767) {
        $maxchar = 400;
    } elseif ($_COOKIE['mediaQuery'] > 567) {
        $maxchar = 280;
    } elseif ($_COOKIE['mediaQuery'] > 429) {
        $maxchar = 220;
    }
}
$cur_user_id = get_current_user_id();
// $additionally_field = (object)$post->additionally_field[0];
$statistics = glampings_reviews_statistic($post->ID);
$count_rating = $statistics['count'];
$average_rating = $statistics['average_rating'];
$count_content_symbol = mb_strlen(get_the_content());

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ($post->post_status != 'publish') { ?>
        <h3 class="post-pending">Глэмпинг находится на модерации</h3>
    <?php } ?>

    <div class="images-wrap">
        <div class="images">
            <div id="single-thumbnail" class="images__gallery thumbnail-gallery">
                <?php glamping_single_thumbnail($post->ID); ?>
            </div>
        </div>

        <div class="meta mt10 mt-smail-10">
            <div class="meta__item item-rating">
                <?php if ($count_rating) { ?>
                    <a href="#reviews-section">
                        <?php get_rating_post($average_rating, $count_rating); ?>
                    </a>
                <?php
                } else {
                    get_rating_post($average_rating, $count_rating);
                }
                ?>
            </div>

            <!-- <div class="meta__item item-views" title="Просмотры">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path d="M160 256C160 185.3 217.3 128 288 128C358.7 128 416 185.3 416 256C416 326.7 358.7 384 288 384C217.3 384 160 326.7 160 256zM288 336C332.2 336 368 300.2 368 256C368 211.8 332.2 176 288 176C287.3 176 286.7 176 285.1 176C287.3 181.1 288 186.5 288 192C288 227.3 259.3 256 224 256C218.5 256 213.1 255.3 208 253.1C208 254.7 208 255.3 208 255.1C208 300.2 243.8 336 288 336L288 336zM95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6V112.6zM288 80C222.8 80 169.2 109.6 128.1 147.7C89.6 183.5 63.02 225.1 49.44 256C63.02 286 89.6 328.5 128.1 364.3C169.2 402.4 222.8 432 288 432C353.2 432 406.8 402.4 447.9 364.3C486.4 328.5 512.1 286 526.6 256C512.1 225.1 486.4 183.5 447.9 147.7C406.8 109.6 353.2 80 288 80V80z"/>
                </svg>
                <span><?php //echo $post->views; ?></span>
            </div> -->
        </div>
    </div>

    <div class="single-content-wrap">

        <div class="single-content">
            <div class="single-section title">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                <div class="title__address mb10">
                    <a href="https://yandex.ru/maps/?rtext=~<?php echo get_additionally_meta('coordinates'); ?>"
                        target="_blank"
        				rel="nofollow"
                        title="Построить маршрут">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C9.87827 2 7.84344 2.84285 6.34315 4.34315C4.84285 5.84344 4 7.87827 4 10C4 13.0981 6.01574 16.1042 8.22595 18.4373C9.31061 19.5822 10.3987 20.5195 11.2167 21.1708C11.5211 21.4133 11.787 21.6152 12 21.7726C12.213 21.6152 12.4789 21.4133 12.7833 21.1708C13.6013 20.5195 14.6894 19.5822 15.774 18.4373C17.9843 16.1042 20 13.0981 20 10C20 7.87827 19.1571 5.84344 17.6569 4.34315C16.1566 2.84285 14.1217 2 12 2ZM12 23C11.4453 23.8321 11.445 23.8319 11.4448 23.8317L11.4419 23.8298L11.4352 23.8253L11.4123 23.8098C11.3928 23.7966 11.3651 23.7776 11.3296 23.753C11.2585 23.7038 11.1565 23.6321 11.0278 23.5392C10.7705 23.3534 10.4064 23.0822 9.97082 22.7354C9.10133 22.043 7.93939 21.0428 6.77405 19.8127C4.48426 17.3958 2 13.9019 2 10C2 7.34784 3.05357 4.8043 4.92893 2.92893C6.8043 1.05357 9.34784 0 12 0C14.6522 0 17.1957 1.05357 19.0711 2.92893C20.9464 4.8043 22 7.34784 22 10C22 13.9019 19.5157 17.3958 17.226 19.8127C16.0606 21.0428 14.8987 22.043 14.0292 22.7354C13.5936 23.0822 13.2295 23.3534 12.9722 23.5392C12.8435 23.6321 12.7415 23.7038 12.6704 23.753C12.6349 23.7776 12.6072 23.7966 12.5877 23.8098L12.5648 23.8253L12.5581 23.8298L12.556 23.8312C12.5557 23.8314 12.5547 23.8321 12 23ZM12 23L12.5547 23.8321C12.2188 24.056 11.7807 24.0556 11.4448 23.8317L12 23Z" fill="black"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8ZM8 10C8 7.79086 9.79086 6 12 6C14.2091 6 16 7.79086 16 10C16 12.2091 14.2091 14 12 14C9.79086 14 8 12.2091 8 10Z" fill="black"></path>
                        </svg>
                        <?php echo get_additionally_meta('address'); ?>
                    </a>
                </div>
            </div>

            <div class="single-section description">
                <div class="single-section__content collapse-content-descr">
                    <?php echo apply_filters( 'the_content', get_the_content() ); ?>
                </div>
                <div class="single-section__content collapse-content-descr active">
                    <?php echo replace_quotes(kama_excerpt([ 'maxchar' => $maxchar ])); ?>
                </div>
                <?php if ($count_content_symbol > 400) {?>
                    <div class="collapse-content-btn js-btn-descr">
                        <span>Развернуть описание</span>
                        <svg width="15" height="7" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L8 8L15 1" stroke="#161616" stroke-width="1.5"/>
                        </svg>
                    </div>
                <?php } ?>
            </div>

            <div class="single-section facilities-wrap">
                <div class="facilities">
                    <?php
                    glamping_icons_facilities('glamping_facilities_general', 'Удобства общие');
                    glamping_icons_facilities('glamping_territory', 'Территория');
                    glamping_icons_facilities('glamping_entertainment', 'Развлечения');
                    glamping_icons_facilities('glamping_nutrition', 'Питание');
                    glamping_icons_facilities('facilities_general_kitchen', 'Кухня');
                    glamping_icons_facilities('facilities_general_bathroom', 'Ванная комната');
                    glamping_icons_facilities('facilities_options_children', 'Для детей');
                    glamping_icons_facilities('glamping_facilities_safety', 'Безопасность');
                    ?>
                </div>
                <button class="primary-light green nxl ntext w-200 js-facilities-more" data-type="no">Показать все удобства</button>
            </div>

            <div class="single-section conditions">
                <div class="single-section__title">
                    <h3>Условия размещения</h3>
                </div>
                <div class="single-section__content">
                    <?php get_additionally_content(); ?>
                </div>
            </div>

            <?php get_accommodation_options_new(); ?>

            <!-- <?php //if ( get_additionally_meta('coordinates') ) { ?>
                <div id="map-container" class="single-section map">
                    <div class="single-section__title">
                        <h3>Карта</h3>
                    </div>
                    <div id="map" class="single-section__content"></div>
                </div>
            <?php //} ?> -->

            <?php wtd_item($post->wtd_options); ?>
            <?php faq_item($post->faq_options); ?>
            <?php glemp_stocs($post->ID); ?>

            <div id="reviews-section" class="single-section reviews">
                <div class="single-section__title">
                    <div class="single-section__title">
                        <h3>Отзывы</h3>
                    </div>
                    <div class="reviews-items">
                        <?php glampings_reviews_items(); ?>
                    </div>
                </div>
            </div>

            <div class="reviews-items__button-more">
                <button class="primary-light green nxl ntext w-200 js-reviews-more mb-10" type="button" name="button"
                data-count="<?php echo $statistics['count']; ?>"
                data-pagenum="1"
                data-post="<?php echo $post->ID; ?>">Показать еще отзывы</button>
            </div>
            <button data-modal="add-review" class="primary golden nxl ntext w-200 js-open-modal" type="button" name="button">Написать отзыв</button>
        </div>

        <aside class="single-aside">
            <div id="aside-content" class="single-aside__content">
                <div class="single-aside__content__item aside-item favorites-comparison">
                    <div class="btn-group add-favorites-comparison">
                        <button id="add-favorites" data-postid="<?php the_ID(); ?>" class="round-sup-red single" type="button" name="button" title="Добавить в избранное">
                            <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
                            </svg>
                        </button>
                        <button id="add-comparison" data-postid="<?php the_ID(); ?>" class="round-sup-red single comparison-btn" type="button" name="button" title="Добавить к сравнению">
                            <svg class="rotate90" width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
                            </svg>
                        </button>

                        <!-- <button id="yand-share" type="button" name="button">
                            <svg width="15.000000" height="17.000000" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path id="Vector" d="M12.5 17C11.8 17 11.21 16.75 10.72 16.25C10.24 15.75 10 15.15 10 14.44C10 14.36 10.02 14.16 10.06 13.85L4.2 10.36C3.98 10.58 3.72 10.75 3.43 10.86C3.14 10.99 2.83 11.05 2.5 11.05C1.8 11.05 1.21 10.8 0.72 10.3C0.24 9.81 0 9.2 0 8.5C0 7.79 0.24 7.18 0.72 6.69C1.21 6.19 1.8 5.94 2.5 5.94C2.83 5.94 3.14 6 3.43 6.13C3.72 6.25 3.98 6.41 4.2 6.63L10.06 3.14C10.03 3.04 10.01 2.95 10.01 2.85C10 2.76 10 2.66 10 2.55C10 1.84 10.24 1.24 10.72 0.74C11.21 0.24 11.8 0 12.5 0C13.19 0 13.78 0.24 14.27 0.74C14.75 1.24 15 1.84 15 2.55C15 3.25 14.75 3.86 14.27 4.35C13.78 4.85 13.19 5.09 12.5 5.09C12.16 5.09 11.85 5.03 11.56 4.91C11.27 4.79 11.01 4.63 10.79 4.41L4.93 7.9C4.96 8 4.98 8.09 4.99 8.19C4.99 8.28 5 8.38 5 8.5C4.99 8.61 4.99 8.71 4.99 8.8C4.98 8.9 4.96 8.99 4.93 9.09L10.79 12.58C11.01 12.36 11.27 12.2 11.56 12.08C11.85 11.96 12.16 11.9 12.5 11.9C13.19 11.9 13.78 12.14 14.27 12.64C14.75 13.13 15 13.74 15 14.44C15 15.15 14.75 15.75 14.27 16.25C13.78 16.75 13.19 17 12.5 17Z" fill="#5E6D77" fill-opacity="1.000000" fill-rule="evenodd"/>
                            </svg>
                        </button> -->

                        <script src="https://yastatic.net/share2/share.js"></script>
                        <style media="screen">
                            .ya-share2__container_size_m .ya-share2__item_more.ya-share2__item_has-pretty-view .ya-share2__link_more.ya-share2__link_more-button-type_short {
                                display: flex;
                                border: 1px solid rgb(94, 109, 119);
                                background: rgb(255, 255, 255);
                            }
                            .ya-share2__item_more.ya-share2__item_has-pretty-view .ya-share2__icon_more {
                                background-image: url(data:image/svg+xml,%3Csvg%20width=%2716%27%20height=%2716%27%20fill=%27none%27%20xmlns=%27http://www.w3.org/2000/svg%27%3E%3Cpath%20d=%27M14.6%202.9a2.7%202.7%200%2001-4.554%201.963L5.303%207.28a2.702%202.702%200%20010%201.44l4.743%202.417a2.7%202.7%200%2011-.834%201.708l-5.05-2.575a2.7%202.7%200%20110-4.54l5.05-2.575A2.7%202.7%200%201114.6%202.9z%27%20fill=%27%235E6D77%27/%3E%3C/svg%3E);
                            }
                        </style>
                        <div class="ya-share2" data-curtain data-shape="round" data-limit="0"
                            data-more-button-type="short"
                            data-services="vkontakte,odnoklassniki" title="Поделиться"></div>
                    </div>
                </div>

                <!-- <div class="single-aside__content__item aside-item mt20 mt-smail-10">
                    <div class="single-aside__content__title mb6">
                        <span>Копировать ссылку</span>
                    </div>
                    <div class="aside-item__content copy-group">
                        <div class="copy-group__text to-copy">
                            <?php //the_permalink(); ?>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                            <path d="M3.33301 10.5H2.66634C2.31272 10.5 1.97358 10.3596 1.72353 10.1095C1.47348 9.85947 1.33301 9.52033 1.33301 9.16671V3.16671C1.33301 2.81309 1.47348 2.47395 1.72353 2.2239C1.97358 1.97385 2.31272 1.83337 2.66634 1.83337H8.66634C9.01996 1.83337 9.3591 1.97385 9.60915 2.2239C9.8592 2.47395 9.99967 2.81309 9.99967 3.16671V3.83337M7.33301 6.50004H13.333C14.0694 6.50004 14.6663 7.09699 14.6663 7.83337V13.8334C14.6663 14.5698 14.0694 15.1667 13.333 15.1667H7.33301C6.59663 15.1667 5.99967 14.5698 5.99967 13.8334V7.83337C5.99967 7.09699 6.59663 6.50004 7.33301 6.50004Z" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <button class="copy-group__btn copy-btns" type="button" name="button" title="Копировать ссылку"></button>
                    </div>
                </div> -->

                <?php get_contact_information_content(); ?>

            </div>
        </aside>

    </div>

</article><!-- #post-<?php the_ID(); ?> -->

<div class="modal modal-based-theme acc-details" data-modal="acc-details-test">
    <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"></path>
    </svg>
    <h3 class="modal__title">Изменение статуса публикации</h3>
    <div class="modal-content margin-top-20">
        <p>Вы хотите <span id="status">отправить в архив</span> <span id="modal-post-title">Создание сайтов любой сложности</span>?</p>
        <div class="modal-content-btn margin-top-20">
            <button class="button" id="yes">Да, <span id="status-btn-text">отправить в архив</span>
            </button><button class="button js-modal-close" id="no">Нет, не надо
            </button>
        </div>
    </div>
</div>

<?php //if ( get_additionally_meta('coordinates') ) { ?>
    <!-- <script type="text/javascript">
        var coords = '<?php //echo get_additionally_meta('coordinates'); ?>';
        var title = '<?php //the_title(); ?>';
        var adress = '<?php //echo get_additionally_meta('address'); ?>';
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
                hintContent: title
            }, {
                preset: 'islands#darkBlueMountainIcon',
            });
            myMap.geoObjects.add(myPlacemark);
            myMap.behaviors.disable(['scrollZoom']);
        }
    </script> -->
<?php //}
get_template_part( 'template-parts/popups/add-rating' );

// $text = 'Индивидуальная ванная комната';
// $value_pl = explode(' ', $text);
// $num_el = count($value_pl)-1;
// $end_el = $value_pl[$num_el];
// array_pop($value_pl);
// $value_text = '<span>';
// $value_text .= implode(" ", $value_pl) . '<span>' . $end_el . '</span> <span class="icon-text-red">₽</span>';
// $value_text .= '</span>';
//
// echo '<pre>';
// var_dump($value_text);
// echo '<pre>';
