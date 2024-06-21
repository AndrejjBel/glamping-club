const passwordVision = () => {
    const inputWithIcon = document.querySelectorAll('form .input-with-icon')
    if ( inputWithIcon.length > 0 ) {
        const icons = document.querySelectorAll('form .input-with-icon svg')
        const input = document.querySelector('form .input-with-icon input')
        icons.forEach((icon) => {
            icon.addEventListener('click', function() {
                if ( icon.classList.contains('pass-eye') ) {
                    if ( icon.parentElement.children[0].type == 'password' ) {
                        icon.parentElement.children[0].type = 'text'
                    } else {
                        icon.parentElement.children[0].type = 'password'
                    }
                    icon.parentElement.children[1].classList.toggle('active')
                    icon.parentElement.children[2].classList.toggle('active')
                }
            })
        });
    }
}
passwordVision()

const regUser = () => {
    const registerform = document.querySelector('#registerform')
    if ( registerform ) {
        const contentWarnings = document.querySelector('.auth-reg__content__warnings')
        const userPass = document.querySelector('#user_pass')
        const btnGeneratePassword = document.querySelector('#generate-password')
        const result = document.querySelector('.password-complexity__result')

        userPass.addEventListener('input', (e) => {
            checkPasswordStrength(userPass, result,	['black', 'listed', 'word']);     // Blacklisted words
        })

        btnGeneratePassword.addEventListener('click', (e) => {
            e.preventDefault();
            userPass.value = genPassword.get( 12, 1, 1, 1);
            checkPasswordStrength(userPass, result,	['black', 'listed', 'word']);
            // passRegSpanRegex.classList.remove("active")
            // password.style.border = ''
        })

        registerform.button.addEventListener('click', (e) => {
            e.preventDefault();
            let formData = new FormData(registerform);
            formData.append('action', 'reg_user');
            formData.append('nonce', glamping_club_ajax.nonce);

            jQuery(document).ready( function($){
                $.ajax({
                    url: glamping_club_ajax.ajaxUrl,
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {
                        // resultSuccess.innerHTML = `<p class="color-green fs-20 mt40">${cuccessText}</p>`;
                    },
                    success: function(data){
                        contentWarnings.innerHTML = ''
                        contentWarnings.style.display = 'none'
                        console.dir(data);
                        var data_json = JSON.parse(data);
                        if (data_json.class == 'errors') {
                            if (document.querySelector('.toast-container')) {
                                document.querySelector('.toast-container').innerHTML = ''
                            }
                            contentWarnings.insertAdjacentHTML(
                                'beforeEnd',
                                `<p class="color-red">Заполните все обязательные поля</p>`
                            );
                            contentWarnings.style.display = 'block';
                            for (var variable in data_json) {
                                if (variable != 'class') {
                                    // contentWarnings.insertAdjacentHTML(
                                    //     'beforeEnd',
                                    //     `<p class="color-red">${data_json[variable]}</p>`
                                    // );
                                    // contentWarnings.style.display = 'block';

                                    new Toast({
                                        title: false,
                                        text: data_json[variable],
                                        theme: 'danger',
                                        autohide: true,
                                        interval: 10000
                                    });
                                }
                            }
                        } else {
                            contentWarnings.innerHTML = `<p class="color-success">Регистрация на сайте прошла успешно, необходимо подтвердить E-mail, Вам отправлено письмо с инструкциями для подтверждения, если письма нет, проверьте папку спам</p>`;
                            contentWarnings.style.display = 'block';
                            registerform.reset();
                            // setTimeout(() => {
                            //     window.location.href = "/login/";
                            // }, 3000);
                        }
                    },
                    error: function (jqXHR, text, error) {
                        console.log('Ошибка отправки.');
                    }
                });
            });

        });
    }
}
regUser();

