<div class="filtr-item sorting" title="Сортировка">
    <div class="filtr-item__title js-filtr-title">
        <div class="filtr-item__title__text"><?php echo filtr_cookie_value()['title']; ?></div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M4.251 181.1C7.392 177.7 11.69 175.1 16 175.1c3.891 0 7.781 1.406 10.86 4.25l197.1 181.1l197.1-181.1c6.5-6 16.64-5.625 22.61 .9062c6 6.5 5.594 16.59-.8906 22.59l-208 192c-6.156 5.688-15.56 5.688-21.72 0l-208-192C-1.343 197.7-1.749 187.6 4.251 181.1z"/>
        </svg>
    </div>

    <div class="filtr-item__options select">
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

<div class="filtr-item region">
    <div class="filtr-item__title js-filtr-title">
        <div class="filtr-item__title__text">Регионы</div>
        <div class="filtr-item__title__count"></div>
    </div>

    <ul class="filtr-item__options item-options-checkbox custom-scroll">
        <li>
            <input type="checkbox" id="111" name="Московская область" value="">
            <label for="111">
                <span class="checkmark fcheckbox">
                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
                    </svg>
                </span>
                <span class="name">Московская область</span>
                <span class="count">1</span>
            </label>
        </li>
    </ul>
</div>

<div class="filtr-item price">
    <div class="filtr-item__title js-filtr-title">
        <div class="filtr-item__title__text">Цена</div>
        <div class="filtr-item__title__count"></div>
    </div>

    <div class="filtr-item__inputs">
        <div class="group-input">
            <label for="min_price">Мин.</label>
            <input id="min_price" type="text" name="min_price" value="">
        </div>
        <div class="group-input">
            <label for="max_price">Макс.</label>
            <input id="max_price" type="text" name="max_price" value="">
        </div>
    </div>
    <div class="filtr-item__slider">
        <div id="glc-slider" class="glc-slider"></div>
    </div>
</div>

<div class="filtr-item price">
    <div class="filtr-item__title js-filtr-title">
        <div class="filtr-item__title__text">Тип места</div>
        <div class="filtr-item__title__count"></div>
    </div>

    <!-- <ul class="filtr-item__options item-options-checkbox custom-scroll">
        <li>
            <input type="checkbox" id="111" name="Московская область" value="">
            <label for="111">
                <span class="checkmark fcheckbox">
                    <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
                    </svg>
                </span>
                <span class="name">Московская область</span>
                <span class="count">1</span>
            </label>
        </li>
    </ul> -->
</div>
