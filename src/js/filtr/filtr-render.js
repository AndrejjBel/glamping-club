localStorage.removeItem('glcRegion');
localStorage.removeItem('glcType');
localStorage.removeItem('glcAllocation');
localStorage.removeItem('glcWorking');
localStorage.removeItem('glcNature');
localStorage.removeItem('glcFacilGen');
localStorage.removeItem('glcFacilChildren');
localStorage.removeItem('glcEntertainment');
localStorage.removeItem('glcTerritory');
localStorage.removeItem('glcSafety');
localStorage.removeItem('glcPrice');
localStorage.removeItem('glcPriceSt');
localStorage.removeItem('glcPriceMin');
localStorage.removeItem('glcPriceMax');

const locationsArchive = (glempAll) => {
    const regionItem = document.querySelector('.filtr-item.region');
    if (!regionItem) return;
    regionItem.style.display = '';
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
    } else {
        regionItem.children[1].innerHTML = '';
        regionItem.style.display = 'none';
    }
}
locationsArchive(JSON.parse(glamping_club_ajax.glAll));

const filtrTypeArchive = (glempAll) => {
    const typeItem = document.querySelector('.filtr-item.type');
    if (!typeItem) return;
    typeItem.style.display = '';
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
    } else {
        typeItem.children[1].innerHTML = '';
        typeItem.style.display = 'none';
    }
}
filtrTypeArchive(JSON.parse(glamping_club_ajax.glAll));