const emailForgotActions = () => {
    const forgotForm = document.querySelector('#forgot');
    if ( forgotForm ) {
        const forgotFormBtn = document.querySelector('#forgot-send');
        const contentWarnings = document.querySelector('.auth-reg__content__warnings')
        const contentInfo = document.querySelector('.auth-reg__content__info')
        forgotFormBtn.addEventListener('click', (e) => {
            e.preventDefault();
            let formData = new FormData(forgotForm);
            formData.append('action', 'emailverifi');
            formData.append('nonce', glamping_club_ajax.nonce);

            jQuery(document).ready( function($){
                $.ajax({
                    url: glamping_club_ajax.ajaxUrl,
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {
                        // resultSuccess.innerHTML = `<p class="color-green fs-20 mt40">${cuccessText}</p>`;
                    },
                    success: function(data){
                        contentWarnings.innerHTML = ''
                        contentWarnings.style.display = 'none'
                        console.dir(data);
                        var data_json = JSON.parse(data);
                        if (data_json.class == 'errors') {
                            if (document.querySelector('.toast-container')) {
                                document.querySelector('.toast-container').innerHTML = ''
                            }
                            contentWarnings.insertAdjacentHTML(
                                'beforeEnd',
                                `<p class="color-red">Заполните все обязательные поля</p>`
                            );
                            contentWarnings.style.display = 'block';
                            for (var variable in data_json) {
                                if (variable != 'class') {
                                    // contentWarnings.insertAdjacentHTML(
                                    //     'beforeEnd',
                                    //     `<p class="color-red">${data_json[variable]}</p>`
                                    // );
                                    // contentWarnings.style.display = 'block';

                                    new Toast({
                                        title: false,
                                        text: data_json[variable],
                                        theme: 'danger',
                                        autohide: true,
                                        interval: 10000
                                    });
                                }
                            }
                        }
                        else {
                            contentInfo.innerHTML = `<p class="color-success">${data_json.success_send_mail}</p>`;
                            forgotForm.reset();
                            // contentWarnings.style.display = 'block';
                            // setTimeout(() => {
                            //     window.location.href = "/login/";
                            // }, 3000);
                        }
                    },
                    error: function (jqXHR, text, error) {
                        console.log('Ошибка отправки.');
                    }
                });
            });

        });
    }
}
emailForgotActions();

const userRecoveryPass = () => {
    const forgotForm = document.querySelector('#new-password-form');
    const forgotFormBtn = document.querySelector('#forgot-send');
    if ( forgotForm ) {
        const contentWarnings = document.querySelector('.auth-reg__content__warnings')
        forgotFormBtn.addEventListener('click', (e) => {
            e.preventDefault();
            let formData = new FormData(forgotForm);
            formData.append('action', 'new_user_pass');
            formData.append('nonce', glamping_club_ajax.nonce);

            jQuery(document).ready( function($){
                $.ajax({
                    url: glamping_club_ajax.ajaxUrl,
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {
                        // resultSuccess.innerHTML = `<p class="color-green fs-20 mt40">${cuccessText}</p>`;
                    },
                    success: function(data){
                        contentWarnings.innerHTML = ''
                        contentWarnings.style.display = 'none'
                        console.dir(data);
                        var data_json = JSON.parse(data);
                        if (data_json.class == 'errors') {
                            if (document.querySelector('.toast-container')) {
                                document.querySelector('.toast-container').innerHTML = ''
                            }
                            contentWarnings.insertAdjacentHTML(
                                'beforeEnd',
                                `<p class="color-red">Заполните все обязательные поля</p>`
                            );
                            contentWarnings.style.display = 'block';
                            for (var variable in data_json) {
                                if (variable != 'class') {
                                    // contentWarnings.insertAdjacentHTML(
                                    //     'beforeEnd',
                                    //     `<p class="color-red">${data_json[variable]}</p>`
                                    // );
                                    // contentWarnings.style.display = 'block';

                                    new Toast({
                                        title: false,
                                        text: data_json[variable],
                                        theme: 'danger',
                                        autohide: true,
                                        interval: 10000
                                    });
                                }
                            }
                        }
                        else {
                            contentWarnings.innerHTML = `<p class="color-success">${data_json.notise}</p>`;
                            contentWarnings.style.display = 'block';
                            forgotForm.reset();
                            setTimeout(() => {
                                window.location.href = "/login/";
                            }, 3000);
                        }
                    },
                    error: function (jqXHR, text, error) {
                        console.log('Ошибка отправки.');
                    }
                });
            });

        });
    }
}
userRecoveryPass();

