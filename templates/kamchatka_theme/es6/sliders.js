/**
 * Created by GermanWeb on 12.10.2018.
 */
(function ($) {
    $(function () {
        // Slick for header
        $('.home-page__slider').slick({
            dots: false,
            arrows: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3000,
            swipe: false,
            fade: true,
            cssEase: 'ease',
            speed: 2000
        });

        // Slick for news
        $('.block-news__one').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<span class="flaticon-return"><sapn class="flaticon-bg"></sapn></span>',
            nextArrow: '<span class="flaticon-next"><sapn class="flaticon-bg"></sapn></span>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        // Slick for events
        $('.block-news__two').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<span class="flaticon-return"><sapn class="flaticon-bg"></sapn></span>',
            nextArrow: '<span class="flaticon-next"><sapn class="flaticon-bg"></sapn></span>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        // Slick for mobile-events
        if ($('.block-news__mobile').length > 0) {
            $('.block-news__mobile').slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 3,
                slidesToScroll: 1,
                prevArrow: '<span class="flaticon-return"><sapn class="flaticon-bg"></sapn></span>',
                nextArrow: '<span class="flaticon-next"><sapn class="flaticon-bg"></sapn></span>',
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }

        // Slick for links
        $('.links__body').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: '<span class="flaticon-return"><sapn class="flaticon-bg"></sapn></span>',
            nextArrow: '<span class="flaticon-next"><sapn class="flaticon-bg"></sapn></span>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });

    // Fix для Slick слайдера при resize главная страница новости/события
    // $(window).on('resize', function () {
        // if ($(window).width() >= '1025') {
        //     if ($('#home-page').length == true) {
        //         location.reload();
        //     }
        // }
    // })
})(jQuery);
