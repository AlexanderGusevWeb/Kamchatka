/**
 * Created by GermanWeb on 25.02.2019.
 */
(function ($) {
    $(function () {
        // Анимация слайдер "Главная"/"Новости, События"
        $('.news__link').on('click', function () {
            if ($(this).hasClass('news__passive')) {
                $('.news__link').toggleClass('news__active').toggleClass('news__passive');
            }

            if ($('.news__link-one.news__active').length == true) {

                $('.block-news__two').animate({
                    opacity: 0
                }, 400);

                setTimeout(function () {

                    $('.block-news__one').removeClass('d_none').animate({
                        opacity: 1
                    }, 300);

                    $('.block-news__two').addClass('d_none');
                }, 300);

            } else if ($('.news__link-two.news__active').length == true) {

                $('.block-news__one').animate({
                    opacity: 0
                }, 400);

                setTimeout(function () {
                    $('.block-news__two').removeClass('d_none').animate({
                        opacity: 1
                    }, 300);

                    $('.block-news__one').addClass('d_none');
                }, 300);
            }
        });

        $('.news__link-one').on('click', function () {
            $('.news__link-two a').css({
                'opacity': '0',
                'display': 'none'
            });
            $('.news__link-two .news__separate').css({
                'opacity': '0',
                'display': 'none'
            });

            setTimeout(function () {
                $('.news__link-one a').show().animate({
                    opacity: 1
                }, 400);

                $('.news__link-one .news__separate').show().animate({
                    opacity: 1
                }, 400);
            }, 100);
        });

        $('.news__link-two').on('click', function () {
            $('.news__link-one a').css({
                'opacity': '0',
                'display': 'none'
            });
            $('.news__link-one .news__separate').css({
                'opacity': '0',
                'display': 'none'
            });

            setTimeout(function () {
                $('.news__link-two a').show().animate({
                    opacity: 1
                }, 400);

                $('.news__link-two .news__separate').show().animate({
                    opacity: 1
                }, 400);
            }, 100);
        });
    });
})(jQuery);