const newPassword = () => {
    const registerform = document.querySelector('#registerform')
    const newPasswordForm = document.querySelector('#new-password-form')
    const userSettingsForm = document.querySelector('#user-settings')
    if ( registerform || newPasswordForm || userSettingsForm ) {
        const btnGeneratePassword = document.querySelector('#generate-password')
        const newPassword = document.querySelector('#user_pass')
        const newPasswordAgain = document.querySelector('#new_password_again')
        const result = document.querySelector('.password-complexity__result')

        if ( newPassword ) {
            newPassword.addEventListener('input', (e) => {
                checkPasswordStrength(newPassword, result,	['black', 'listed', 'word']);
            })

            if ( btnGeneratePassword ) {
                btnGeneratePassword.addEventListener('click', (e) => {
                    e.preventDefault();
                    let newPassGen = genPassword.get( 12, 1, 1, 1);
                    newPassword.value = newPassGen;
                    if ( newPasswordAgain ) {
                        newPasswordAgain.value = newPassGen;
                    }
                    checkPasswordStrength(newPassword, result,	['black', 'listed', 'word']);
                })
            }
        }
    }
}
newPassword();

var genPassword = (function() {
    return {
        get: function (passwordLength, hasUpperLower, hasDigit, hasSpecial, skipChars, elem, elemRepeat) {
            passwordLength = passwordLength || 6;
            hasUpperLower = typeof hasUpperLower === 'undefined' ? 1 : hasUpperLower;
            hasDigit = typeof hasDigit === 'undefined' ? 1 : hasDigit;
            hasSpecial = typeof hasSpecial === 'undefined' ? 0 : hasSpecial;
            skipChars = skipChars || '0oOIl@';

            var password = '';
            var digitChars = '1234567890';
            var lowerChars = 'abcdefghijklmnopqrstuvwxyz';
            var upperChars = lowerChars.toUpperCase();
            var specialChars = '!@#$%^&*()_+';

            // exclude some characters, by default 0 o O I l @
            lowerChars = lowerChars.replace(new RegExp('['+skipChars+']','g'),'');
            upperChars = upperChars.replace(new RegExp('['+skipChars+']','g'),'');
            digitChars = digitChars.replace(new RegExp('['+skipChars+']','g'),'');
            specialChars = specialChars.replace(new RegExp('['+skipChars+']','g'),'');

            // what if everyone is excluded
            if (!lowerChars)
            throw 'Error, all lower chars removed!';
            if (hasUpperLower && !upperChars)
            throw 'Error, all upper chars removed!';
            if (hasSpecial && !specialChars)
            throw 'Error, all special chars removed!';
            if (hasDigit && !digitChars)
            throw 'Error, all digits chars removed!';

            // not enough
            var minLength = passwordLength - 1 - hasUpperLower - hasDigit - hasSpecial;

            if (minLength<0)
            throw 'Error, increase password length or simple password strength!';

            // take one required character
            function randomChar(charSet) {
                Math.random();
                return charSet[ Math.floor(Math.random() * charSet.length) ];
            }
            password += randomChar(lowerChars);
            if (hasUpperLower) {
                password += randomChar(upperChars);
                lowerChars += upperChars;
            }
            if (hasDigit) {
                password += randomChar(digitChars);
                lowerChars += digitChars;
            }
            if (hasSpecial) {
                password += randomChar(specialChars);
                lowerChars += specialChars;
            }

            // add the remaining characters of the password
            while (passwordLength > password.length) {
                password += randomChar(lowerChars);
            }

            // mix, otherwise the first characters lUdSc
            return password.split('').sort(function(){return 0.5 - Math.random();}).join('');
    }}
}());

function checkPasswordStrength( pass, result, blacklistArray ) {
    var pass = pass.value;
    blacklistArray = blacklistArray.concat( wp.passwordStrength.userInputDisallowedList() )
    var strength = wp.passwordStrength.meter( pass, blacklistArray );
    result.innerText = ''
    if ( strength <= 1 ) {
        result.innerText = tripinglamp_pwsl.bad
        result.parentElement.style.color = 'red'
    } else if ( strength == 2 || strength == 3 ) {
        result.innerText = tripinglamp_pwsl.good
        result.parentElement.style.color = 'orange'
    } else if ( strength >= 4 ) {
        result.innerText = tripinglamp_pwsl.strong
        result.parentElement.style.color = 'green'
    }
}
