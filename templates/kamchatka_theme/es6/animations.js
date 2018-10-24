/**
 * Created by GermanWeb on 12.10.2018.
 */
(function ($) {
    $(function () {
        //Анимация мобильного меню START
        $('.mobile-menu__links').animate({
            height: "hide"
        }, 0);

        $('.mobile-menu__icon').on('click', function () {
            $(this).closest('.mobile-menu').toggleClass('menu_state_open');
            $('.mobile-menu__links').animate({
                height: "toggle"
            }, 500);
        });
        //Анимация мобильного меню END

        // Анимация поиск START
        // Open
        $(".buttonSearch .btn1 .flaticon-magnifying-glass").click(function () {
            if ($('.buttonSearch__mobile-bottom.active').length != true) {
                $(".buttonSearch").animate({
                    height: 70
                }, 300);

                $(".buttonSearch input").animate({
                    height: 44,
                    opacity: 1
                }, 100).css('border', '2px solid #fff');

                $(".buttonSearch__main form").animate({
                    height: 70
                }, 800);

                $(".buttonSearch__main button").animate({
                    top: 0
                }, 800);

                $(".buttonSearch__mobile-top button").animate({
                    top: 65
                }, 800);

                $(".buttonSearch__mobile-top button > .flaticon-magnifying-glass").css('display', 'none');


                $(".buttonSearch__mobile-bottom button").animate({
                    top: 0,
                    opacity: 1
                }, 800).css('display', 'block');

                $(".buttonSearch button.btn1 .flaticon-magnifying-glass").css('display', 'none');

                $(".buttonSearch button.btn2").css('display', 'block');

                setTimeout(function () {
                    $('.buttonSearch .flaticon-close').animate({
                        opacity: 1
                    }, 1).css('display', 'block');
                }, 700);

                $('.buttonSearch__mobile-bottom').addClass('active').css('display', 'block');

                $('.mobile-menu').removeClass('menu_state_open');
                $('.mobile-menu__links').animate({
                    height: "hide"
                }, 500);
            }
        });

        // Close
        $(".flaticon-close, .mobile-menu__icon").click(function () {
            if ($('.buttonSearch__mobile-bottom.active').length == true) {
                $(".buttonSearch input").animate({
                    height: 0,
                    opacity: 0
                }, 10).css('border', 'none').val("");

                setTimeout(function () {
                    $(".buttonSearch").animate({
                        height: 0
                    }, 300);
                }, 200);

                $(".buttonSearch__main form").animate({
                    height: 0
                }, 800);

                $(".buttonSearch__main button").animate({
                    top: -70
                }, 800);

                $(".buttonSearch button.btn1 .flaticon-magnifying-glass").css('display', 'block');

                $(".buttonSearch button.btn2").css('display', 'none');

                $(".buttonSearch__mobile-top button").animate({
                    top: -35
                }, 800);

                setTimeout(function () {
                    $(".buttonSearch__mobile-top button > .flaticon-magnifying-glass").css('display', 'block');
                }, 350);

                $(".buttonSearch__mobile-bottom button").animate({
                    opacity: 1
                }, 800);

                $('.buttonSearch .flaticon-close').animate({
                    opacity: 0
                }, 100).css('display', 'none');

                $('.buttonSearch__mobile-bottom').removeClass('active').css('display', 'none');
            }
        });
        // Анимация поиск END

        // Анимация табы(header) START
        $('.tab-link').on('click', function () {
            $('.tab-link__background').animate({
                top: 150
            }, 300);

            $(this).find('.tab-link__background').animate({
                top: 0
            }, 200);
        });

        $('.tab-link-one').on('click', function () {
            $('.tab').animate({
                opacity: 0
            }, 400);

            setTimeout(function () {
                $('.tab').addClass('d_none');

                $('.tab-one').removeClass('d_none').animate({
                    opacity: 1
                }, 300);
            }, 300);
        });

        $('.tab-link-two').on('click', function () {
            $('.tab').animate({
                opacity: 0
            }, 400);

            setTimeout(function () {
                $('.tab').addClass('d_none');

                $('.tab-two').removeClass('d_none').animate({
                    opacity: 1
                }, 300);
            }, 300);


        });

        $('.tab-link-three').on('click', function () {
            $('.tab').animate({
                opacity: 0
            }, 400);

            setTimeout(function () {
                $('.tab').addClass('d_none');

                $('.tab-three').removeClass('d_none').animate({
                    opacity: 1
                }, 300);
            }, 300);
        });
        // Анимация табы(header) END

        // Анимация слайдер новости/события START
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
        // Анимация слайдер новости/события END

        // Анимация табы "Направления деятельности" START
        $('.tab-body:first-child').removeClass('d_none').css('opacity', '1');
        $('.activities__tab-link:first-child').addClass('action');

        $('.activities__tab-link').on('click', function () {

            $('.activities__tab-link').removeClass('action');

            var thisTab = $(this).attr('data');

            $('.tab-body').animate({
                opacity: 0
            }, 200);

            setTimeout(function () {
                $('.tab-body').addClass('d_none');
            }, 300);

            setTimeout(function () {
                $('.activities__tab-body[data='+ thisTab +']').removeClass('d_none').animate({
                    opacity: 1
                }, 200);
            }, 500);

            $('.activities__tab-link[data='+ thisTab +']').addClass('action');

        });
        // Анимация табы "Направления деятельности" END

        //Анимация WOW.js START
        new WOW().init();
        //Анимация WOW.js END

        //Страница "Устав муниципального района" табаы START
        // Кнопка
        $('.charter-page__button').on('click', function () {
            $('.button-text').toggleClass('active');

            $('.charter-page__button .flaticon-back').toggleClass('active');

            $('.one-tab__title').toggleClass('active');

            $('.one-tab__text').toggle(500);
        })
        // Один таб
        //Страница "Устав муниципального района" табаы END
    });

    $(window).load(function () {
        $('.news__link-one').trigger('click');
    });
})(jQuery);
