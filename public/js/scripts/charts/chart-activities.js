/*=========================================================================================
    File Name: chart-activities.js
    Description: Chart Activities
    ----------------------------------------------------------------------------------------
    Item Name: Ventonic
    Author: Ing Oscar Lobo
==========================================================================================*/

$(window).on("load", function () {

    var $primary = '#0087FF';
    var $success = '#28C76F';
    var $danger = '#EA5455';
    var $warning = '#FF9F43';
    var $yellow = '#f0db4e';
    var $red = '#fe1605';

    var $label_color = '#1E1E1E';
    var grid_line_color = '#dae1e7';
    var scatter_grid_color = '#f3f3f3';
    var $scatter_point_light = '#D1D4DB';
    var $scatter_point_dark = '#5175E0';
    var $white = '#fff';
    var $black = '#000';

    var themeColors = [$primary, $success, $danger, $warning, $yellow, $red, $label_color];






    // Bar Chart
    // ------------------------------------------

    //Get the context of the Chart canvas element we want to select
    var barChartctx = $("#bar-chart");

    // Chart Options
    var barchartOptions = {
        // Elements options apply to all of the options unless overridden in a dataset
        // In this case, we are setting the border of each bar to be 2px wide
        elements: {
            rectangle: {
                borderWidth: 2,
                borderSkipped: 'left'
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        responsiveAnimationDuration: 500,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: grid_line_color,
                },
                scaleLabel: {
                    display: true,
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    color: grid_line_color,
                },
                scaleLabel: {
                    display: true,
                },
                ticks: {
                    stepSize: 1000
                },
            }],
        },
        title: {
            display: true,
            text: ''
        },

    };

    // Chart Data
    var barchartData = {
        labels: pro_label,
        datasets: [{
            label: "Cantidad",
            data: pro_qty,
            backgroundColor: themeColors,
            borderColor: "transparent"
        }]
    };

    var barChartconfig = {
        type: 'bar',

        // Chart Options
        options: barchartOptions,

        data: barchartData
    };

    // Create the chart
    var barChart = new Chart(barChartctx, barChartconfig);

});
