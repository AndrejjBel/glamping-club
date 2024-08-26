// --toast-theme-default: #fff;
// --toast-theme-primary: #0d6efd;
// --toast-theme-secondary: #6c757d;
// --toast-theme-success: #198754;
// --toast-theme-danger: #dc3545;
// --toast-theme-warning: #ffc107;
// --toast-theme-info: #0dcaf0;
// --toast-theme-light: #f8f9fa;
// --toast-theme-dark: #212529;

function toast(title, text, theme, autohide, interval) {
    new Toast({
      title: title,
      text: text,
      theme: theme,
      autohide: autohide,
      interval: interval
    });
}
// toast(false, 'Сообщение...', 'success', true, 3000);

const myModal = new HystModal({
    linkAttributeName: "data-hystmodal",
    catchFocus: false,
    backscroll: false,
    // fixedSelectors: 'body',
    afterClose: function(modal){
        // console.log('Message after modal has closed');
        // console.dir(modal._modalBlock); //modal window object
        let form = modal._modalBlock.querySelector('form');
        let textWarning = modal._modalBlock.querySelector('.glc-modal__content__text__warning')
        if (form) {
            form.reset();
        }
        if (textWarning) {
            textWarning.innerHTML = '';
        }
    },
});

const editSettings = () => {
    const userSettingsForm = document.querySelector('#user-settings');
    const settingsSaveBtn = document.querySelector('#user-save');
    const jsSettingsBtn = document.querySelectorAll('.js-settings');
    if ( jsSettingsBtn.length ) {
        jsSettingsBtn.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                console.dir(btn.dataset.action);
                const form = document.querySelector('#'+btn.dataset.action);
                console.dir(form);

                let formData = new FormData(form);
                formData.append('action', 'edit_settings');
                formData.append('nonce', glamping_club_ajax.nonce);
                formData.append('type', btn.dataset.input);
                formData.append('user_id', glamping_club_ajax.marker);
                let test = '';

                jQuery(document).ready( function($){
                    $.ajax({
                        url: glamping_club_ajax.ajaxUrl,
                        method: 'post',
                        processData: false,
                        contentType: false,
                        data: formData,
                        beforeSend: function () {
                            // test = new Toast({
                            //   title: false,
                            //   text: 'Обрабатываем запрос...',
                            //   theme: 'success',
                            //   autohide: false,
                            //   interval: false
                            // });
                        },
                        success: function(data){
                            // test._hide();
                            console.dir(data);
                            data = JSON.parse(data);
                            let warningWrap = document.querySelector('.glc-modal__content__text__warning.'+btn.dataset.input);
                            if (btn.dataset.input == 'name') {
                                warningWrap.innerHTML = `<span class="color-${data.class}">${data.notise}<span>`;
                                warningWrap.classList.add('active');
                                if (data.class == 'success') {
                                    document.querySelector('input#user_name').setAttribute('value', data.value);
                                }
                            }
                            if (btn.dataset.input == 'email') {
                                warningWrap.innerHTML = `<span class="color-${data.class}">${data.notise}<span>`;
                                warningWrap.classList.add('active');
                                if (data.class == 'success') {
                                    document.querySelector('input#user_email').setAttribute('value', data.value);
                                }

                            }
                            if (btn.dataset.input == 'pass') {
                                warningWrap.innerHTML = `<span class="color-${data.class}">${data.notise}<span>`;
                                warningWrap.classList.add('active');
                                if (data.class == 'success') {
                                    myModal.open('#passChangeEnd');
                                    document.querySelector('input#verifi').value = data.verifi_user_pass_change;
                                    // setTimeout(() => {
                                    //     myModal.close();
                                    // }, 4000);
                                }

                            }
                            if (btn.dataset.input == 'pass_new') {
                                warningWrap.innerHTML = `<span class="color-${data.class}">${data.notise}<span>`;
                                warningWrap.classList.add('active');
                                if (data.class == 'success') {
                                    setTimeout(() => {
                                        window.location.href = '/login/';
                                        // location.reload();
                                    }, 4000);
                                }
                            }
                        },
                        error: function (jqXHR, text, error) {
                            console.log('Ошибка отправки.');
                        }
                    });
                });
            });
        });
    }
}
editSettings();
