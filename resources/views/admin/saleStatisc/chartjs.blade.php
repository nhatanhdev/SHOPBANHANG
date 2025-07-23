<div class="row justify-content-center ">
    <div class="col-lg-12">
        <div class="single_element">
            <div class="quick_activity">
                <div class="row">
                    <div class="col-12">
                        <div class="quick_activity_wrap">
                            <div class="single_quick_activity">
                                <h4>Tổng Danh Thu </h4>
                                <h3><span class="counter">{{number_format($total)}}</span> đ</h3>
                            </div>
                            <div class="single_quick_activity">
                                <h4>Tổng Chi Phí</h4>
                                <h3> <span class="counter">-{{number_format($total-$total_profix)}}</span> đ</h3>
                            </div>
                            <div class="single_quick_activity">
                                <h4>Tổng Lợi Nhuận</h4>
                                <h3> <span class="counter">{{number_format($total_profix)}}</span> đ</h3>
                            </div>
                            <div class="single_quick_activity">
                                <h4>Đơn Hàng Đã Đặt</h4>
                                <h3> <span class="counter">{{number_format($total_order)}}</span></h3>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-12">
        <div class="white_box box_border mb_30 min_430">
            <div class="box_header  box_header_block ">
                <div class="main-title">
                    <h3 class="mb-0">Danh Thu Cửa Hàng</h3>
                    <span>Trong 12 Tháng Năm {{$year}}</span>
                </div>
                <div class="box_select d-flex">
                    {{-- <select class="nice_Select2 mr_5">
                        <option value="1">Monthly</option>
                        <option value="1"></option>
                    </select> --}}
                    <select class="nice_Select2 year_seleted">
                        <option value="2024" {{$year == 2024 ? 'selected' : ''}} >Năm 2024</option>
                        <option value="2023" {{$year == 2023 ? 'selected' : ''}} >Năm 2023</option>
                        <option value="2022" {{$year == 2022 ? 'selected' : ''}} >Năm 2022</option>
                        <option value="2021" {{$year == 2021 ? 'selected' : ''}} >Năm 2021</option>
                        <option value="2020" {{$year == 2020 ? 'selected' : ''}} >Năm 2020</option>
                        <option value="2019" {{$year == 2019 ? 'selected' : ''}} >Năm 2019</option>
                    </select>
                </div>
            </div>
            <div id="mixedchart"></div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="white_box box_border min_400">
            <div class="QA_table ">

                <table class="table lms_table_active">
                    <thead>
                        <tr>
                            <th scope="col">Theo Tháng</th>
                            <th scope="col">Số Đơn Hàng</th>
                            <th scope="col">Tiền Hàng</th>
                            <th scope="col">Vận Chuyển</th>
                            <th scope="col">Danh Thu</th>
                            <th scope="col">Các Chi Phí</th>
                            <th scope="col">Lợi Nhuận</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if((isAllZeros($data)) == true)
                        <tr class="row_tong">
                            <th scope="row" class="tong">0</th>
                            <th scope="col">{{number_format($total_order)}}</th>
                            <th scope="col">{{number_format($total) }} đ</th>
                            <th scope="col">0</th>
                            <th scope="col">{{number_format($total)}} đ</th>
                            <th scope="col">-{{number_format($total-$total_profix)}} đ</th>

                            <th scope="col">{{number_format($total_profix)}} đ</th>
                        </tr>
                        @foreach ($orders as  $item)
                        <tr>
                            <th scope="row">{{$item->month}}</th>
                            <td>{{$item->sodon}}</td>
                            <td>{{number_format($item->total_amount) == 0 ? 0 : number_format($item->total_amount) . 'đ'}} </td>
                            <td>0</td>
                            <td>{{number_format($item->total_amount) == 0 ? 0 : number_format($item->total_amount) . 'đ'}} </td>
                            <td>{{number_format($item->total_amount - intval($item->total_amount/rand(2,5))) == 0 ? 0 : '-'.number_format($item->total_amount - intval($item->total_amount/rand(2,5))) . 'đ'}} </td>

                            <td>{{number_format(intval($item->total_amount/rand(2,5))) == 0 ? 0 : number_format(intval($item->total_amount/rand(2,5))) . 'đ'}}</td>

                          </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-lg-4">
        <div class="white_box box_border mb_30 min_400">
            <div class="box_header ">
                <div class="main-title">
                    <h3 class="mb-0">Danh Thu Và Lợi Nhận </h3>
                </div>
            </div>
            <canvas height="220px" id="doughutChart"></canvas>
        </div>
    </div>
</div>

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
                if(data.status == true)
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
    $(".nice_Select2").niceSelect();
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
