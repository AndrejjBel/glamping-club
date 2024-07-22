const locationsArchive = (glempAll) => {
    const regionItem = document.querySelector('.filtr-item.region');
    if (!regionItem) return;
    let locObj = [];
    glempAll.forEach((item) => {
        let locItem = {
            location: item.location,
            location_id: item.location_id,
            location_slug: item.location_slug,
        }
        locObj.push(locItem);
    });
    locObj = removeDuplicates(locObj);

    locObj.sort(function(a, b) {
        return a.location.localeCompare(b.location);
    });

    if (locObj.length) {
        countFiltrItem('glcRegion', regionItem);
        ls = localStorage.getItem('glcRegion');
        let chek = '';
        regionItem.children[1].innerHTML = '';
        locObj.forEach((item) => {
            if (ls) {
                if (ls.includes(item.location)) {
                    chek = 'checked';
                } else {
                    chek = '';
                }
            }
            let count = glempAll.filter(elem => elem.location_id == item.location_id);
            regionItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item.location_id}" name="${item.location}" data-name="glcRegion" value="" ${chek}>
                    <label for="${item.location_id}">
                        <span class="checkmark fcheckbox">
                            <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
                            </svg>
                        </span>
                        <span class="name">${item.location}</span>
                        <span class="count">${count.length}</span>
                    </label>
                </li>`
            )
        });
    }
}
locationsArchive(JSON.parse(glamping_club_ajax.glAll));

const filtrTypeArchive = (glempAll) => {
    const typeItem = document.querySelector('.filtr-item.type');
    if (!typeItem) return;
    let typObj = [];
    if ( glempAll.length > 1 ) {
        glempAll.forEach((item) => {
            typObj = typObj.concat(item.type);
        });
        typObj = makeUniqSort(typObj);
    } else {
        typObj = glempAll[0].type
    }
    if (typObj.length) {
        typeItem.children[1].innerHTML = '';
        countFiltrItem('glcType', typeItem);
        ls = localStorage.getItem('glcType');
        let chek = '';
        typObj.forEach((item) => {
            if (ls) {
                if (ls.includes(item)) {
                    chek = 'checked';
                } else {
                    chek = '';
                }
            }
            let count = glempAll.filter(elem => elem.type.includes(item));
            typeItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item}" name="${item}" data-name="glcType" value="" ${chek}>
                    <label for="${item}">
                        <span class="checkmark fcheckbox">
                            <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
                            </svg>
                        </span>
                        <span class="name">${item}</span>
                        <span class="count">${count.length}</span>
                    </label>
                    <span></span>
                </li>`
            )
        });
    }
}
filtrTypeArchive(JSON.parse(glamping_club_ajax.glAll));

function removeDuplicates(arr) {
  const locationsById = ((
    function() {
      return arr.reduce((acc, n) => ((acc[n.location_id] ??= []).push(n), acc), {});
    })(arr)
  )
  function getRandom(val) {
    return val[Math.floor(Math.random() * val.length)];
  }
  return Object
    .values(locationsById)
    .map(getRandom);
}

function itemsChange() {
    const filtrItems = document.querySelector('.glampings-filtr-items');
    const glampingsMap = document.querySelector('.glampings-map');
    if (!filtrItems) return;
    filtrItems.addEventListener('click', function(event) {
        let inputs = filtrItems.querySelectorAll('input');
        let input = event.target.closest('input');
        if (input) {
            let glempAll = JSON.parse(glamping_club_ajax.glAll);
            let newgGempAll =  glempAll.filter(filtrOptionsChange);
            glempRender(newgGempAll);
            checkLocalCheng(input, input.dataset.name, '');
            if (input.dataset.name == 'glcRegion') {
                // checkLocalCheng(input, 'glcRegion', '');
                if (!localStorage.getItem('glcType')) {
                    locationsArchive(glempAll);
                    filtrTypeArchive(newgGempAll);
                } else {
                    locationsArchive(newgGempAll);
                    filtrTypeArchive(newgGempAll);
                }
            }
            if (input.dataset.name == 'glcType') {
                // checkLocalCheng(input, 'glcType', '');
                if (!localStorage.getItem('glcRegion')) {
                    // filtrTypeArchive(glempAll);
                    locationsArchive(newgGempAll);
                } else {
                    filtrTypeArchive(newgGempAll);
                    locationsArchive(newgGempAll);

                }
            }
            glampingsMap.children[0].innerHTML = '';
            mapRender(mapPointTest(newgGempAll));
        }
    });
}
itemsChange();

