/**
 * Created by GermanWeb on 12.10.2018.
 */
(function ($) {
    $(function () {
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

        var widthCharts = 1024;

        // Google Charts
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
                width: widthCharts,
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
                        color: '#000',
                        fontName: 'Oswald',
                        fontSize: 21
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

        function windowSize() {

            if ($(window).width() > '900' && $(window).width() <= '1200') {
                widthCharts = 768;
            } else if ($(window).width() > '700' && $(window).width() <= '900') {
                widthCharts = 550;
            } else {

            }

            // Google Charts
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
                    width: '100%',
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
                            color: '#000',
                            fontName: 'Oswald',
                            fontSize: 21
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
        }

        $(window).on('load resize', windowSize);
    });
})(jQuery);