@extends('layouts.home')
@section('title')
<title>Đăng Ký</title>
@endsection
@section('css')
<style>
    .container .row{
        display: flex;
        justify-content: center;
    }
    .btn-auth {
        display: flex;
        justify-content: space-between;
    }
    .register-title {
        margin-bottom: 40px !important;
    }
    .btn-login::before {
        display: none;
    }
    .marintop {
        margin-top: 0px !important;
    }
    .pading{
        margin-bottom: 10px ;
    }
</style>
@endsection
@section('content')
@include('home.partials.banner')
<section class="gap">
    <div class="container">
       <div class="row">
         <div class="col-lg-6">
           <div class="box register">
             <div class="parallax" style="background-image: url(assets/img/patron.html)"></div>
             <h3 class="register-title text-center">Đăng Ký</h3>
             <form method="post" action="{{ route('do_register') }}">
                @csrf
               <input type="text" name="name" placeholder="Họ Tên">
               <input type="email" name="email" placeholder="Email">
               <input type="password" name="password" placeholder="Password">
               <p class="pading">
                Dữ liệu cá nhân của bạn sẽ được sử dụng để hỗ trợ trải nghiệm của bạn trên toàn bộ trang web này, để quản lý quyền truy cập vào tài khoản của bạn và cho các mục đích khác được mô tả trong chính sách bảo mật của chúng tôi.
               </p>
               <div class="btn-auth">
                    <a href="{{ route('login') }}" class="button btn-login">Đăng Nhập</a>

                    <button type="submit" class="button marintop">Đăng Ký</button>
                </div>
             </form>
           </div>
         </div>
       </div>
    </div>


 </section>
@endsection
