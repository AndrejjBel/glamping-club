window.addEventListener('load', () => {
    const isBackForward = window.performance && performance.navigation && performance.navigation.type === 2;
    const inputs = document.querySelectorAll('.filtr-item input[type="checkbox"]');
    if (inputs.length) {
        if (isBackForward) {
            inputs.forEach((input) => {
                input.checked = false;
            });
        }
    }
});

const preloader = () => {
    window.onload = function() {
        const preload = document.querySelector('.preloader');
        if ( preload ) {
            preload.classList.add("preloader-remove");
        }
    };
}
preloader();

const cookieHidden = () => {
    const cookieBar = document.querySelector('.cookie-bar')
    const btnCookie = document.querySelector('#cookie-yes')
    if ( cookieBar ) {
        let cookieUser = localStorage.getItem('glempCookieUser')
        if ( cookieUser !== 'yes' ) {
            cookieBar.classList.add('visible')
        }
        btnCookie.addEventListener('click', (e)=> {
            localStorage.setItem('glempCookieUser', 'yes' )
            cookieBar.classList.remove('visible')
        })
    }
}
cookieHidden();

// function filtrHidden(elem) {
//     // const filtr = document.querySelector('.archive-glampings__left');
//     const filtr = document.querySelector('.glampings-filtr');
//     const btnHidden = document.querySelector('.glampings-filtr-hidden');
//     filtr.classList.toggle('visible-hidden');
//     if (filtr.classList.contains('visible-hidden')) {
//         btnHidden.classList.add('visible-hidden');
//         document.querySelector('.archive-glampings__left').style.width = 'auto';
//         document.querySelector('.glampings-map').style.maxWidth = '100%';
//         // map.container.fitToViewport();
//     } else {
//         btnHidden.classList.remove('visible-hidden');
//         document.querySelector('.glampings-map').style.maxWidth = '';
//         document.querySelector('.archive-glampings__left').style.width = '';
//         // map.container.fitToViewport();
//     }
// }

const singleThumbnailGallery = () => {
    const thumbGallery = document.querySelector('#single-thumbnail');
    if (!thumbGallery) return;
    const btn = thumbGallery.querySelector('#js-gallery-count');
    const tg = lightGallery(thumbGallery, {
        selector: '.item',
        download: false,
        plugins: [lgThumbnail],
        mobileSettings: {
            showCloseIcon: true
        }
    });
    if (btn) {
        btn.addEventListener('click', (e) => {
            tg.openGallery();
        });
    }
    // const thumbGalleryCount = thumbGallery.querySelectorAll('a').length;
    // const itemCount = thumbGallery.querySelector('#gallery-item-count');
    // if (itemCount) {
    //     itemCount.innerHTML = thumbGalleryCount;
    // }
}
singleThumbnailGallery();

const singleAccOptionGallery = () => {
    const accGallery = document.querySelectorAll('.acc-option__media');
    if (accGallery.length) {
        accGallery.forEach((gallery) => {
            const galleryId = document.getElementById(gallery.id);
            lightGallery(galleryId, {
                selector: '.acc-media',
                download: false,
                plugins: [lgThumbnail],
            });
        });
    }
}
// singleAccOptionGallery();

const sliderGlempType = ( index, indexItem, defolt, mob, tablet, decstop ) => {
    const swiperType = new Swiper(index, {
        slidesPerView: defolt,
        spaceBetween: 4,
        loop: true,
        loopAddBlankSlides: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            // type: "progressbar",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            376: {
                slidesPerView: mob,
            },
            768: {
                slidesPerView: tablet,
            },
            1024: {
                slidesPerView: decstop,
            },
        },
        // on: {
        //     init: function () {
        //         const lg = lightGallery(document.querySelector(index), {
        //             selector: '.acc-media',
        //             download: false,
        //             plugins: [lgThumbnail],
        //         });
        //         const slide = document.querySelector(indexItem);
        //         slide.addEventListener('lgBeforeClose', () => {
        //             swiperType.slideTo(lg.index, 0)
        //         });
        //     },
        // }
    });
}

function initSliderGlempType(item) {
    for (var i = 0; i < item; i++) {
        sliderGlempType('.galery'+i, '#sw-'+i, 1, 1, 1, 1);
    }
}
initSliderGlempType(20);

function initSliderGlempReview(item) {
    for (var i = 0; i < item; i++) {
        sliderGlempType('.galery-review'+i, '#sw-review-'+i, 1, 2, 4, 5);
    }
}
initSliderGlempReview(100);

function optionsGallery(index) {
    const gallery = document.querySelector(index);
    const lg = lightGallery(gallery, {
        selector: '.acc-media',
        download: false,
        plugins: [lgThumbnail],
        mobileSettings: {
            showCloseIcon: true
        }
    });
    const btn = document.querySelector(index+' #js-gallery-count');
    const btnR = document.querySelector(index+' .galery-review-list__count');
    if (btn) {
        btn.addEventListener('click', (e) => {
            lg.openGallery();
        });
    }
    if (btnR) {
        btnR.addEventListener('click', (e) => {
            lg.openGallery();
        });
    }
}

function initOptionsGallery(item) {
    for (var i = 0; i < item; i++) {
        optionsGallery('.galery'+i);
    }
}
initOptionsGallery(20);

function initOptionsGalleryRev(item, i=0) {
    for (i; i < item; i++) {
        optionsGallery('.list-'+i);
    }
}
initOptionsGalleryRev(100);

function initOptionsGalleryReview(item) {
    for (var i = 0; i < item; i++) {
        optionsGallery('.galery-review'+i);
    }
}
initOptionsGalleryReview(100);

function toastAll(title, text, theme, autohide, interval) {
    new Toast({
      title: title,
      text: text,
      theme: theme,
      autohide: autohide,
      interval: interval
    });
}
// toast(false, 'Сообщение...', 'success', true, 3000);

function copyElem() {
    const copyBtns = document.querySelectorAll('.copy-btns');
    const inputEl = document.querySelector('.to-copy');
    // const alert = document.querySelector('.alerts__item');
    if (copyBtns.length) {
        copyBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                // let text = btn.previousElementSibling.value;
                let text = inputEl.innerHTML.trim();
                copyToClipboard(text);
                toastAll(false, 'Ссылка скопирована в буфер обмена', 'success', true, 3000);
            });
        });
    }
}
copyElem();

function unsecuredCopyToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;
    document.body.appendChild(textArea);
    // textArea.focus();
    textArea.select();
    try{
        document.execCommand('copy')
    }
    catch(err){
        console.error('Невозможно скопировать в буфер обмена',err)
    }
    document.body.removeChild(textArea)
}

function copyToClipboard(content) {
    if (window.isSecureContext && navigator.clipboard) {
        navigator.clipboard.writeText(content);
    } else {
        unsecuredCopyToClipboard(content);
    }
}

const contactsMobailVision = () => {
    const btn = document.querySelector('#contacts-mobail-btn');
    if (!btn) return;
    const singleAside = document.querySelector('.single-aside');
    const iconPhone = document.querySelector('.icon-phone');
    const iconMessage = document.querySelector('.icon-message');
    const svgClose = document.querySelector('svg.close');
    overlay      = document.querySelector('.js-overlay-modal'),
    btn.addEventListener('click', (e) => {
        overlay.classList.add('active');
        singleAside.classList.toggle('active');
        // iconPhone.classList.toggle('active');
        // iconMessage.classList.toggle('active');
        // svgClose.classList.toggle('active');
    });

    document.addEventListener( 'click', (e) => {
        const withinsingleAside = e.composedPath().includes(singleAside);
        const withinsingleBtn = e.composedPath().includes(btn);
        if ( ! withinsingleAside && !withinsingleBtn ) {
            singleAside.classList.remove('active');
            // overlay.classList.remove('active');
            // iconPhone.classList.remove('active');
            // iconMessage.classList.remove('active');
            // svgClose.classList.remove('active');
        }
    });

    overlay.addEventListener( 'click', (e) => {
        const withinsingleAside = e.composedPath().includes(singleAside);
        const withinsingleBtn = e.composedPath().includes(btn);
        if ( ! withinsingleAside && !withinsingleBtn ) {
            singleAside.classList.remove('active');
            overlay.classList.remove('active');
            // iconPhone.classList.remove('active');
            // iconMessage.classList.remove('active');
            // svgClose.classList.remove('active');
        }
    });

    document.addEventListener('keydown', function(e) {
        if( e.keyCode == 27 ) {
            singleAside.classList.remove('active');
            overlay.classList.remove('active');
            // iconPhone.classList.remove('active');
            // iconMessage.classList.remove('active');
            // svgClose.classList.remove('active');
        }
    });
}
contactsMobailVision();

