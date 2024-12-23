<div class="hystmodal new-modal" id="contact" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <button data-hystclose class="hystmodal__close">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path d="M21 7L7 21M7 7L21 21" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <div class="new-modal__content">
                <div class="modal-title">Заявка на консультацию</div>
                <div class="modal-description">Заполните форму ниже и мы с вами оперативно свяжемся в ближайшие несколько часов.</div>
                <form class="modal-form">
                    <input class="modal-form-input js-autocomplete" type="text" name="name_contact" placeholder="Ваше имя" autocomplete="<?php echo random_number();?>">
                    <input class="modal-form-input js-autocomplete phone_mask" type="text" name="phone_contact" placeholder="Телефон" autocomplete="<?php echo random_number();?>">
                    <div class="group-checkbox">
                        <input id="privacy" class="modal-form-input-checkbox" type="checkbox" name="privacy">
                        <label for="privacy">
                            <span class="check">
                                <svg width="8" height="7" viewBox="0 0 8 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.228199 3.76581C0.102319 3.62451 0.102319 3.3954 0.228199 3.2541C0.354078 3.11279 0.558169 3.11279 0.684049 3.2541L2.74782 5.5708C2.8737 5.71211 2.8737 5.94121 2.74782 6.08252C2.62194 6.22383 2.41785 6.22383 2.29197 6.08252L0.228199 3.76581Z" fill="white"/>
                                    <path d="M7.30976 0.257225C7.4354 0.115269 7.63986 0.114894 7.76591 0.256389C7.89155 0.397427 7.89168 0.626049 7.76621 0.767271L2.89566 6.24905C2.77259 6.38756 2.57276 6.38771 2.44953 6.24937C2.32669 6.11149 2.32637 5.88804 2.4488 5.7497L7.30976 0.257225Z" fill="white"/>
                                </svg>
                            </span>
                            <span class="label">Даю своё согласие на обработку персональных данных</span>
                        </label>
                    </div>
                </form>
                <button id="contact-form-btn" class="contact-form-btn primary golden nxl ntext w-240">Свяжитесь со мной</button>

                <div class="content-success">
                    <div class="modal-title">Спасибо, ваша заявка <br>успешно направлена!</div>
                    <div class="modal-description">В ближайшее время мы свяжемся с <br> вами по указанному номеру.</div>
                </div>
            </div>

        </div>
    </div>
</div>
