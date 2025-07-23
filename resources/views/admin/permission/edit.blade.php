@extends('layouts.admin')
@section('title')
<title>Quyền Hạn </title>
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
                            <h3 class="mb-0">Sửa Quyền Hạn</h3>
                        </div>
                    </div>

                    <form action="{{route('admin.permission.update',['id' => $permission->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tên </label>
                            <input type="text"
                             name ="name"
                             class="form-control @error('name') is-invalid @enderror"
                             value="{{$permission->name}}"
                             placeholder="">
                            @error('name')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control @error('display_name') is-invalid @enderror" name="display_name" rows="4">{{$permission->display_name}}</textarea>
                            @error('display_name')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">
                                <input type="checkbox" class="checkbox_all">
                                Tất Cả
                            </label>
                        </div>
                        @foreach ($permissionsParent as $parent)
                            <div class="mb-3 h-100">
                                <div class="card border-primary mb-3 col-md-12">
                                    <div class="card-header">
                                        <input
                                            id="{{ $parent->id }}"
                                            class="checkbox_wrapper"
                                            type="checkbox"
                                            value=""
                                            autocomplete="off"
                                        >
                                        <label for="{{ $parent->id }}">
                                            Quyền: {{ $parent->name }}
                                        </label>
                                    </div>
                                    <div class="row text-center">
                                        @foreach ($parent->permissionChildrent as $child)
                                            <div class="card-body text-primary col-md-3">
                                                <h5 class="card-title">
                                                    <input
                                                        id="{{ $child->id }}"

                                                        class="checkbox_childrent"
                                                        type="checkbox"
                                                        name="permission_id[]"
                                                        value="{{ $child->id }}"
                                                        autocomplete="off"
                                                    >
                                                    <label for="{{ $child->id }}">
                                                        {{ $child->name }}
                                                    </label>
                                                </h5>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                          <button type="submit" class="btn_1 full_width text-center">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
$(document).ready(function() {
    $('.checkbox_wrapper').on('click', function() {
        $(this).closest('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    });

    $('.checkbox_all').on('click', function() {
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
        $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));

    });
});

</script>
@endsection
