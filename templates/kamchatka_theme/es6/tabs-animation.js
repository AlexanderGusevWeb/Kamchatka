/**
 * Created by GermanWeb on 25.02.2019.
 */
(function ($) {
    $(function () {
        // Анимация табов "Главная страниц"/"Header"
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

        // Анимация табов "Главная"/"Направления деятельности"
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

        // Кнопка открыть/закрыть все табы
        $(document).on('click', '.tabs__button', function () {
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

        // Один таб открыть/закрыть
        $(document).on('click', '.flaticon-minus-horizontal-straight-line', function () {
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

        // Вложенные табы открыть/закрыть
        $(document).on('click', '.extra-tab__title', function () {
            $(this).toggleClass('active').parent().toggleClass('active');
            $(this).parent().find('.extra-tab__text').toggle(400);
            $(this).find('.flaticon-back').toggleClass('active');
        });

        // Страница "Район"/"Почётные граждане" табаы
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

        // Страница "Район"/"Районная газета" табаы
        $(document).on('click', '.newspaper-page__button', function () {
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

        $(document).on('click', '.newspaper-page__header_hide', function () {
            //// Выбор года (Район/Районная газета)
            if ($('.js-select-year').length > 1) {
                let year = $(this).find('.js-select-year').text().trim();
                window.location.href = "/page-area/newspaper-area/?year=" + year;
            }

            //// Выбор года (Администрация/План работы)
            if ($('.js-doc-year').length > 1) {
                let year = $(this).find('.js-doc-year').text().trim();
                window.location.href = "/page-administration/page-work-plan/?year=" + year;
            }

            //// Выбор года (Администрация/Упр. образования, соц. и мол. политики / Отчеты и планы работы)
            if ($('.js-doc-year-education').length > 1) {
                let year = $(this).find('.js-doc-year-education').text().trim();
                $.get( "/page-administration/page-departments/page-dep-education/tekuwaya-deyatelnost/otchety-i-plany-raboty/?year=" + year, function( data ) {
                    let content = $(data).find('.wrapper-ajax-js');
                    $('.to-insert-ajax-js').html(content);
                });
            }
        });
    });
})(jQuery);