@extends('layouts.home')
@section('title')
<title>Đăng Nhập</title>
@endsection
@section('css')
<style>
    .container .row{
        display: flex;
        justify-content: center;
    }

    .register{
        margin-top: 25px;
        text-align: center;
    }
    .login-title {
        margin-bottom: 40px !important;
    }

    .btn_1.full_width {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        color: white;
        padding: 6px;
        border-radius: 3px;
        margin-bottom: 10px;

    }
    .border_style {
        position: relative;
        text-align:center;
        margin: 20px 0px;
    }
    .border_style span {
        z-index: 2;
        position: relative;
        background-color: #f0f0f0;
        padding: 0px 30px;
    }
    .border_style::after {
        content: '';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 1px;
        width: 100%;
        background-color: #bbc1c9;
        left: 0;
        z-index: 1;
    }
    .btn-login {
        border: 1px solid #3b76ef;
        transition: 0.3s all linear;
        background-color: #3b76ef;

    }
    .google{
        background-color: #ec4615;
        border: 1px solid #ec4615;

    }
    .google:hover{
        background-color: transparent;
        color: #ec4615;
    }
    .facebook{
        background-color: #3b5998;
        border: 1px solid #3b5998;
    }
    .facebook:hover{
        background-color: transparent;
        color: #3b5998;
    }

    .btn-login:hover {
        background-color: transparent;
        color: #365995;

    }
</style>
@endsection
@section('content')

@include('home.partials.banner')
<section class="gap">
    <div class="container">
       <div class="row">
         <div class="col-lg-6" >
           <div class="box login">
             <h3 class="login-title">Đăng Nhập</h3>
             <form action="{{ route('do_login') }}" method="post">
                @csrf
               <input type="text" name="email" placeholder="Email của bạn">
               <input type="password" name="password" placeholder="Password">

               <div class="btn-auth btn1 full_width">
                <button  class="btn_1 full_width btn-login">Đăng Nhập</button>
               </div>

               <p class="text-center" style="margin-top: 20px;margin-bottom: 10px;">
                Cần một tài khoản?
                <a href="{{ route('register') }}"> Đăng Ký</a></p>
                <div class="text-center">
                    <a href="#" class="pass_forget_btn">Quên Mật Khẩu?</a>
                </div>
                <div class="border_style">
                    <span>Or</span>
                </div>
                 <div class="row social_login_btn">
                    <div class="form-group col-md-12 text-center">
                        <a href="{{route('auth.facebook')}}" class="btn_1 full_width facebook"><i class="fab fa-facebook-square"></i>Đăng Nhập with Facebook</a>
                    </div>
                    <div class="form-group col-md-12 text-center">
                        <a href="{{route('auth.google')}}" class="btn_1 full_width google"><i class="fab fa-google"></i>Đăng Nhập with Google</a>
                    </div>
                </div>
             </form>
           </div>
         </div>
       </div>
    </div>
 </section>
@endsection
