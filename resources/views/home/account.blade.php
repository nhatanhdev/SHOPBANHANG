@extends('layouts.home')
@section('title')
    <title>Tài Khoản Của Tôi</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('home/assets/css/address.css') }}">

    <style>
        .list-group-item.active {
            background-color: #000 !important;
            color: white;
            border-color: transparent;
        }

        .col-lg-8 .card-body.active {
            display: block !important;
        }

        .lable_table th {
            padding: 10px 2px;
            text-align: center;
        }
        input[type="text"] {
            border:  1px solid #999;
        }
        input[type="password"], input[type="number"] {
            border-radius: 50px;
            width: 100%;
            height: 50px;
            padding-left: 30px;
            border:  1px solid #999;
            outline: none;
            font-size: 16px;
        }

        @media only screen and (max-width: 500px) {
        .jrDLfj {
            border-bottom: 1px solid #efefef;
            box-sizing: border-box;
            height: initial;
            padding: 10px;

            flex-direction: column;

        }
        .PTegQ8{
            padding-bottom: 10px;
        }
        .DTh_Ib {
        padding: 12px 0px 0;
        }
        .mRiaYb.oNu1GY{
            flex-direction: column;
        }
        .sMlAxh{
            justify-content: start;
        }

    }

    </style>
@endsection
@section('content')
    @include('home.partials.banner')

    <section class="py-4" style="margin-bottom: 120px">
        <div class="container">
            <h3 class="d-none">Account</h3>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card shadow-none mb-3 mb-lg-0">
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <div data-target="0"
                                            class="list-group-item active d-flex justify-content-between align-items-center">
                                            Dash board <i class="bx bx-tachometer fs-5"></i></div>
                                        <div data-target="1"
                                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                            Đơn Hàng <i class="bx bx-cart-alt fs-5"></i></div>
                                        <div data-target="3"
                                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                            Địa Chỉ <i class="bx bx-home-smile fs-5"></i></div>
                                        <div data-target="4"
                                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                            Phương Thức Thanh Toán<i class="bx bx-credit-card fs-5"></i></div>
                                        <div data-target="5"
                                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                                            Chi Tiết Tài Khoản <i class="bx bx-user-circle fs-5"></i></div>
                                        <a href="{{ route('logout') }}"
                                            class="list-group-item d-flex justify-content-between align-items-center bg-transparent">Đăng
                                            Xuất <i class="bx bx-log-out fs-5"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-none mb-0">
                                <div class="card-body active" style="display: none;">
                                    Xin chào {{ auth()->user()->name }} (không phải {{ auth()->user()->name }}? <a
                                        href="{{ route('logout') }}">Đăng Xuất</a> )
                                    <br>
                                    Từ bảng điều khiển tài khoản của bạn, bạn có thể xem Đơn hàng gần đây, quản lý địa chỉ
                                    giao hàng và thanh toán cũng như chỉnh sửa mật khẩu và thông tin tài khoản của bạn
                                </div>

                                <div class="card-body" style="display: none;">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="">
                                                <tr class="lable_table">
                                                    <th>Đơn Hàng</th>
                                                    <th>Ngày Đặt</th>
                                                    <th>Trạng Thái</th>
                                                    <th>Tổng</th>
                                                    <th>Thao Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $item)
                                                <tr>
                                                    <td>{{$item->sku}}</td>
                                                    <td>{{$item->created_at}}</td>
                                                    <td>
                                                        <div class="badge rounded-pill bg-dark w-100">{{$item->statuses->name}}</div>
                                                    </td>
                                                    <td>{{number_format($item->total_price)}} đ</td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                                <button type="button"
                                                                class="btn btn-light btn-sm rounded-0" onclick="Showdetail({{$item->id}})"><img src="{{asset('home/assets/img/svg/eye-see-show-svgrepo-com.svg')}}"  width="20px" alt=""></button>
                                                            @if($item->status == 2)
                                                                <a href="javascript:;"
                                                                class="btn btn-light btn-sm rounded-0"><img src="{{asset('home/assets/img/svg/pay-by-credit-card-svgrepo-com.svg')}}"  width="20px" alt=""></a>
                                                            @endif
                                                            @if($item->status < 3)
                                                                <button type="button"
                                                                class="btn btn-light btn-sm rounded-0" onclick="Cancel({{$item->id}})"><img src="{{asset('home/assets/img/svg/cancel-svgrepo-com.svg')}}"  width="20px" alt=""></button>
                                                            @endif

                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-body" style="display: none;">
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                </div>

                                <div class="card-body" style="display: none;">
                                    <div class="fkIi86">
                                        <div class="CAysXD" role="main">
                                            <div class="Vfy7i0">
                                                <div class="jrDLfj">
                                                    <div class="TPi1ZQ">
                                                        <div class="PTegQ8">Địa chỉ của tôi</div>
                                                        <div class="Zk21QZ"></div>
                                                    </div>
                                                    <div>
                                                        <div class="v83kOK">
                                                            <div style="display: flex;"><button
                                                                    class="shopee-button-solid shopee-button-solid--primary Vpc5fC">
                                                                    <div class="GipOsI">
                                                                        <div class="kzWd1d"><svg
                                                                                enable-background="new 0 0 10 10"
                                                                                viewBox="0 0 10 10" x="0" y="0"
                                                                                class="shopee-svg-icon icon-plus-sign">
                                                                                <polygon
                                                                                    points="10 4.5 5.5 4.5 5.5 0 4.5 0 4.5 4.5 0 4.5 0 5.5 4.5 5.5 4.5 10 5.5 10 5.5 5.5 10 5.5">
                                                                                </polygon>
                                                                            </svg></div>
                                                                        <div>Thêm địa chỉ mới</div>
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="_2f9MDn">
                                                    <div class="DTh_Ib">
                                                        <div class="wMgGpz">Địa chỉ</div>
                                                        <div class="phUg9e qgjZnV">
                                                            <div class="mrHKcx">
                                                                <div role="heading" class="mRiaYb oNu1GY">
                                                                    <div id="address-card_c5e1d8f1-6e76-4117-9879-4ef5e246ee4d_header"
                                                                        class="CCAodK aE_RFg"><span class="AMx6oo xkPHQf">
                                                                            <div class="kV1nkS">Nhật Nè</div>
                                                                        </span>
                                                                        <div class="j9nfet"></div>
                                                                        <div role="row" class="qmU0hi FQB1xE DPJLqq">
                                                                            (+84) 373950754</div>
                                                                    </div>
                                                                    <div class="gcimiv"><button class="sMlAxh">Cập
                                                                            nhật</button></div>
                                                                </div>
                                                                <div id="address-card_c5e1d8f1-6e76-4117-9879-4ef5e246ee4d_content"
                                                                    role="heading" class="mRiaYb oNu1GY">
                                                                    <div class="CCAodK aE_RFg">
                                                                        <div class="S8RZkg">
                                                                            <div role="row" class="DPJLqq">Số 11/138,
                                                                                Thiên Lôi</div>
                                                                            <div role="row" class="DPJLqq">Phường Vĩnh
                                                                                Niệm, Quận Lê Chân, Hải Phòng</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="XjmW7h gcimiv"><button
                                                                            class="N6pneA fjdwZV rc6El_"
                                                                            disabled="">Thiết lập mặc định</button>
                                                                    </div>
                                                                </div>
                                                                <div id="address-card_c5e1d8f1-6e76-4117-9879-4ef5e246ee4d_badge"
                                                                    role="row" class="jFJhIS DPJLqq"><span
                                                                        role="mark" class="SBGPfX Ox2pBw bOxoVV">Mặc
                                                                        định</span></div>
                                                            </div>
                                                        </div>
                                                        <div class="phUg9e qgjZnV">
                                                            <div class="mrHKcx">
                                                                <div role="heading" class="mRiaYb oNu1GY">
                                                                    <div id="address-card_90b761ff-7bc4-4b22-9ec2-edf5788b3d8e_header"
                                                                        class="CCAodK aE_RFg"><span class="AMx6oo xkPHQf">
                                                                            <div class="kV1nkS">Nhật …</div>
                                                                        </span>
                                                                        <div class="j9nfet"></div>
                                                                        <div role="row" class="qmU0hi FQB1xE DPJLqq">
                                                                            (+84) 373950754</div>
                                                                    </div>
                                                                    <div class="gcimiv"><button class="sMlAxh">Cập
                                                                            nhật</button><button
                                                                            class="sMlAxh">Xóa</button></div>
                                                                </div>
                                                                <div id="address-card_90b761ff-7bc4-4b22-9ec2-edf5788b3d8e_content"
                                                                    role="heading" class="mRiaYb oNu1GY">
                                                                    <div class="CCAodK aE_RFg">
                                                                        <div class="S8RZkg">
                                                                            <div role="row" class="DPJLqq">Thôn mắt
                                                                                rồng</div>
                                                                            <div role="row" class="DPJLqq">Xã Lập Lễ,
                                                                                Huyện Thủy Nguyên, Hải Phòng</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="XjmW7h gcimiv"><button
                                                                            class="N6pneA fjdwZV rc6El_">Thiết lập mặc
                                                                            định</button></div>
                                                                </div>
                                                                <div id="address-card_90b761ff-7bc4-4b22-9ec2-edf5788b3d8e_badge"
                                                                    role="row" class="jFJhIS DPJLqq"><span
                                                                        role="mark" class="SBGPfX tS7xk_ bOxoVV">Địa
                                                                        chỉ lấy hàng</span><span role="mark"
                                                                        class="SBGPfX tS7xk_ bOxoVV">Địa chỉ trả
                                                                        hàng</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-body" style="display: none;">
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                    Nhật Đẹp zai
                                </div>

                                <div class="card-body" style="display: none;">
                                    <form action="{{route('home.update_account',['id' => $user->id])}}" method="post" class="row g-3">
                                        @csrf
                                    <div class="col-md-6">
                                        <label class="form-label">Họ</label>
                                        <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tên</label>
                                        <input type="text" class="form-control" name="name" value="{{$user->name}}" />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Địa Chỉ Email</label>
                                        <input
                                        type="text"
                                        class="form-control"
                                        name="email"
                                        value="{{$user->email}}"
                                        />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Số Điện Thoại</label>
                                        <input
                                        type="number"
                                        name="phone"
                                        class="form-control"
                                        value="{{$user->phone}}"
                                        />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Mật Khẩu Hiện Tại</label>
                                        <input type="password" class="form-control" name="password" value="" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Mật Khẩu Mới</label>
                                        <input type="password" class="form-control" value=""  name="password_new"/>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Xác Nhận Mật Khẩu Mới </label>
                                        <input type="password" class="form-control" value="" name="confim_password_new" />
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-ecomm ">
                                       Lưu Thay Đổi
                                        </button>
                                    </div>
                                    </form>
                                </div>


                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
    </section>
    <div class="modal_order">
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.list-group-item').click(function() {
                $('.list-group-item').removeClass('active');
                $(this).addClass('active');

                var targetIndex = $(this).data('target');
                console.log('Target index:', targetIndex); // Debugging line
                $('.col-lg-8 .card-body').removeClass('active').hide();

                var targetElement = $('.col-lg-8 .card-body').eq(targetIndex);
                console.log('Target element:', targetElement); // Debugging line
                targetElement.addClass('active').show();
            });
        });
    </script>
    <script>
        function Showdetail(id){
            $.ajax({
                type: 'POST',
                url: '{{ route("home.order_detail") }}',
                data: {
                    id: id,
                    '_token': '{{ csrf_token() }}'  // Include CSRF token
                },
                beforeSend: function() {
                    $('#modal_loading').modal('show');
                },
                success: function(respone) {
                    if (respone.status == true) {
                        $('#modal_loading').modal('hide');
                        $('.modal_order').html(respone.modal_page)
                        $('#exampleModal').modal('show');

                    }
                },
                complete: function(){
                    $('#modal_loading').modal('hide');
                },
            });

        }

    </script>
    <script>
        function Cancel(id){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('home.cancel_order')}}",
                        type: 'POST',
                        data: {
                            id : id,
                        },
                        dataType: 'json',
                        beforeSend: function(jqXHR, settings) {
                            $('#loading').show();
                        },
                        success: function(respone) {
                            if (respone.status == true) {
                                Swal.fire({
                                    title: "Success!",
                                    text: respone.message,
                                    icon: "success"
                                });
                                location.reload();

                            }
                            else{
                                Swal.fire({
                                    title: "Error!",
                                    text: respone.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                    title: "Error!",
                                    text: error,
                                    icon: "error"
                                });
                        },
                        complete: function () {
                            setTimeout(function() {
                                $('#loading').hide();
                            }, 500); // 2000 milliseconds = 2 seconds
                        },

                    })

                }
            });
        }
    </script>

@endsection
