@extends('layouts.admin')
@section('title')
<title>Seo</title>
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
                            <h3 class="mb-0">Sửa Seo</h3>
                        </div>
                    </div>

                    <form action="{{route('admin.seo.update',['id' => $seo->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text"
                             name ="title"
                             class="form-control @error('title') is-invalid @enderror"
                             value="{{$seo->title}}"
                             placeholder="<title>Tiêu đề trang chứa từ khóa chính - Tên thương hiệu</title>">
                            @error('title"')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SEO_META</label>
                            <textarea class="form-control my-editor @error('seo_meta') is-invalid @enderror" name="seo_meta" rows="6">{{$seo->seo_meta}}</textarea>
                            @error('seo_meta')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">CANONICAL</label>
                            <textarea class="form-control my-editor @error('canonical') is-invalid @enderror" name="canonical" rows="4">{{$seo->canonical}}</textarea>
                            @error('canonical')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div><div class="mb-3">
                            <label class="form-label">GRAPH TAGS</label>
                            <textarea class="form-control my-editor @error('grap_tags') is-invalid @enderror" name="grap_tags" rows="6">{{$seo->grap_tags}}</textarea>
                            @error('grap_tags')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div><div class="mb-3">
                            <label class="form-label">TWITTER CARDS</label>
                            <textarea class="form-control my-editor @error('twitter_cards') is-invalid @enderror" name="twitter_cards" rows="6">{{$seo->twitter_cards}}</textarea>
                            @error('twitter_cards')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div><div class="mb-3">
                            <label class="form-label">ROBOTS</label>
                            <textarea class="form-control my-editor @error('robots') is-invalid @enderror" name="robots" rows="4">{{$seo->robots}}</textarea>
                            @error('robots')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                          <button type="submit" class="btn_1 full_width text-center">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

