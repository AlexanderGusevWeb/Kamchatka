(function ($) {
    $(function () {
    });

    $(document).on('submit', '.post_vote', function (event) {
        event.preventDefault();

        let selected = $('input[name=answer]:checked', $(this)).val();
        
        $.post('/' + window.pageData.lang + '/vote/post/' + selected);
    });

    $(document).on('click', '.voting-js-submit', function () {
        const $oneAnswered = $('.post_vote');
        let questionsAnswered = 0;

        $oneAnswered.each(function () {
            const $input = $(this).find('input');
            const $incorrectAnswer = $(this).find('.incorrect-answer');

            let i = 0;
            
            $input.each(function () {
                if ($(this).prop('checked')) i++;
            });

            if (i === 0) {
                $incorrectAnswer.show('ease');
            } else {
                $incorrectAnswer.hide('ease');
                questionsAnswered++;
            }
        });

        if ($oneAnswered.length === questionsAnswered) {
            $oneAnswered.each(function () {
                $(this).submit();
            });

            $('.voting-modal-window').slideDown('ease');
            setTimeout(function () {
                $('.voting-modal-window').slideUp('ease');
            }, 1500);

            $('.voting').hide('ease');
            $('.voting-successful').show('ease');
            $(this).hide('ease');
        }
    });

    $(document).on('click', '.folder-js', function (event) {
        event.preventDefault();

        let itemLink = $(this).attr('href');

        $('.back-button').show('ease');

        $.post(itemLink, function (data) {
            let receivePoll = $(data).find('.one-page__wrapper');

            $('.one-page').empty().html(receivePoll);

            $('.voting').addClass('voting_show');
            $('a.button-back').attr('href', '/page-polls/rezultaty-oprosa/');
            $('.voting-js-submit').hide();
        });
    });

    $(document).on('change', '.post_vote input', function () {
        $(this).parents('.post_vote').find('.item_button').removeClass('active');
        let checked = $(this).prop('checked');

        if (checked) {
            $(this).parent().find('.item_button').addClass('active');
        }
    });

    $(document).on('click', '.anti-corruption-page input.time-step', function (event) {
        event.preventDefault();

        let $text = $(this).val();

        $('.time-step.active').text($text);
        $('.wrapper_hide').slideUp('ease');
        $('.time-step').removeClass('hide');
        $('.flaticon-angle-arrow-down').toggleClass('active');
        $(this).addClass('hide');

        let currentLocation = window.location + '?year=' + $text;

        console.log(currentLocation);

        $.ajax({
            type: "GET",
            url: currentLocation,
            dataType: 'html',
            success: function (data) {
                let content = $(data).find('.folder-poll');
                $('.one-page__body').empty().html(content);
            }
        });
    });

    $(document).on('click', '.anti-corruption-page .pagination_numbers a', function (event) {
        event.preventDefault();

        let thisUrl = $(this).attr('href');

        $.ajax({
            type: "GET",
            url: thisUrl,
            dataType: 'html',
            success: function (data) {
                let content = $(data).find('.folder-poll');
                $('.one-page__body').empty().html(content);
            }
        });
    });
})(jQuery);