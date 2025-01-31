const filtrOptionsVision = () => {
    const filtrTitle = document.querySelectorAll('.js-filtr-title');
    const filtrItemOptions = document.querySelectorAll('.filtr-item__options');
    if (!filtrTitle.length) return;
    filtrTitle.forEach((item) => {
        item.addEventListener('click', (e) => {
            if (item.classList.contains('sort-glemp')) {
                item.nextElementSibling.nextElementSibling.classList.toggle('active');
            } else {
                item.nextElementSibling.classList.toggle('active');
            }

            if (item.children[1])  item.children[1].classList.toggle('active');
            if (item.children[2])  item.children[2].classList.toggle('active');
        });
    });

    document.addEventListener('keydown', function(e) {
        if( e.keyCode == 27 ) {
            filtrTitle.forEach((item) => {
                if (item.classList.contains('sort-glemp')) {
                    item.nextElementSibling.nextElementSibling.classList.toggle('active');
                } else {
                    item.nextElementSibling.classList.toggle('active');
                }
                if (item.children[1])  item.children[1].classList.remove('active');
                if (item.children[2])  item.children[2].classList.toggle('active');
            });
        }
    });
}
filtrOptionsVision();

function optionsName(name) {
    const options = {
        'Рекомендованные': 'recommended',
        'Сначала дешевые': 'min_price',
        'Сначала дорогие': 'max_price',
    };
    return options[name];
}
