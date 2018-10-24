/**
 * Created by GermanWeb on 12.10.2018.
 */
(function ($) {
    $(function () {
        // Slick for news 1
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
        // Slick for news 2
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
})(jQuery);
