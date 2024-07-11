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

function initSliderGlempType(item) {
    for (var i = 0; i < item; i++) {
        sliderGlempType('.galery'+i, '#sw-'+i, 2, 3, 5, 6);
    }
}

function optionsGallery(index) {
    const gallery = document.querySelector(index);
    const lg = lightGallery(gallery, {
        selector: '.acc-media',
        download: false,
        plugins: [lgThumbnail],
    });
    const btn = document.querySelector(index+' #js-gallery-count');
    if (btn) {
        btn.addEventListener('click', (e) => {
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
    btn.addEventListener('click', (e) => {
        singleAside.classList.toggle('active');
        iconPhone.classList.toggle('active');
        iconMessage.classList.toggle('active');
        svgClose.classList.toggle('active');
    });

    document.addEventListener( 'click', (e) => {
        const withinsingleAside = e.composedPath().includes(singleAside);
        const withinsingleBtn = e.composedPath().includes(btn);
        if ( ! withinsingleAside && !withinsingleBtn ) {
            singleAside.classList.remove('active');
            iconPhone.classList.remove('active');
            iconMessage.classList.remove('active');
            svgClose.classList.remove('active');
        }
    });

    document.addEventListener('keydown', function(e) {
        if( e.keyCode == 27 ) {
            singleAside.classList.remove('active');
            iconPhone.classList.remove('active');
            iconMessage.classList.remove('active');
            svgClose.classList.remove('active');
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

const addFavCom = () => {
    const favoritesBtns = document.querySelectorAll('#add-favorites');
    const comparisonBtns = document.querySelectorAll('#add-comparison');
    if (favoritesBtns.length) {
        const supFavorites = document.querySelector('#sup-favorites');
        favoritesBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                let glcFavCount = localCheng('glcFav', btn.dataset.postid);
                supFavorites.innerHTML = glcFavCount;
                btn.classList.toggle('active');
                if (btn.classList.contains('active')) {
                    btn.attributes.title.value = 'Удалить из избранного';
                    console.dir(btn);
                } else {
                    btn.attributes.title.value = 'Добавить в избранное';
                }
            });
        });
    }
    if (comparisonBtns.length) {
        const supComparison = document.querySelector('#sup-comparison');
        comparisonBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                let glcComparCount = localCheng('glcCompar', btn.dataset.postid);
                supComparison.innerHTML = glcComparCount;
                btn.classList.toggle('active');
                if (btn.classList.contains('active')) {
                    btn.attributes.title.value = 'Удалить из сравнения';
                    console.dir(btn);
                } else {
                    btn.attributes.title.value = 'Добавить к сравнению';
                }
            });
        });
    }
}
addFavCom();

const deleteFavCom = () => {
    const favoritesBtns = document.querySelectorAll('#delete-favorites');
    const comparisonBtns = document.querySelectorAll('#delete-comparison');
    if (favoritesBtns.length) {
        const supFavorites = document.querySelector('#sup-favorites');
        favoritesBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                let glcFavCount = localCheng('glcFav', btn.dataset.postid);
                supFavorites.innerHTML = glcFavCount;
                btn.parentElement.parentElement.parentElement.parentElement.remove();
            });
        });
    }
    if (comparisonBtns.length) {
        const supComparison = document.querySelector('#sup-comparison');
        comparisonBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                let glcComparCount = localCheng('glcCompar', btn.dataset.postid);
                supComparison.innerHTML = glcComparCount;
                btn.parentElement.parentElement.parentElement.parentElement.remove();
            });
        });
    }
}
deleteFavCom();

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

function favoritesRender() {
    const supFavorites = document.querySelector('#sup-favorites');
    const supComparison = document.querySelector('#sup-comparison');
    const addFavorites = document.querySelector('#add-favorites');
    const addComparison = document.querySelector('#add-comparison');
    let glcFav = favoritesRenderNologin('glcFav');
    let glcCompar = favoritesRenderNologin('glcCompar');
    if (supFavorites) {
        supFavorites.innerHTML = glcFav.length;
        if (addFavorites) {
            if (glcFav.includes(addFavorites.dataset.postid)) {
                addFavorites.classList.add('active');
                addFavorites.attributes.title.value = 'Удалить из избранного';
            }
        }
    }
    if (supComparison) {
        supComparison.innerHTML = glcCompar.length;
        if (addComparison) {
            if (glcCompar.includes(addComparison.dataset.postid)) {
                addComparison.classList.add('active');
                addComparison.attributes.title.value = 'Удалить из сравнения';
            }
        }
    }
}
favoritesRender();

function favoritesRenderNologin(name) {
    // const glcFav = localStorage.getItem('glcFav');
    const glcFav = Cookies.get(name);
    let glcFav_obj = [];
    if (glcFav) {
        glcFav_obj = glcFav.split(',');
    }
    // else {
    //     glcFav_obj = glcFav.split('');
    // }
    // console.dir(glcFav_obj);
    return glcFav_obj;
}

