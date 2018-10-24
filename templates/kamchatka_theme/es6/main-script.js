(function ($) {
    $(function () {


    });

    // Preloader
    $(window).load(function () {
        setTimeout(function () {
            $('#preloader').fadeOut('slow');

            $('.news').addClass('show');
        }, 300);
    });

    // Fix для Slick слайдера главная/события
    $(window).on('resize', function () {
        if($('#home-page').length == true ) {
            location.reload();
        }
    })
})(jQuery);