const collapseViews = () => {
    const collapseContent = document.querySelectorAll('.glampings .collapse-content');
    if (collapseContent.length) {
        collapseContent.forEach((item) => {
            item.nextElementSibling.addEventListener('click', (e) => {
                item.classList.toggle('active');
                item.nextElementSibling.classList.toggle('active');
                if (item.nextElementSibling.classList.contains('active')) {
                    item.nextElementSibling.children[0].innerText = 'Свернуть';
                } else {
                    item.nextElementSibling.children[0].innerText = 'Развернуть';
                }
            });
        });
    }
}
collapseViews();

const collapseHeightViews = () => {
    const btndetails = document.querySelectorAll('.glampings .js-btndetails');
    const collapseContent = document.querySelectorAll('.glampings .collapse-content');
    if (btndetails.length) {
        btndetails.forEach((item) => {
            item.addEventListener('click', (e) => {
                // item.classList.toggle('active');
                item.parentElement.nextElementSibling.nextElementSibling.classList.toggle('active');
                if (item.parentElement.nextElementSibling.nextElementSibling.classList.contains('active')) {
                    item.innerText = 'Скрыть';
                } else {
                    item.innerText = 'Подробнее';
                }
            });
        });
    }
}
collapseHeightViews();

const collapseHeightViewsAcc = () => {
    const btndetails = document.querySelectorAll('.glampings .js-btndetails-acc');
    if (!btndetails.length) return;
    btndetails.forEach((item) => {
        item.addEventListener('click', (e) => {
            console.dir(item);
        });
    });
}
collapseHeightViewsAcc();

const collapseViewsContent = () => {
    const btndetails = document.querySelectorAll('.glampings .js-btn-descr');
    const collapseContent = document.querySelectorAll('.glampings .collapse-content-descr');
    if (btndetails.length) {
        // console.dir(collapseContent);
        btndetails.forEach((item) => {
            item.addEventListener('click', (e) => {
                item.classList.toggle('active');
                collapseContent.forEach((el) => {
                    el.classList.toggle('active');
                });
                if (item.classList.contains('active')) {
                    item.children[0].innerText = 'Свернуть описание';
                } else {
                    item.children[0].innerText = 'Развернуть описание';
                }
            });
        });
    }
}
collapseViewsContent();

const addFavCom = () => {
    const favoritesBtns = document.querySelectorAll('#add-favorites');
    const comparisonBtns = document.querySelectorAll('#add-comparison');
    const singleGlampings = document.querySelector('.single-glampings');
    if (!singleGlampings) return;
    if (favoritesBtns.length) {
        const supFavorites = document.querySelectorAll('#sup-favorites');
        favoritesBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                let glcFavCount = localCheng('glcFav', btn.dataset.postid);
                supFavorites.forEach((item) => {
                    item.innerHTML = glcFavCount;
                });
                btn.classList.toggle('active');
                if (btn.classList.contains('active')) {
                    btn.attributes.title.value = 'Удалить из избранного';
                } else {
                    btn.attributes.title.value = 'Добавить в избранное';
                }
            });
        });
    }
    if (comparisonBtns.length) {
        const supComparison = document.querySelectorAll('#sup-comparison');
        comparisonBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                let glcComparCount = localCheng('glcCompar', btn.dataset.postid);
                supComparison.forEach((item) => {
                    item.innerHTML = glcComparCount;
                });
                btn.classList.toggle('active');
                if (btn.classList.contains('active')) {
                    btn.attributes.title.value = 'Удалить из сравнения';
                } else {
                    btn.attributes.title.value = 'Добавить к сравнению';
                }
            });
        });
    }
}
// addFavCom();

function addFavNew(elem) {
    const supFavorites = document.querySelectorAll('#sup-favorites');
    let glcFavCount = localCheng('glcFav', elem.dataset.postid);
    supFavorites.forEach((item) => {
        item.innerHTML = glcFavCount;
    });
    elem.classList.toggle('active');
    if (elem.classList.contains('active')) {
        elem.attributes.title.value = 'Удалить из избранного';
    } else {
        elem.attributes.title.value = 'Добавить в избранное';
    }
}

function addCompNew(elem) {
    const supComparison = document.querySelectorAll('#sup-comparison');
    let glcComparCount = localCheng('glcCompar', elem.dataset.postid);
    supComparison.forEach((item) => {
        item.innerHTML = glcComparCount;
    });
    elem.classList.toggle('active');
    if (elem.classList.contains('active')) {
        elem.attributes.title.value = 'Удалить из сравнения';
    } else {
        elem.attributes.title.value = 'Добавить к сравнению';
    }
}

// const deleteFavCom = () => {
//     const favoritesBtns = document.querySelectorAll('#delete-favorites');
//     const comparisonBtns = document.querySelectorAll('#delete-comparison');
//     if (favoritesBtns.length) {
//         const supFavorites = document.querySelectorAll('#sup-favorites');
//         favoritesBtns.forEach((btn) => {
//             btn.addEventListener('click', (e) => {
//                 let glcFavCount = localCheng('glcFav', btn.dataset.postid);
//                 btn.parentElement.parentElement.parentElement.parentElement.remove();
//                 supFavorites.forEach((item) => {
//                     item.innerHTML = glcFavCount;
//                 });
//             });
//         });
//     }
//     if (comparisonBtns.length) {
//         const supComparison = document.querySelectorAll('#sup-comparison');
//         comparisonBtns.forEach((btn) => {
//             btn.addEventListener('click', (e) => {
//                 let glcComparCount = localCheng('glcCompar', btn.dataset.postid);
//                 btn.parentElement.parentElement.parentElement.parentElement.remove();
//                 supComparison.forEach((item) => {
//                     item.innerHTML = glcComparCount;
//                 });
//             });
//         });
//     }
// }
// deleteFavCom();
//
// function buttonsFavChange() {
//     const glampingsItems = document.querySelector('.glampings-items');
//     const singleGlampings = document.querySelector('.single-glampings');
//     if (!glampingsItems) return;
//     const supFavorites = document.querySelectorAll('#sup-favorites');
//     const supСomparison = document.querySelectorAll('#sup-comparison');
//     glampingsItems.addEventListener('click', function(event) {
//         let btns = glampingsItems.querySelectorAll('button');
//         let btn = event.target.closest('button');
//         if (btn) {
//             if (btn.id == 'add-favorites') {
//                 let glcFavCount = localCheng('glcFav', btn.dataset.postid);
//                 supFavorites.forEach((item) => {
//                     item.innerHTML = glcFavCount;
//                 });
//                 btn.classList.toggle('active');
//                 if (btn.classList.contains('active')) {
//                     btn.attributes.title.value = 'Удалить из избранного';
//                 } else {
//                     btn.attributes.title.value = 'Добавить в избранное';
//                 }
//             }
//
//             if (btn.id == 'add-comparison') {
//                 let glcComparCount = localCheng('glcCompar', btn.dataset.postid);
//                 supСomparison.forEach((item) => {
//                     item.innerHTML = glcComparCount;
//                 });
//                 btn.classList.toggle('active');
//                 if (btn.classList.contains('active')) {
//                     btn.attributes.title.value = 'Удалить из сравнения';
//                 } else {
//                     btn.attributes.title.value = 'Добавить к сравнению';
//                 }
//             }
//         }
//     });
// }
// buttonsFavChange();