function itemsVal(inputs) {
    let inputChecked = [];
    inputs.forEach((input) => {
        if (input.checked == true) {
            inputChecked.push(input);
        }
    });
    return inputChecked;
}

function checkLocalCheng(item, lsName, filtrItemCount) {
    let ls_obj = [];
    let ls_obj_new = [];
    if ( localStorage.getItem(lsName) ) {
        ls = localStorage.getItem(lsName);
        if (ls.includes(',')) {
            ls_obj = ls.split(',');
            if (item.checked == false) {
                let ls_obj_new = ls_obj.filter(function(e) { return e !== item.name });
                if (ls_obj_new.length == 0) {
                    localStorage.removeItem(lsName)
                } else {
                    localStorage.setItem(lsName, ls_obj_new);
                }
            } else {
                ls_obj.push(item.name);
                ls_obj_new = ls_obj; //.slice();
                localStorage.setItem(lsName, ls_obj_new);
            }
        } else {
            ls_obj.push(ls);
            if (item.checked == false && item.name == ls) {
                localStorage.removeItem(lsName)
            } else {
                ls_obj.push(item.name);
                let ls_obj_new = ls_obj.join(',');
                localStorage.setItem(lsName, ls_obj_new);
            }
        }
    } else {
        ls_obj.push(item.name);
        let ls_obj_new = ls_obj.join(',');
        localStorage.setItem(lsName, ls_obj_new);
    }
    lsf = localStorage.getItem(lsName);
    ls_objf = [];
    if (lsf) {
        if (lsf.includes(',')) {
            ls_objf = lsf.split(',');
            if (ls_objf.length == 0) {
                item.parentElement.parentElement.previousElementSibling.children[1].innerText = '';
            } else {
                item.parentElement.parentElement.previousElementSibling.children[1].innerText = ls_objf.length;
            }
        } else {
            item.parentElement.parentElement.previousElementSibling.children[1].innerText = 1;
        }
    } else {
        item.parentElement.parentElement.previousElementSibling.children[1].innerText = '';
    }
}

function countFiltrItem(name, countSelector) {
    lsf = localStorage.getItem(name);
    ls_objf = [];
    if (lsf) {
        if (lsf.includes(',')) {
            ls_objf = lsf.split(',');
            if (ls_objf.length == 0) {
                countSelector.children[0].children[1].innerText = '';
            } else {
                countSelector.children[0].children[1].innerText = ls_objf.length;
            }
        } else {
            countSelector.children[0].children[1].innerText = 1;
        }
    } else {
        countSelector.children[0].children[1].innerText = '';
    }
}

function filtrOptionsChange(item, index, arr) {
    const inputs = document.querySelectorAll('.glampings-filtr-items input');
    let region = [];
    let types = [];
    inputs.forEach((input) => {
        if (input.checked == true) {
            if (input.dataset.name == 'glcRegion') {
                region.push(input.id);
            } else if (input.dataset.name == 'glcType') {
                types.push(input.id);
            }
        }
    });

    let regionIncl = 1;
    if (region.length) {
        regionIncl = region.map(Number).includes(item.location_id);
    }

    let typesIncl = 1;
    if (types.length) {
        typesIncl = types.some((element) => item.type.includes(element));
    }

    if ( regionIncl && typesIncl ) {
        return true;
    } else {
        return false;
    }
}

