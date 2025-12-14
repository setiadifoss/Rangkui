$(document).ready(function () {
  $.ajax({
    url: `${baseUrl}report/stats-collection/stats`,
    method: 'get',
    dataType: 'json',
    success: function (data) {
      dataSeries = data.series

      Highcharts.chart('pie-chart', {
        chart: {
          type: 'pie'
        },
        title: {
          text: 'Statistic Collection'
        },
        tooltip: {
          valueSuffix: '%'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: false
            },
            showInLegend: true
          },
          series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [
              {
                enabled: true,
                distance: 20
              },
              {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                  fontSize: '1.2em',
                  textOutline: 'none',
                  opacity: 0.7
                },
                filter: {
                  operator: '>',
                  property: 'percentage',
                  value: 10
                }
              }
            ]
          }
        },
        series: [
          {
            name: 'Percentage',
            colorByPoint: true,
            data: dataSeries
          }
        ]
      })
    },
    error: function (xhr, status, error) {
      console.log('Error: ' + error)
    }
  })
})