function localCheng(name, value) {
    let ls_obj = [];
    if ( Cookies.get(name) ) { // localStorage.getItem(name)
        let ls = Cookies.get(name); // localStorage.getItem(name)
        ls_obj = ls.split(',');
        if (ls_obj.includes(value)) {
            ls_obj = ls_obj.filter((i) => i !== value);
        } else {
            ls_obj.push(value);
        }
    } else {
        ls_obj = [];
        ls_obj.push(value);
    }
    // localStorage.setItem(name, ls_obj);
    // Cookies.remove('name')
    Cookies.set(name, ls_obj);
    return ls_obj.length;
}

// function favoritesRender() {
//     const supFavorites = document.querySelectorAll('#sup-favorites');
//     const supComparison = document.querySelectorAll('#sup-comparison');
//     const addFavorites = document.querySelectorAll('#add-favorites');
//     const addComparison = document.querySelectorAll('#add-comparison');
//     let glcFav = favoritesRenderNologin('glcFav');
//     let glcCompar = favoritesRenderNologin('glcCompar');
//     if (supFavorites.length) {
//         supFavorites.forEach((item) => {
//             item.innerHTML = glcFav.length;
//         });
//         if (addFavorites.length) {
//             addFavorites.forEach((item) => {
//                 if (glcFav.includes(item.dataset.postid)) {
//                     item.classList.add('active');
//                     item.attributes.title.value = 'Удалить из избранного';
//                 }
//             });
//         }
//     }
//     if (supComparison.length) {
//         supComparison.forEach((item) => {
//             item.innerHTML = glcCompar.length;
//         });
//         if (addComparison.length) {
//             addComparison.forEach((item) => {
//                 if (glcCompar.includes(item.dataset.postid)) {
//                     item.classList.add('active');
//                     item.attributes.title.value = 'Удалить из сравнения';
//                 }
//             });
//         }
//     }
// }
// favoritesRender();
//
// function favoritesRenderNologin(name) {
//     const glcFav = Cookies.get(name);
//     let glcFav_obj = [];
//     if (glcFav) {
//         glcFav_obj = glcFav.split(',');
//     }
//     return glcFav_obj;
// }

function favoritesRenderLogin() {
    // if (glamping_club_ajax.user_id) {
    //
    // } else {
    //     const glcFav = localStorage.getItem('glcFav');
    //     const glcFav_obj = glcFav.split(',');
    // }
}

const filrtMobile = () => {
    const btn = document.querySelector('button.button-filtr-icon');
    if (!btn) return;
    const filtr = document.querySelector('.glampings-filtr');
    const glampingsLeft = document.querySelector('.archive-glampings__left');
    const glampingsLeftGlampings = document.querySelector('.archive-glampings__left__glampings');
    const closeFiltr = document.querySelector('button.close-filtr');
    const overlay = document.querySelector('.js-overlay-modal');
    const body = document.querySelector('body');
    btn.addEventListener('click', (e) => {
        // glampingsLeftGlampings.style.display = 'none';
        glampingsLeft.style.display = 'flex';
        filtr.classList.add('active');
        overlay.classList.add('active');
        body.style.overflow = 'hidden';
        // glampingsLeft.style.display = 'flex';
    });
    if (closeFiltr) {
        closeFiltr.addEventListener('click', (e) => {
            filtr.classList.remove('active');
            overlay.classList.remove('active');
            body.style.overflow = '';
            glampingsLeft.style.display = '';
            // glampingsLeftGlampings.style.display = '';
        });
    }
    overlay.addEventListener('click', (e) => {
        filtr.classList.remove('active');
        body.style.overflow = '';
        glampingsLeft.style.display = '';
        // glampingsLeftGlampings.style.display = '';
    });

    document.addEventListener('swiped-left', function(e) {
        if (filtr) {
            filtr.classList.remove('active');
            overlay.classList.remove('active');
            body.style.overflow = '';
            glampingsLeft.style.display = '';
            // glampingsLeftGlampings.style.display = '';
        }
    });

    document.body.addEventListener('keyup', function (e) {
        var key = e.keyCode;
        if (key == 27) {
            if (filtr) {
                filtr.classList.remove('active');
                overlay.classList.remove('active');
                body.style.overflow = '';
                glampingsLeft.style.display = '';
                // glampingsLeftGlampings.style.display = '';
            }
        };
    }, false);
}
filrtMobile();

function conditionalFilesFront() {
    const conditional = document.querySelectorAll('.conditional-parent input');
    if (!conditional.length) return;
    conditional.forEach((item) => {
        // console.dir(item.checked + ' - ' + item.value);
        let child = item.value;
        let cf = document.querySelector('.cmb-row.'+child+'');
        if (item.checked && cf) {
            cf.style.display = 'block';
        }

        item.addEventListener('change', (e) => {
            if (item.checked && cf) {
                cf.style.display = 'block';
            } else {
                document.querySelector('.cmb-row.'+item.dataset.child+'').style.display = '';
            }
        });
    });
}
conditionalFilesFront();

jQuery( function( $ ) {
    function replaceTitlesGen(groupId, titleId) {
        var $box = $( document.getElementById( groupId ) );
        var replaceTitles = function() {
            $box.find( '.cmb-group-title' ).each( function() {
                var $this = $( this );
                var txt = $this.next().find( '[id$="'+titleId+'"]' ).val();
                var rowindex;
                if ( ! txt ) {
                    txt = $box.find( '[data-grouptitle]' ).data( 'grouptitle' );
                    if ( txt ) {
                        rowindex = $this.parents( '[data-iterator]' ).data( 'iterator' );
                        txt = txt.replace( '{#}', ( rowindex + 1 ) );
                    }
                }                if ( txt ) {
                    $this.text( txt );
                }
            });
        };
        var replaceOnKeyUp = function( evt ) {
            var $this = $( evt.target );
            var id = titleId;
            if ( evt.target.id.indexOf(id, evt.target.id.length - id.length) !== -1 ) {
                $this.parents( '.cmb-row.cmb-repeatable-grouping' ).find( '.cmb-group-title' ).text( $this.val() );
            }
        };
        $box
            .on( 'cmb2_add_row cmb2_remove_row cmb2_shift_rows_complete', replaceTitles )
            .on( 'keyup', replaceOnKeyUp );
        replaceTitles();
    }
    replaceTitlesGen('acc_options_repeat', 'title');
    replaceTitlesGen('faq_options_repeat', 'title');
    replaceTitlesGen('wtd_options_repeat', 'title');
});

