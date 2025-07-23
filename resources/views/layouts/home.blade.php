<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from winsfolio.net/html/patte/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Jul 2024 02:24:43 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @yield('title')
  <link rel="icon" href="{{asset('home/assets/img/heading-img.png')}}">
  <!-- CSS only -->
    @include('home.partials.css')
 </head>
<body>
<!-- loader -->
@include('home.partials.loading')
<!-- loader end -->
@include('home.partials.header')
<div class="main">
    @yield('content')
</div>
@include('home.partials.footer')
<!-- cart-popup -->
    <div id="lightbox" class="lightbox clearfix mini_cart">
        @include('home.partials.mini_cart')
    </div>

<!-- cart-popup end -->
<!-- search-popup -->
<div class="search-popup">
        <button class="close-search style-two"><span class="flaticon-multiply"><i class="far fa-times-circle"></i></span></button>
        <button class="close-search"><i class="fa-solid fa-arrow-right"></i></button>
        <form method="get" action="{{ route('home.search') }}">
            <div class="form-group">
                <input type="text" name="q" value="{{request()->q}}" placeholder="Tìm Kiếm mọi thứ ở đây" required="">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
</div>
<!-- search-popup end -->
<!-- progress -->
<div id="progress">
      <span id="progress-value"><i class="fa-solid fa-up-long"></i></span>
</div>
<!-- progress end -->
<!-- Bootstrap Js -->
@include('home.partials.script')
</body>