const filtrAllocationArchive = (glempAll) => {
    const typeItem = document.querySelector('.filtr-item.allocation');
    if (!typeItem) return;
    typeItem.style.display = '';
    let typObj = [];
    if ( glempAll.length > 1 ) {
        glempAll.forEach((item) => {
            typObj = typObj.concat(item.allocation);
        });
        typObj = typObj.reduce((acc, i) => i ? [...acc, i] : acc, []);
        typObj = makeUniqSort(typObj);
    } else {
        typObj = glempAll[0].allocation
    }
    typeItem.children[1].innerHTML = '';
    if (typObj.length) {
        // typeItem.children[1].innerHTML = '';
        countFiltrItem('glcAllocation', typeItem);
        ls = localStorage.getItem('glcAllocation');
        let chek = '';
        typObj.forEach((item) => {
            if (ls) {
                if (ls.includes(item)) {
                    chek = 'checked';
                } else {
                    chek = '';
                }
            }
            let count = glempAll.filter(elem => elem.allocation.includes(item));
            typeItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item}" name="${item}" data-name="glcAllocation" value="" ${chek}>
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
    } else {
        typeItem.children[1].innerHTML = '';
        typeItem.style.display = 'none';
    }
}
filtrAllocationArchive(JSON.parse(glamping_club_ajax.glAll));

const filtrWorkingArchive = (glempAll) => {
    const typeItem = document.querySelector('.filtr-item.working');
    if (!typeItem) return;
    typeItem.style.display = '';
    let typObj = [];
    if ( glempAll.length > 1 ) {
        glempAll.forEach((item) => {
            typObj = typObj.concat(item.working_mode_seasons);
        });
        typObj = typObj.reduce((acc, i) => i ? [...acc, i] : acc, []);
        typObj = montsSort(typObj);
    } else {
        typObj = glempAll[0].working_mode_seasons
    }
    typeItem.children[1].innerHTML = '';
    if (typObj.length) {
        // typeItem.children[1].innerHTML = '';
        countFiltrItem('glcWorking', typeItem);
        ls = localStorage.getItem('glcWorking');
        let chek = '';
        typObj.forEach((item) => {
            if (ls) {
                if (ls.includes(item)) {
                    chek = 'checked';
                } else {
                    chek = '';
                }
            }
            let count = glempAll.filter(elem => elem.working_mode_seasons.includes(item));
            typeItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item}" name="${item}" data-name="glcWorking" value="" ${chek}>
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
    } else {
        typeItem.children[1].innerHTML = '';
        typeItem.style.display = 'none';
    }
}
filtrWorkingArchive(JSON.parse(glamping_club_ajax.glAll));

const filtrNatureArchive = (glempAll) => {
    const typeItem = document.querySelector('.filtr-item.nature');
    if (!typeItem) return;
    typeItem.style.display = '';
    let typObj = [];
    if ( glempAll.length > 1 ) {
        glempAll.forEach((item) => {
            typObj = typObj.concat(item.nature_around);
        });
        typObj = typObj.reduce((acc, i) => i ? [...acc, i] : acc, []);
        typObj = makeUniqSort(typObj);
    } else {
        typObj = glempAll[0].nature_around
    }
    typeItem.children[1].innerHTML = '';
    if (typObj.length) {
        // typeItem.children[1].innerHTML = '';
        countFiltrItem('glcNature', typeItem);
        ls = localStorage.getItem('glcNature');
        let chek = '';
        typObj.forEach((item) => {
            if (ls) {
                if (ls.includes(item)) {
                    chek = 'checked';
                } else {
                    chek = '';
                }
            }
            let count = glempAll.filter(elem => elem.nature_around.includes(item));
            typeItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item}" name="${item}" data-name="glcNature" value="" ${chek}>
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
    } else {
        typeItem.children[1].innerHTML = '';
        typeItem.style.display = 'none';
    }
}
filtrNatureArchive(JSON.parse(glamping_club_ajax.glAll));

const filtrFacilitiesGeneralArchive = (glempAll) => {
    const typeItem = document.querySelector('.filtr-item.facilities_general');
    if (!typeItem) return;
    typeItem.style.display = '';
    let typObj = [];
    if ( glempAll.length > 1 ) {
        glempAll.forEach((item) => {
            typObj = typObj.concat(item.facilities_general);
        });
        typObj = typObj.reduce((acc, i) => i ? [...acc, i] : acc, []);
        typObj = makeUniqSort(typObj);
    } else {
        typObj = glempAll[0].facilities_general
    }
    typeItem.children[1].innerHTML = '';
    if (typObj.length) {
        // typeItem.children[1].innerHTML = '';
        countFiltrItem('glcFacilGen', typeItem);
        ls = localStorage.getItem('glcFacilGen');
        let chek = '';
        typObj.forEach((item) => {
            if (ls) {
                if (ls.includes(item)) {
                    chek = 'checked';
                } else {
                    chek = '';
                }
            }
            let count = glempAll.filter(elem => elem.facilities_general.includes(item));
            typeItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item}" name="${item}" data-name="glcFacilGen" value="" ${chek}>
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
    } else {
        typeItem.children[1].innerHTML = '';
        typeItem.style.display = 'none';
    }
}
filtrFacilitiesGeneralArchive(JSON.parse(glamping_club_ajax.glAll));

const filtrChildrenArchive = (glempAll) => {
    const typeItem = document.querySelector('.filtr-item.children');
    if (!typeItem) return;
    typeItem.style.display = '';
    let typObj = [];
    if ( glempAll.length > 1 ) {
        glempAll.forEach((item) => {
            typObj = typObj.concat(item.facilities_children);
        });
        typObj = typObj.reduce((acc, i) => i ? [...acc, i] : acc, []);
        typObj = makeUniqSort(typObj);
    } else {
        typObj = glempAll[0].facilities_children
    }
    typeItem.children[1].innerHTML = '';
    if (typObj.length) {
        // typeItem.children[1].innerHTML = '';
        countFiltrItem('glcFacilChildren', typeItem);
        ls = localStorage.getItem('glcFacilChildren');
        let chek = '';
        typObj.forEach((item) => {
            if (ls) {
                if (ls.includes(item)) {
                    chek = 'checked';
                } else {
                    chek = '';
                }
            }
            let count = glempAll.filter(elem => elem.facilities_children.includes(item));
            typeItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item}" name="${item}" data-name="glcFacilChildren" value="" ${chek}>
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
    } else {
        typeItem.children[1].innerHTML = '';
        typeItem.style.display = 'none';
    }
}
filtrChildrenArchive(JSON.parse(glamping_club_ajax.glAll));

const filtrErtainmentArchive = (glempAll) => {
    const typeItem = document.querySelector('.filtr-item.entertainment');
    if (!typeItem) return;
    typeItem.style.display = '';
    let typObj = [];
    if ( glempAll.length > 1 ) {
        glempAll.forEach((item) => {
            typObj = typObj.concat(item.entertainment);
        });
        typObj = typObj.reduce((acc, i) => i ? [...acc, i] : acc, []);
        typObj = makeUniqSort(typObj);
    } else {
        typObj = glempAll[0].entertainment
    }
    typeItem.children[1].innerHTML = '';
    if (typObj.length) {
        // typeItem.children[1].innerHTML = '';
        countFiltrItem('glcEntertainment', typeItem);
        ls = localStorage.getItem('glcEntertainment');
        let chek = '';
        typObj.forEach((item) => {
            if (ls) {
                if (ls.includes(item)) {
                    chek = 'checked';
                } else {
                    chek = '';
                }
            }
            let count = glempAll.filter(elem => elem.entertainment.includes(item));
            typeItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item}" name="${item}" data-name="glcEntertainment" value="" ${chek}>
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
    } else {
        typeItem.children[1].innerHTML = '';
        typeItem.style.display = 'none';
    }
}
filtrErtainmentArchive(JSON.parse(glamping_club_ajax.glAll));

const filtrTerritoryArchive = (glempAll) => {
    const typeItem = document.querySelector('.filtr-item.territory');
    if (!typeItem) return;
    typeItem.style.display = '';
    let typObj = [];
    if ( glempAll.length > 1 ) {
        glempAll.forEach((item) => {
            typObj = typObj.concat(item.territory);
        });
        typObj = typObj.reduce((acc, i) => i ? [...acc, i] : acc, []);
        typObj = makeUniqSort(typObj);
    } else {
        typObj = glempAll[0].territory
    }
    typeItem.children[1].innerHTML = '';
    if (typObj.length) {
        // typeItem.children[1].innerHTML = '';
        countFiltrItem('glcTerritory', typeItem);
        ls = localStorage.getItem('glcTerritory');
        let chek = '';
        typObj.forEach((item) => {
            if (ls) {
                if (ls.includes(item)) {
                    chek = 'checked';
                } else {
                    chek = '';
                }
            }
            let count = glempAll.filter(elem => elem.territory.includes(item));
            typeItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item}" name="${item}" data-name="glcTerritory" value="" ${chek}>
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
    } else {
        typeItem.children[1].innerHTML = '';
        typeItem.style.display = 'none';
    }
}
filtrTerritoryArchive(JSON.parse(glamping_club_ajax.glAll));

const filtrSafetyArchive = (glempAll) => {
    const typeItem = document.querySelector('.filtr-item.safety');
    if (!typeItem) return;
    typeItem.style.display = '';
    let typObj = [];
    if ( glempAll.length > 1 ) {
        glempAll.forEach((item) => {
            typObj = typObj.concat(item.safety);
        });
        typObj = typObj.reduce((acc, i) => i ? [...acc, i] : acc, []);
        typObj = makeUniqSort(typObj);
    } else {
        typObj = glempAll[0].safety
    }
    if (typObj.length) {
        typeItem.children[1].innerHTML = '';
        countFiltrItem('glcSafety', typeItem);
        ls = localStorage.getItem('glcSafety');
        let chek = '';
        typObj.forEach((item) => {
            if (ls) {
                if (ls.includes(item)) {
                    chek = 'checked';
                } else {
                    chek = '';
                }
            }
            let count = glempAll.filter(elem => elem.safety.includes(item));
            typeItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item}" name="${item}" data-name="glcSafety" value="" ${chek}>
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
    } else {
        typeItem.children[1].innerHTML = '';
        typeItem.style.display = 'none';
    }
}
filtrSafetyArchive(JSON.parse(glamping_club_ajax.glAll));

function sliderNumber(startMin, startMax, min, max) {
    const slider = document.getElementById('glc-slider');
    if (!slider) return;
    const minPriceInput = document.getElementById('min_price');
    const maxPriceInput = document.getElementById('max_price');
    const icon = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
    <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"/>
    </svg>`;
    noUiSlider.create(slider, {
        start: [startMin, startMax],
        connect: true,
        range: {
            'min': min,
            'max': max
        }
    });
    let sliderValueStart = slider.noUiSlider.get();
    localStorage.setItem('glcPrice', sliderValueStart.map(Number));
    localStorage.setItem('glcPriceSt', sliderValueStart.map(Number));
    // console.dir(sliderValueStart);
    slider.noUiSlider.on('update', function () {
        let sliderValue = slider.noUiSlider.get();
        minPriceInput.value = Math.ceil(sliderValue[0]);
        maxPriceInput.value = Math.ceil(sliderValue[1]);
    });
    slider.noUiSlider.on('end', function (values, handle) {
        console.dir(handle);
        console.dir(Number(values[handle]).toFixed());
        console.dir(values.map(Number).map(elem => elem.toFixed()));
        const glampingsMap = document.querySelector('.glampings-map');
        let sliderValue = slider.noUiSlider.get();
        console.dir(sliderValue.map(Number).map(elem => elem.toFixed()));

        let glempAll = JSON.parse(glamping_club_ajax.glAll);
        let newgGempAll =  glempAll.filter(filtrOptionsChange).filter(priceRange, sliderValue);
        glempRender(newgGempAll);
        localStorage.setItem('glcPrice', sliderValue.map(Number).map(elem => elem.toFixed()));
        if (handle == '0') {
            localStorage.setItem('glcPriceMin', Math.ceil(sliderValue[0]));
        }
        if (handle == '1') {
            localStorage.setItem('glcPriceMax', Math.ceil(sliderValue[1]));
        }
        // localStorage.setItem('glcPriceMin', Math.ceil(sliderValue[0]));
        // localStorage.setItem('glcPriceMax', Math.ceil(sliderValue[1]));

        let sliderValueStartStr = sliderValueStart.map(Number).join(',');
        let sliderValueStr = sliderValue.map(Number).join(',');

        console.dir(sliderValueStartStr);
        console.dir(sliderValueStr);

        const names = [
            'glcType',
            'glcAllocation',
            'glcWorking',
            'glcNature',
            'glcFacilGen',
            'glcFacilChildren',
            'glcEntertainment',
            'glcTerritory',
            'glcSafety'
        ];
        let inputs = document.querySelectorAll('.glampings-filtr-items input');

        if (itemsVal(inputs, names) || sliderValueStartStr !== sliderValueStr) {
            locationsArchive(newgGempAll);
        } else {
            locationsArchive(glempAll);
        }
        filtrTypeArchive(newgGempAll);
        filtrAllocationArchive(newgGempAll);
        filtrWorkingArchive(newgGempAll);
        filtrNatureArchive(newgGempAll);
        filtrFacilitiesGeneralArchive(newgGempAll);
        filtrChildrenArchive(newgGempAll);
        filtrErtainmentArchive(newgGempAll);
        filtrTerritoryArchive(newgGempAll);
        filtrSafetyArchive(newgGempAll);

        glampingsMap.children[0].innerHTML = '';
        mapRender(mapPointTest(newgGempAll));

        // console.dir(slider.parentElement.previousElementSibling.previousElementSibling.children[1]);

        if (isArraysEqual(sliderValueStart, sliderValue)) {
            slider.parentElement.previousElementSibling.previousElementSibling.children[1].innerHTML = '';
        } else {
            slider.parentElement.previousElementSibling.previousElementSibling.children[1].innerHTML = icon;
        }
        chekAllFitrs();
    });
}
// sliderNumber(2000, 8000, 2000, 8000);

function isArraysEqual(firstArray, secondArray) {
    return firstArray.toString() === secondArray.toString();
}

function chekAllFitrs() {
    const filtrItems = document.querySelectorAll('.filtr-item__title__count');
    if (!filtrItems.length) return;
    const btnFiltrClear = document.querySelectorAll('#all-filter-clear');
    let countObj = [];
    filtrItems.forEach((item) => {
        if (item.innerHTML) {
            countObj.push(item.innerHTML);
        }
    });
    if (countObj.length) {
        btnFiltrClear.forEach((btn) => {
            btn.classList.add('activate');
        });
    } else {
        btnFiltrClear.forEach((btn) => {
            btn.classList.remove('activate');
        });
    }
    return countObj.length;
}
// chekAllFitrs();

function removeAllFitrs() {
    const btnFiltrClear = document.querySelectorAll('#all-filter-clear');
    if (!btnFiltrClear.length) return;
    const priceCount = document.querySelector('.filtr-item.price .filtr-item__title__count');
    const glampingsMap = document.querySelector('.glampings-map');
    btnFiltrClear.forEach((btn) => {
        btn.addEventListener('click', function(e) {
            localStorage.removeItem('glcRegion');
            localStorage.removeItem('glcType');
            localStorage.removeItem('glcAllocation');
            localStorage.removeItem('glcWorking');
            localStorage.removeItem('glcNature');
            localStorage.removeItem('glcFacilGen');
            localStorage.removeItem('glcFacilChildren');
            localStorage.removeItem('glcEntertainment');
            localStorage.removeItem('glcTerritory');
            localStorage.removeItem('glcSafety');
            // localStorage.removeItem('glcPrice');
            // localStorage.removeItem('glcPriceSt');
            localStorage.removeItem('glcPriceMin');
            localStorage.removeItem('glcPriceMax');
            // localStorage.removeItem('glcPrice');

            let glempAll = JSON.parse(glamping_club_ajax.glAll);
            localStorage.setItem('glcPrice', priceSliderOption(glempAll));

            locationsArchive(glempAll);
            filtrTypeArchive(glempAll);
            filtrAllocationArchive(glempAll);
            filtrWorkingArchive(glempAll);
            filtrNatureArchive(glempAll);
            filtrFacilitiesGeneralArchive(glempAll);
            filtrChildrenArchive(glempAll);
            filtrErtainmentArchive(glempAll);
            filtrTerritoryArchive(glempAll);
            filtrSafetyArchive(glempAll);

            glempRender(glempAll);
            glampingsMap.children[0].innerHTML = '';
            mapRender(mapPointTest(glempAll));

            sliderUpdatePrice(glempAll);
            priceCount.innerHTML = '';

            btnFiltrClear.forEach((btn) => {
                btn.classList.remove('activate');
            });

            // btnFiltrClear.classList.remove('activate');
        });
    });
}
removeAllFitrs();

function priceSliderRender(arr) {
    let pricesObj = [];
    let priceMin = '';
    let priceMax = '';
    if ( arr.length > 1 ) {
        arr.forEach((item) => {
            pricesObj = pricesObj.concat(item.price);
        });
        pricesObj = makeUniqSort(pricesObj);
        priceMin = Math.min.apply(null, pricesObj);
        priceMax = Math.max.apply(null, pricesObj);
    } else {
        pricesObj = arr[0].price
        priceMin = pricesObj;
        priceMax = pricesObj;
    }
    sliderNumber(priceMin, priceMax, priceMin, priceMax);
    return {priceMin: priceMin, priceMax: priceMax};
}
// priceSliderRender(JSON.parse(glamping_club_ajax.glAll));
priceSliderRender(JSON.parse(glamping_club_ajax.glAll));

function priceSliderOption(arr) {
    let pricesObj = [];
    let priceMin = '';
    let priceMax = '';
    if ( arr.length > 1 ) {
        arr.forEach((item) => {
            pricesObj = pricesObj.concat(item.price);
        });
        pricesObj = makeUniqSort(pricesObj);
        priceMin = Math.min.apply(null, pricesObj);
        priceMax = Math.max.apply(null, pricesObj);
    } else {
        pricesObj = arr[0].price
        priceMin = pricesObj;
        priceMax = pricesObj;
    }
    return [priceMin, priceMax];
}

function sliderUpdatePrice(arr) {
    const slider = document.getElementById('glc-slider');
    let pricesObj = [];
    let priceMin = '';
    let priceMax = '';
    if ( arr.length > 1 ) {
        arr.forEach((item) => {
            pricesObj = pricesObj.concat(item.price);
        });
        pricesObj = makeUniqSort(pricesObj);
        priceMin = Math.min.apply(null, pricesObj.map(Number));
        priceMax = Math.max.apply(null, pricesObj.map(Number));
    } else {
        pricesObj = arr[0].price
        priceMin = +pricesObj;
        priceMax = +pricesObj;
    }
    let glempAll = JSON.parse(glamping_club_ajax.glAll);
    let currPrice = [];
    currPrice = localStorage.getItem('glcPrice').split(',').map(Number);
    let currPriceMin = localStorage.getItem('glcPriceMin');
    let currPriceMax = localStorage.getItem('glcPriceMax');
    let stPriceMin = '';
    let stPriceMax = '';
    if (currPriceMin) {
        stPriceMin = currPriceMin;
    } else {
        stPriceMin = currPrice[0];
    }
    if (currPriceMax) {
        stPriceMax = currPriceMax;
    } else {
        stPriceMax = currPrice[1];
    }
    slider.noUiSlider.updateOptions({
        start: [stPriceMin, stPriceMax],
        range: {
            'min': priceMin,
            'max': priceMax
        }
    });
    let priceObj = [priceMin, priceMax];
    // localStorage.setItem('glcPrice', priceObj);

    return priceObj;
}

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

        let glcType = localStorage.getItem('glcType');
        let glcAllocation = localStorage.getItem('glcAllocation');
        let glcWorking = localStorage.getItem('glcWorking');
        let glcNature = localStorage.getItem('glcNature');
        let glcFacilGen = localStorage.getItem('glcFacilGen');
        let glcFacilChildren = localStorage.getItem('glcFacilChildren');
        let glcEntertainment = localStorage.getItem('glcEntertainment');
        let glcTerritory = localStorage.getItem('glcTerritory');
        let glcSafety = localStorage.getItem('glcSafety');
        let glcPrice = localStorage.getItem('glcPrice');
        let glcPriceSt = localStorage.getItem('glcPriceSt');

        const names = [
            'glcType',
            'glcAllocation',
            'glcWorking',
            'glcNature',
            'glcFacilGen',
            'glcFacilChildren',
            'glcEntertainment',
            'glcTerritory',
            'glcSafety'
        ];

        if (input) {
            let glempAll = JSON.parse(glamping_club_ajax.glAll);
            let newgGempAll =  glempAll.filter(filtrOptionsChange);
            sliderUpdatePrice(newgGempAll);
            // sliderUpdatePriceNew(glcPrice);
            let sliderValueStart = priceSliderOption(glempAll);
            // console.dir(sliderValueStart);

            let priceObj = [];
            // let glcPrice = localStorage.getItem('glcPrice');
            if (glcPrice) {
                priceObj = glcPrice.split(',');
                // sliderUpdatePriceNew(glcPrice);
            }

            newgGempAll =  glempAll.filter(filtrOptionsChange).filter(priceRange, priceObj.map(Number));

            let sortGl = Cookies.get('glcSort');
            if (sortGl) {
                if (sortGl == 'new_items') {
                    newgGempAll.sort((x, y) => y.post_date - x.post_date);
                } else if (sortGl == 'recommended') {
                    newgGempAll.sort((x, y) => y.recommended - x.recommended);
                } else if (sortGl == 'max_price') {
                    newgGempAll.sort((x, y) => y.price - x.price);
                } else if (sortGl == 'min_price') {
                    newgGempAll.sort((x, y) => x.price - y.price);
                }
                // else if (sortGl == 'popular') {
                //     newgGempAll.sort((x, y) => y.views - x.views);
                // } else if (sortGl == 'rating') {
                //     newgGempAll.sort((x, y) => y.review_rating - x.review_rating || y.review_count - x.review_count);
                // }
            }
            glempRender(newgGempAll);
            checkLocalCheng(input, input.dataset.name, '');
            // console.dir(input.dataset.name);
            if (input.dataset.name == 'glcRegion') {
                // locationsArchive(newgGempAll);
                filtrTypeArchive(newgGempAll);
                filtrAllocationArchive(newgGempAll);
                filtrWorkingArchive(newgGempAll);
                filtrNatureArchive(newgGempAll);
                filtrFacilitiesGeneralArchive(newgGempAll);
                filtrChildrenArchive(newgGempAll);
                filtrErtainmentArchive(newgGempAll);
                filtrTerritoryArchive(newgGempAll);
                filtrSafetyArchive(newgGempAll);
            }

            if (input.dataset.name == 'glcType') {
                if (itemsVal(inputs, names) || glcPrice !== glcPriceSt) {
                    locationsArchive(newgGempAll);
                } else {
                    locationsArchive(glempAll);
                }

                // filtrTypeArchive(newgGempAll);
                filtrAllocationArchive(newgGempAll);
                filtrWorkingArchive(newgGempAll);
                filtrNatureArchive(newgGempAll);
                filtrFacilitiesGeneralArchive(newgGempAll);
                filtrChildrenArchive(newgGempAll);
                filtrErtainmentArchive(newgGempAll);
                filtrTerritoryArchive(newgGempAll);
                filtrSafetyArchive(newgGempAll);
            }
            if (input.dataset.name == 'glcAllocation') {
                if (itemsVal(inputs, names) || glcPrice !== glcPriceSt) {
                    locationsArchive(newgGempAll);
                } else {
                    locationsArchive(glempAll);
                }

                filtrTypeArchive(newgGempAll);
                // filtrAllocationArchive(newgGempAll);
                filtrWorkingArchive(newgGempAll);
                filtrNatureArchive(newgGempAll);
                filtrFacilitiesGeneralArchive(newgGempAll);
                filtrChildrenArchive(newgGempAll);
                filtrErtainmentArchive(newgGempAll);
                filtrTerritoryArchive(newgGempAll);
                filtrSafetyArchive(newgGempAll);
            }
            if (input.dataset.name == 'glcWorking') {
                if (itemsVal(inputs, names) || glcPrice !== glcPriceSt) {
                    locationsArchive(newgGempAll);
                } else {
                    locationsArchive(glempAll);
                }
                filtrTypeArchive(newgGempAll);
                filtrAllocationArchive(newgGempAll);
                // filtrWorkingArchive(newgGempAll);
                filtrNatureArchive(newgGempAll);
                filtrFacilitiesGeneralArchive(newgGempAll);
                filtrChildrenArchive(newgGempAll);
                filtrErtainmentArchive(newgGempAll);
                filtrTerritoryArchive(newgGempAll);
                filtrSafetyArchive(newgGempAll);
            }
            if (input.dataset.name == 'glcNature') {
                if (itemsVal(inputs, names) || glcPrice !== glcPriceSt) {
                    locationsArchive(newgGempAll);
                } else {
                    locationsArchive(glempAll);
                }
                filtrTypeArchive(newgGempAll);
                filtrAllocationArchive(newgGempAll);
                filtrWorkingArchive(newgGempAll);
                // filtrNatureArchive(newgGempAll);
                filtrFacilitiesGeneralArchive(newgGempAll);
                filtrChildrenArchive(newgGempAll);
                filtrErtainmentArchive(newgGempAll);
                filtrTerritoryArchive(newgGempAll);
                filtrSafetyArchive(newgGempAll);
            }
            if (input.dataset.name == 'glcFacilGen') {
                if (itemsVal(inputs, names) || glcPrice !== glcPriceSt) {
                    locationsArchive(newgGempAll);
                } else {
                    locationsArchive(glempAll);
                }
                filtrTypeArchive(newgGempAll);
                filtrAllocationArchive(newgGempAll);
                filtrWorkingArchive(newgGempAll);
                filtrNatureArchive(newgGempAll);
                // filtrFacilitiesGeneralArchive(newgGempAll);
                filtrChildrenArchive(newgGempAll);
                filtrErtainmentArchive(newgGempAll);
                filtrTerritoryArchive(newgGempAll);
                filtrSafetyArchive(newgGempAll);
            }
            if (input.dataset.name == 'glcFacilChildren') {
                if (itemsVal(inputs, names) || glcPrice !== glcPriceSt) {
                    locationsArchive(newgGempAll);
                } else {
                    locationsArchive(glempAll);
                }
                filtrTypeArchive(newgGempAll);
                filtrAllocationArchive(newgGempAll);
                filtrWorkingArchive(newgGempAll);
                filtrNatureArchive(newgGempAll);
                filtrFacilitiesGeneralArchive(newgGempAll);
                // filtrChildrenArchive(newgGempAll);
                filtrErtainmentArchive(newgGempAll);
                filtrTerritoryArchive(newgGempAll);
                filtrSafetyArchive(newgGempAll);
            }
            if (input.dataset.name == 'glcEntertainment') {
                if (itemsVal(inputs, names) || glcPrice !== glcPriceSt) {
                    locationsArchive(newgGempAll);
                } else {
                    locationsArchive(glempAll);
                }
                filtrTypeArchive(newgGempAll);
                filtrAllocationArchive(newgGempAll);
                filtrWorkingArchive(newgGempAll);
                filtrNatureArchive(newgGempAll);
                filtrFacilitiesGeneralArchive(newgGempAll);
                filtrChildrenArchive(newgGempAll);
                // filtrErtainmentArchive(newgGempAll);
                filtrTerritoryArchive(newgGempAll);
                filtrSafetyArchive(newgGempAll);
            }
            if (input.dataset.name == 'glcTerritory') {
                if (itemsVal(inputs, names) || glcPrice !== glcPriceSt) {
                    locationsArchive(newgGempAll);
                } else {
                    locationsArchive(glempAll);
                }
                filtrTypeArchive(newgGempAll);
                filtrAllocationArchive(newgGempAll);
                filtrWorkingArchive(newgGempAll);
                filtrNatureArchive(newgGempAll);
                filtrFacilitiesGeneralArchive(newgGempAll);
                filtrChildrenArchive(newgGempAll);
                filtrErtainmentArchive(newgGempAll);
                // filtrTerritoryArchive(newgGempAll);
                filtrSafetyArchive(newgGempAll);
            }
            if (input.dataset.name == 'glcSafety') {
                if (itemsVal(inputs, names) || glcPrice !== glcPriceSt) {
                    locationsArchive(newgGempAll);
                } else {
                    locationsArchive(glempAll);
                }
                filtrTypeArchive(newgGempAll);
                filtrAllocationArchive(newgGempAll);
                filtrWorkingArchive(newgGempAll);
                filtrNatureArchive(newgGempAll);
                filtrFacilitiesGeneralArchive(newgGempAll);
                filtrChildrenArchive(newgGempAll);
                filtrErtainmentArchive(newgGempAll);
                filtrTerritoryArchive(newgGempAll);
                // filtrSafetyArchive(newgGempAll);
            }

            glampingsMap.children[0].innerHTML = '';
            mapRender(mapPointTest(newgGempAll));

            chekAllFitrs();

            console.dir(itemsVal(inputs, names));
        }
    });
}
itemsChange();

function itemsVal(inputs, names) {
    let inputChecked = [];
    let inputCheckedName = [];
    inputs.forEach((input) => {
        if (input.checked == true) {
            inputChecked.push(input);
            inputCheckedName.push(input.dataset.name);
        }
    });
    // return inputChecked;
    let checkedName = makeUniq(inputCheckedName);
    let elExists = checkedName.some(el => names.includes(el));

    return elExists;
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
    let allocation =[];
    let working =[];
    let nature =[];
    let facilGen =[];
    let facilChildren =[];
    let entertainment =[];
    let territory =[];
    let safety =[];
    inputs.forEach((input) => {
        if (input.checked == true) {
            if (input.dataset.name == 'glcRegion') {
                region.push(input.id);
            } else if (input.dataset.name == 'glcType') {
                types.push(input.id);
            } else if (input.dataset.name == 'glcAllocation') {
                allocation.push(input.id);
            } else if (input.dataset.name == 'glcWorking') {
                working.push(input.id);
            } else if (input.dataset.name == 'glcNature') {
                nature.push(input.id);
            } else if (input.dataset.name == 'glcFacilGen') {
                facilGen.push(input.id);
            } else if (input.dataset.name == 'glcFacilChildren') {
                facilChildren.push(input.id);
            } else if (input.dataset.name == 'glcEntertainment') {
                entertainment.push(input.id);
            } else if (input.dataset.name == 'glcTerritory') {
                territory.push(input.id);
            } else if (input.dataset.name == 'glcSafety') {
                safety.push(input.id);
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

    let allocationIncl = 1;
    if (allocation.length) {
        typesIncl = allocation.some((element) => item.allocation.includes(element));
    }

    let workingIncl = 1;
    if (working.length) {
        workingIncl = working.some((element) => item.working_mode_seasons.includes(element));

        // workingIncl = working.some((element) => {
        //     if (element == 'whole_year') {
        //         item.working_mode.includes(element);
        //     } else {
        //         item.working_mode_seasons.includes(element);
        //     }
        // });
    }

    let natureIncl = 1;
    if (nature.length) {
        natureIncl = nature.some((element) => item.nature_around.includes(element));
    }

    let facilGenIncl = 1;
    if (facilGen.length) {
        facilGenIncl = facilGen.some((element) => item.facilities_general.includes(element));
    }

    let facilChildrenIncl = 1;
    if (facilChildren.length) {
        facilChildrenIncl = facilChildren.some((element) => item.facilities_children.includes(element));
    }

    let entertainmentIncl = 1;
    if (entertainment.length) {
        entertainmentIncl = entertainment.some((element) => item.entertainment.includes(element));
    }

    let territoryIncl = 1;
    if (territory.length) {
        territoryIncl = territory.some((element) => item.territory.includes(element));
    }

    let safetyIncl = 1;
    if (safety.length) {
        safetyIncl = safety.some((element) => item.safety.includes(element));
    }

    if ( regionIncl && typesIncl && allocationIncl && workingIncl && natureIncl && facilGenIncl && facilChildrenIncl && entertainmentIncl && territoryIncl && safetyIncl ) {
        return true;
    } else {
        return false;
    }
}

function priceRange(item) {
    if (Number(item.price) >= this[0] && Number(item.price) <= this[1]) {
        return item;
    }
}

function glempRender(glemps) {
    const glampingsItems = document.querySelector('.glampings-items');
    let glcFav = favoritesRenderFiltr('glcFav');
    let glcCompar = favoritesRenderFiltr('glcCompar');
    glampingsItems.innerHTML = '';
    glemps.forEach((glemp) => {
        let recommended = glemp.recommended;
        let recRend = ``;
        if (recommended == 'yes') {
            recRend = `<div class="glamping-item__recommended">Рекомендуем</div>`;
        }
        let price = currFormat(glemp.price);
        let type = glemp.type.join(', ');
        let clFav = '';
        let clCompar = '';
        let titleFav = 'Добавить в избранное';
        let titleCompar = 'Добавить к сравнению';
        if (glcFav.includes(glemp.id)) {
            clFav = ' active';
            titleFav = 'Удалить из избранного';
        }
        if (glcCompar.includes(glemp.id)) {
            clCompar = ' active';
            titleCompar = 'Удалить из сравнения';
        }
        let slider = ``;
        glemp.media_urls.forEach((item) => {
            slider += `<div class="swiper-slide"><img src="${item}" alt="" loading="lazy" /></div>`;
        });
        let rating = reviews_stars_items_average( 2.9, 4 );

        glampingsItems.insertAdjacentHTML(
            "beforeEnd",
            `<div id="post-${glemp.id}" class="glamping-item" title="${glemp.title}">
            	<a href="${glemp.url}" class="glamping-item__url" rel="bookmark"></a>
                ${recRend}
                <div class="glamping-item__btns-fav-comp">
            		<button id="add-favorites" data-postid="${glemp.id}" class="glamping-item__btns-fav-comp__btn-add-fav round-sup-red${clFav}" type="button" name="button" title="${titleFav}">
            			<svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            				<path d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"/>
            			</svg>
            		</button>
            		<button id="add-comparison" data-postid="${glemp.id}" class="glamping-item__btns-fav-comp__btn-add-comp round-sup-red${clCompar}" type="button" name="button" title="${titleCompar}">
            			<svg class="rotate90" width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            				<path d="M448 64c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zm0 256c0 17.7-14.3 32-32 32H192c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32zM0 192c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
            			</svg>
            		</button>
            	</div>
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
            			<div class="glamping-item__content__rating">${rating}</div>
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
function myGeeks(array) {
    let filtered = array.filter(function (el) {
        return el != null;
    });
}
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
function montsSort(arr) {
    let monts = [];
    arr.forEach((mont) => {
        if (mont == 'Весь год') {
            monts[0] = 'Весь год';
        }
        if (mont == 'январь') {
            monts[1] = 'январь';
        }
        if (mont == 'февраль') {
            monts[2] = 'февраль';
        }
        if (mont == 'март') {
            monts[3] = 'март';
        }
        if (mont == 'апрель') {
            monts[4] = 'апрель';
        }
        if (mont == 'май') {
            monts[5] = 'май';
        }
        if (mont == 'июнь') {
            monts[6] = 'июнь';
        }
        if (mont == 'июль') {
            monts[7] = 'июль';
        }
        if (mont == 'август') {
            monts[8] = 'август';
        }
        if (mont == 'сентябрь') {
            monts[9] = 'сентябрь';
        }
        if (mont == 'октябрь') {
            monts[10] = 'октябрь';
        }
        if (mont == 'ноябрь') {
            monts[11] = 'ноябрь';
        }
        if (mont == 'декабрь') {
            monts[12] = 'декабрь';
        }
    });
    return monts;
}

function favoritesRenderFiltr(name) {
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
            {
                suppressMapOpenBlock: true,
                balloonPanelMaxMapArea: 390000,
                // balloonPanelMaxMapArea: Infinity
                // balloonMaxWidth: 270
            }
        ),
		// map.behaviors.disable(['scrollZoom']);

        MyPanelContentLayout = ymaps.templateLayoutFactory.createClass(
			'$[properties.balloonContentBodyPan]'
	    ),

		objectManager = new ymaps.ObjectManager({
			clusterize: true,
			gridSize: 32,
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
        objectManager.objects.options.set({
			balloonPanelContentLayout: MyPanelContentLayout
        });
        if (geoData.features.length == 1) {
            map.setCenter(map.geoObjects.getBounds()[0], 14, {checkZoomRange: true});
        } else {
            map.setBounds(map.geoObjects.getBounds(), {checkZoomRange:true, zoomMargin:9, useMapMargin: true});
        }
		map.geoObjects.events.add('mouseenter', function (e) {
			let id = e.get('objectId');
            const markerst = document.querySelectorAll('.ymaps-2-1-79-map .glc-icon-content');
            markerst.forEach((item) => {
                if (item.id == id) {
                    item.classList.add('active');
                }
            });
		});
        map.geoObjects.events.add('mouseleave', function (e) {
            let id = e.get('objectId');
            const markerst = document.querySelectorAll('.ymaps-2-1-79-map .glc-icon-content');
            markerst.forEach((item) => {
                if (item.id == id) {
                    item.classList.remove('active');
                }
            });
		});

        map.geoObjects.events.add('click', function (e) {
			const id = e.get('objectId');
            const markerst = document.querySelectorAll('.ymaps-2-1-79-map .glc-icon-content');
            markerst.forEach((item) => {
                if (item.id == id) {
                    item.classList.add('focus');
                }
            });
		});

        map.geoObjects.events.add('balloonclose', function (e) {
            const id = e.get('objectId');
            const markerst = document.querySelectorAll('.ymaps-2-1-79-map .glc-icon-content');
            markerst.forEach((item) => {
                if (item.id == id) {
                    item.classList.remove('focus');
                }
            });
        });

        map.geoObjects.events.add('balloonopen', function (e) {
            const id = e.get('objectId');
            // console.dir(id);
            const addFavorites = document.querySelector('.ymaps-2-1-79-balloon__content #add-favorites');
            const addComparison = document.querySelector('.ymaps-2-1-79-balloon__content #add-comparison');
            const supFavorites = document.querySelectorAll('#sup-favorites');
            const supComparison = document.querySelectorAll('#sup-comparison');

            let glcFav = favoritesRenderNologin('glcFav');
            let glcCompar = favoritesRenderNologin('glcCompar');

            if (addFavorites) {
                if (glcFav.includes(addFavorites.dataset.postid)) {
                    addFavorites.classList.add('active');
                    addFavorites.attributes.title.value = 'Удалить из избранного';
                }
                addFavorites.addEventListener('click', (e) => {
                    let addFavoritesBtnSingle = document.querySelector('button#add-favorites[data-postid="'+addFavorites.dataset.postid+'"]');
                    mapFavComAction(addFavorites, addFavoritesBtnSingle, supFavorites, 'glcFav');
                });
            }
            if (addComparison) {
                if (glcCompar.includes(addComparison.dataset.postid)) {
                    addComparison.classList.add('active');
                    addComparison.attributes.title.value = 'Удалить из сравнения';
                }
                addComparison.addEventListener('click', (e) => {
                    let addComparisonBtnSingle = document.querySelector('button#add-comparison[data-postid="'+addComparison.dataset.postid+'"]');
                    mapFavComAction(addComparison, addComparisonBtnSingle, supComparison, 'glcCompar');
                });
            }

            var swiper = new Swiper(".balloonPan", {
                slidesPerView: 1,
                spaceBetween: 8,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    340: {
                        slidesPerView: 2,
                    },
                    414: {
                        slidesPerView: 3,
                    }
                },
            });
        });

        map.events.add('click', function() {
            map.balloon.close();
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('#mapYandex')) {
                map.balloon.close();
            }
        });
	}
    markersHover();
}
mapRender(JSON.parse(glamping_club_ajax.glAllMap));

const mapPointTest = (glAll) => {
    // console.dir(glAll);
    let points = [];
    glAll.forEach((item) => {
        let itemUrl = item.url;
        let media_urls = item.media_urls;
        let media = '';
        let mi = 0;
        media_urls.forEach((media_url) => {
            if (mi <= 2) {
                media += `<img width="60" height="60" src="${media_url}" class="attachment-map-image" alt="" decoding="async">`;
            }
            mi++;
        });

        let rating = reviews_stars_items_average( 2.9, 4 );

        let thumb = `<img width="120" height="120" src="${media_urls[0]}" class="attachment-map-image" alt="" decoding="async">`;


        let img = `<img width="60" height="60" src="${item.thumbnail_url}" class="attachment-map-image" alt="" decoding="async">`;

        let mediaUrls = '';
        if (media_urls.length) {
            mediaUrls += `<div class="swiper balloonPan">`;
            mediaUrls += `<div class="swiper-wrapper">`;
            media_urls.forEach((media_url) => {
                mediaUrls += `<div class="swiper-slide">`;
                mediaUrls += `<img width="80" height="80" src="${media_url}" class="attachment-map-image" alt="" decoding="async">`;
                mediaUrls += `</div>`;
            });
            mediaUrls += `</div>`;
            mediaUrls += `<div class="swiper-button-next"></div>`;
            mediaUrls += `<div class="swiper-button-prev"></div>`;
            mediaUrls += `</div>`;
        }
        let phoneGlamping = '';
        if (item.phone) {
            phoneGlamping = `<a href="tel:${item.phone}" class="glamp-phone">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                </svg>
            </a>`;
        }
        let whatsupGlamping = '';
        if (item.whatsup) {
            whatsupGlamping = `<a href="https://wa.me/${item.whatsup}" class="glamp-wa">
                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" fill="#25d366"></path>
                </svg>
            </a>`;
        }

        let bcb = `<div class="balloon-content-body">
        <div class="balloon-content-body__img">${thumb}</div>
        <div class="balloon-content-body__content">
        <div class="balloon-content-body__content__title">
        <a href="${itemUrl}">${item.title}</a>
        </div>
        <div class="balloon-content-body__content__rating">${rating}</div>
        <div class="balloon-content-body__content__price">от ${item.price}р.</div>
        <div class="balloon-content-body__content__address">${item.adress}</div>
        </div>
        </div>`;

        let bcbpDef = `<div class="balloon-content-body-pan">
        <div class="balloon-content-body-pan__title"><a href="${itemUrl}">${item.title}</a></div>
        <div class="balloon-content-body-pan__img">
        <a href="${itemUrl}" class="balloon-content-body-pan__img__link"></a>
        <div class="balloon-content-body-pan__img__count">${media_urls.length} фото</div>
        ${media}
        </div>
        <div class="balloon-content-body-pan__content">
        <div class="balloon-content-body-pan__content__price">от ${item.price}р.</div>
        <div class="balloon-content-body-pan__content__address">${item.adress}</div>
        <div class="balloon-content-body-pan__content__buttons"></div>
        </div>
        </div>`;

        let bcbp = `<div class="balloon-content-body-pan">
            <div class="balloon-content-body-pan__img">
                ${mediaUrls}
            </div>
            <div class="balloon-content-body-pan__content">
                <div class="balloon-content-body-pan__content__info">
                    <div class="balloon-content-body-pan__content__info__title"><a href="${itemUrl}">${item.title}</a></div>
                    <div class="balloon-content-body-pan__content__info__rating">${rating}</div>
                    <div class="balloon-content-body-pan__content__info__price">от ${item.price}р.</div>
                    <div class="balloon-content-body-pan__content__info__address">${item.adress}</div>
                </div>
                <div class="balloon-content-body-pan__content__buttons">
                    ${phoneGlamping}
                    ${whatsupGlamping}
                    <button id="add-favorites" data-postid="${item.id}" class="btn-add-fav" type="button" name="button" title="Добавить в избранное">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/>
                            <path class="full" d="M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>`;

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
    				// balloonContentHeader: item.title,
                    balloonContentBody: bcb, //`${img}<p class="ymaps-2-1-79-balloon-content__header">от ${item.price}р.</p> Адрес: ${item.adress}`,
                    balloonContentBodyPan: bcbp,
    				// balloonContentFooter: `<a href="${itemUrl}">Подробнее</a>`,
                    // balloonContentFooter: '<a href=\"'+itemUrl+'\">Подробнее</a>',
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
    // console.dir(geoData);
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

function reviews_stars_items_average( average_rating, count_otziv ) {
	let rating = average_rating;
	let star_full = `<svg class="star-full" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path class="fa-secondary" fill="var(--reviews-color)" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
	</svg>`;
	let star_aver = `<svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path class="fa-primary" fill="var(--reviews-color)" d="M288 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.995 275.8 .0131 287.1-.0391L288 439.8zM433.2 512C432.1 512.1 431 512.1 429.9 512H433.2z"/>
	<path class="fa-secondary" fill="#d7dbe3" d="M146.3 512C145.3 512.1 144.2 512.1 143.1 512H146.3zM288 439.8V-.0387L288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.1 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L288 439.8z"/>
	</svg>`;
	let star_half = `<svg class="star-full" width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path class="fa-secondary" fill="#d7dbe3" d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"/>
	</svg>`;

	let content = `<div class="rating-stars">`;

	//$full_stars = $doc_meta->rating/$doc_meta->raitcol;
	let empty_stars = Math.floor( 5 - average_rating );
	while ( average_rating > 0 ) {
		if ( average_rating > 0 && average_rating - 1 >= 0 ) {
			content += star_full;
		}
		if ( average_rating > 0 && average_rating - 1 < 0 ) {
			content += star_aver;
		}
		average_rating--;
	}
	while ( empty_stars > 0 ) {
		content += star_half;

		empty_stars--;
	}
	content += `</div>`;
	content += `<div class="rating-count">
		<div class="rating-count__rating">`;
	content += rating; //.toFixed(1);
	content += `</div>
        <div class="rating-count__otziv">`;

	content += `<span>/ `;
    content += count_otziv+' '+num_word(count_otziv, ['отзыв', 'отзыва', 'отзывов']);
    content += `</span>`;
	content += `</div>
	    </div>`;
    return content;
}

function num_word(value, words){
	value = Math.abs(value) % 100;
	var num = value % 10;
	if(value > 10 && value < 20) return words[2];
	if(num > 1 && num < 5) return words[1];
	if(num == 1) return words[0];
	return words[2];
    // num_word(value, ['товар', 'товара', 'товаров']);
}

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
                let glempAll = JSON.parse(glamping_club_ajax.glAll);
                let newgGempAll =  glempAll.filter(filtrOptionsChange);
                let priceObj = [];
                priceObj = sliderUpdatePrice(newgGempAll);
                newgGempAll =  glempAll.filter(filtrOptionsChange).filter(priceRange, priceObj);
                mapRender(mapPointTest(newgGempAll));
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

const listCardMapMobile = () => {
    const btnMap = document.querySelector('.js-btn-map-mobile');
    if (!btnMap) return;
    const glampingsItems = document.querySelector('#archive-glampings .glampings-items');
    const glampingsMap = document.querySelector('.glampings-map');
    const archGlampingsLeft = document.querySelector('.archive-glampings__left');
    const btns = btnMap.querySelectorAll('button');
    // btns.forEach((btn) => {
        btnMap.addEventListener('click', (e) => {
            btnMapChange(btns);
            if (btnMap.id == 'mapClose') {
                archGlampingsLeft.classList.remove('no-map');
                glampingsItems.classList.remove('card');
                glampingsItems.classList.add('list');
                glampingsMap.classList.add('active');
                glampingsMap.children[0].innerHTML = '';
                let glempAll = JSON.parse(glamping_club_ajax.glAll);
                let newgGempAll =  glempAll.filter(filtrOptionsChange);
                let priceObj = [];
                priceObj = sliderUpdatePrice(newgGempAll);
                newgGempAll =  glempAll.filter(filtrOptionsChange).filter(priceRange, priceObj);
                mapRender(mapPointTest(newgGempAll));
                btnMap.id = 'mapVision'
                btnMap.innerText = 'Список'
                Cookies.set('glcTemp', btnMap.id);
            } else if (btnMap.id == 'mapVision') {
                glampingsItems.classList.remove('list');
                glampingsItems.classList.add('card');
                glampingsMap.classList.remove('active');
                archGlampingsLeft.classList.add('no-map');
                btnMap.id = 'mapClose'
                btnMap.innerText = 'Карта'
                Cookies.set('glcTemp', btnMap.id);
            }
            // Cookies.set('glcTemp', btnMap.id);
            document.querySelector('#page').scrollIntoView({ behavior: 'smooth' });
        });
        // console.dir(btn);
    // });
}
listCardMapMobile();

function btnMapChange(btns) {
    btns.forEach((btn) => {
        btn.classList.remove('active');
    });
}

function sortGlemp() {
    let sortGlemp = document.querySelector('.filtr-item__options.sort-glemp');
    if (!sortGlemp) return;
    let filtrOptions = sortGlemp.querySelectorAll('.filtr-option');
    filtrOptions.forEach((elem) => {
        elem.addEventListener('click', (e) => {
            elem.parentElement.previousElementSibling.children[0].innerText = e.target.innerText;
            optionsChecked(filtrOptions);
            elem.children[1].classList.add('active');
            let sortGl = elem.dataset.value;
            Cookies.set('glcSort', sortGl);
            sortGlempRender(sortGl);
            sortGlemp.classList.remove('active');
            sortGlemp.previousElementSibling.children[1].classList.remove('active');
        });
    });
}
sortGlemp();

function sortGlempRender(sortGl) {
    let priceObj = [];
    let glcPrice = localStorage.getItem('glcPrice');
    if (glcPrice) {
        priceObj = glcPrice.split(',');
    }
    let glempAll = JSON.parse(glamping_club_ajax.glAll);
    let newgGempAll =  glempAll.filter(filtrOptionsChange).filter(priceRange, priceObj.map(Number));
    // let sortGl = Cookies.get('glcSort');
    if (sortGl) {
        if (sortGl == 'new_items') {
            newgGempAll.sort((x, y) => y.post_date - x.post_date);
        } else if (sortGl == 'recommended') {
            newgGempAll.sort((x, y) => y.recommended - x.recommended);
        } else if (sortGl == 'max_price') {
            newgGempAll.sort((x, y) => y.price - x.price);
        } else if (sortGl == 'min_price') {
            newgGempAll.sort((x, y) => x.price - y.price);
        }
        // else if (sortGl == 'popular') {
        //     newgGempAll.sort((x, y) => y.views - x.views);
        // } else if (sortGl == 'rating') {
        //     newgGempAll.sort((x, y) => y.review_rating - x.review_rating || y.review_count - x.review_count);
        // }
    }
    glempRender(newgGempAll);
}

function optionsChecked(options) {
    options.forEach((elem) => {
        elem.children[1].classList.remove('active');
    });
}

const addFavCom = () => {
    const favoritesBtns = document.querySelectorAll('#add-favorites');
    const comparisonBtns = document.querySelectorAll('#add-comparison');
    const singleGlampings = document.querySelector('.single-glampings');
    const comparesMain = document.querySelector('.compares-main');
    if (!singleGlampings && !comparesMain) return;
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
addFavCom();

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
//                 document.querySelector('#post-info-'+btn.parentElement.parentElement.parentElement.parentElement.dataset.info).remove();
//                 // jQuery(document).ready( function($){
//                 //     $('.mySlick1').slick('slickRemove', 6);
//                 //     $('.mySlick2').slick('slickRemove', 6);
//                 // });
//                 supComparison.forEach((item) => {
//                     item.innerHTML = glcComparCount;
//                 });
//                 location.reload();
//             });
//         });
//     }
// }
// deleteFavCom();

function buttonsFavChange() {
    const glampingsItems = document.querySelector('.glampings-items');
    const singleGlampings = document.querySelector('.single-glampings');
    if (!glampingsItems) return;
    const supFavorites = document.querySelectorAll('#sup-favorites');
    const supСomparison = document.querySelectorAll('#sup-comparison');
    glampingsItems.addEventListener('click', function(event) {
        let btns = glampingsItems.querySelectorAll('button');
        let btn = event.target.closest('button');
        if (btn) {
            if (btn.id == 'add-favorites') {
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
            }

            if (btn.id == 'add-comparison') {
                let glcComparCount = localCheng('glcCompar', btn.dataset.postid);
                supСomparison.forEach((item) => {
                    item.innerHTML = glcComparCount;
                });
                btn.classList.toggle('active');
                if (btn.classList.contains('active')) {
                    btn.attributes.title.value = 'Удалить из сравнения';
                } else {
                    btn.attributes.title.value = 'Добавить к сравнению';
                }
            }
        }
    });
}
buttonsFavChange();

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
    const supFavorites = document.querySelectorAll('#sup-favorites');
    const supComparison = document.querySelectorAll('#sup-comparison');
    const addFavorites = document.querySelectorAll('#add-favorites');
    const addComparison = document.querySelectorAll('#add-comparison');
    let glcFav = favoritesRenderNologin('glcFav');
    let glcCompar = favoritesRenderNologin('glcCompar');
    if (supFavorites.length) {
        supFavorites.forEach((item) => {
            item.innerHTML = glcFav.length;
        });
        if (addFavorites.length) {
            addFavorites.forEach((item) => {
                if (glcFav.includes(item.dataset.postid)) {
                    item.classList.add('active');
                    item.attributes.title.value = 'Удалить из избранного';
                }
            });
        }
    }
    if (supComparison.length) {
        supComparison.forEach((item) => {
            item.innerHTML = glcCompar.length;
        });
        if (addComparison.length) {
            addComparison.forEach((item) => {
                if (glcCompar.includes(item.dataset.postid)) {
                    item.classList.add('active');
                    item.attributes.title.value = 'Удалить из сравнения';
                }
            });
        }
    }
}
favoritesRender();

function favoritesRenderNologin(name) {
    const glcFav = Cookies.get(name);
    let glcFav_obj = [];
    if (glcFav) {
        glcFav_obj = glcFav.split(',');
    }
    return glcFav_obj;
}

function mapFavComAction(addFavorites, addFavoritesBtnSingle, supFavorites, btnType) {
    addFavorites.classList.toggle('active');
    addFavoritesBtnSingle.classList.toggle('active');

    let glcFavCount = localCheng(btnType, addFavorites.dataset.postid);
    supFavorites.forEach((item) => {
        item.innerHTML = glcFavCount;
    });
    if (addFavorites.classList.contains('active')) {
        addFavorites.attributes.title.value = 'Удалить из избранного';
    } else {
        addFavorites.attributes.title.value = 'Добавить в избранное';
    }
    if (addFavoritesBtnSingle.classList.contains('active')) {
        addFavoritesBtnSingle.attributes.title.value = 'Удалить из избранного';
    } else {
        addFavoritesBtnSingle.attributes.title.value = 'Добавить в избранное';
    }
}