function glempRender(glemps) {
    const glampingsItems = document.querySelector('.glampings-items');
    let glcFav = favoritesRender('glcFav');
    glampingsItems.innerHTML = '';
    glemps.forEach((glemp) => {
        let price = currFormat(glemp.price);
        let type = glemp.type.join(', ');
        let clFav = '';
        let titleFav = 'Добавить в избранное';
        if (glcFav.includes(glemp.id)) {
            clFav = ' active';
            titleFav = 'Удалить из избранного';
        }
        let slider = ``;
        glemp.media_urls.forEach((item) => {
            slider += `<div class="swiper-slide"><img src="${item}" alt="" loading="lazy" /></div>`;
        });

        glampingsItems.insertAdjacentHTML(
            "beforeEnd",
            `<div id="post-${glemp.id}" class="glamping-item" title="${glemp.title}">
            	<a href="${glemp.url}" class="glamping-item__url" rel="bookmark"></a>
            	<button id="add-favorites" data-postid="${glemp.id}" class="glamping-item__btn-add round-sup-red${clFav}" type="button" name="button" title="${titleFav}">
            		<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            			<path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
            		</svg>
            	</button>
            	<div class="glamping-item__thumbnail">
                    <div id="slider-post-${glemp.id}" class="swiper slider-post-${glemp.id}">
                        <div class="swiper-wrapper">${slider}</div>
                    	<div class="swiper-button-next"></div>
                    	<div class="swiper-button-prev"></div>
                    	<div class="swiper-pagination"></div>
                    </div>
            	</div>
            	<div class="glamping-item__content">
            		<div class="glamping-item__content__left">
            			<div class="glamping-item__content__title">${glemp.title}</div>
            			<div class="glamping-item__content__rating">
            				<?php reviews_stars_items_average( 2.94, 4 ); ?>
            			</div>
            			<div class="glamping-item__content__bottom">
            				<div class="glamping-item__content__bottom__type">
            					<svg width="10" height="10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path d="M394.3 3.745C401.1 9.425 401.9 19.52 396.3 26.29L308.9 130.4L532.8 397.2C540 405.8 544 416.7 544 428V464C544 490.5 522.5 512 496 512H80C53.49 512 32 490.5 32 464V428C32 416.7 35.98 405.8 43.23 397.2L267.1 130.4L179.7 26.29C174.1 19.52 174.9 9.425 181.7 3.745C188.5-1.936 198.6-1.054 204.3 5.715L287.1 105.5L371.7 5.715C377.4-1.054 387.5-1.936 394.3 3.745H394.3zM64 428V464C64 472.8 71.16 480 80 480H129.9L275.4 294.1C278.4 290.3 283.1 288 288 288C292.9 288 297.6 290.3 300.6 294.1L446.1 480H496C504.8 480 512 472.8 512 464V428C512 424.2 510.7 420.6 508.3 417.7L288 155.3L67.74 417.7C65.33 420.6 64 424.2 64 428zM170.6 480H405.4L288 329.1L170.6 480z"></path>
                                </svg>
            					${type}
            				</div>
            				<div class="glamping-item__content__bottom__address">
            		            <a href="#map-container" title="На карте">
            		                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            		                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C9.87827 2 7.84344 2.84285 6.34315 4.34315C4.84285 5.84344 4 7.87827 4 10C4 13.0981 6.01574 16.1042 8.22595 18.4373C9.31061 19.5822 10.3987 20.5195 11.2167 21.1708C11.5211 21.4133 11.787 21.6152 12 21.7726C12.213 21.6152 12.4789 21.4133 12.7833 21.1708C13.6013 20.5195 14.6894 19.5822 15.774 18.4373C17.9843 16.1042 20 13.0981 20 10C20 7.87827 19.1571 5.84344 17.6569 4.34315C16.1566 2.84285 14.1217 2 12 2ZM12 23C11.4453 23.8321 11.445 23.8319 11.4448 23.8317L11.4419 23.8298L11.4352 23.8253L11.4123 23.8098C11.3928 23.7966 11.3651 23.7776 11.3296 23.753C11.2585 23.7038 11.1565 23.6321 11.0278 23.5392C10.7705 23.3534 10.4064 23.0822 9.97082 22.7354C9.10133 22.043 7.93939 21.0428 6.77405 19.8127C4.48426 17.3958 2 13.9019 2 10C2 7.34784 3.05357 4.8043 4.92893 2.92893C6.8043 1.05357 9.34784 0 12 0C14.6522 0 17.1957 1.05357 19.0711 2.92893C20.9464 4.8043 22 7.34784 22 10C22 13.9019 19.5157 17.3958 17.226 19.8127C16.0606 21.0428 14.8987 22.043 14.0292 22.7354C13.5936 23.0822 13.2295 23.3534 12.9722 23.5392C12.8435 23.6321 12.7415 23.7038 12.6704 23.753C12.6349 23.7776 12.6072 23.7966 12.5877 23.8098L12.5648 23.8253L12.5581 23.8298L12.556 23.8312C12.5557 23.8314 12.5547 23.8321 12 23ZM12 23L12.5547 23.8321C12.2188 24.056 11.7807 24.0556 11.4448 23.8317L12 23Z" fill="black"></path>
            		                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8ZM8 10C8 7.79086 9.79086 6 12 6C14.2091 6 16 7.79086 16 10C16 12.2091 14.2091 14 12 14C9.79086 14 8 12.2091 8 10Z" fill="black"></path>
            		                </svg>
            		                ${glemp.adress}
            		            </a>
            		        </div>
            			</div>
            		</div>
            		<div class="glamping-item__content__right">
            			<div class="glamping-item__content__right__price">
            				<span class="price-number">${price}</span>
            				<span class="price-text">за 1 ночь</span>
            			</div>
            			<div class="glamping-item__content__right__btn">
            				<button class="primary ld w100 btnvib" type="button" name="button">выбрать</button>
            			</div>
            		</div>
            	</div>
            </div>`
        )
    });
    sliderInit();
}

