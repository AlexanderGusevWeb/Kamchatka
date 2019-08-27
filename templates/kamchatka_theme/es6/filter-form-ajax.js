(function ($) {
    $(function () {
        $('.project-docs div.wrapper-header').empty();
        $('.project-docs div.docs-list-js').empty();

        // restartFilterOnLoadPage('.tabs-ajax-js.active');
        // restartFilterOnLoadPage('.inside-tabs-ajax-js.active');
    });

    // function restartFilterOnLoadPage(classPage) {
    //     if ($(classPage).length > 0) {
    //         const pageNameNow = $.trim($(classPage).text());
    //         const optionVal = $('#hidden-doc option[data-real-name-js="' + pageNameNow + '"]').val();
    //         $('#hidden-doc').val(optionVal);
    //         $('.filter-form').submit();
    //     }
    // }

    $(document).on('submit', '.filter-form', function (event) {
        event.preventDefault();

        let checkedValue = $(this).find("input[type='radio']:checked").val();
        let parentClass = '';
        checkedValue === '1543' ? parentClass = '.project-docs' : parentClass = '.simple-docs';

        let activePageHref = '';
        if ($('.tabs-ajax-js.active').length > 0) {
            activePageHref = $('.tabs-ajax-js.active').attr('href');
        } else if ($('.inside-tabs-ajax-js.active').length > 0) {
            activePageHref = $('.inside-tabs-ajax-js.active').attr('href');
        }

        let $url = '';
        if (typeof activePageHref !== 'undefined') {
            $url = activePageHref + '?doc-filter[filter-time]=all';
            $url = activePageHref + '';
        } else {
            $url = window.location.href.split('?')[0];
        }
        
        console.log($url);

        $.ajax({
            type: "GET",
            url: $url,
            data: $(this).serialize(),
            dataType: 'html',
            success: function (data) {
                $('div.wrapper-header').empty();
                $('div.docs-list-js').empty();
                let docsTitle = $(data).find(parentClass + ' .docs-list__header');
                let docsList = $(data).find(parentClass + ' .docs-list-js');

                $(parentClass + ' .wrapper-header').html(docsTitle);
                $(parentClass + ' .docs-list__body').html(docsList);
            }
        });
    });

    $(document).on('click', '.pagination_numbers li', function (event) {
        event.preventDefault();

        let checkedValue = $('.filter-form').find("input[type='radio']:checked").val();
        let parentClass = '';
        checkedValue === '1543' ? parentClass = '.project-docs' : parentClass = '.simple-docs';

        $.ajax({
            type: "POST",
            url: $(this).find('a').attr('href'),
            data: $('.filter-form').serialize(),
            dataType: 'html',
            success: function (data) {
                $('.docs-list-js').empty();
                let docsList = $(data).find(parentClass + ' .docs-list-js');
                $(parentClass + ' .docs-list__body').html(docsList);
            }
        });
    });

    $(document).on('click', '.documents-page .docs-list__result-filter a', function (event) {
        event.preventDefault();

        let checkedValue = $('.filter-form').find("input[type='radio']:checked").val();
        let parentClass = '';
        checkedValue === '1543' ? parentClass = '.project-docs' : parentClass = '.simple-docs';

        $.ajax({
            type: "POST",
            url: $(this).attr('href'),
            data: $('.filter-form').serialize(),
            dataType: 'html',
            success: function (data) {
                $('.docs-list-js').empty();
                let docsList = $(data).find(parentClass + ' .docs-list-js');
                $(parentClass + ' .docs-list__body').html(docsList);
            }
        });
    });
})(jQuery);
