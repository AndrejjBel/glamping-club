const filtrOptionsVision = () => {
    const filtrTitle = document.querySelectorAll('.js-filtr-title');
    if (!filtrTitle.length) return;
    filtrTitle.forEach((item) => {
        item.addEventListener('click', (e) => {
            item.nextElementSibling.classList.toggle('active');
            if (item.children[1])  item.children[1].classList.toggle('active');
            console.dir(item.nextElementSibling);
        });

        // item.nextElementSibling.children.forEach((el) => {
        //     el.addEventListener('click', (e) => {
        //         console.dir(el);
        //     });
        // });

        for (var variable of item.nextElementSibling.children) {
            console.dir(variable);
            variable.addEventListener('click', (e) => {
                console.dir(variable.innerText);
            });
        }
    });

    document.addEventListener( 'click', (e) => {
        filtrTitle.forEach((item) => {
            const itemNo = e.composedPath().includes(item);
            if (!itemNo) {
                item.nextElementSibling.classList.remove('active');
                if (item.children[1])  item.children[1].classList.remove('active');
            }
        });
    });

    document.addEventListener('keydown', function(e) {
        if( e.keyCode == 27 ) {
            filtrTitle.forEach((item) => {
                item.nextElementSibling.classList.remove('active');
                if (item.children[1])  item.children[1].classList.remove('active');
            });
        }
    });
}
filtrOptionsVision();