function favoritesRenderLogin() {
    // if (glamping_club_ajax.user_id) {
    //
    // } else {
    //     const glcFav = localStorage.getItem('glcFav');
    //     const glcFav_obj = glcFav.split(',');
    // }
}

function mapRender() {
    const archiveGlampings = document.querySelector('#archive-glampings');
    if (!archiveGlampings) return;
    ymaps.ready(init);
	function init() {
        var map;
		var geoJson = JSON.parse(glamping_club_ajax.glAll);
		var zoomNum = (glamping_club_ajax.yand_zoom) ? glamping_club_ajax.yand_zoom : 12;
		map = new ymaps.Map('mapYandex', {center:[54.9924, 73.3686], zoom:zoomNum, controls: ['zoomControl',  /*'fullscreenControl'*/]}),
		map.behaviors.disable(['scrollZoom']);
		objectManager = new ymaps.ObjectManager({
			clusterize: true,
			gridSize: 32,
			clusterDisableClickZoom: true
		});
		objectManager.clusters.options.set({preset: 'islands#redClusterIcons'}); // , clusterIconColor: '#00ABAA'
		objectManager.objects.options.set({preset: 'islands#greenMountainIcon'}); // , iconColor: '#00ABAA'
		objectManager.add(geoJson);
		map.geoObjects.add(objectManager);
		map.setBounds(map.geoObjects.getBounds(),{checkZoomRange:true, zoomMargin:9});
		map.geoObjects.events.add('click', function (e) {
			let id = e.get('objectId');
			let geoObject = objectManager.objects.getById(id);
			// console.dir(geoObject.properties.id);
		});
	};

	const glPosts = document.querySelectorAll('.glamping-item');
	glPosts.forEach((post) => {
		let postId = post.id.split('-')[1];
		post.addEventListener('mouseenter', function() {
			refreshObjects(Number(postId));
		});
		post.addEventListener('mouseleave', function() {
			backObjects();
		});
	});
}
mapRender();

function refreshObjects(elementId) {
    objectManager.objects.each(object => {
        const isActive = object.id === elementId;
        objectManager.objects.setObjectOptions(object.id, {
            preset: isActive ? 'islands#redMountainIcon' : 'islands#greenMountainIcon'
        })
    });
}

function backObjects() {
    objectManager.objects.each(object => {
        objectManager.objects.setObjectOptions(object.id, {
            preset: 'islands#greenMountainIcon'
        })
    });
}

function sliderNumber() {
    const slider = document.getElementById('glc-slider');
    if (!slider) return;

    const minPriceInput = document.getElementById('min_price');
    const maxPriceInput = document.getElementById('max_price');

    noUiSlider.create(slider, {
        start: [2000, 80000],
        connect: true,
        range: {
            'min': 2000,
            'max': 8000
        }
    });

    slider.noUiSlider.on('update', function () {
        let sliderValue = slider.noUiSlider.get();
        minPriceInput.value = Math.ceil(sliderValue[0]);
        maxPriceInput.value = Math.ceil(sliderValue[1]);
        // console.dir(sliderValue);

        // contractSum.value = '$' +Math.round(sliderValue);
        // rangeSliderHash.noUiSlider.set(sliderValue/+motherhash_ajax.cost_power);
        // contractHash.innerText = (sliderValue/+motherhash_ajax.cost_power).toFixed(1) + ' TH/s';
        // if (resultSumm) {
        //     resultSumm.innerText = Math.round(sliderValue);
        // }
    });

    slider.noUiSlider.on('end', function () {
        let sliderValue = slider.noUiSlider.get();
        console.dir(sliderValue);
    });
}
sliderNumber();

const listCardMap = () => {
    const btnMap = document.querySelector('.js-btn-map');
    if (!btnMap) return;
    const glampingsItems = document.querySelector('#archive-glampings .glampings-items');
    const glampingsMap = document.querySelector('.glampings-map');
    const archGlampingsLeft = document.querySelector('.archive-glampings__left');
    const btns = btnMap.querySelectorAll('button');
    btns.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            btnMapChange(btns);
            btn.classList.add('active');
            if (btn.id == 'mapVision') {
                archGlampingsLeft.classList.remove('no-map');
                glampingsItems.classList.remove('card');
                glampingsItems.classList.add('list');
                glampingsMap.classList.add('active');
                glampingsMap.children[0].innerHTML = '';
                mapRender();
            } else if (btn.id == 'mapClose') {
                glampingsItems.classList.remove('list');
                glampingsItems.classList.add('card');
                glampingsMap.classList.remove('active');
                archGlampingsLeft.classList.add('no-map');
            }
            Cookies.set('glcTemp', btn.id);
        });
        // console.dir(btn);
    });
}
listCardMap();

function btnMapChange(btns) {
    btns.forEach((btn) => {
        btn.classList.remove('active');
    });
}
