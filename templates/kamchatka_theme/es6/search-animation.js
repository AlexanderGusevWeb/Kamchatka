/**
 * Created by GermanWeb on 25.02.2019.
 */
(function ($) {
    $(function () {
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
    });
})(jQuery);
