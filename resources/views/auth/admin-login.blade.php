@extends('layouts.auth')
@section('title')
<title>Đăng Nhập</title>
@endsection
@section('content')
<div class="main_content_iner">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="modal-content cs_modal">
                                <div class="modal-header text-center">
                                    <h5 class="modal-title w-100">Đăng Nhập</h5>
                                </div>
                                <div class="text-center">
                                    <h6 class="">Chào mừng bạn đến với trang quản trị</h6>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('admin_do_login') }}">
                                        @csrf
                                        <div class="input-group">
                                            {{-- <span class="input-group-text">
                                                <i class="fa fa-phone"></i>
                                            </span> --}}
                                            <input type="text" class="form-control"  name="email" placeholder="Enter your email">
                                        </div>
                                        <div class="input-group">
                                            {{-- <span class="input-group-text">
                                                <i class="fa fa-phone"></i>
                                            </span> --}}
                                            <input type="password" class="form-control"  name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn_1 full_width text-center">Đăng Nhập</button>

                                        {{-- <p>Cần một tài khoản? <a data-bs-toggle="modal" data-bs-target="#sing_up" data-bs-dismiss="modal" href="#"> Đăng Ký</a></p>
                                        <div class="text-center">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#forgot_password" data-bs-dismiss="modal" class="pass_forget_btn">Quên Mật Khẩu?</a>
                                        </div>
                                        <div class="border_style">
                                            <span>Or</span>
                                        </div> --}}
                                        {{-- <div class="row social_login_btn">
                                            <div class="form-group col-md-12 text-center">
                                                <a href="{{route('auth.facebook')}}" class="btn_1 full_width"><i class="fab fa-facebook-square"></i>Đăng Nhập with Facebook</a>
                                            </div>
                                            <div class="form-group col-md-12 text-center">
                                                <a href="{{route('auth.google')}}" class="btn_1 full_width"><i class="fab fa-google"></i>Đăng Nhập with Google</a>
                                            </div>
                                        </div> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
