(function ($) {
    $(function () {

    });

    let numberImage = 0;

    $(document).on('click', '.photo-video-page .pagination_numbers a', function (event) {
        event.preventDefault();

        let thisUrl = $(this).attr('href');

        $.ajax({
            type: "GET",
            url: thisUrl,
            dataType: 'html',
            success: function (data) {
                let content = $(data).find('.gallery');
                $('.one-page__body').empty().html(content);
            }
        });
    });

    $(document).on('click', '.image-download, .image-full-screen', function () {
        const urlImage = $('.lb-image').attr('src');
        $(this).attr('href', urlImage);
    });

    $(document).on('click', '.triangle', function () {
        $('#lightboxOverlay, #lightbox').addClass('hide');
        $('.gallery__auto-play').show('ease');

        setTimeout(() => {
            $('#lightboxOverlay, #lightbox').hide('ease');
            $('.gallery__auto-play').addClass('active');
        }, 300);

        $('body').addClass('no-overflow-y');
        $('header').hide('ease');
        $('footer').hide('ease');

        const slideNumbers = $('.lb-number').text();
        const slideNow = +(slideNumbers.replace(/\b\s\/\s\d/, ''));
        const slideAll = 9;
        
        numberImage = $('.pagination_numbers .active a').text();
        let currentPositionImage = numberImage * slideAll - (slideAll - slideNow);

        $('.slick-slider').slick('slickGoTo', currentPositionImage - 1);
    });

    $(document).on('click', '.gallery__slider-close', function () {
        $('#lightboxOverlay, #lightbox').removeClass('hide');

        $('.gallery__auto-play').removeClass('active');

        setTimeout(() => {
            $('.gallery__auto-play').slideUp('ease');
            $('body').removeClass('no-overflow-y');
            $('header').show('ease');
            $('footer').show('ease');
        }, 600);
    });

})(jQuery);