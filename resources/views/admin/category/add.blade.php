@extends('layouts.admin')
@section('title')
<title>Danh Mục</title>
@endsection @section('content')
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="box_header ">
                        <div class="main-title">
                            <h3 class="mb-0">Thêm Danh Mục Mới</h3>
                        </div>
                    </div>
                    <form action="{{route('admin.category.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" >Tên danh mục</label>
                            <input type="text"
                             name ="name_category"
                             class="form-control"
                             placeholder="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" >Danh mục cha</label>
                            <select class="form-control" name="parent_id" >
                                <option value="0">Danh mục cha</option>
                                {!! $htmlOption !!}
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
