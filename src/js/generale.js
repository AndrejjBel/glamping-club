function navScroll(elementId) {
    const masthead = document.getElementById(elementId);
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            masthead.style.top = "0";
        } else {
            if (prevScrollpos > masthead.offsetHeight) { //clientHeight
                masthead.style.top = '-'+masthead.offsetHeight+'px';
            }
        }
        prevScrollpos = currentScrollPos;
    }
}
navScroll('masthead');

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
