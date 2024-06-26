<div class="hystmodal" id="faAction" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window" role="dialog" aria-modal="true">
            <button data-hystclose class="hystmodal__close">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <path d="M21 7L7 21M7 7L21 21" stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <div class="tripinglamp-modal fa-action-modal">
                <div class="tripinglamp-modal__content">
                    <div class="tripinglamp-modal__content__text">
                        <h3 class="tripinglamp-modal__content__text__title"><?php esc_html_e( 'Protect account with 2FA', 'tripinglamp' ); ?></h3>
                        <span class="tripinglamp-modal__content__text__subtitle"><?php esc_html_e( 'To activate 2FA scan the QR code or enter the code manually in Google Authenticator', 'tripinglamp' ); ?></span>
                        <div class="address__qr">
                            <img src="<?php echo qrCodeGen()['qr_url']; ?>" alt="<?php //bloginfo( 'QR BTC' ); ?>">
                        </div>
                        <div class="form-group address__field">
                            <label for="wallet-address"><?php esc_html_e( 'Code', 'tripinglamp' ); ?></label>
                            <div class="input-icon">
                                <input id="code" class="input-field to-copy" type="text" name="code" value="<?php echo qrCodeGen()['secret']; ?>" disabled />
                                <svg class="copy-btn" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <g clip-path="url(#clip0_755_176)">
                                        <path d="M3.33334 10H2.66668C2.31305 10 1.97392 9.85953 1.72387 9.60948C1.47382 9.35943 1.33334 9.02029 1.33334 8.66667V2.66667C1.33334 2.31305 1.47382 1.97391 1.72387 1.72386C1.97392 1.47381 2.31305 1.33334 2.66668 1.33334H8.66668C9.0203 1.33334 9.35944 1.47381 9.60949 1.72386C9.85953 1.97391 10 2.31305 10 2.66667V3.33334M7.33334 6H13.3333C14.0697 6 14.6667 6.59696 14.6667 7.33334V13.3333C14.6667 14.0697 14.0697 14.6667 13.3333 14.6667H7.33334C6.59696 14.6667 6.00001 14.0697 6.00001 13.3333V7.33334C6.00001 6.59696 6.59696 6 7.33334 6Z" stroke="#98A2B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_755_176">
                                            <rect width="16" height="16" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                            <a id="refresh-code" class="refresh-code-link" href="#"><?php esc_html_e( 'Refresh', 'tripinglamp' ); ?></a>
                        </div>

                        <form id="form-fa-code" class="form-fa-code">
                            <label for="wallet-address"><?php esc_html_e( 'Google authenticator', 'tripinglamp' ); ?></label>
                            <div class="form-group-email-withdrawal">
                                <input name="code[]" type="number" maxlength="1" placeholder="0" autofocus>
                                <input name="code[]" type="number" maxlength="1" placeholder="0">
                                <input name="code[]" type="number" maxlength="1" placeholder="0">
                                <div class="form-group-check-email__delimiter">
                                    <span>-</span>
                                </div>
                                <input name="code[]" type="number" maxlength="1" placeholder="0">
                                <input name="code[]" type="number" maxlength="1" placeholder="0">
                                <input name="code[]" type="number" maxlength="1" placeholder="0">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tripinglamp-modal__buttons">
                    <!-- <button data-hystclose class="secondary lg"><?php esc_html_e( 'Cancel', 'tripinglamp' ); ?></button> -->
                    <button id="fa-action" class="primary lg js-fa-action w100"><?php esc_html_e( 'Confirm', 'tripinglamp' ); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