function makeUniq(arr) { return [...new Set(arr)]; }
function makeUniqSort(arr) { return [...new Set(arr)].sort(); }
function makeUniqNum(arr) { return [...new Set(arr)].sort(function(a, b){return a - b}); }
function currFormat(num) {
    let nf = Intl.NumberFormat(
        'ru-RU',
        {
            'currency': 'RUB',
            style:"currency",
            minimumFractionDigits:0,
            maximumFractionDigits:0
        }
    ).format(num);
    return nf;
}

function favoritesRender(name) {
    const glcFav = Cookies.get(name);
    let glcFav_obj = [];
    if (glcFav) {
        glcFav_obj = glcFav.split(',').map(Number);
    }
    return glcFav_obj;
}

function sliderArchiveGlampings(elem) {
    const mySl = new Swiper(elem, {
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
}

function sliderInit() {
    const sliders = document.querySelectorAll('.glamping-item');
    if (!sliders.length) return;
    sliders.forEach((item) => {
        let sl = '.slider-'+item.id;
        sliderArchiveGlampings(sl);
    });

}
sliderInit();

function mapRender(geoData) {
    const archiveGlampings = document.querySelector('#archive-glampings');
    if (!archiveGlampings) return;
    ymaps.ready(init);
	function init() {
        var map;
		var geoJson = geoData; //JSON.parse(glamping_club_ajax.glAllMap);
		var zoomNum = (glamping_club_ajax.yand_zoom) ? Number(glamping_club_ajax.yand_zoom) : 12;
		map = new ymaps.Map('mapYandex',
            {
                center: [54.9924, 73.3686],
                zoom: zoomNum,
                controls: ['zoomControl',  /*'fullscreenControl'*/]
            },
            // {
            //     maxZoom: 12
            // }
        ),
		map.behaviors.disable(['scrollZoom']);
		objectManager = new ymaps.ObjectManager({
			clusterize: true,
			gridSize: 64,
            // viewportMargin: 50
			// clusterDisableClickZoom: true
		});
		objectManager.clusters.options.set({preset: 'islands#darkGreenClusterIcons', clusterIconColor: '#1921B1'}); //  , clusterIconColor: '#00ABAA'
		objectManager.objects.options.set(
            {
                iconLayout: 'default#imageWithContent',
                iconImageHref: '',
                iconImageSize: [80, 24],
                iconImageOffset: [-40, -30]
            },
            // {preset: 'islands#darkGreenStretchyIcon'}
        ); //  islands#greenMountainIcon, iconColor: '#00ABAA'
		objectManager.add(geoJson);
		map.geoObjects.add(objectManager);
        if (geoData.features.length == 1) {
            map.setCenter(map.geoObjects.getBounds()[0], 14, {checkZoomRange: true});
        } else {
            map.setBounds(map.geoObjects.getBounds(), {checkZoomRange:true, zoomMargin:9, useMapMargin: true});
        }
		// map.geoObjects.events.add('click', function (e) {
		// 	let id = e.get('objectId');
		// 	let geoObject = objectManager.objects.getById(id);
		// });
	}
    markersHover();
}
mapRender(JSON.parse(glamping_club_ajax.glAllMap));

const mapPointTest = (glAll) => {
    let points = [];
    glAll.forEach((item) => {
        let coord = [];
        points.push(
            {
                id: item.id,
                type: "Feature",
                geometry: {
                    type: "Point",
                    coordinates: item.coordinates.split(', ')
                },
                properties: {
                    id: item.id,
    				price: item.price,
    				balloonContentHeader: item.title,
                    balloonContentBody: `<p class="ymaps-2-1-79-balloon-content__header">от ${item.price}р.</p> Адрес: ${item.adress}`,
    				balloonContentFooter: `<a href="${item.url}">Подробнее</a>`,
    				clusterCaption: item.title,
    				link: item.url,
                    hintContent: `<span>${item.title}</span>`,
    				iconContent: `<span id="${item.id}" class="glc-icon-content">${item.price}р</span>`,
                }
            }
        );
    });
    let geoData = {
        type: 'FeatureCollection',
        metadata: {
            name: 'Глэмпинги',
			creator: 'creatsites.ru',
			description: 'Глэмпинги Creatsites.'
        },
        features: points
    };
    return geoData;
}
mapPointTest(JSON.parse(glamping_club_ajax.glAll));

function refreshObjects(elementId) {
    objectManager.objects.each(object => {
        const isActive = object.id === elementId;
        objectManager.objects.setObjectOptions(object.id, {
            preset: isActive ? 'islands#redStretchyIcon' : 'islands#darkGreenStretchyIcon'
        })
    });
}

function backObjects() {
    objectManager.objects.each(object => {
        objectManager.objects.setObjectOptions(object.id, {
            preset: 'islands#darkGreenStretchyIcon'
        })
    });
}

function markersHover() {
    const glPosts = document.querySelectorAll('.glamping-item');
	glPosts.forEach((post) => {
		let postId = post.id.split('-')[1];
		post.addEventListener('mouseenter', function() {
            const markers = document.querySelectorAll('.ymaps-2-1-79-map .glc-icon-content');
            markers.forEach((item) => {
                if (item.id == postId) {
                    item.classList.add('active');
                    item.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.style.zIndex = '999';
                }
            });
		});
		post.addEventListener('mouseleave', function() {
            const markers = document.querySelectorAll('.ymaps-2-1-79-map .glc-icon-content');
            markers.forEach((item) => {
                item.classList.remove('active');
                item.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.style.zIndex = '';
            });
		});
	});
}
