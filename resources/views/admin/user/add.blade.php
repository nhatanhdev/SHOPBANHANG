@extends('layouts.admin')
@section('title')
<title>Người Dùng</title>
@endsection
@section('css')
<style>
    .select2-container .select2-search--inline .select2-search__field {
        margin-top: 10px !important;
    }
    .tox-tinymce{
        width: 100% !important;
    }
    .message-error{
        margin-top: 5px !important;
        color:red;
        font-size: 12px;
    }
    .message-error{
        margin-top: 5px !important;
        color:red;
        font-size: 12px;
    }
    .nice-select.is-invalid{
        border: 1px solid red !important
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
                            <h3 class="mb-0">Thêm User</h3>
                        </div>
                    </div>

                    <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tên User</label>
                            <input type="text"
                             name ="name"
                             class="form-control @error('name') is-invalid @enderror"
                             value="{{old('name')}}"
                             placeholder="">
                            @error('name')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text"
                             name="email"
                             value="{{old('email')}}"

                             class="form-control @error('email') is-invalid @enderror"
                             placeholder="">
                             @error('email')
                             <div class="message-error">{{ $message }}</div>
                             @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                             name="password"
                             value=""

                             class="form-control @error('password') is-invalid @enderror"
                             placeholder="">
                             @error('password')
                             <div class="message-error">{{ $message }}</div>
                             @enderror
                        </div>

                        <label class="form-label mb-2 mt-2">Ảnh đại diện</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar">
                        </div>
                        @error('avatar')
                        <div class="message-error">{{ $message }}</div>
                        @enderror


                        <div class="mb-3 mt-3">
                            <label class="form-label">Vai Trò</label>
                            @error('role_id')
                            <div class="message-error mb-2">{{ $message }}</div>
                            @enderror
                            <select class="default_sel mb_30 w-100  @error('role_id') is-invalid @enderror" name="role_id[]" style="display: none;" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
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