const addEditGlemp = () => {
    const addEditBtns = document.querySelectorAll('.js-btn-add-edit');
    if (!addEditBtns.length) return;
    addEditBtns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            clearValidate();
            const form = document.querySelector('#single_glampings_front');
            const formMedia = document.querySelector('#media_gallery_front');
            const formAccOptions = document.querySelector('#accommodation_options_front');
            const formFaqOptions = document.querySelector('#faq_options_front');
            const formWtdOptions = document.querySelector('#wtd_options');

            let formData = new FormData(form);
            let formDataMedia = new FormData(formMedia);
            let formDataAccOptions = new FormData(formAccOptions);
            let formDataFaqOptions = new FormData(formFaqOptions);
            let formDataWtdOptions = new FormData(formWtdOptions);

            let content = window.tinyMCE.get('glamping_description').getContent();
            let content_glc_notes = window.tinyMCE.get('additionally_field_0_glc_notes').getContent();
            formData.set('glamping_description', content);
            formData.set('additionally_field[0][glc_notes]', content_glc_notes);
            // console.dir(Array.from(formData));
            // console.dir(Array.from(formDataMedia));
            // console.dir(Array.from(formDataAccOptions));

            Array.from(formDataMedia).forEach((item) => {
                if (item[0] != 'object_id') {
                    formData.set(item[0], item[1]);
                }
            });
            Array.from(formDataAccOptions).forEach((item) => {
                if (item[0] != 'object_id') {
                    formData.set(item[0], item[1]);
                }
            });
            Array.from(formDataFaqOptions).forEach((item) => {
                if (item[0] != 'object_id') {
                    formData.set(item[0], item[1]);
                }
            });
            Array.from(formDataWtdOptions).forEach((item) => {
                if (item[0] != 'object_id') {
                    formData.set(item[0], item[1]);
                }
            });
            formData.append('nonce', glamping_club_ajax.nonce);
            formData.append('user_id', glamping_club_ajax.user_id);
            formData.append('action_type', btn.dataset.type);
            formData.append('action', 'add_post_glampings');

            // console.dir(Array.from(formData));

            let optionsItems = document.querySelectorAll('#acc_options_repeat .cmb-repeatable-grouping');
            let wtdOptionsItems = document.querySelectorAll('#wtd_options_repeat .cmb-repeatable-grouping');
            accOptionsRepeat(optionsItems, formData);
            wtdOptionsRepeat(wtdOptionsItems, formData)
            jQuery(document).ready( function($){
    	        $.ajax({
    	            url: glamping_club_ajax.ajaxUrl,
    	            method: 'post',
    	            processData: false,
    	            contentType: false,
    	            data: formData,
    	            success: function (data) {
    	                var data_json = JSON.parse(data);
    	                console.dir(data_json);
    	                // console.dir(data);
                        // console.dir(data_json.type);
                        if (data_json.type == 'success') {
                            window.location.href = '/dashboard/?tab=glemp';
                        } else if (data_json.type == 'errors') {
                            // for (var variable in data_json) {
                            //     console.dir(variable);
                            // }

                            if (data_json.false_acc_options) {
                                accOptionsValidate();
                                if (typeof data_json.false_acc_options[0] == 'string') {
                                    data_json.false_acc_options.forEach((item) => {
                                        // console.dir(item);
                                        if (item == 'description') {
                                            document.querySelector('#wp-acc_options_0_description-wrap').style.border = '1px solid red';
                                        } else {
                                            document.querySelector('#acc_options_repeat input[data-name="'+item+'"]').style.border = '1px solid red';
                                        }
                                        document.querySelector('#cmb-group-acc_options-0 h3').style.background = '#ffebeb';
                                        let elementPosition = document.querySelector('#cmb-group-acc_options-0').getBoundingClientRect().top;
                                        let offsetPosition = elementPosition - 100;

                                        window.scrollBy({
                                            top: offsetPosition,
                                            behavior: "smooth"
                                        });
                                    });

                                } else if (typeof data_json.false_acc_options[0] == 'object') {
                                    let i = 0;
                                    data_json.false_acc_options.forEach((items) => {
                                        // console.dir(items);
                                        items.forEach((item) => {
                                            if (item == 'description') {
                                                document.querySelector('#wp-acc_options_'+i+'_description-wrap').style.border = '1px solid red';
                                            } else {
                                                document.querySelector('#acc_options_repeat input#acc_options_'+i+'_'+item+'').style.border = '1px solid red';
                                            }
                                            document.querySelector('#cmb-group-acc_options-'+i+' h3').style.background = '#ffebeb';
                                        });
                                        i++;
                                        let elementPosition = document.querySelector('#cmb-group-acc_options-0').getBoundingClientRect().top;
                                        let offsetPosition = elementPosition - 100;

                                        window.scrollBy({
                                            top: offsetPosition,
                                            behavior: "smooth"
                                        });
                                    });
                                }
                            }

                            if (data_json.additionally_field) {
                                document.querySelector('[data-groupid="additionally_field"] h3').style.background = '#ffebeb';
                                for (var variable in data_json.additionally_field) {
                                    document.querySelector('#'+variable).style.border = '1px solid red';
                                }
                                let elementPosition = document.querySelector('.cmb2-id-additionally-field').getBoundingClientRect().top;
                                let offsetPosition = elementPosition - 100;

                                window.scrollBy({
                                    top: offsetPosition,
                                    behavior: "smooth"
                                });
                            }

                            if (data_json.empty_description) {
                                document.querySelector('.cmb2-id-glamping-description').style.background = '#ffebeb';
                                document.querySelector('#page').scrollIntoView({
                                    behavior: "smooth",
                                    block: "start"
                                });
                            }
                            if (data_json.inputs) {
                                for (var variable in data_json.inputs) {
                                    // document.querySelector('[name="'+variable+'"]').style.border = '1px solid red';
                                    document.querySelector('[name="'+variable+'"]').parentElement.parentElement.style.background = '#ffebeb';
                                }
                                document.querySelector('#page').scrollIntoView({
                                    behavior: "smooth",
                                    block: "start"
                                });
                            }

                            if (data_json.multicheck) {
                                for (var variable in data_json.multicheck) {
                                    document.querySelector('[for="'+variable+'"]').parentElement.parentElement.style.background = '#ffebeb';
                                }
                                document.querySelector('#page').scrollIntoView({
                                    behavior: "smooth",
                                    block: "start"
                                });
                            }
                        }
    	            },
    	            error: function (jqXHR, text, error) {
                        console.dir('Error');
                        console.dir(error);
                    }
    	        });
    	    });
        });
    });
}
addEditGlemp();

function accOptionsRepeat(optionsItems, formData) {
    if (!optionsItems.length) return;
    optionsItems.forEach((item, i) => {
        let aoId = 'acc_options_'+i+'_description';
        let aoKey = 'acc_options['+i+'][description]';
        let content_acc_options = window.tinyMCE.get(aoId).getContent();
        formData.set(aoKey, content_acc_options);
    });
}

function wtdOptionsRepeat(optionsItems, formData) {
    if (!optionsItems.length) return;
    optionsItems.forEach((item, i) => {
        let aoId = 'wtd_options_'+i+'_text';
        let aoKey = 'wtd_options['+i+'][text]';
        let content_acc_options = window.tinyMCE.get(aoId).getContent();
        formData.set(aoKey, content_acc_options);
    });
}

function accOptionsValidate() {
    let optionsItems = document.querySelectorAll('#acc_options_repeat .cmb-repeatable-grouping');
    console.dir(optionsItems);
    // let accItemInputs = accItem.querySelectorAll('input[data-valid="required-field"]');

    optionsItems.forEach((item) => {
        console.dir(item);
        let accItemInputs = item.querySelectorAll('input[data-valid="required-field"]');
        console.dir(accItemInputs);
        let noValid = inputValid(accItemInputs);
        if (noValid) {
            item.querySelector('h3').style.background = '#ffebeb';
        }
    });

    function inputValid(inputs) {
        let i = 0;
        if (inputs.length) {
            inputs.forEach((input) => {
                if (!input.value) {
                    console.dir(input);
                    input.style.border = '1px solid red';
                    i++;
                }
            });
        }
        return i;
    }
}
// accOptionsValidate();

function addEditGlempValidate() {
    let optionsItems = document.querySelectorAll('#acc_options_repeat .cmb-repeatable-grouping');
    let addGroupAccBtn = document.querySelector('.cmb-add-group-row[data-selector="acc_options_repeat"]');
    if (!addGroupAccBtn) return;

    addGroupAccBtn.addEventListener('click', (e) => {
        // e.preventDefault();
        let accItem = addGroupAccBtn.parentElement.parentElement.parentElement.previousElementSibling;
        let accItemTitle = accItem.querySelector('h3');
        console.dir(accItemTitle);
        let numberItem = accItem.dataset.iterator;
        let accItemInputs = accItem.querySelectorAll('input[data-valid="required-field"]');
        let aoIdItem = 'acc_options_'+numberItem+'_description';

        let aoItemNumber = 'acc_options['+numberItem+'][description]';
        let content_acc_options = window.tinyMCE.get(aoIdItem).getContent();

        let ivc = 0;
        accItemInputs.forEach(input => {
            if (!input.value) {
                input.style.border = '1px solid red';
                accItemTitle.style.background = '#ffebeb';
                ivc++;
            }
        });

        if (!content_acc_options) {
            accItemTitle.style.background = '#ffebeb';
        }

        if (ivc || !content_acc_options) {
            addGroupAccBtn.disabled = true;
            accItemTitle.style.background = '#ffebeb';

            let elementPosition = accItemTitle.getBoundingClientRect().top;
            let offsetPosition = elementPosition - 100;

            window.scrollBy({
                top: offsetPosition,
                behavior: "smooth"
            });
        }

        btnActive(accItemInputs, addGroupAccBtn, aoIdItem, numberItem, accItemTitle);

    });
}
addEditGlempValidate();

