@extends('layouts.admin')
@section('title')
<title>Đánh Giá</title>
@endsection
@section('css')
<style>

    .nice-select.is-invalid{
        border: 1px solid red !important
    }
    input[type="checkbox"] {
        width: 13px;
        height: 13px;
    }

</style>
@endsection
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="box_header ">
                        <div class="main-title">
                            <h3 class="mb-0">Thêm Đánh Giá</h3>
                        </div>
                    </div>

                    <form action="{{route('admin.rating.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="user_id">
                                <option selected>Chọn Khách Hàng</option>
                                @foreach ($users as $user  )
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="rate">
                                <option selected>Chọn sao</option>
                                @for ($i = 1 ; $i<=5 ; $i++)
                                <option value="{{$i}}">{{rate_star($i)}}</option>

                                @endfor
                              </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea class="form-control my-editor @error('content') is-invalid @enderror" name="content" rows="4">{{old('content')}}</textarea>
                            @error('content')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        <div>
                        <div class="mb-3 mt-3">
                            <select class="form-select" aria-label="Default select example" name="product_id">
                                <option selected>Chọn Sản Phẩm Đánh Giá</option>
                                @foreach ($products as $product  )
                                <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>

                          <button type="submit" class="btn_1 full_width text-center">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
