@extends('layouts.admin')
@section('title')
<title>Roles</title>
@endsection
@section('css')
@endsection
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="box_header ">
                        <div class="main-title">
                            <h3 class="mb-0">Thêm Permission</h3>
                        </div>
                    </div>

                    <form action="{{route('admin.permission.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Moduls</label>
                            @error('category_id')
                            <div class="message-error mb-2">{{ $message }}</div>
                            @enderror
                            <select class="default_sel mb_30 w-100  @error('category_id') is-invalid @enderror" name="name_module" style="display: none;">

                                <option value="">Chọn Moduls</option>
                                @foreach ( config('permissions.table_modules') as $name_module )
                                <option value="{{ $name_module }}">{{ $name_module }}</option>
                                @endforeach
                            </select>


                        </div>

                            <div class="mb-3 h-100">
                                <label for="">
                                    <input type="checkbox" class="checkbox_all">
                                    Tất Cả
                                </label>
                                <div class="card border-primary mb-3 col-md-12">
                                    <div class="row text-center">
                                        @foreach ( config('permissions.action') as $action )
                                            <div class="card-body text-primary col-md-3">
                                                <h5 class="card-title">
                                                    <input
                                                        id="{{ $action }}"
                                                        class="checkbox_childrent"
                                                        type="checkbox"
                                                        name="actions[]"
                                                        value="{{ $action }}"
                                                        autocomplete="off"
                                                    >
                                                    <label for="{{ $action }}">
                                                        {{ $action }}
                                                    </label>
                                                </h5>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                          <button type="submit" class="btn_1 full_width text-center">Thêm</button>
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
        $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));

    });
});

</script>

@endsection
