function navScroll(elementId) {
    const masthead = document.getElementById(elementId);
    const asideContent = document.getElementById('aside-content');
    const btnFiltrVisionMobile = document.getElementById('btn-filtr-vision-mobile');
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            if (masthead) {
                let headHeight = masthead.offsetHeight+20;
                masthead.style.top = "0";
                if (currentScrollPos == 0) {
                    masthead.style.top = "";
                }
            } else {
                headHeight = 20;
            }
            if (asideContent) {
                asideContent.style.top = headHeight+"px";
            }
            if (btnFiltrVisionMobile) {
                btnFiltrVisionMobile.style.top = '';
            }
        } else {
            if (masthead) {
                if (prevScrollpos > masthead.offsetHeight) { //clientHeight
                    masthead.style.top = '-'+masthead.offsetHeight+'px';
                }
            }
            if (asideContent) {
                asideContent.style.top = '24px';
            }
            if (btnFiltrVisionMobile) {
                btnFiltrVisionMobile.style.top = '0';
            }
        }
        prevScrollpos = currentScrollPos;
    }
}
navScroll('masthead');

function asideScroll(elementId, header) {
    const asideContent = document.getElementById(elementId);
    const headerDiv = document.getElementById(header);
    var prevScroll = window.pageYOffset;
    window.onscroll = function() {
        var currentScroll = window.pageYOffset;
        if (prevScroll > currentScroll) {
            asideContent.style.top = headerDiv.offsetHeight+"px";
        } else {
            asideContent.style.top = '24px';
        }
        prevScroll = currentScroll;
    }
}
// asideScroll('aside-content', 'masthead');

function dashboardHeight(headerId, tabsTd) {
    const dashboardHead = document.getElementById(headerId);
    const tabs = document.getElementById(tabsTd);
    if (dashboardHead && tabs) {
        const logo = document.getElementById('dashboard-logo');
        const sidebarContent = document.getElementById('dashboard-sidebar-content');
        let ha = dashboardHead.offsetHeight;
        let h = `calc(100vh - ${ha}px)`;
        tabs.style.height = h;
        sidebarContent.style.height = h;
        logo.style.height = `${ha}px`;

        window.addEventListener('resize', () => {
            ha = dashboardHead.offsetHeight;
            h = `calc(100vh - ${ha}px)`;
            tabs.style.height = h;
            sidebarContent.style.height = h;
            logo.style.height = `${ha}px`;
        });
    }
}
dashboardHeight('dashboard-header', 'dashboard-tabs');

function dashboardHeightPlus(headerId, footerId, tabsTd) {
    const dashboardHead = document.getElementById(headerId);
    const dashboardFooter = document.getElementById(footerId);
    const tabs = document.getElementById(tabsTd);
    if (dashboardHead && dashboardFooter && tabs) {
        let ha = dashboardHead.offsetHeight+dashboardFooter.offsetHeight;
        let h = `calc(100vh - ${ha}px)`;
        tabs.style.height = h;

        window.addEventListener('resize', () => {
            h = `calc(100vh - ${ha}px)`;
            tabs.style.height = h;
        });
    }
}
// dashboardHeightPlus('masthead', 'dashboard-colophon', 'dashboard-tabs');

const sidebarNavVision = () => {
    btnSidebarNav = document.querySelector('#js-sidebar-nav')
    if ( btnSidebarNav ) {
        sidebarNav = document.querySelector('.sidebar-nav')
        overlay = document.querySelector('.js-overlay-modal')
        close = document.querySelector('#js-close')
        body = document.querySelector('body')
        btnSidebarNav.addEventListener('click', (e) => {
            overlay.classList.toggle('active');
            sidebarNav.classList.toggle('active');
            body.classList.toggle('js-overlay');
        });
        overlay.addEventListener('click', function() {
            sidebarNav.classList.remove('active');
            this.classList.remove('active');
            body.classList.remove('js-overlay');
        });
        document.body.addEventListener('keyup', function (e) {
            var key = e.keyCode;
            if (key == 27) {
                sidebarNav.classList.remove('active');
                overlay.classList.remove('active');
                body.classList.remove('js-overlay');
            };
        }, false);
        close.addEventListener('click', function() {
            sidebarNav.classList.remove('active');
            overlay.classList.remove('active');
            body.classList.remove('js-overlay');
        });
    }
}
sidebarNavVision();

const sidebarDashboardVision = () => {
    btnSidebarNav = document.querySelector('#js-sidebar-nav-dashboard')
    if ( btnSidebarNav ) {
        sidebarNav = document.querySelector('#dashboard-sidebar')
        overlay = document.querySelector('.js-overlay-modal')
        close = document.querySelector('#js-dashboard-close')
        body = document.querySelector('body')
        btnSidebarNav.addEventListener('click', (e) => {
            overlay.classList.toggle('active');
            sidebarNav.classList.toggle('active');
            body.classList.toggle('js-overlay');
        });
        overlay.addEventListener('click', function() {
            sidebarNav.classList.remove('active');
            this.classList.remove('active');
            body.classList.remove('js-overlay');
        });
        document.body.addEventListener('keyup', function (e) {
            var key = e.keyCode;
            if (key == 27) {
                sidebarNav.classList.remove('active');
                overlay.classList.remove('active');
                body.classList.remove('js-overlay');
            };
        }, false);
        close.addEventListener('click', function() {
            sidebarNav.classList.remove('active');
            overlay.classList.remove('active');
            body.classList.remove('js-overlay');
        });
    }
}
sidebarDashboardVision();

