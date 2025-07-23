@extends('layouts.home')
@section('title')
<title>Đặt Hàng Thành Công</title>
@endsection
@section('css')
@endsection
@section('content')
@include('home.partials.banner')
<section class="gap">
  <div class="container">
    <div class="card py-3 mt-sm-3 checkout-complete">
      <div class="card-body text-center">
        <h2 class="h4 pb-3">Cảm ơn bạn đã đặt hàng !</h2>
        <p class="fs-sm mb-2">Đơn hàng của bạn đã được đặt và sẽ được xử lý sớm nhất có thể.</p>
        <p class="fs-sm mb-2">Hãy đảm bảo rằng bạn ghi lại số đơn hàng của mình là <strong class="fw-medium">{{$sku}}</strong>
        </p>
        <p class="fs-sm">Bạn sẽ sớm nhận được email xác nhận đơn hàng của mình. </p>
        </p><a class="btn btn-light rounded-0 mt-3 me-3" href="{{route('home.product')}}">Tiếp Tục Mua Sắp</a><a class="btn btn-white rounded-0 mt-3" href="{{route('home.index')}}"><i class="bx bx-map"></i>Kiểm Tra Đơn Hàng</a>
      </div>
    </div>
  </div>
</section>
@endsection
