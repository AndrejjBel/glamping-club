<div class="hystmodal" id="passChange" aria-hidden="true">
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
                        <h3 class="glc-modal__content__text__title"><?php esc_html_e( 'Изменить пароль', 'glamping-club' ); ?></h3>
                        <div class="glc-modal__content__text__warning pass"></div>
                        <form id="pass_change_user" class="user-settings-edit">
                            <div class="form-group new-password">
                                <label for="user_pass_curr"><?php _e( 'Текущий пароль', 'glamping-club' );?><span class="color-red"> *</span></label>
                                <div class="input-with-icon">
                                    <input type="password" name="user_pass_curr" id="user_pass_curr" class="input-password" value="">
                                    <svg class="eye-yes pass-eye active" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.57441 12.7075C2.39492 12.4296 2.25003 12.1889 2.14074 12C2.25003 11.8111 2.39492 11.5704 2.57441 11.2925C3.03543 10.5787 3.71817 9.6294 4.60454 8.68394C6.39552 6.77356 8.89951 5 12 5C15.1005 5 17.6045 6.77356 19.3955 8.68394C20.2818 9.6294 20.9646 10.5787 21.4256 11.2925C21.6051 11.5704 21.75 11.8111 21.8593 12C21.75 12.1889 21.6051 12.4296 21.4256 12.7075C20.9646 13.4213 20.2818 14.3706 19.3955 15.3161C17.6045 17.2264 15.1005 19 12 19C8.89951 19 6.39552 17.2264 4.60454 15.3161C3.71817 14.3706 3.03543 13.4213 2.57441 12.7075ZM23 12C23.8944 11.5528 23.8943 11.5524 23.8941 11.5521L23 12ZM23.8941 11.5521C24.0348 11.8336 24.0352 12.1657 23.8944 12.4472L23 12C23.8944 12.4472 23.8938 12.4484 23.8936 12.4488L23.8925 12.4511L23.889 12.458L23.8777 12.4802C23.8681 12.4987 23.8546 12.5247 23.8372 12.5576C23.8025 12.6233 23.752 12.7168 23.686 12.834C23.5542 13.0684 23.3601 13.3985 23.1057 13.7925C22.5979 14.5787 21.8432 15.6294 20.8545 16.6839C18.8955 18.7736 15.8995 21 12 21C8.10049 21 5.10448 18.7736 3.14546 16.6839C2.15683 15.6294 1.40207 14.5787 0.894336 13.7925C0.63985 13.3985 0.445792 13.0684 0.313971 12.834C0.248023 12.7168 0.19754 12.6233 0.162753 12.5576C0.145357 12.5247 0.131875 12.4987 0.122338 12.4802L0.11099 12.458L0.107539 12.4511L0.105573 12.4472L0.999491 12.0003C0.111724 12.4441 0.105434 12.4468 0.105569 12.4472L0.105573 12.4472C-0.0351909 12.1657 -0.0351909 11.8343 0.105573 11.5528L1 12C0.105573 11.5528 0.106186 11.5516 0.10637 11.5512L0.107539 11.5489L0.11099 11.542L0.122338 11.5198C0.131875 11.5013 0.145357 11.4753 0.162753 11.4424C0.19754 11.3767 0.248023 11.2832 0.313971 11.166C0.445792 10.9316 0.63985 10.6015 0.894336 10.2075C1.40207 9.42131 2.15683 8.3706 3.14546 7.31606C5.10448 5.22644 8.10049 3 12 3C15.8995 3 18.8955 5.22644 20.8545 7.31606C21.8432 8.3706 22.5979 9.42131 23.1057 10.2075C23.3601 10.6015 23.5542 10.9316 23.686 11.166C23.752 11.2832 23.8025 11.3767 23.8372 11.4424C23.8546 11.4753 23.8681 11.5013 23.8777 11.5198L23.889 11.542L23.8925 11.5489L23.8941 11.5521ZM10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12ZM12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8Z" fill="#9d9d9d"></path>
                                    </svg>
                                    <svg class="eye-no pass-eye" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_324_10684)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L4.56849 5.9827C2.7597 7.53968 1.25036 9.41852 0.118844 11.5272C-0.0347895 11.8135 -0.0397387 12.1566 0.105573 12.4472L1 12C0.105573 12.4472 0.106186 12.4485 0.10637 12.4488L0.107539 12.4512L0.11099 12.458L0.122338 12.4802C0.131875 12.4988 0.145357 12.5247 0.162753 12.5576C0.19754 12.6233 0.248023 12.7168 0.313971 12.834C0.445792 13.0684 0.63985 13.3985 0.894336 13.7926C1.40207 14.5787 2.15683 15.6294 3.14546 16.684C5.10448 18.7736 8.10049 21 12 21L12.0163 20.9999C14.0848 20.9661 16.0962 20.3536 17.8261 19.2403L22.2929 23.7071C22.6834 24.0976 23.3166 24.0976 23.7071 23.7071C24.0976 23.3166 24.0976 22.6834 23.7071 22.2929L18.6471 17.2329L14.8311 13.4169L14.824 13.4098L10.5901 9.17595L10.5832 9.16899L6.76711 5.35292L1.70711 0.292893ZM16.3714 17.7856L14.0497 15.464C13.891 15.5635 13.7251 15.652 13.5531 15.7286C13.0625 15.9472 12.5328 16.0648 11.9957 16.0742C11.4586 16.0837 10.9252 15.9849 10.4271 15.7837C9.92902 15.5826 9.47657 15.2831 9.09674 14.9033C8.71691 14.5235 8.41747 14.071 8.21629 13.5729C8.01511 13.0749 7.91631 12.5414 7.92579 12.0043C7.93527 11.4672 8.05282 10.9375 8.27145 10.4469C8.34805 10.2749 8.43652 10.109 8.53604 9.95028L5.9871 7.40134C4.45031 8.7014 3.14935 10.2582 2.14257 12.0032C2.25165 12.1916 2.39592 12.4311 2.57441 12.7075C3.03543 13.4213 3.71817 14.3706 4.60454 15.3161C6.39395 17.2248 8.89512 18.9969 11.9918 19C13.5373 18.9734 15.0437 18.5524 16.3714 17.7856ZM10.0279 11.4421C9.96372 11.6346 9.92907 11.836 9.92548 12.0396C9.92074 12.3081 9.97014 12.5749 10.0707 12.8239C10.1713 13.0729 10.321 13.2992 10.511 13.4891C10.7009 13.679 10.9271 13.8287 11.1761 13.9293C11.4252 14.0299 11.6919 14.0793 11.9604 14.0745C12.164 14.071 12.3655 14.0363 12.5579 13.9721L10.0279 11.4421ZM20.7526 13.6877L12.0732 5.00035C15.1399 5.02799 17.6186 6.78864 19.3955 8.68397C20.2818 9.62943 20.9646 10.5787 21.4256 11.2926C21.6044 11.5694 21.7488 11.8093 21.858 11.9978C21.5223 12.582 21.1532 13.1462 20.7526 13.6877ZM23 12L23.8944 11.5528C23.8946 11.5532 23.8944 11.5528 23 12ZM23.8819 12.4714C24.0348 12.1854 24.0395 11.8429 23.8944 11.5528L23.8925 11.5489L23.889 11.5421L23.8777 11.5198C23.8681 11.5013 23.8546 11.4753 23.8372 11.4425C23.8025 11.3767 23.752 11.2833 23.686 11.166C23.5542 10.9317 23.3601 10.6015 23.1057 10.2075C22.5979 9.42134 21.8432 8.37062 20.8545 7.31608C18.8957 5.22667 15.9001 3.00046 12.0012 3.00003C11.2171 2.99828 10.4355 3.08765 9.67209 3.26634C9.31876 3.34905 9.03796 3.61668 8.93838 3.96563C8.83881 4.31458 8.93609 4.69009 9.19257 4.94681L20.1326 15.8968C20.3306 16.095 20.6027 16.2011 20.8827 16.1891C21.1627 16.1771 21.4247 16.0483 21.6052 15.8339C22.479 14.7953 23.2421 13.6684 23.8819 12.4714ZM12.0012 3.00003L12 3.00003V4.00003L12.0023 3.00003L12.0012 3.00003Z" fill="#9d9d9d"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="glc-modal__buttons">
                    <button data-hystclose class="secondary lg"><?php esc_html_e( 'Закрыть', 'glamping-club' ); ?></button>
                    <button class="primary lg js-settings" data-input="pass" data-action="pass_change_user"><?php esc_html_e( 'Далее', 'glamping-club' ); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