function btnActive(accItemInputs, addGroupAccBtn, aoIdItem, numberItem, accItemTitle) {
    accItemInputs.forEach((input) => {
        input.addEventListener('input', (e) => {
            input.style.border = '';
            addGroupAccBtn.disabled = false;
            accItemTitle.style.background = '';
        });
    });

    setInterval(function(){
        let content_acc_options = window.tinyMCE.get(aoIdItem).getContent();
        let descriptionWrap = document.querySelector('#wp-acc_options_'+numberItem+'_description-wrap');
        if (!content_acc_options) {
            descriptionWrap.style.border = '1px solid red';
            addGroupAccBtn.disabled = true;
            // accItemTitle.style.background = '#ffebeb';
        } else {
            descriptionWrap.style.border = '';
            addGroupAccBtn.disabled = false;
            accItemTitle.style.background = '';
        }
    }, 500);
}

function clearValidate() {
    const metaboxWrapItems = document.querySelectorAll('#cmb2-metabox-single_glampings_front .cmb-row');
    const additionallyTitle = document.querySelector('.cmb2-id-additionally-field h3');
    const additionallyInputs = document.querySelectorAll('.cmb2-id-additionally-field input');
    const accOptions = document.querySelectorAll('#acc_options_repeat input');
    const accTitle = document.querySelectorAll('#acc_options_repeat h3');
    const accWpEditor = document.querySelectorAll('#acc_options_repeat wp-core-ui');
    // console.dir(metaboxWrapItems);
    metaboxWrapItems.forEach((item) => {
        item.style.background = '';
    });
    additionallyTitle.style.background = '';
    additionallyInputs.forEach((item) => {
        item.style.border = '';
    });

    accTitle.forEach((item) => {
        item.style.background = '';
    });

    accOptions.forEach((item) => {
        item.style.border = '';
    });

    accWpEditor.forEach((item) => {
        item.style.border = '';
    });

}

function userGlampingIdentification() {
    const form = document.querySelector('form#glamping-identification');
    if (!form) return;
    const btn = form.querySelector('button#user-glamping-identification');
    const message = document.querySelector('.dashboard-tab__content__message');
    btn.addEventListener('click', (e) => {
        // console.dir(form.children[0].value);
        if (+form.children[0].value) {
            form.children[0].style.border = '';
            let formData = new FormData(form);
            formData.append('nonce', glamping_club_ajax.nonce);
            formData.append('user_id', glamping_club_ajax.user_id);
            formData.append('action', 'owner_identification');

            jQuery(document).ready( function($){
    	        $.ajax({
    	            url: glamping_club_ajax.ajaxUrl,
    	            method: 'post',
    	            processData: false,
    	            contentType: false,
    	            data: formData,
    	            success: function (data) {
                        console.dir(data);
                        var data_json = JSON.parse(data);
                        if (data_json.type == 'success') {
                            toastAll(false, 'На почту отправлено письмо для подтверждения', 'success', true, 6000);
                            message.innerHTML = `<span class="success">На почту отправлено письмо для подтверждения</span>`;
                            setTimeout(function(){
                                message.innerHTML = '';
                            }, 6000);
                        } else if (data_json.type == 'errors') {
                            if (data_json.no_email) {
                                toastAll(false, 'В информации глэмпинга не указан E-mail. Свяжитесь с админом сайта.', 'warning', true, 6000);
                                message.innerHTML = `<span class="warning">В информации глэмпинга не указан E-mail.<br>Свяжитесь с админом сайта.</span>`;
                                setTimeout(function(){
                                    message.innerHTML = '';
                                }, 6000);
                            } else {
                                toastAll(false, 'Свяжитесь с админом сайта', 'error', true, 6000);
                                message.innerHTML = `<span class="error">Свяжитесь с админом сайта</span>`;
                                setTimeout(function(){
                                    message.innerHTML = '';
                                }, 6000);
                            }
                        }
                    },
    	            error: function (jqXHR, text, error) {
                        console.dir(error);
                    }
    	        });
            });
        } else {
            form.children[0].style.border = '1px solid red';
        }
    });
}
userGlampingIdentification();

function slidersCompare(index) {
    new Swiper(index, {
        slidesPerView: 2,
        // spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            376: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 4,
            },
            1024: {
                slidesPerView: 5,
            },
        }
    });
}
// slidersCompare('.mySwiper1');
// slidersCompare('.mySwiper2');

function relListSwiper(index) {
    const slider = document.querySelector(index);
    new Swiper(slider, {
        slidesPerView: 1,
        spaceBetween: 22,
        navigation: {
            nextEl: ".swiper-nav .swiperm-button-next",
            prevEl: ".swiper-nav .swiperm-button-prev",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            380: {
                slidesPerView: 'auto',
            },
            1024: {
                slidesPerView: 3,
            },
            1330: {
                slidesPerView: 4,
            },
        }
    });
}
relListSwiper('.relListSwiper');

function slickSlider() {
    jQuery(document).ready( function($){
        const iconBtnNext = `<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
            <path d="M85.14 475.8c-3.438-3.141-5.156-7.438-5.156-11.75c0-3.891 1.406-7.781 4.25-10.86l181.1-197.1L84.23 58.86c-6-6.5-5.625-16.64 .9062-22.61c6.5-6 16.59-5.594 22.59 .8906l192 208c5.688 6.156 5.688 15.56 0 21.72l-192 208C101.7 481.3 91.64 481.8 85.14 475.8z"/>
        </svg>`;
        const iconBtnPrev = `<svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
            <path d="M234.8 36.25c3.438 3.141 5.156 7.438 5.156 11.75c0 3.891-1.406 7.781-4.25 10.86L53.77 256l181.1 197.1c6 6.5 5.625 16.64-.9062 22.61c-6.5 6-16.59 5.594-22.59-.8906l-192-208c-5.688-6.156-5.688-15.56 0-21.72l192-208C218.2 30.66 228.3 30.25 234.8 36.25z"/>
        </svg>`;
        $('.mySlick1').slick({
          slidesToShow: 5,
          slidesToScroll: 1,
          asNavFor: '.mySlick2',
          infinite: false,
          speed: 200,
          adaptiveHeight: true,
          appendArrows: '.slider-compare-navigation',
          prevArrow: '<button type="button" class="slick-prev">'+iconBtnPrev+'</button>',
          nextArrow: '<button type="button" class="slick-next">'+iconBtnNext+'</button>',
          responsive: [
              {
                  breakpoint: 1349,
                  settings: {
                      slidesToShow: 4,
                      slidesToScroll: 1
                  }
              },
              {
                  breakpoint: 1024,
                  settings: {
                      slidesToShow: 3,
                      slidesToScroll: 1
                  }
              },
              {
                  breakpoint: 767,
                  settings: {
                      slidesToShow: 2,
                      slidesToScroll: 1
                  }
              },
              {
                  breakpoint: 480,
                  settings: {
                      slidesToShow: 2,
                      slidesToScroll: 1
                  }
              }
          ]
        });

        $('.mySlick2').slick({
          slidesToShow: 5,
          slidesToScroll: 1,
          asNavFor: '.mySlick1',
          infinite: false,
          speed: 200,
          arrows: false,
          responsive: [
              {
                  breakpoint: 1349,
                  settings: {
                      slidesToShow: 4,
                      slidesToScroll: 1
                  }
              },
              {
                  breakpoint: 1024,
                  settings: {
                      slidesToShow: 3,
                      slidesToScroll: 1
                  }
              },
              {
                  breakpoint: 767,
                  settings: {
                      slidesToShow: 2,
                      slidesToScroll: 1
                  }
              },
              {
                  breakpoint: 480,
                  settings: {
                      slidesToShow: 2,
                      slidesToScroll: 1
                  }
              }
          ]
        });

        // $(".mySlick1").each(function() {
        //     var highestSlide = 0;
        //     var slider = $(this);
        //     slider.find(".slick-slide").each(function() {
        //         if ($(this).height() > highestSlide) {
        //             highestSlide = $(this).height();
        //         }
        //     });
        //     slider.find(".slick-slide").css("height", highestSlide + "px");
        // });

        // const sections = document.querySelectorAll('.compare-item__section');
        // let highestSection = 0;
        // sections.forEach((section) => {
        //     if (section.classList.contains('section9')) {
        //         console.dir(section.offsetHeight);
        //         if (section.offsetHeight > highestSection) {
        //             highestSection = section.offsetHeight;
        //         }
        //     }
        // });
        // sections.forEach((section) => {
        //     if (section.classList.contains('section9')) {
        //         section.style.height = highestSection+'px';
        //     }
        // });
        // document.querySelector('.section-left9').style.height = highestSection+'px';
        // console.dir(highestSection);

        sectionAutoHeight(15);

    });
}
slickSlider();

