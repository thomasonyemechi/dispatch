(function ($) {
    "use strict";
    var $main_nav = $('#main-nav');
    var $toggle = $('.toggle');
    var defaultOptions = {
        disableAt: false,
        customToggle: $toggle,
        levelSpacing: 40,
        navTitle: 'Unique Dispatch',
        levelTitles: true,
        levelTitleAsBack: true,
        pushContent: '#container',
        insertClose: 2
    };
    var Nav = $main_nav.hcOffcanvasNav(defaultOptions);
    $('.landing-slider').slick({
        arrows: false,
        autoplay: true,
        dots: true,
    });
    $('.favorites-slider').slick({
        autoplay: true,
        infinite: true,
        slidesToShow: 4.5,
        slidesToScroll: 3,
        arrows: false,
    });
    $('.personal-img').slick({
        arrows: false,
        autoplay: true,
    });
})(jQuery);
