(function ($) {
    $(function () {
        // Script обрезки текста
        $('.one-news__text').ellipsis({'setTitle':'onEllipsis'} );

    });

    // Preloader
    $(window).load(function () {
        setTimeout(function () {
            $('#preloader').fadeOut('slow');

            $('.news').addClass('show');
        }, 300);
    });
})(jQuery);
