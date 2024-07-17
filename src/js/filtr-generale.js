const filtrOptionsVision = () => {
    const filtrTitle = document.querySelectorAll('.js-filtr-title');
    const filtrItemOptions = document.querySelectorAll('.filtr-item__options');
    if (!filtrTitle.length) return;
    filtrTitle.forEach((item) => {
        item.addEventListener('click', (e) => {
            item.nextElementSibling.classList.toggle('active');
            if (item.children[1])  item.children[1].classList.toggle('active');
        });
    });

    // document.addEventListener( 'click', (e) => {
    //     filtrTitle.forEach((item) => {
    //         const itemNo = e.composedPath().includes(item);
    //         if (!itemNo) {
    //             item.nextElementSibling.classList.remove('active');
    //             if (item.children[1])  item.children[1].classList.remove('active');
    //         }
    //     });
    // });

    document.addEventListener('keydown', function(e) {
        if( e.keyCode == 27 ) {
            filtrTitle.forEach((item) => {
                item.nextElementSibling.classList.remove('active');
                if (item.children[1])  item.children[1].classList.remove('active');
            });
        }
    });

    filtrItemOptions.forEach((item) => {
        let filtrOptions = item.querySelectorAll('.filtr-option');
        filtrOptions.forEach((elem) => {
            elem.addEventListener('click', (e) => {
                // console.dir(elem.dataset.value);
                elem.parentElement.previousElementSibling.children[0].innerText = e.target.innerText;
                optionsChecked(filtrOptions);
                elem.children[1].classList.add('active');
                Cookies.set('glcSort', elem.dataset.value);
            });
        });
    });
}
filtrOptionsVision();

function optionsChecked(options) {
    options.forEach((elem) => {
        elem.children[1].classList.remove('active');
    });
}

function optionsName(name) {
    const options = {
        'Рекомендованные': 'recommended',
        'Сначала дешевые': 'min_price',
        'Сначала дорогие': 'max_price',
    };
    return options[name];
}
