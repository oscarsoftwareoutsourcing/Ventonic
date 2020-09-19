/*=========================================================================================
    File Name: chart-sales.js
    Description: Chart for Sales
    ----------------------------------------------------------------------------------------
    Item Name: Ventonic
    Author: Ing Oscar Lobo
==========================================================================================*/

$(document).ready(function () {
    //console.log(user_id);
    //console.log(stat_pie);


    var $yellow = '#f0db4e',
        $red = '#fe1605',
        $primary = "#0087FF",
        $success = "#28C76F",
        $danger = "#EA5455",
        $warning = "#FF9F43",
        $info = "#00cfe8",
        $label_color_light = "#dae1e7";

    var themeColors = [$success, $yellow, $red, $warning, $info];
    var themeColors2 = [$primary, $success, $danger, $warning, $warning, $info];
    // RTL Support
    var yaxis_opposite = false;
    if ($("html").data("textdirection") == "rtl") {
        yaxis_opposite = true;
    }

    // Bar Chart
    // ----------------------------------
    var barChartOptions = {
        chart: {
            height: 350,
            type: "bar"
        },
        colors: themeColors2,
        plotOptions: {
            bar: {
                horizontal: true
            }
        },
        dataLabels: {
            enabled: false
        },
        series: [{
            data: pro_qty
        }],
        xaxis: {
            categories: pro_label,
            tickAmount: 5
        },
        yaxis: {
            opposite: yaxis_opposite
        }
    };
    var barChart = new ApexCharts(
        document.querySelector("#bar-chart"),
        barChartOptions
    );
    barChart.render();

    // Pie Chart
    // -----------------------------
    var pieChartOptions = {
        chart: {
            type: "pie",
            height: 350
        },
        colors: themeColors,
        labels: pie_label, //['Exitosa', 'Perdida', 'En Proceso'],
        series: pie_qty,
        legend: {
            itemMargin: {
                horizontal: 2
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 350
                },
                legend: {
                    position: "bottom"
                }
            }
        }]
    };
    var pieChart = new ApexCharts(
        document.querySelector("#pie-chart"),
        pieChartOptions
    );
    pieChart.render();

    // Heat Map Chart
    // -----------------------------
    function generateData(count, yrange) {
        var i = 0,
            series = [];
        while (i < count) {
            var x = "w" + (i + 1).toString(),
                y =
                Math.floor(Math.random() * (yrange.max - yrange.min + 1)) +
                yrange.min;

            series.push({
                x: x,
                y: y
            });
            i++;
        }
        return series;
    }
});