function sectionAutoHeight(items) {
    const sections = document.querySelectorAll('.compare-item__section');
    if (sections.length) {
        for (let i = 1; i <= items; i++) {
            let highestSection = 0;
            sections.forEach((section) => {
                if (section.classList.contains('section'+i)) {
                    if (section.offsetHeight > highestSection) {
                        highestSection = section.offsetHeight;
                    }
                }
            });
            sections.forEach((section) => {
                if (section.classList.contains('section'+i)) {
                    section.style.height = highestSection+'px';
                }
            });
            document.querySelector('.section-left'+i).style.height = highestSection+'px';
        }
    }
}

function filepondReviews() {
    const singleGlampings = document.querySelector('.single-glampings');
    if (!singleGlampings) return;
    const input = document.querySelector('input#filepondRev');
    // FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.registerPlugin(
        // FilePondPluginFileValidateType,
        // FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        // FilePondPluginImageTransform,
        // FilePondPluginImageEdit
    );

    FilePond.create( input,
        {
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact',
            // imagePreviewTransparencyIndicator: 'grid'
        }
    );
}
// filepondReviews();

function fileUploadWithPreviewReviews() {
    const reviewsImg = document.querySelector('.reviews-img');
    if (!reviewsImg) return;
    const upload = new FileUploadWithPreview.FileUploadWithPreview(
        'reviews-img',
        {
            maxFileCount: 9,
            multiple: true,
            accept: '.jpg, .jpeg, .png',
            text: {
                browse: 'Загрузить',
                chooseFile: 'Выберите файлы...',
                label: 'Выберите файлы для загрузки',
                selectedCount: 'файлов выбрано'
            }
        }
    );
    const btn = document.querySelector('#btn-submit');
    btn.addEventListener('click', (e) => {
        const form = document.querySelector('#glc-add-reviews');
        let formData = new FormData(form);
        // console.dir(upload.cachedFileArray);
        console.dir(formData);
    });
}
fileUploadWithPreviewReviews();

const addReviews = () => {
    const form = document.querySelector('#single_reviews');
    const btn = document.querySelector('#btn-submit');
    if (!form) return;
    const starsWarning = document.querySelector('.full-stars-warning');
    const reviewsDescription = document.querySelector('#reviews_description');
    btn.addEventListener('click', (e) => {
        const reviewsDescription = document.querySelector('#reviews_description');
        const ratingBtns = document.querySelectorAll('input[name="fst"]');;
        let formData = new FormData(form);
        ratingBtns.forEach((item) => {
            if (item.checked) {
                formData.append('review_rating', item.value);
            }
        });
        formData.append('review_description', reviewsDescription.value);
        formData.append('nonce', glamping_club_ajax.nonce);
        formData.append('user_id', glamping_club_ajax.user_id);
        formData.append('glempid', btn.dataset.glempid);
        formData.append('action', 'add_reviews');

        jQuery(document).ready( function($){
            $.ajax({
                url: glamping_club_ajax.ajaxUrl,
                method: 'post',
                processData: false,
                contentType: false,
                data: formData,
                success: function (data) {
                    console.dir(data);
                    var data_json = JSON.parse(data);
                    console.dir(data_json);
                    if (data_json.type == 'success') {
                        document.querySelector('.modal.active').classList.remove('active');
                        document.querySelector('.js-overlay-modal').classList.remove('active');
                        document.querySelector('body').style.overflowY = '';
                        toastAll(false, 'Отзыв добавлен, после модерации он будет опубликован.', 'success', true, 10000);
                        form.reset();
                        document.querySelector('ul#reviews_media_gallery-status').innerHTML = '';
                        reviewsDescription.value = '';
                        ratingBtns.forEach((item) => {
                            item.checked = false;
                        });
                        document.querySelector('input#fst-0').checked = true;
                    } else if (data_json.type == 'errors') {
                        if (data_json.empty_rating) {
                            starsWarning.style.display = 'block';
                            setTimeout(function(){
                                starsWarning.style.display = '';
                            }, 6000);
                        }
                        if (data_json.empty_description) {
                            reviewsDescription.style.border = '1px solid red';
                            setTimeout(function(){
                                reviewsDescription.style.border = '';
                            }, 6000);
                        }
                    }
                },
                error: function (jqXHR, text, error) {
                    console.dir(error);
                }
            });
        });

    });
}
addReviews();

const reviewsMore = () => {
    const moreBtn = document.querySelector('.js-reviews-more');
    if (moreBtn) {
        const reviews = document.querySelector('.reviews-items');
        // console.dir(moreBtn.dataset.count);
        if (+moreBtn.dataset.count > 5) {
            moreBtn.style.display = 'inline-block';
        }
        moreBtn.addEventListener('click', (e) => {
            let formData = new FormData();
            formData.append('nonce', glamping_club_ajax.nonce);
            formData.append('action', 'reviews_more');
            formData.append('offset', moreBtn.dataset.pagenum);
            formData.append('post_id', moreBtn.dataset.post);
            let numList = +moreBtn.dataset.pagenum;
            ( function( $ ) {
                $.ajax({
                    url: glamping_club_ajax.ajaxUrl,
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {},
                    success: function (data) {
                        // console.dir(data);
                        reviews.insertAdjacentHTML('beforeEnd', data);
                        btnWievsOverflows('.reviews-items__item-text');
                        // collapseViewsReviews();
                        initOptionsGalleryRev(100, numList*5);
                        countImgRev();
                    },
                    error: function (jqXHR, text, error) {
                        console.log('Send error');
                    }
                });
            }( jQuery ) );
            moreBtn.dataset.pagenum = +moreBtn.dataset.pagenum+1;
            if (+moreBtn.dataset.pagenum*5 >= +moreBtn.dataset.count) {
                moreBtn.style.display = '';
            }
            // initSliderGlempReview(100);
            // setTimeout(function(){
            //     initSliderGlempReview(100);
            //     initOptionsGalleryReview(100);
            //     initOptionsGalleryRev(100, numList*5);
            // }, 400);
        });
    }
}
reviewsMore();

function fileDown() {
    let load = document.querySelector('#load');
    if (!load) return;
    document.querySelector('#file').addEventListener('change', function(e) {
      let tgt = e.target || window.event.srcElement,
            files = tgt.files;
      // load.innerHTML = '';
      if(files && files.length) {
        for(let i = 0; i < files.length; i++) {
            let $self = files[i],
                    fr = new FileReader();
            fr.onload = function(e) {
            load.insertAdjacentHTML('beforeEnd', `<div class="load-img"><img src="${e.srcElement.result}"/></div>`);
            // load.insertAdjacentHTML('beforeEnd', `<div class="load-img"><img src="${e.srcElement.result}"/><p>${$self.name}</p></div>`);
            }
            fr.readAsDataURL(files[i]);
        };
      }
    });
}

