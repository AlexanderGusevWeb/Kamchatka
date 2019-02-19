(function ($) {
    $(function () {
        // Breadcrumbs- обрезки текста
        $('.breadcrumbs a').ellipsis();

        // Добоаление класса блоку с таблицей
        $('.extra-tab table').parent().addClass('table-block table-page');

        // Форма обратной связи "Прикрепить файл"
        $('.file input[type="file"]').on('change', function () {
            const fileName = $('input[type="file"]')[0].files[0].name;
            
            console.log(fileName);

            $('.removeText-js p').remove();

            $('.removeText-js').append('<p>' + fileName + '</p>');
        });
    });

    // Preloader
    $(window).load(function () {
        setTimeout(function () {
            $('#preloader').fadeOut('slow');

            $('.news').addClass('show');
        }, 300);

        $('body').removeClass('no-scroll');
    });
})(jQuery);
