<div class="modal modal-based-theme" data-modal="add-review">
    <svg class="modal__cross js-modal-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    <path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"></path>
    </svg>
    <div id="add-rating-modal" class="modal-wrapper">
        <h3 class="modal__title">Добавить отзыв</h3>
        <div class="modal-content margin-top-20">
            <div class="form-add-reviews">
                <div class="form-add-reviews__stars full-stars">
                    <div class="rating-group">
                        <!-- по умолчанию 0 -->
                        <input name="fst" value="0" type="radio" disabled checked />

                        <!-- рейтинг 1 -->
                        <label for="fst-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                            </svg>
                        </label>
                        <input name="fst" id="fst-1" value="1" type="radio" />

                        <!-- рейтинг 2 -->
                        <label for="fst-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                            </svg>
                        </label>
                        <input name="fst" id="fst-2" value="2" type="radio" />

                        <!-- рейтинг 3 -->
                        <label for="fst-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                            </svg>
                        </label>
                        <input name="fst" id="fst-3" value="3" type="radio" />

                        <!-- рейтинг 4 -->
                        <label for="fst-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                            </svg>
                        </label>
                        <input name="fst" id="fst-4" value="4" type="radio" />

                        <!-- рейтинг 5 -->
                        <label for="fst-5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/>
                            </svg>
                        </label>
                        <input name="fst" id="fst-5" value="5" type="radio" />
                    </div>
                    <span class="full-stars-warning">Поставьте оценку</span>
                </div>
                <div class="form-add-reviews__fields">
                    <input id="name" type="text" name="name" value="" placeholder="Ваше имя" />
                    <input id="email" type="text" name="email" value="" placeholder="Ваш E-mail" />
                    <textarea id="text" name="text" rows="8" cols="80" placeholder="Текст отзыва"></textarea>
                </div>
                <span class="form-add-reviews__info">Все поля обязательны к заполнению</span>
                <div class="form-add-reviews__button">
                    <button id="btn-submit" type="button" name="button">Добавить отзыв</button>
                </div>
            </div>
        </div>
    </div>
  </div>