const deleteFavCom = () => {
    const favoritesBtns = document.querySelectorAll('#delete-favorites');
    const comparisonBtns = document.querySelectorAll('#delete-comparison');
    if (favoritesBtns.length) {
        const supFavorites = document.querySelectorAll('#sup-favorites');
        favoritesBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                let glcFavCount = localChengC('glcFav', btn.dataset.postid);
                btn.parentElement.parentElement.parentElement.parentElement.remove();
                supFavorites.forEach((item) => {
                    item.innerHTML = glcFavCount;
                });
            });
        });
    }
    if (comparisonBtns.length) {
        const supComparison = document.querySelectorAll('#sup-comparison');
        comparisonBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                let glcComparCount = localChengC('glcCompar', btn.dataset.postid);
                btn.parentElement.parentElement.parentElement.parentElement.remove();
                document.querySelector('#post-info-'+btn.parentElement.parentElement.parentElement.parentElement.dataset.info).remove();
                // jQuery(document).ready( function($){
                //     $('.mySlick1').slick('slickRemove', 6);
                //     $('.mySlick2').slick('slickRemove', 6);
                // });
                supComparison.forEach((item) => {
                    item.innerHTML = glcComparCount;
                });
                location.reload();
                // slickSlider();
            });
        });
    }
}
deleteFavCom();

function localChengC(name, value) {
    let ls_obj = [];
    if ( Cookies.get(name) ) { // localStorage.getItem(name)
        let ls = Cookies.get(name); // localStorage.getItem(name)
        ls_obj = ls.split(',');
        if (ls_obj.includes(value)) {
            ls_obj = ls_obj.filter((i) => i !== value);
        } else {
            ls_obj.push(value);
        }
    } else {
        ls_obj = [];
        ls_obj.push(value);
    }
    // localStorage.setItem(name, ls_obj);
    // Cookies.remove('name')
    Cookies.set(name, ls_obj);
    return ls_obj.length;
}

function accordion(btnSelector, afterClose=0) {
    const acc = document.querySelectorAll('.faq-item '+btnSelector);
    if (acc.length) {
        acc.forEach((item) => {
            item.addEventListener('click', (e) => {
                if (afterClose) {
                    accFor(acc, item);
                    if (item.classList.contains('active')) {
                        item.classList.remove('active');
                        item.nextElementSibling.classList.remove('active');
                    } else {
                        item.classList.add('active');
                        item.nextElementSibling.classList.add('active');
                    }
                } else {
                    item.classList.toggle('active');
                    item.nextElementSibling.classList.toggle('active');
                }
            });
        });
    }
}
accordion('.faq-item__header', 1);

function accFor(acc, item) {
    acc.forEach((el) => {
        if (el != item) {
            el.nextElementSibling.classList.remove('active');
            el.classList.remove('active');
        }
    });
}

function collapseViewsReviews() {
    const btns = document.querySelectorAll('.reviews-items__item-btn button');
    if (!btns.length) return;
    btns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            // console.dir(btn);
            btn.parentElement.previousElementSibling.classList.toggle('active');
            btn.children[1].classList.toggle('active');
            if (btn.children[1].classList.contains('active')) {
                btn.children[0].innerText = 'Скрыть';
            } else {
                btn.children[0].innerText = 'Показать полностью';
            }
        });
    });
}
// collapseViewsReviews();

function collapseReviews(btn) {
    btn.parentElement.previousElementSibling.classList.toggle('active');
    btn.children[1].classList.toggle('active');
    if (btn.children[1].classList.contains('active')) {
        btn.children[0].innerText = 'Скрыть';
    } else {
        btn.children[0].innerText = 'Показать полностью';
    }
}

const facilitiesMore = () => {
    const btn = document.querySelector('.js-facilities-more');
    if (!btn) return;
    let elems = btn.previousElementSibling.children;
    let elNone = 0;
    for (var elem of elems) {
        if (getComputedStyle(elem).display == 'none') {
            elNone++;
        }
    }
    if (elNone > 0) {
        btn.classList.add('activate');
    }
    btn.addEventListener('click', (e) => {
        if (btn.dataset.type == 'no') {
            for (var variable of btn.parentElement.children[0].children) {
                variable.style.display = 'block';
            }
            btn.innerText = 'Свернуть';
            btn.dataset.type = 'yes';
        } else {
            for (var variable of btn.parentElement.children[0].children) {
                variable.style.display = '';
            }
            btn.innerText = 'Показать все удобства';
            btn.dataset.type = 'no';
        }
    });
}
// facilitiesMore();

function btnWievsOverflows(elem) {
    const elems = document.querySelectorAll(elem);
    elems.forEach((el) => {
        if (multiLineOverflows(el)) {
            el.nextElementSibling.classList.add('active');
        }
    });
}
btnWievsOverflows('.reviews-items__item-text');

function btnWievsWtd(elem) {
    const elems = document.querySelectorAll(elem);
    if (!elems.length) return;
    elems.forEach((elem) => {
        let el = elem.previousElementSibling
        if (multiLineOverflows(el)) {
            el.classList.add('is-button');
            elem.classList.add('active');
        }
    });

    var wtdSwiper = new Swiper(".wtdSwiper", {
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}
btnWievsWtd('.js-btndetails-wtd');

const collapseViewsStocks = () => {
    const btns = document.querySelectorAll('button.js-stocks-more');
    if (!btns.length) return;
    btns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            btn.parentElement.previousElementSibling.children[2].classList.toggle('activate');
            btn.parentElement.classList.toggle('activate');
            if (btn.parentElement.classList.contains('activate')) {
                btn.innerText = 'Свернуть';
            } else {
                btn.innerText = 'Подробнее';
            }
        });
    });
}
collapseViewsStocks();

const collapseAccMobile = () => {
    const btn = document.querySelector('button.js-acc-more-all');
    if (!btn) return;
    btn.addEventListener('click', (e) => {
        btn.classList.toggle('active');
        let items = btn.parentElement.previousElementSibling.children;
        for (var item of items) {
            item.classList.toggle('active');
        }
        if (btn.classList.contains('active')) {
            btn.innerText = 'Свернуть';
        } else {
            btn.innerText = 'Все варианты';
        }

    });
}
collapseAccMobile();

function multiLineOverflows(el) {
    return el.scrollHeight > el.clientHeight;
}

const countImgRev = () => {
    const reviews = document.querySelectorAll('.reviews-items__item');
    if (!reviews.length) return;
    reviews.forEach((item, i) => {
        if (item.children[2].children[0]) {
            let elNone = 0;
            for (var variable of item.children[2].children[0].children) {
                if (variable.classList.contains('galery-review-list__item')) {
                    if (getComputedStyle(variable).display == 'none') {
                        elNone++;
                    }
                }
            }
            if (+elNone > 0) {
                item.children[2].children[0].lastElementChild.children[1].innerText = elNone;
                item.children[2].children[0].lastElementChild.classList.add('active');
            }
        }
    });

    window.addEventListener('resize', (e) => {
        reviews.forEach((item, i) => {
            if (item.children[2].children[0]) {
                let elNone = 0;
                for (var variable of item.children[2].children[0].children) {
                    if (variable.classList.contains('galery-review-list__item')) {
                        if (getComputedStyle(variable).display == 'none') {
                            elNone++;
                        }
                    }
                }
                if (+elNone > 0) {
                    item.children[2].children[0].lastElementChild.children[1].innerText = elNone;
                    item.children[2].children[0].lastElementChild.classList.add('active');
                } else {
                    item.children[2].children[0].lastElementChild.children[1].innerText = elNone;
                    item.children[2].children[0].lastElementChild.classList.remove('active');
                }
            }
        });
    });
}
countImgRev();

function headerScroll() {
    const header = document.getElementById('genhead');
    if (!header) return;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        // console.dir(currentScrollPos);
        if (currentScrollPos > 200) {
            header.classList.add('fixed');
        } else {
            header.classList.remove('fixed');
        }
    };
}
headerScroll();

