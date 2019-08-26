(function ($) {
    $(function () {
        // Input radio logics
        $('.filter-form__radio-button-doc[for="doc"]').on('change', function () {
            $('.filter-form__type-project-doc').hide();
            $('.filter-form__type-doc').show();
            // $('.remove-text-js').text('Дата подписания')
        });

        $('.filter-form__radio-button-doc[for="draft-doc"]').on('change', function () {
            $('.filter-form__type-doc').hide();
            $('.filter-form__type-project-doc').show();
            // $('.remove-text-js').text('Дата размещения')
        });

        // Form label style
        const $form = $('[class^="filter-form"]');

        $form
            .find('input')
            .change(function () {
                inputChange(this);
            });

        $form
            .find('select')
            .change(function () {
                inputChange(this);
            });

        // Form label style
        labelCheck('#number-doc');
        labelCheck('#name-doc');
        labelCheck('#type-doc');
        labelCheck('#type-project-doc');
        labelCheck('#date-doc');
        labelCheck('#department-doc');
        labelCheck('#collegiate-doc');
        labelCheck('#hidden-doc');

        $('input[type="reset"]').on('click', function () {
            $(this)
                .parents('.filter-form')
                .find('input:not(#doc):not(#draft-doc):not([type="reset"]):not([type="submit"])')
                .each(function () {
                    $(this).val('');
                    inputChange(this);
                });

            $(this)
                .parents('.filter-form')
                .find('select option')
                .each(function () {
                    $(this).val() === '' ? $(this).attr('selected') : $(this).removeAttr('selected');

                    let parentSelect = $(this).parent();
                    inputChange(parentSelect);
                });

            $('.filter-form__radio-button-doc').removeClass('active');
            $('input[type="radio"]').removeAttr('checked')
        });

        $('input[type="radio"]')
            .each(function () {
                if ($(this).prop('checked')) {
                    $(this)
                        .parents('label')
                        .addClass('active');
                }
            })
            .on('click', function () {
                $('.filter-form__radio-button-doc').removeClass('active');

                $(this)
                    .parents('label')
                    .addClass('active');
            });

        // Button filter result
        $('.docs-list__result-filter .wrapper').on('click', function () {
            $('.wrapper_hide').slideToggle('ease');
            $('.flaticon-angle-arrow-down').toggleClass('active');
        });

        $('.time-step').on('click', function () {
            let $text = $(this).text();

            $('.time-step.active').text($text);
            $('.wrapper_hide').slideToggle('ease');
            $('.time-step').removeClass('hide');
            $(this).addClass('hide');
        });

        uiFocus('type-doc');
        uiFocus('type-project-doc');
        uiFocus('department-doc');
        uiFocus('collegiate-doc');
        uiFocus('hidden-doc');

        $('#date-doc, #date-doc-to')
            .datepicker({
                dateFormat: 'yy.mm.dd',
                prevText: '',
                nextText: '',
                onSelect: function(dateText, inst) {
                    $("input[name='something']").val(dateText);
                },
            });

        $('.filter-form__date-doc .date-doc').on('click', function () {
            inputDate(this, '#date-doc')
        });

        $('.filter-form__date-doc .date-doc-to').on('click', function () {
            inputDate(this, '#date-doc-to')
        });
    });

    // Function on click date. hide/show label
    function inputDate(value, nameId) {
        if ($('#ui-datepicker-div').is(":visible")) {
            $(value).find('.remove-text-js').css({
                'font-size': '0',
            });
        }

        if($(nameId).datepicker().val() == '') {
            let dateNow = $.datepicker.formatDate('yy.mm.dd', new Date());
            $(nameId).datepicker().val(dateNow)
        }
    }

    // Function form label style
    function inputChange(value) {
        if ($(value).val() === '') {
            $(value)
                .parent()
                .find('label')
                .css({
                    'font-size': '17px',
                });

        } else {
            $(value)
                .parent()
                .find('label')
                .css({
                    'font-size': '0',
                });
        }
    }

    // Function form label style
    function labelCheck(value) {
        if ($(value).val() !== '') {
            $(value)
                .parent()
                .find('label')
                .css({
                    'font-size': '0',
                });
        }
    }

    // Function jQuery Ui
    function uiFocus(item) {
        $('#' + item)
            .selectmenu({
                appendTo: '.filter-form__' + item,
                open: function (event, ui) {
                    $(this)
                        .parent()
                        .find('label')
                        .addClass('active');

                    $('.ui-menu').show('blind', 'slow');
                },

                close: function () {
                    $(this).parent()
                        .find('label')
                        .removeClass('active');

                    $('.ui-menu').css({
                        'display': 'none'
                    })
                },

                change: function (event, ui) {
                    let uiValue = ui.item.value;

                    if (uiValue !== '') {
                        $(this)
                            .parent()
                            .find('label')
                            .css({
                                'font-size': '0',
                            });
                    }
                },
            });
    }
})(jQuery);
