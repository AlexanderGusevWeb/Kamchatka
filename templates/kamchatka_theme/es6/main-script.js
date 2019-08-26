(function ($) {
    $(function () {
        // Breadcrumbs- обрезки текста
        $('.breadcrumbs a').ellipsis();

        // Добоаление класса блокам с таблицей
        $('.extra-tab table').parent().addClass('table-block table-page');

        if ($('main table').length > 0) {
            if($('.table-page').length == 0) {
                $('.secondary-page').addClass('table-page');
            }
        }

        // Форма обратной связи "Прикрепить файл"
        $('.file input[type="file"]').on('change', function () {
            let fileName = $('input[type="file"]')[0].files[0].name;
            $('.removeText-js p').remove();
            $('.removeText-js').append('<p>' + fileName + '</p>');
        });

        // Страница "Коллегиальные органы" Анимация кнопки Документы
        $('.collegiate-page__doc-link').on('click', function () {
            $(this).find('.collegiate-page__button').toggleClass('active');
            $(this).parent().find('.doc-tab').slideToggle();
        });
    });

    // Preloader
    $(window).load(function () {
        setTimeout(function () {
            $('#preloader').fadeOut('slow');
            $('.news').addClass('show');

        }, 300);
        $('body').removeClass('no-scroll');
        // Fix для Slick слайдера при load главная страница новости/события
        $('.news__link-one').trigger('click');
    });

    function windowSize() {
        if ($(window).width() >= '992') {
            //// Инициализировать анимацию WOW.js только при экранах болше 992px
            new WOW().init();
        }
    }

    $(window).on('load', windowSize);

    // Button hidden/show form
    $(document).on('click', '.button-form-js', function () {
        $(this).hide();
        $('.filter').slideToggle('linear');
    });

})(jQuery);