const filtrVision = () => {
    btnfiltrVision = document.querySelector('#js-filtr-vision')
    if ( btnfiltrVision ) {
        filtr = document.querySelector('.filtr-items')
        close = document.querySelector('#js-filtr-close')
        body = document.querySelector('body')
        btnfiltrVision.addEventListener('click', (e) => {
            filtr.classList.toggle('active');
            body.classList.toggle('js-overlay');
        });
        document.body.addEventListener('keyup', function (e) {
            var key = e.keyCode;
            if (key == 27) {
                filtr.classList.remove('active');
                body.classList.remove('js-overlay');
            };
        }, false);
        close.addEventListener('click', function() {
            filtr.classList.remove('active');
            body.classList.remove('js-overlay');
        });
    }
}
// filtrVision();

const searchVision = () => {
    btnsearchVision = document.querySelector('#js-search-vision')
    if ( btnsearchVision ) {
        search = document.querySelector('.header-generale__form')
        btnsearchVision.addEventListener('click', (e) => {
            search.classList.toggle('active');
            btnsearchVision.classList.toggle('active');
        });
        document.body.addEventListener('keyup', function (e) {
            var key = e.keyCode;
            if (key == 27) {
                search.classList.remove('active');
                btnsearchVision.classList.remove('active');
            };
        }, false);
    }
}
searchVision();

// jQuery
jQuery(document).ready( function($){

    function scrollToTop(pxShow, scrollSpeed){
        // pxShow - height on which the button will show
    	// scrollSpeed - how slow / fast you want the button to scroll to top.
        $(window).scroll(function(){
    	 if($(window).scrollTop() >= pxShow){
    		$(".btn-to-top").addClass('visible');
            $(".request-call").addClass('btn-top-vision');
    	 } else {
    		$(".btn-to-top").removeClass('visible');
            $(".request-call").removeClass('btn-top-vision');
    	 }
    	});
        $('a.scroll-to-top').on('click', function(){
            $('html, body').animate({scrollTop:0}, scrollSpeed);
            return false;
        });
    }
    scrollToTop(400, 400);

    function scrollAnimate(){
        $(document).on('click', 'a.animate-scroll[href^="#"]', function (event) {
            event.preventDefault();
            //var indent = $($.attr(this, 'href')).attr('data-top');
            var indent = $(this).attr('data-top');
            if (indent) {
                indent_top = indent;
            } else {
                indent_top = 0;
            }
            if ($($.attr(this, 'href')).length > 0) {
                $('html, body').animate({
                    scrollTop: $($.attr(this, 'href')).offset().top - indent_top
                }, 500);
            }
        });
    }
    scrollAnimate();

    // // magnificPopup
    // function mfpInit( index ) {
    //     $('.gallery-'+index).magnificPopup({
    //         type: 'image',
    //         delegate: '.mfp',
    //         tClose: 'Закрыть (Esc)',
    //         tLoading: 'Загрузка...',
    //         gallery:{
    //             enabled: true,
    //             tPrev: 'Назад',
    //             tNext: 'Вперед',
    //             tCounter: '%curr% из %total%'
    //         },
    //         image: {
    //             tError: '<a href="%url%">Изображение</a> не удалось загрузить.'
    //         },
    //         ajax: {
    //             tError: '<a href="%url%">Запрос</a> не выполнен.'
    //         }
    //     });
    // }
    // mfpInit('1');
    // mfpInit('2');
    // mfpInit('3');
    // mfpInit('4');
    // mfpInit('5');
    // mfpInit('6');
    // mfpInit('7');
    // mfpInit('8');
    // mfpInit('9');
    // mfpInit('10');
    // mfpInit('11');
    // mfpInit('12');
    // mfpInit('13');
    // mfpInit('14');
    // mfpInit('15');
    // mfpInit('16');
    // mfpInit('17');
    // mfpInit('18');
    // mfpInit('19');
    // mfpInit('20');
    // mfpInit('all');
    //
    // $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
	// 	disableOn: 700,
	// 	type: 'iframe',
	// 	mainClass: 'mfp-fade',
    //     tClose: 'Закрыть (Esc)',
	// 	removalDelay: 160,
	// 	preloader: false,
    //     fixedContentPos: true,
    //     fixedBgPos: true,
    //     overflowY: 'hidden',
    //     // callbacks: {
    //     //     open: function() {
    //     //
    //     //     },
    //     //     close: function() {
    //     //
    //     //     }
    //     // }
	// });
    //
    // $('.image-popup-fit-width').magnificPopup({
	// 	type: 'image',
	// 	closeOnContentClick: true,
	// 	image: {
	// 		verticalFit: false
	// 	}
	// });
    //
    // $('.image-popup-vertical-fit').magnificPopup({
	// 	type: 'image',
	// 	closeOnContentClick: true,
	// 	mainClass: 'mfp-img-mobile',
	// 	image: {
	// 		verticalFit: true
	// 	}
    //
	// });

});
