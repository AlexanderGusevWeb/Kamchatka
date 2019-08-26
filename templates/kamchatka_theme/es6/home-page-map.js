/**
 * Created by GermanWeb on 12.10.2018.
 */
(function ($) {
    $(function () {
        // Главня страница переключение городов карты
        $('.map-item').on('click', function () {
            $('.map-item').removeClass('active');
            $(this).addClass('active');

            let itemClass = $(this).attr('class');
            itemClass = itemClass.replace('map-item', '');
            itemClass = itemClass.replace('active', '');
            itemClass = itemClass.replace(/\s/g, '');
            itemClass = "." + itemClass;

            $('.city').removeClass('active');
            $('.tab-one__right').find(itemClass).addClass('active');
        });
    });
})(jQuery);
