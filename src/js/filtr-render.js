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
        let count = glempAll.filter(elem => elem.location_id == item.location_id);
        regionItem.children[1].innerHTML = '';
        locObj.forEach((item) => {
            regionItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item.location_id}" name="${item.location}" data-name="region" value="">
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
    const regionItem = document.querySelector('.filtr-item.type');
    if (!regionItem) return;
    let typObj = [];
    if ( glempAll.length > 1 ) {
        glempAll.forEach((item) => {
            typObj = typObj.concat(item.type);
        });
        typObj = makeUniqSort(typObj);
    } else {
        typObj = arr[0].type
    }
    if (typObj.length) {
        regionItem.children[1].innerHTML = '';
        typObj.forEach((item) => {
            let itemName = '';
            if (item == 'glamping') {
                itemName = 'Глэмпинг';
            } else if (item == 'eco_hotel') {
                itemName = 'Эко-отель';
            } else if (item == 'camp_site') {
                itemName = 'Турбаза';
            } else if (item == 'private_sector') {
                itemName = 'Частный сектор';
            }
            let count = glempAll.filter(elem => elem.type == item);
            regionItem.children[1].insertAdjacentHTML(
                "beforeend",
                `<li>
                    <input type="checkbox" id="${item}" name="${itemName}" data-name="type" value="">
                    <label for="${item}">
                        <span class="checkmark fcheckbox">
                            <svg width="12" height="12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
                            </svg>
                        </span>
                        <span class="name">${itemName}</span>
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
    filtrItems.addEventListener('click', function(event) {
        let inputs = filtrItems.querySelectorAll('input');
        let input = event.target.closest('input');
        if (input) {
            console.dir(itemsVal(inputs));
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

function countOption(arr) {
    let count = arr.filter(function(elem) {
    	if ([5, 6].includes(elem.location_id)) {
    		return true;
    	}
    });
    return count;
}

function makeUniq(arr) { return [...new Set(arr)]; }
function makeUniqSort(arr) { return [...new Set(arr)].sort(); }
function makeUniqNum(arr) { return [...new Set(arr)].sort(function(a, b){return a - b}); }
