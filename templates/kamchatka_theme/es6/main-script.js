(function ($) {
    $(function () {
        //Анимация мобильного меню START

        $('.mobile-menu__links').animate({
            height: "hide"
        }, 0);

        $('.mobile-menu__icon').on('click', function () {
            $(this).closest('.mobile-menu').toggleClass('menu_state_open');
            $('.mobile-menu__links').animate({
                height: "toggle"
            }, 500);
        });
        //Анимация мобильного меню END

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
        // Переключение языка сайта END

        // Анимация поиск START
        // Open
        $(".buttonSearch .btn1 .flaticon-magnifying-glass").click(function () {
            if ($('.buttonSearch__mobile-bottom.active').length != true) {
                $(".buttonSearch").animate({
                    height: 70
                }, 300);

                $(".buttonSearch input").animate({
                    height: 44,
                    opacity: 1
                }, 100).css('border', '2px solid #fff');


                $(".buttonSearch__main button").animate({
                    top: 0
                }, 800);


                $(".buttonSearch__mobile-top button").animate({
                    top: 65
                }, 800);

                $(".buttonSearch__mobile-top button > .flaticon-magnifying-glass").css('display', 'none');


                $(".buttonSearch__mobile-bottom button").animate({
                    top: 0,
                    opacity: 1
                }, 800).css('display', 'block');

                $(".buttonSearch button.btn1 .flaticon-magnifying-glass").css('display', 'none');

                $(".buttonSearch button.btn2").css('display', 'block');

                setTimeout(function () {
                    $('.buttonSearch .flaticon-close').animate({
                        opacity: 1
                    }, 1).css('display', 'block');
                }, 700);

                $('.buttonSearch__mobile-bottom').addClass('active').css('display', 'block');

                $('.mobile-menu').removeClass('menu_state_open');
                $('.mobile-menu__links').animate({
                    height: "hide"
                }, 500);
            }
        });

        // Close
        $(".flaticon-close, .mobile-menu__icon").click(function () {
            if ($('.buttonSearch__mobile-bottom.active').length == true) {
                $(".buttonSearch input").animate({
                    height: 0,
                    opacity: 0
                }, 10).css('border', 'none').val("");

                setTimeout(function () {
                    $(".buttonSearch").animate({
                        height: 0
                    }, 300);
                }, 200);

                $(".buttonSearch__main button").animate({
                    top: -70
                }, 800);

                $(".buttonSearch__mobile-top button").animate({
                    top: -35
                }, 800);

                setTimeout(function () {
                    $(".buttonSearch__mobile-top button > .flaticon-magnifying-glass").css('display', 'block');
                }, 350);

                $(".buttonSearch__mobile-bottom button").animate({
                    opacity: 1
                }, 800);

                // $(".buttonSearch button.btn1 .flaticon-magnifying-glass").css('display', 'block');
                //
                // $(".buttonSearch button.btn2").css('display', 'none');

                $('.buttonSearch .flaticon-close').animate({
                    opacity: 0
                }, 100).css('display', 'none');

                $('.buttonSearch__mobile-bottom').removeClass('active').css('display', 'none');
            }
        });
        // Анимация поиск END

        // Анимация табы(header) START
        $('.tab-link').on('click', function () {
            $('.tab-link__background').animate({
                top: 150
            }, 300);

            $(this).find('.tab-link__background').animate({
                top: 0
            }, 200);
        });

        $('.tab-link-one').on('click', function () {
            $('.tab').animate({
                opacity: 0
            }, 400);

            setTimeout(function () {
                $('.tab').addClass('d_none');

                $('.tab-one').removeClass('d_none').animate({
                    opacity: 1
                }, 300);
            }, 300);
        });

        $('.tab-link-two').on('click', function () {
            $('.tab').animate({
                opacity: 0
            }, 400);

            setTimeout(function () {
                $('.tab').addClass('d_none');

                $('.tab-two').removeClass('d_none').animate({
                    opacity: 1
                }, 300);
            }, 300);


        });

        $('.tab-link-three').on('click', function () {
            $('.tab').animate({
                opacity: 0
            }, 400);

            setTimeout(function () {
                $('.tab').addClass('d_none');

                $('.tab-three').removeClass('d_none').animate({
                    opacity: 1
                }, 300);
            }, 300);
        });
        // Анимация табы(header) END

        // Переменные для Google Charts
        var sobolevo = $('.tab-three__regions').attr('data-sobolevo');
        var sobolevo_population = $('.tab-three__regions').attr('data-sobolevo_population').replace(' ', '');
        sobolevo_population = parseInt(sobolevo_population, 10);

        var ustevo = $('.tab-three__regions').attr('data-ustevo');
        var ustevo_population = $('.tab-three__regions').attr('data-ustevo_population').replace(' ', '');
        ustevo_population = parseInt(ustevo_population, 10);

        var krutogorovo = $('.tab-three__regions').attr('data-krutogorovo');
        var krutogorovo_population = $('.tab-three__regions').attr('data-krutogorovo_population').replace(' ', '');
        krutogorovo_population = parseInt(krutogorovo_population, 10);

        var ichinsky = $('.tab-three__regions').attr('data-ichinsky');
        var ichinsky_population = $('.tab-three__regions').attr('data-ichinsky_population').replace(' ', '');
        ichinsky_population = parseInt(ichinsky_population, 10);

        var sum_population = sobolevo_population + ustevo_population + krutogorovo_population + ichinsky_population;
        $('.all_population').text(sum_population + ' чел.');

        // Google Charts START
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Area', 'Population'],
                ['Численность населения ' + sobolevo, sobolevo_population],
                ['Численность населения ' + ustevo, ustevo_population],
                ['Численность населения ' + krutogorovo, krutogorovo_population],
                ['Численность населения ' + ichinsky, ichinsky_population]
            ]);

            var options = {
                width: 1080,
                height: 450,
                title: '',
                pieSliceText: 'none',
                pieHole: 0.7,
                slices: {
                    0: {color: '#006abb'},
                    1: {color: '#007b35'},
                    2: {color: '#00a3e4'},
                    3: {color: '#00bf49'}
                },
                chartArea: {
                    top: '10%',
                    bottom: '10%',
                    left: '0',
                    width: '100%',
                    height: '100%'
                },
                legend: {
                    textStyle: {
                        color: '#006abb',
                        fontName: 'Oswald',
                        fontSize: 19
                    },
                    position: 'labeled'
                },
                tooltip: {
                    trigger: 'none'
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
        // Google Charts END

        // Анимация слайдер новости/события START
        $('.news__link').on('click', function () {
            if ($(this).hasClass('news__passive')) {
                $('.news__link').toggleClass('news__active').toggleClass('news__passive');
            }

            if ($('.news__link-one.news__active').length == true) {

                $('.block-news__two').animate({
                    opacity: 0
                }, 400);

                setTimeout(function () {

                    $('.block-news__one').removeClass('d_none').animate({
                        opacity: 1
                    }, 300);

                    $('.block-news__two').addClass('d_none');
                }, 300);

            } else if ($('.news__link-two.news__active').length == true) {

                $('.block-news__one').animate({
                    opacity: 0
                }, 400);

                setTimeout(function () {
                    $('.block-news__two').removeClass('d_none').animate({
                        opacity: 1
                    }, 300);

                    $('.block-news__one').addClass('d_none');
                }, 300);
            }
        });

        $('.news__link-one').on('click', function () {
            $('.news__link-two a').css({
                'opacity': '0',
                'display': 'none'
            });
            $('.news__link-two .news__separate').css({
                'opacity': '0',
                'display': 'none'
            });

            setTimeout(function () {
                $('.news__link-one a').show().animate({
                    opacity: 1
                }, 400);

                $('.news__link-one .news__separate').show().animate({
                    opacity: 1
                }, 400);
            }, 100);
        });

        $('.news__link-two').on('click', function () {
            $('.news__link-one a').css({
                'opacity': '0',
                'display': 'none'
            });
            $('.news__link-one .news__separate').css({
                'opacity': '0',
                'display': 'none'
            });

            setTimeout(function () {
                $('.news__link-two a').show().animate({
                    opacity: 1
                }, 400);

                $('.news__link-two .news__separate').show().animate({
                    opacity: 1
                }, 400);
            }, 100);
        });
        // Анимация слайдер новости/события END

        // Slick for news START
        $('.block-news').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<span class="flaticon-return"><sapn class="flaticon-bg"></sapn></span>',
            nextArrow: '<span class="flaticon-next"><sapn class="flaticon-bg"></sapn></span>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 700,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        // Slick for news END

        // Slick for links START
        $('.links__body').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: '<span class="flaticon-return"><sapn class="flaticon-bg"></sapn></span>',
            nextArrow: '<span class="flaticon-next"><sapn class="flaticon-bg"></sapn></span>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 700,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        // Slick for links END

        // Script обрезки текста START
        $('.one-news__text').ellipsis({'setTitle':'onEllipsis'} );
        // Script обрезки текста END

        // Анимация табы "Направления деятельности" START
        $('.tab-body:first-child').removeClass('d_none').css('opacity', '1');
        $('.activities__tab-link:first-child').addClass('action');

        $('.activities__tab-link').on('click', function () {

            $('.activities__tab-link').removeClass('action');

            var thisTab = $(this).attr('data');

            $('.tab-body').animate({
                opacity: 0
            }, 200);

            setTimeout(function () {
                $('.tab-body').addClass('d_none');
            }, 300);

            setTimeout(function () {
                $('.activities__tab-body[data='+ thisTab +']').removeClass('d_none').animate({
                    opacity: 1
                }, 200);
            }, 500);

            $('.activities__tab-link[data='+ thisTab +']').addClass('action');

        });
        // Анимация табы "Направления деятельности" END

        //Анимация WOW.js START
        new WOW().init();
        //Анимация WOW.js END
    });

    $(window).load(function () {

        $('.news__link-one').trigger('click');

        setTimeout(function () {
            $('#preloader').fadeOut('slow');

            $('.news').addClass('show');
        }, 300);
    });
})(jQuery);
