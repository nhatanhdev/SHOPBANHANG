@extends('layouts.home')
@section('title')
<title>Thanh Toán</title>
@endsection
@section('css')
<style>
    #lightbox{
    display: none;
    }
    .list {
        height: 30vh !important;
        overflow: auto !important;
    }
</style>
@endsection
@section('content')
@include('home.partials.banner')
<section class="gap">
    <div class="container">
        <form class="checkout-meta donate-page" method="post" action="{{ route('home.checkout_order') }}">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <h3>
                        Chi tiết thanh toán
                    </h3>
                        <div class="col-lg-12">
                            <input type="text" class="input-text " name="billing_name" placeholder="Tên" value="{{old('billing_name')}}">
                            <input type="email" class="input-text " name="billing_email" placeholder="Địa Chỉ Email" value="{{old('billing_email')}}">

                            <div class="row">
                            <div class="col-lg-4">
                                <select name="billing_city" class="nice-select Advice city city-select">
                                    <option value="0"> Chọn Thành Phố</option>
                                    @foreach ( $cities as $city )
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-lg-4 provinces">
                                @include('home.ajax.district')
                            </div>
                            <div class="col-lg-4 wards">
                                @include('home.ajax.ward')
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="billing_address" placeholder="Địa Chỉ" value="{{old('billing_address')}}">
                            </div>
                            <div class="col-lg-6">
                                <input type="tel" class="input-text " name="billing_phone"  placeholder="Số Điện Thoại" value="{{old('billing_phone')}}">
                            </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-4">
                    <div class="woocommerce-additional-fields">
                        <h3>Ghi Chú </h3>
                        <textarea name="billing_note" class="input-text " placeholder="Ghi Chú Đặt Hàng">{{old('billing_note')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-lg-5">
                <div class="col-lg-6">
                        <div class="cart_totals cart-Total">
                            <h4>
                                 GIỎ HÀNG
                            </h4>
                            <table class="shop_table_responsive">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Tạm Tính:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount">
                                            <bdi>
                                                <span class="woocommerce-Price-currencySymbol">
                                                </span>{{ number_format($total) }} đ
                                            </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="Shipping">
                                        <th>Phí Vận Chuyển:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount amount">
                                                MIỄN PHÍ
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="Voucher">
                                        <th>Giảm Giá:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount amount">
                                                {{isset($reduce) ? '-'.number_format($reduce) . ' đ' : '--'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="Total">
                                        <th>Tổng Cộng:</th>
                                        <td>
                                            <span class="woocommerce-Price-amount">
                                            <bdi>
                                                {{  isset($reduce) ?  number_format($total - $reduce) : number_format($total)}} đ
                                            </bdi>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout-side">
                        <h3>
                            Phương Thức Thanh Toán
                        </h3>
                        <ul>
                            @foreach ( $payments as $key => $item )
                                <li>
                                    <input type="radio"  name="method_payment" value="{{ $item->id }}" {{ $key == 0 ? 'checked' : '' }}>
                                    <label for="Bank_Payment">
                                        {{ $item->name }}
                                    </label>
                                </li>
                            @endforeach

                        </ul>
                        <button type="submit" class="button">Đặt Hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('js')
<script>

    $(document).ready(function(){
        $('.province ul.list').css("opacity","0")
        $('.ward ul.list').css("opacity","0")
        $('.city-select').on('change', function (){

            var id = $(this).val()
            // var city = $('option[value='+id+']').prop('selected', true).text();
            // $('input[name="billing_address"]').val(city + ", ");
            $.ajax({
                url: "{{route('ajax.districts')}}",
                type: 'GET',
                data: {
                    id : id,
                },
                success: function (data) {
                    if(data.status == true){
                        $('.provinces').html(data.views)
                        $('.wards').html(data.view2)

                    }
                    else{
                        $('.provinces').html(data.views)
                        $('.wards').html(data.view2)
                        $('.province ul.list').css("opacity","0")
                        $('.ward ul.list').css("opacity","0")

                    }

                },
                error: function (error) {
                },
            })
        })
    })
</script>


@endsection
