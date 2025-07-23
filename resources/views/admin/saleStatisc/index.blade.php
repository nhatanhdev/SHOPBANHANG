@extends('layouts.admin')
@section('title')
<title>Thông Kê</title>
@endsection
@section('css')
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto);

    body {
    font-family: Roboto, sans-serif;
    }

    #chart {
    max-width: 100%;
    margin: 35px auto;
    }

</style>
@endsection
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30 chart_ajax">
       @include('admin.saleStatisc.chartjs')
    </div>
</div>
@endsection
@section('js')


<script>
    var colors = {
        danger: '#FF4560',   // Define your danger color
        info: '#008FFB',     // Define your info color
        bodyColor: '#333',   // Define your body text color
        cardBg: '#FFF',      // Define your card background color
        gridBorder: '#ddd'   // Define your grid border color
    };
    function number_format(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    if ($('#mixedchart').length) {
    var options = {
      chart: {
        height: 300,
        type: 'line',
        stacked: false,
        parentHeightOffset: 0,
        foreColor: colors.bodyColor,
        background: colors.cardBg,
        toolbar: {
          show: false
        },
      },
      theme: {
        mode: 'dark'
      },
      tooltip: {
        theme: 'dark'
      },
      colors: [colors.info, colors.danger],
      grid: {
        borderColor: colors.gridBorder,
        padding: {
          bottom: -4
        },
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      stroke: {
        width: [0, 3],
        curve: 'smooth'
      },
      plotOptions: {
        bar: {
          columnWidth: '50%'
        }
      },
      series: [{
        name: 'Danh Thu',
        type: 'column',
        data: @json($data)
      }, {
        name: 'Lợi Nhuận',
        type: 'area',
        data:  @json($profit)
    }],
      legend: {
        show: true,
        position: "top",
        horizontalAlign: 'center',
        fontFamily: 'Arial, sans-serif',
        itemMargin: {
          horizontal: 8,
          vertical: 0
        },
      },
      fill: {
        opacity: [.75,0.25],
      },
      labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11' ,'12'],
      markers: {
        size: 0
      },
      xaxis: {
        type: 'category', // Use 'category' type for discrete data
        categories: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
        axisBorder: {
          color: colors.gridBorder,
        },
        axisTicks: {
          color: colors.gridBorder,
        },
      },
      yaxis: {
        opposite: false,
        title: {
          text: "Points",
          offsetX: -45,
        },
        labels: {
            align: 'left',
            offsetX: -10,
            formatter: function(value) {
                // Use your number formatting logic here
                return number_format(value);
            }
        }
        },

      tooltip: {
        shared: true,
        intersect: false,
        y: [{
          formatter: function (y) {
            if(typeof y !== "undefined") {
              return  number_format(y.toFixed(0)) + " đ";
            }
            return y;
          }
        }, {
          formatter: function (y) {
            if(typeof y !== "undefined") {
              return  number_format(y.toFixed(0)) + " đ";
            }
            return y;
          }
        }]
      }
    }
    var chart = new ApexCharts(
      document.querySelector("#mixedchart"),
      options
    );
    chart.render();
  }
</script>
<script>
    $('.year_seleted').on('change',function(){
        var year = $(this).val()
        console.log(year)
        $.ajax({
            url: '{{ route("admin.saleStatistic.show")}}',
            type: 'POST',
            data : {
                year : year
            },
            beforeSend: function() {
                $('.loading-js').show();
            },
            success: function(data) {
                $('.chart_ajax').html(data.data_statstic)

            },
            error: function(error) {
                console.log(error)
            },
            complete: function(){
                $('.loading-js').hide();
            },
        })
    })
</script>

<script>
    (function ($) {
    "use strict";
    const ctx = document.getElementById("doughutChart").getContext("2d");
    ctx.height = 220;
    new Chart(ctx, {
        type: "doughnut",
        data: {
            defaultFontFamily: "Poppins",
            labels: [
                'Lợi Nhuận',
                'Danh Thu',
            ],
            datasets: [
                {
                    data: [@json($total_profix), @json($total)],
                    backgroundColor: [
                        "rgba(237, 25, 25, 0.8)",
                        "rgba(39, 78, 245, 0.8)",
                    ],

                },
            ],
        },
        options: { responsive: true },
    });
})(jQuery);
</script>

<script>
    $('.tong').text('')
    $('.tong').text('Tổng')
    $('.row_tong').css('background-color', 'aquamarine');
</script>
@endsection
