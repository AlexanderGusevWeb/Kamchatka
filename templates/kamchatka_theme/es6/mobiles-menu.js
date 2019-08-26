/**
 * Created by GermanWeb on 25.02.2019.
 */
(function ($) {
    $(function () {
        // Анимация главного мобильного меню
        $('.mobile-menu__links').animate({
            height: "hide"
        }, 0);

        $('.mobile-menu__icon').on('click', function () {
            $(this).closest('.mobile-menu').toggleClass('menu_state_open');
            $('.mobile-menu__links').animate({
                height: "toggle"
            }, 500);
        });

        //Мобильное сайдбар-меню
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
    });

    function windowSize() {
        if ($(window).width() >= '992') {
            //// При экране болье 992px развернуть сайдбар-меню
            $('.secondary-page nav li').css({
                'height': 'auto',
                'opacity': 1,
                'display': 'flex'
            });

        } else {
            //// При экране меньше 992px свернуть сайдбар-меню
            $('.secondary-page nav li').css({
                'height': 0,
                'opacity': 0,
                'display': 'none'
            });

            $('.secondary-page__mobile-menu').removeClass('active');
        }
    }

    $(window).on('resize', windowSize);
})(jQuery);