<?php
$taxonomy_obj = get_queried_object();
$taxonomy_id = $taxonomy_obj->term_id;
?>
<button class="close-filtr" type="button" name="button">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289Z" fill="#6B8194"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#6B8194"/>
    </svg>
</button>
<div class="glampings-filtr-items">
    <div class="filtr-item btn-map">
        <div class="filtr-item__options btn-group btn-group-map js-btn-map">
            <button id="mapClose" class="secondary fs12 w100 map-close<?php echo template_cookie_value()['btn_close']; ?>" type="button" name="button">Список</button>
            <button id="mapVision" class="secondary fs12 w100 map-vision<?php echo template_cookie_value()['btn_vision']; ?>" type="button" name="button">Карта</button>
        </div>
    </div>

    <div class="filtr-item sorting" title="Сортировка">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text"><?php echo filtr_cookie_value()['title']; ?></div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
            </svg>
        </div>

        <div class="filtr-item__options select sort-glemp">
            <div class="filtr-option" data-value="new_items">
                <div class="filtr-option__text">Новинки</div>
                <svg class="<?php echo filtr_cookie_value('new_items')['class']; ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="11" fill="none" viewBox="0 0 16 11" data-test="checked-option">
                    <path fill="#000" fill-rule="evenodd" d="M15.707.293a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-1.414 0l-5-5a1 1 0 0 1 1.414-1.414L6 8.586 14.293.293a1 1 0 0 1 1.414 0" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="filtr-option" data-value="recommended">
                <div class="filtr-option__text">Рекомендованные</div>
                <svg class="<?php echo filtr_cookie_value('recommended')['class']; ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="11" fill="none" viewBox="0 0 16 11" data-test="checked-option">
                    <path fill="#000" fill-rule="evenodd" d="M15.707.293a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-1.414 0l-5-5a1 1 0 0 1 1.414-1.414L6 8.586 14.293.293a1 1 0 0 1 1.414 0" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="filtr-option" data-value="min_price">
                <div class="filtr-option__text">Сначала дешевые</div>
                <svg class="<?php echo filtr_cookie_value('min_price')['class']; ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="11" fill="none" viewBox="0 0 16 11" data-test="checked-option">
                    <path fill="#000" fill-rule="evenodd" d="M15.707.293a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-1.414 0l-5-5a1 1 0 0 1 1.414-1.414L6 8.586 14.293.293a1 1 0 0 1 1.414 0" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="filtr-option" data-value="max_price">
                <div class="filtr-option__text">Сначала дорогие</div>
                <svg class="<?php echo filtr_cookie_value('max_price')['class']; ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="11" fill="none" viewBox="0 0 16 11" data-test="checked-option">
                    <path fill="#000" fill-rule="evenodd" d="M15.707.293a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-1.414 0l-5-5a1 1 0 0 1 1.414-1.414L6 8.586 14.293.293a1 1 0 0 1 1.414 0" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="filtr-item region-loc">
        <div class="filtr-item__title">
            <div class="filtr-item__title__text">Регионы</div>
            <sup class="filtr-item__title__count"></sup>
        </div>

        <ul class="filtr-item__options region-loc__options item-options-checkbox custom-scroll">
            <?php locations_list_filtr($taxonomy_id);
            ?>
        </ul>
    </div>

    <div class="filtr-item price">
        <div class="filtr-item__title">
            <div class="filtr-item__title__text">Цена</div>
            <sup class="filtr-item__title__count"></sup>
        </div>

        <div class="filtr-item__inputs">
            <div class="group-input">
                <label for="min_price">Мин.</label>
                <input id="min_price" type="text" name="min_price" value="" disabled>
            </div>
            <div class="group-input">
                <label for="max_price">Макс.</label>
                <input id="max_price" type="text" name="max_price" value="" disabled>
            </div>
        </div>
        <div class="filtr-item__slider">
            <div id="glc-slider" class="glc-slider"></div>
        </div>
    </div>

    <div class="filtr-item type">
        <div class="filtr-item__title">
            <div class="filtr-item__title__text">Тип места</div>
            <sup class="filtr-item__title__count"></sup>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll">
            <?php filtr_options_render('type_options'); ?>
        </ul>
    </div>

    <div class="filtr-item allocation">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">Тип размещения</div>
            <sup class="filtr-item__title__count"></sup>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
            </svg>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll select">
            <?php filtr_options_render('allocation_options'); ?>
        </ul>
    </div>

    <div class="filtr-item working">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">Режим работы</div>
            <sup class="filtr-item__title__count"></sup>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
            </svg>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll select">
            <?php filtr_options_render('working_mode_seasons'); ?>
        </ul>
    </div>

    <div class="filtr-item nature">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">Окружение</div>
            <sup class="filtr-item__title__count"></sup>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
            </svg>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll select">
            <?php filtr_options_render('nature_around_options'); ?>
        </ul>
    </div>

    <div class="filtr-item facilities_general">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">В глэмпинге</div>
            <sup class="filtr-item__title__count"></sup>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
            </svg>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll select">
            <?php filtr_options_render('facilities_options_general'); ?>
        </ul>
    </div>

    <div class="filtr-item children">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">Дети</div>
            <sup class="filtr-item__title__count"></sup>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
            </svg>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll select">
            <?php filtr_options_render('facilities_options_children'); ?>
        </ul>
    </div>

    <!-- <div class="filtr-item price">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">В доме</div>
            <div class="filtr-item__title__count"></div>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll">
            <?php //filtr_options_render('facilities_options_home'); ?>
        </ul>
    </div>

    <div class="filtr-item price">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">В ванной комнате</div>
            <div class="filtr-item__title__count"></div>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll">
            <?php //filtr_options_render('facilities_options_bathroom'); ?>
        </ul>
    </div>

    <div class="filtr-item price">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">На кухне</div>
            <div class="filtr-item__title__count"></div>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll">
            <?php //filtr_options_render('facilities_options_kitchen'); ?>
        </ul>
    </div> -->

    <div class="filtr-item entertainment">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">Развлечения</div>
            <sup class="filtr-item__title__count"></sup>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
            </svg>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll select">
            <?php filtr_options_render('entertainment_options'); ?>
        </ul>
    </div>

    <div class="filtr-item territory">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">На территории</div>
            <sup class="filtr-item__title__count"></sup>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
            </svg>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll select">
            <?php filtr_options_render('territory_options'); ?>
        </ul>
    </div>

    <div class="filtr-item safety">
        <div class="filtr-item__title js-filtr-title">
            <div class="filtr-item__title__text">Безопасность</div>
            <sup class="filtr-item__title__count"></sup>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
            </svg>
        </div>

        <ul class="filtr-item__options item-options-checkbox custom-scroll select">
            <?php filtr_options_render('facilities_options_safety'); ?>
        </ul>
    </div>
</div>