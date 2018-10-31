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
        //// Open
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

        //// Close
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
                $('.activities__tab-body[data=' + thisTab + ']').removeClass('d_none').animate({
                    opacity: 1
                }, 200);
            }, 500);

            $('.activities__tab-link[data=' + thisTab + ']').addClass('action');

        });
        // Анимация табы "Направления деятельности" END

        //Анимация WOW.js START
        new WOW().init();
        //Анимация WOW.js END

        //Страница "O Районе" мобильное меню START
        $('.area__mobile-menu').on('click', function () {
            $(this).toggleClass('active');

            if ($('.area__mobile-menu.active').length == true) {

                setTimeout(function () {
                    $('.area nav li').animate({
                        'height': 50
                    }, 100).animate({
                        'opacity': 1
                    }, 150);
                }, 10);

            } else {

                setTimeout(function () {
                    $('.area nav li').animate({
                        'opacity': 0
                    }, 150).animate({
                        'height': 0
                    }, 100);
                }, 10);
            }

        });
        //Страница "O Районе" мобильное меню END

        //Страница "Устав муниципального района" табаы START
        //// Кнопка открыть/закрыть табы
        $('.charter-page__button').on('click', function () {
            // Стрелка
            $('.tabs__button .flaticon-back').toggleClass('active');

            if ($('.two').length == true) {
                // Табы откурыть
                $('.one-tab').addClass('active');
                $('.one-tab__title').addClass('active');
                $('.one-tab__text').show(500);

                // Смена текста кнопки
                $('.active-one').addClass('one').removeClass('active-one');
                $('.two').addClass('active-two').removeClass('two');

            } else {
                // Табы закрыть
                $('.one-tab').removeClass('active');
                $('.one-tab__title').removeClass('active');
                $('.one-tab__text').hide(500);

                // Смена текста кнопки
                $('.active-two').addClass('two').removeClass('active-two');
                $('.one').addClass('active-one').removeClass('one');
            }
        });

        //// Один таб
        $('.flaticon-minus-horizontal-straight-line').on('click', function () {
            $(this).closest('.one-tab').toggleClass('active').find('.one-tab__title').toggleClass('active');
            $(this).closest('.one-tab').find('.one-tab__text').toggle(500);

            //// Смена кнопки если все табы открыты/закрыты
            var oneTabLength = $('.one-tab').length;
            var oneTabActiveLength = $('.one-tab__title.active').length;

            if (oneTabLength == oneTabActiveLength) {
                $('.tabs__button .flaticon-back').removeClass('active');

                // Смена текста кнопки
                $('.active-one').addClass('one').removeClass('active-one');
                $('.two').addClass('active-two').removeClass('two');
            } else {
                $('.tabs__button .flaticon-back').addClass('active');

                //// Смена текста кнопки
                $('.active-two').addClass('two').removeClass('active-two');
                $('.one').addClass('active-one').removeClass('one');
            }
        });
        //Страница "Устав муниципального района" табаы END

        //Страница "Почётные граждане" табаы START
        $('.honorary-page__button').on('click', function () {

            var $human = $(this).parents('.human');

            //// Стрелка
            $human.find('.tabs__button .flaticon-back').toggleClass('active');

            if ($human.find('.human__info.active').length == false) {
                //// Разделительная линия показать
                $human.find('.human__info').toggleClass('active');

                //// Табы откурыть
                $human.find('.human__footer').show(500);

                //// Смена текста кнопки
                $human.find('.active-one').addClass('one').removeClass('active-one');
                $human.find('.two').addClass('active-two').removeClass('two');

            } else {
                $human.find('.human__info').toggleClass('active');

                //// Табы закрыть
                $human.find('.human__footer').hide(500);

                //// Смена текста кнопки
                $human.find('.active-two').addClass('two').removeClass('active-two');
                $human.find('.one').addClass('active-one').removeClass('one');
            }

        });
        //Страница "Почётные граждане" табаы END

        //Страница "Районная газета" табаы START
        $('.newspaper-page__button').on('click', function () {
            $(this).toggleClass('active');

            $('.newspaper-page__header_hide').animate({
                'height': '60'
            }, 100).toggle(400);

            $('.newspaper-page__header_hide .newspaper-page__years').animate({
                'opacity': '1'
            }, 400);


            if ($('.newspaper-page__button.active').length == true) {
                $(this).parent().addClass('newspaper-page__header_border');
            } else {
                setTimeout(function () {
                    $('.newspaper-page__header_border').removeClass('newspaper-page__header_border');
                }, 400)
            }
        });

        //// Выбор года
        $('.newspaper-page__header_hide').on('click', function () {
            var year = $(this).find('.js-select-year').text().trim();

            window.location.href = "/page-area/newspaper-area/?year=" + year;
        });
        //Страница "Районная газета" табаы END
    });

    $(window).load(function () {
        $('.news__link-one').trigger('click');
    });
})(jQuery);
