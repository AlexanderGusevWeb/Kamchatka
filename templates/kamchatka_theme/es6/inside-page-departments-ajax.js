(function ($) {

    function chooseActivePageSidebar(pageNameActive) {
        let sidebar = $('.secondary-page__menu li a');

        sidebar.each(function () {
            if ($.trim($(this).text()) == $.trim(pageNameActive)) {

                let activeStatus = $(this).hasClass("active");

                if (!activeStatus) {
                    $('.tabs-ajax-js').removeClass('active').find('a').removeClass('active');
                    $(this).addClass('active').parent().addClass('active');
                }
            }
        });
    }

    function chooseFirstPage() {
        let firstPages = $('.active.main-menu__item-menu').find('.tabs-menu-ajax-js');

        firstPages.each(function (id) {
            if (id == 0) {
                let linkPage = $(this).find('a').attr('href');
                let namePage = $(this).find('a').text();

                $.ajax({
                    type: "POST",
                    url: linkPage,
                    dataType: 'html',
                    success: function (data) {
                        let content = $(data).find('.wrapper-ajax-js');
                        $('.to-insert-ajax-js').html(content);
                    }
                });

                chooseActivePageSidebar(namePage);
            }
        });
    }

    $(function () {
        chooseFirstPage();

        $('.main-menu__item-menu').on('click', function () {
            chooseFirstPage();
        });

        $('.tabs-menu-ajax-js').on('click', function (event) {
            event.preventDefault();

            let parentLink = $(this).parents('.main-menu__item-menu').find('.main-menu__item-link').attr('href');
            let namePage = $(this).find('a').text();

            $.ajax({
                type: "POST",
                url: parentLink,
                dataType: 'html',
                success: function (data) {
                    let content = $(data).find('.secondary-page__menu');
                    let breadcrumbs = $(data).find('.breadcrumbs');

                    $('.secondary-page__menu').html(content);
                    $('.breadcrumbs-wrapper').html(breadcrumbs);

                    // Breadcrumbs- обрезка текста
                    $('.breadcrumbs a').ellipsis();

                    chooseActivePageSidebar(namePage);
                }
            });

            $.ajax({
                type: "POST",
                url: $(this).find('a').attr('href'),
                dataType: 'html',
                success: function (data) {
                    let content = $(data).find('.wrapper-ajax-js');
                    $('.to-insert-ajax-js').html(content);
                }
            });
        });

        $(document).on('click', '.tabs-ajax-js', function (event) {
            event.preventDefault();

            let activeStatus = $(this).parent().hasClass("active");

            if (!activeStatus) {
                $('.tabs-ajax-js').removeClass('active').parent().removeClass('active');
                $('.inside-tabs-ajax-js').removeClass('active').parent().removeClass('active');
                $(this).addClass('active').parent().addClass('active');
            }

            $.ajax({
                type: "POST",
                url: $(this).attr('href'),
                dataType: 'html',
                success: function (data) {
                    let content = $(data).find('.wrapper-ajax-js');
                    let tablePage = $('.to-insert-ajax-js').html(content).find('table');

                    if (tablePage.length > 0) tablePage.parent().addClass('table-block table-page');

                    $('.to-insert-ajax-js table')
                        .prepend('<span class="flaticon-arrow-left-and-right"><p>Чтобы просмотреть данные таблицы проведите пальцем влево/вправо</p></span>')
                        .parents('.departments-page')
                        .removeClass('table-page');
                }
            });
        });

        $(document).on('click', '.inside-tabs-ajax-js', function (event) {
            event.preventDefault();

            let activeStatus = $(this).parent().hasClass("active");

            if (!activeStatus) {
                $('.tabs-ajax-js').removeClass('active').parent().removeClass('active');
                $('.inside-tabs-ajax-js').removeClass('active').parent().removeClass('active');
                $('.second-level-menu').removeClass('active');
                $(this).parents('.second-level-menu').addClass('active');
                $(this).addClass('active').parent().addClass('active');
            }

            $.ajax({
                type: "POST",
                url: $(this).attr('href'),
                dataType: 'html',
                success: function (data) {
                    let content = $(data).find('.wrapper-ajax-js');
                    $('.to-insert-ajax-js').html(content);

                    let selectNow = $('#hidden-doc').val();
                    let selectName = $('#hidden-doc').find('option[value="' + selectNow + '"]').attr('data-real-name-js');
                    console.log(selectName);
                }
            });
        });

        // Click main menu button
        $('.main-menu__item-link[href="javascript:void(0)"]').on('click', function () {
            $('.inside-menu').toggle();
        });

        // Click main menu button
        $(document).on('click', '#all-doc-js', function () {
            $(this).parents('form').submit();
        });
    });
})(jQuery);