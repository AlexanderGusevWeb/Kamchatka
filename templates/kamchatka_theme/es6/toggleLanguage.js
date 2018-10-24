/**
 * Created by GermanWeb on 12.10.2018.
 */
(function ($) {
    $(function () {
        // Переключение языка сайта START
        $('.select').each(function () {
            var $this = $(this),
                selectOption = $this.find('option'),
                selectOptionLength = selectOption.length,
                selectedOption = selectOption.filter(':selected'),
                dur = 500;

            $this.hide();

            $this.wrap('<div class="select"></div>');

            $('<div>', {
                class: 'select__gap'
                // text: 'Рус'
            }).insertAfter($this);

            var selectGap = $this.next('.select__gap'),
                caret = selectGap.find('.caret');

            $('<ul>', {
                class: 'select__list'
            }).insertAfter(selectGap);


            var selectList = selectGap.next('.select__list');

            for (var i = 0; i < selectOptionLength; i++) {
                $('<li>', {
                    class: 'select__item',
                    html: $('<span>', {
                        text: selectOption.eq(i).text()
                    })
                })
                    .attr('data-value', selectOption.eq(i).val())
                    .appendTo(selectList);
            }

            var selectItem = selectList.find('li');

            var selectVal = $('#selectId').val();

            $('.flag').addClass('d_none');
            $('.flag__' + selectVal).removeClass('d_none');

            selectList.slideUp(0);
            selectGap.on('click', function () {
                if (!$(this).hasClass('on')) {
                    $(this).addClass('on');
                    // selectList.slideDown(dur);

                    selectItem.on('click', function () {
                        var chooseItem = $(this).data('value');

                        $('select').val(chooseItem).attr('selected', 'selected');
                        // selectGap.text($(this).find('span').text());

                        // selectList.slideUp(dur);
                        selectGap.removeClass('on');

                        $('.flag').removeClass('flag_shadow').addClass('d_none');
                        $('.flag__' + selectVal).removeClass('d_none');

                        $('.select__list').animate({
                            opacity: 0,
                            height: 41
                        }, 50);

                        setTimeout(function () {
                            $('.select__list').css('display', 'none');
                        }, 300);

                        var acrive_flag = $('#selectId').val();
                        window.location.href = "/" + acrive_flag + "/";
                    });

                    $('.flag').addClass('flag_shadow');
                    $('.select__list').css('display', 'flex').animate({
                        opacity: 1,
                        height: height
                    }, 0);

                } else {
                    $(this).removeClass('on');
                    // selectList.slideUp(dur);

                    $('.flag').removeClass('flag_shadow');

                    $('.select__list').animate({
                        opacity: 0,
                        height: 41
                    }, 50);

                    setTimeout(function () {
                        $('.select__list').css('display', 'none')
                    }, 300);
                }

                // var acrive_flag = $('#selectId').val();
                // var sum_flag = $('#selectId option');

                // $('.select__item span').removeClass('active-flag');

                // for (var i = 0; i < sum_flag.length; i++) {
                //     if (sum_flag[i].value == acrive_flag) {
                //         $('.select__item[data-value="' + acrive_flag + '"] span').addClass('active-flag');
                //     }
                // }

                $('.select__item span').removeClass('active-flag');

                var language = $('#selectId').attr('lang_page');

                $('.select__item[data-value="' + language + '"] span').addClass('active-flag');
            });

            $('.flag').on('click', function () {
                selectGap.click();
            });
        });

        $('.flag').removeClass('flag_shadow').addClass('d_none');

        $('.flag__' + $('#selectId').attr('lang_page')).removeClass('d_none');

        var sum_flag = $('#selectId option').length;
        var height = 20 * sum_flag + 55 + "px";

    });
})(jQuery);