function headerMobileBtn() {
    const search = document.getElementById('header-mobile-search');
    const toggle = document.getElementById('header-mobile-toggle');
    const searchClose = document.getElementById('search-btn-close');
    if (search) {
        const searchForm = document.querySelector('.gen-header__top__search');
        search.addEventListener('click', (e) => {
            searchForm.classList.add('active');
            search.parentElement.classList.add('dispnone');
        });

        searchClose.addEventListener('click', (e) => {
            e.preventDefault();
            searchForm.classList.remove('active');
            search.parentElement.classList.remove('dispnone');
        });
    }

    if (toggle) {
        const navMobile = document.querySelector('.nav-mobile');
        const overlay = document.querySelector('.js-overlay-modal');
        const navClose = document.querySelector('.nav-mobile__close');
        toggle.addEventListener('click', (e) => {
            overlay.classList.add('active');
            navMobile.classList.add('active');
        });
        overlay.addEventListener('click', (e) => {
            overlay.classList.remove('active');
            navMobile.classList.remove('active');
        });
        navClose.addEventListener('click', (e) => {
            overlay.classList.remove('active');
            navMobile.classList.remove('active');
        });
    }
}
headerMobileBtn();

const contactMobileAction = () => {
    const contactMobileBtn = document.querySelector('.js-contact-mobile');
    if (!contactMobileBtn) return;
    contactMobileBtn.addEventListener('click', (e) => {
        document.querySelector('.nav-mobile').classList.remove('active');
        document.querySelector('.js-overlay-modal').classList.remove('active');
    });
}
contactMobileAction();

const contactAction = () => {
    const form = document.querySelector('form.modal-form');
    const btn = document.querySelector('#contact-form-btn');
    if (!btn) return;
    const contentSuccess = document.querySelector('.content-success');
    btn.addEventListener('click', (e) => {
        let formData = new FormData(form);
        formData.append('nonce', glamping_club_ajax.nonce);
        formData.append('action', 'contact');
        ( function( $ ) {
            $.ajax({
                url: glamping_club_ajax.ajaxUrl,
                method: 'post',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function () {},
                success: function (data) {
                    let jsonData = JSON.parse(data);
                    // console.dir(jsonData);
                    if (jsonData.class == 'error') {
                        if (jsonData.name) {
                            form.elements.name_contact.style.border = '1px solid red';
                        }
                        if (jsonData.phone) {
                            form.elements.phone_contact.style.border = '1px solid red';
                        }
                        if (jsonData.privacy) {
                            form.elements.privacy.nextElementSibling.children[1].style.color = 'red';
                        }
                    } else if (jsonData.class == 'success') {
                        contentSuccess.classList.add('active');
                    }
                },
                error: function (jqXHR, text, error) {
                    console.log('Send error');
                }
            });
        }( jQuery ) );
    });

    form.elements.name_contact.addEventListener('input', (e) => {
        form.elements.name_contact.style.border = '';
    });
    form.elements.phone_contact.addEventListener('input', (e) => {
        form.elements.phone_contact.style.border = '';
    });
    form.elements.privacy.addEventListener('change', (e) => {
        form.elements.privacy.nextElementSibling.children[1].style.color = '';
    });
}
contactAction();

function optionsFiltrFront(elemsClass) {
    const elems = document.querySelectorAll(elemsClass);
    if (!elems.length) return;
    elems.forEach((elem) => {
        elem.addEventListener('click', (e) => {
            elem.nextElementSibling.classList.toggle('active');
        });
    });

    // window.onscroll = function() {
    //     elems.forEach((elem) => {
    //         elem.children[1].classList.remove('active');
    //     });
    // };
}
optionsFiltrFront('.js-with-options');

function optionsFiltrFrontAction(elem, type) {
    let elems = elem.parentElement.children;
    for (var item of elems) {
        item.classList.remove('current');
    }
    type.value = elem.innerText;
    elem.classList.add('current');
    type.previousElementSibling.previousElementSibling.children[0].innerText = elem.innerText;
    elem.parentElement.parentElement.parentElement.classList.remove('active');
    elem.parentElement.parentElement.parentElement.parentElement.classList.remove('active');
}

function searhFront() {
    const searchBtn = document.getElementById('searh-front');
    if (!searchBtn) return;
    searchBtn.addEventListener('click', (e) => {
        let glcRegion = document.getElementById('region').value;
        let glcType = document.getElementById('place').value;

        if (glcRegion || glcType) {
            localStorage.setItem('glcRegion', glcRegion);
            localStorage.setItem('glcType', glcType);
            localStorage.setItem('glcRefFront', 'front');
            window.location.href = '/glampings/';
        }
    });
    // console.dir(elem);
}
searhFront();

const newModal = new HystModal({
    linkAttributeName: "data-hystmodal",
    catchFocus: false,
    backscroll: false,
    // fixedSelectors: 'body',
    // beforeOpen: function(modal){
    //     document.querySelector('.nav-mobile').remove('active');
    //     document.querySelector('.js-overlay-modal').remove('active');
    // },
    afterClose: function(modal){
        // console.log('Message after modal has closed');
        // console.dir(modal._modalBlock); //modal window object
        const form = document.querySelector('form.modal-form');
        const contentSuccess = document.querySelector('.content-success');
        if (form) {
            form.reset();
            form.elements.name_contact.style.border = '';
            form.elements.phone_contact.style.border = '';
        }
        if (contentSuccess) {
            contentSuccess.classList.remove('active');
            form.elements.privacy.nextElementSibling.children[1].style.color = '';
            form.elements.privacy.nextElementSibling.children[1].style.color = '';
        }
    },
});

function autocompleteAction() {
    const inputs = document.querySelectorAll('.js-autocomplete');
    if (!inputs.length) return;
    inputs.forEach((input) => {
        console.dir(input);
        input.attributes.autocomplete.value = autoId();
    });
}
// autocompleteAction();

function autoId(){
    var autoId = "";
    var dict = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for(var i=0; i<12; i++){
        autoId += dict.charAt(Math.floor(Math.random() * dict.length));
    }
    return autoId;
}

document.addEventListener("DOMContentLoaded", function () {
    var eventCalllback = function (e) {
        var el = e.target,
        clearVal = el.dataset.phoneClear,
        pattern = el.dataset.phonePattern,
        matrix_def = "+7(___) ___-__-__",
        matrix = pattern ? pattern : matrix_def,
        i = 0,
        def = matrix.replace(/\D/g, ""),
        val = e.target.value.replace(/\D/g, "");
        if (clearVal !== 'false' && e.type === 'blur') {
            if (val.length < matrix.match(/([\_\d])/g).length) {
                e.target.value = '';
                return;
            }
        }
        if (def.length >= val.length) val = def;
        e.target.value = matrix.replace(/./g, function (a) {
            return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a
        });
    }
    //var phone_inputs = document.querySelectorAll('[data-phone-pattern]');
    var phone_inputs = document.querySelectorAll('.phone_mask');
    for (let elem of phone_inputs) {
        for (let ev of ['input', 'blur', 'focus']) {
            elem.addEventListener(ev, eventCalllback);
        }
    }
});

function newScrollbar() {
    const Scrollbar = window.Scrollbar;
    const elems = document.querySelectorAll('.my-scrollbar');
    if (!elems.length) return;
    elems.forEach((elem) => {
        Scrollbar.init(elem, {
            alwaysShowTracks: true
        });
    });
}
newScrollbar();

function sliderRegionFront() {
    const sliders = document.querySelectorAll('.js-splide-slider');
    if (!sliders.length) return;
    sliders.forEach((slider) => {
        new Splide( slider, {
            type   : 'loop',
            drag   : 'free',
            perPage: 5,
            gap: 4,
            pagination: false,
            arrows: false,
            autoWidth: true,
            autoHeight:  true,
            autoScroll: {
                speed: 0.5,
                pauseOnFocus: false
            }
        }).mount(window.splide.Extensions); // window.splide.Extensions
    });
}
sliderRegionFront();

const btnFullScr = () => {
    const btn = document.querySelector('#fullscreen');
    if (btn) {
        setTimeout(function(){
            btn.classList.add('vis');
        }, 600);
    }
}
btnFullScr();

function toggleFullScreen(elem) {
    const map = document.querySelector('.glampings-map');
    if (!document.fullscreenElement) {
        if (map.requestFullscreen) {
            map.requestFullscreen();
            elem.style.backgroundColor = '#ffeba0';
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
            elem.style.backgroundColor = '';
        }
    }
}

Cookies.set('mediaQuery', window.innerWidth);

// console.dir(JSON.parse(glamping_club_ajax.glAll));
//
// console.dir(Scrollbar.getAll());
