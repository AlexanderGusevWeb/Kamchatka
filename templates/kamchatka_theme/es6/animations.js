/**
 * Created by GermanWeb on 12.10.2018.
 */
(function ($) {
    $(function () {
        // Анимация мобильного меню START
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
        //// Открыть
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

        //// Закрыть
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

        // Анимация табы "Главная"/"Header" START
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
        // Анимация табы "Главная"/"Header" END

        // Анимация слайдер "Главная"/"Новости, События" START
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
        // Анимация слайдер "Главная"/"Новости, События" END

        // Анимация табы "Главная"/"Направления деятельности" START
        if ($('#home-page').length == true) {
            $('.tab-body:first-child').removeClass('d_none').css('opacity', '1');
            $('.activities__tab-link:first-child').addClass('action');
        }

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
        // Анимация табы "Главная"/"Направления деятельности" END

        //Мобильное сайдбар-меню START
        $('.secondary-page__mobile-menu').on('click', function () {
            $(this).toggleClass('active');

            if ($('.secondary-page__mobile-menu.active').length == true) {
                $('.secondary-page nav li').css({'display': 'flex'});

                setTimeout(function () {
                    $('.secondary-page nav li').animate({
                        'height': 50
                    }, 100).animate({
                        'opacity': 1
                    }, 150);
                }, 10);

            } else {
                console.log('123');
                setTimeout(function () {
                    $('.secondary-page nav li').animate({
                        'opacity': 0
                    }, 150).animate({
                        'height': 0,
                        'display': 'none'
                    }, 100);
                }, 10);
            }

        });
        //Мобильное сайдбар-меню  END

        // Кнопка открыть/закрыть все табы START
        $('.tabs__button').on('click', function () {
            //// Стрелка
            $(this).find('.flaticon-back').toggleClass('active');

            if ($('.two').length == true) {
                //// Табы откурыть
                $('.one-tab').addClass('active');
                $('.one-tab__title').addClass('active');
                $('.one-tab__text').show(500);

                //// Смена текста кнопки
                $('.active-one').addClass('one').removeClass('active-one');
                $('.two').addClass('active-two').removeClass('two');

            } else {
                //// Табы закрыть
                $('.one-tab').removeClass('active');
                $('.one-tab__title').removeClass('active');
                $('.one-tab__text').hide(500);

                //// Вложенные табы закрыть
                $('.extra-tab__text').hide(400);
                $('.extra-tab .flaticon-back').removeClass('active');
                $('.extra-tab').removeClass('active');
                $('.extra-tab__title').removeClass('active');

                //// Смена текста кнопки
                $('.active-two').addClass('two').removeClass('active-two');
                $('.one').addClass('active-one').removeClass('one');

                $('.doc-tab').slideUp();
            }
        });
        // Кнопка открыть/закрыть все табы END

        // Один таб открыть/закрыть START
        $('.flaticon-minus-horizontal-straight-line').on('click', function () {
            $(this).closest('.one-tab').toggleClass('active').find('.one-tab__title').toggleClass('active');
            $(this).closest('.one-tab').find('.one-tab__text').toggle(500);

            //// Вложенные табы закрыть
            $(this).parents('.one-tab').find('.extra-tab__text').hide(400);
            $(this).parents('.one-tab').find('.extra-tab .flaticon-back').removeClass('active');
            $(this).parents('.one-tab').find('.extra-tab').removeClass('active');
            $(this).parents('.one-tab').find('.extra-tab__title').removeClass('active');

            //// Смена кнопки если все табы открыты/закрыты
            var oneTabLength = $('.one-tab').length;
            var oneTabActiveLength = $('.one-tab__title.active').length;

            if (oneTabLength == oneTabActiveLength) {
                $('.tabs__button .flaticon-back').removeClass('active');

                //// Смена текста кнопки
                $('.active-one').addClass('one').removeClass('active-one');
                $('.two').addClass('active-two').removeClass('two');

            } else {
                $('.tabs__button .flaticon-back').addClass('active');

                //// Смена текста кнопки
                $('.active-two').addClass('two').removeClass('active-two');
                $('.one').addClass('active-one').removeClass('one');
            }

            // Свернуть таб с документами
            $(this).find('.doc-tab').slideUp();
        });
        // Один таб открыть/закрыть END

        // Вложенные таб открыть/закрыть START
        $('.extra-tab__title').on('click', function () {
            $(this).toggleClass('active').parent().toggleClass('active');
            $(this).parent().find('.extra-tab__text').toggle(400);
            $(this).find('.flaticon-back').toggleClass('active');
        });
        // Вложенные таб открыть/закрыть END

        // Страница "Район"/"Почётные граждане" табаы START
        $('.honorary-page__button').on('click', function () {

            $(this).parents('.human').toggleClass('active');

            var $human = $(this).parents('.human');
            var $humanActive = $(this).parents('.human.active');

            if ($human.length == $humanActive.length) {
                //// Табы откурыть
                $human.find('.human__footer').show(500);

                // Смена текста кнопки
                $human.find('.button-text').toggleClass('active');

            } else {
                //// Табы откурыть
                $human.find('.human__footer').hide(500);

                // Смена текста кнопки
                $human.find('.button-text').toggleClass('active');
            }
        });
        // Страница "Район"/"Почётные граждане" табаы END

        // Страница "Район"/"Районная газета" табаы START
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

        $('.newspaper-page__header_hide').on('click', function () {
            //// Выбор года (Район/Районная газета)
            if($('.js-select-year').length > 1) {
                let year = $(this).find('.js-select-year').text().trim();
                window.location.href = "/page-area/newspaper-area/?year=" + year;
            }

            //// Выбор года (Администрация/План работы)
            if($('.js-doc-year').length > 1) {
                let year = $(this).find('.js-doc-year').text().trim();
                window.location.href = "/page-administration/page-work-plan/?year=" + year;
            }
        });
        // Страница "Район"/"Районная газета" табаы END

        // Главня страница переключение городов карты START
        $('.map-item').on('click', function () {
            $('.map-item').removeClass('active');
            $(this).addClass('active');

            let itemClass = $(this).attr('class');
            itemClass = itemClass.replace('map-item', '');
            itemClass = itemClass.replace('active', '');
            itemClass = itemClass.replace(/\s/g, '');
            itemClass = "." + itemClass;

            $('.city').removeClass('active');
            $('.tab-one__right').find(itemClass).addClass('active');

        });
        // Главня страница переключение городов карты END

        // Страница "Коллегиальные органы" Анимация кнопки Документы START
        $('.collegiate-page__doc-link').on('click', function () {
            $(this).find('.collegiate-page__button').toggleClass('active');
            $(this).parent().find('.doc-tab').slideToggle();
        });
        // Страница "Коллегиальные органы" Анимация кнопки Документы END
    });

    // Windows Load START
    // Fix для Slick слайдера при load главная страница новости/события
    $(window).load(function () {
        $('.news__link-one').trigger('click');
    });
    // Windows Load END

    // Windows Load and Resize START
    function windowSize() {
        if ($(window).width() >= '992') {
            //// Инициализировать анимацию WOW.js только при экранах болше 992px START
            new WOW().init();
            //// Инициализировать анимацию WOW.js только при экранах болше 992px END

            //// При экране болье 992px развернуть сайдбар-меню
            $('.secondary-page nav li').css({
                'height': 'auto',
                'opacity': 1,
                'display': 'flex'
            });

            //// При Resize свернуть мобильное сайдбар-меню
            $('.secondary-page__mobile-menu').removeClass('active');

        } else {
            //// При экране меньше 992px свернуть сайдбар-меню
            $('.secondary-page nav li').css({
                'height': 0,
                'opacity': 0,
                'display': 'none'
            });

            //// При Resize свернуть мобильное сайдбар-меню
            $('.secondary-page__mobile-menu').removeClass('active');
        }
    }

    $(window).on('load', windowSize);
    // Windows Load and Resize END
})(jQuery);
