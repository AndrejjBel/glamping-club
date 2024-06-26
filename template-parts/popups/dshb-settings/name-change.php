<?php global $current_user; ?>
<div class="hystmodal" id="nameChange" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <button data-hystclose class="hystmodal__close">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path d="M21 7L7 21M7 7L21 21" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <div class="glc-modal">
                <div class="glc-modal__content">
                    <div class="glc-modal__content__text">
                        <h3 class="glc-modal__content__text__title"><?php esc_html_e( 'Изменить имя', 'glamping-club' ); ?></h3>
                        <div class="glc-modal__content__text__warning name"></div>
                        <form id="name_change_user"class="user-settings-edit">
                            <div class="form-group">
                                <label for="user_new_name"><?php _e( 'Новое имя', 'glamping-club' );?> <span class="color-red">*</span></label>
                                <input type="text" id="user_new_name" name="user_new_name" value="<?php //echo $current_user->display_name; ?>">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="glc-modal__buttons">
                    <button data-hystclose class="secondary lg"><?php esc_html_e( 'Закрыть', 'glamping-club' ); ?></button>
                    <button class="primary lg js-settings" data-input="name" data-action="name_change_user"><?php esc_html_e( 'Изменить', 'glamping-club' ); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
