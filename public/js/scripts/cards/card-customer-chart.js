/*=========================================================================================
    File Name: card-statistics.js
    Description: Card-statistics page content with Apexchart Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(window).on("load", function(){

  var $primary = '#0087FF';
  var $danger = '#EA5455';
  var $warning = '#FF9F43';
  var $info = '#00cfe8';
  var $success = '#00db89';
  var $primary_light = '#9c8cfc';
  var $warning_light = '#FFC085';
  var $danger_light = '#f29292';
  var $info_light = '#1edec5';
  var $strok_color = '#b9c3cd';
  var $label_color = '#e7eef7';
  var $purple = '#df87f2';
  var $white = '#fff';


  

    // Customer Chart
    // -----------------------------

    var customerChartoptions = {
        chart: {
            type: 'pie',
            height: 325,
            dropShadow: {
                enabled: false,
                blur: 5,
                left: 1,
                top: 1,
                opacity: 0.2
            },
            toolbar: {
                show: false
            }
        },
        labels: ['Ofertas de Negociación', 'Ofertas Aceptadas', 'Ofertas Perdidas'],
        series: [29, 12, 8],
        dataLabels: {
            enabled: false
        },
        legend: { show: false },
        stroke: {
            width: 5
        },
        colors: [$primary, $warning, $danger],
        fill: {
            type: 'gradient',
            gradient: {
                gradientToColors: [$primary_light, $warning_light, $danger_light]
            }
        }
    }

    var customerChart = new ApexCharts(
        document.querySelector("#customer-chart"),
        customerChartoptions
    );

    customerChart.render();

   

});
