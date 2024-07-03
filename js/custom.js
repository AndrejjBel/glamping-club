const singleThumbnailGallery = () => {
    const thumbGallery = document.querySelector('#single-thumbnail');
    if (!thumbGallery) return;
    const btn = thumbGallery.querySelector('#js-gallery-count');
    const tg = lightGallery(thumbGallery, {
        selector: '.item',
        download: false,
        plugins: [lgThumbnail],
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
singleAccOptionGallery();

const sliderGlempType = ( index, indexItem, defolt, mob, tablet, decstop ) => {
    const swiperType = new Swiper(index, {
        slidesPerView: defolt,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            type: "progressbar",
        },
        breakpoints: {
            399: {
                slidesPerView: mob,
            },
            768: {
                slidesPerView: tablet,
            },
            1024: {
                slidesPerView: decstop,
            },
        },
        on: {
            init: function () {
                const lg = lightGallery(document.querySelector(index), {
                    selector: '.acc-media',
                    download: false,
                    plugins: [lgThumbnail],
                });
                const slide = document.querySelector(indexItem);
                slide.addEventListener('lgBeforeClose', () => {
                    swiperType.slideTo(lg.index, 0)
                });
            },
        }
    });
}
sliderGlempType('.galery1', '#sw-1', 2, 3, 5, 6);
sliderGlempType('.galery2', '#sw-2', 2, 3, 5, 6);
sliderGlempType('.galery3', '#sw-3', 2, 3, 5, 6);
sliderGlempType('.galery4', '#sw-4', 2, 3, 5, 6);
sliderGlempType('.galery5', '#sw-5', 2, 3, 5, 6);
sliderGlempType('.galery6', '#sw-6', 2, 3, 5, 6);
sliderGlempType('.galery7', '#sw-7', 2, 3, 5, 6);
sliderGlempType('.galery8', '#sw-8', 2, 3, 5, 6);
sliderGlempType('.galery9', '#sw-9', 2, 3, 5, 6);
sliderGlempType('.galery10', '#sw-10', 2, 3, 5, 6);
sliderGlempType('.galery11', '#sw-11', 2, 3, 5, 6);
sliderGlempType('.galery12', '#sw-12', 2, 3, 5, 6);
sliderGlempType('.galery13', '#sw-13', 2, 3, 5, 6);
sliderGlempType('.galery14', '#sw-14', 2, 3, 5, 6);
sliderGlempType('.galery15', '#sw-15', 2, 3, 5, 6);
sliderGlempType('.galery16', '#sw-16', 2, 3, 5, 6);
sliderGlempType('.galery17', '#sw-17', 2, 3, 5, 6);
sliderGlempType('.galery18', '#sw-18', 2, 3, 5, 6);
sliderGlempType('.galery19', '#sw-19', 2, 3, 5, 6);
sliderGlempType('.galery20', '#sw-20', 2, 3, 5, 6);

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
