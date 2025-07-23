@extends('layouts.admin')
@section('title')
<title>Vai Trò</title>
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
                            <h3 class="mb-0">Cập Nhật Kho</h3>
                        </div>
                    </div>

                    <form action="{{route('admin.inventory.update',['id' => $inventory->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tên Sản Phẩm</label>
                            <input type="text"
                             name ="product_id"
                             class="form-control"
                             value="{{$inventory->products->name}}"
                             placeholder="" readonly>

                        </div>
                        <div>
                            <input type="hidden" value="{{$inventory->product_id}}" name="product_id">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá Nhập</label>
                            <textarea class="form-control @error('price_wholesale') is-invalid @enderror" name="price_wholesale" rows="4">{{$inventory->price_wholesale}}</textarea>
                            @error('price_wholesale')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số Lượng</label>
                            <textarea class="form-control @error('quantity') is-invalid @enderror" name="quantity" rows="4">{{$inventory->quantity}}</textarea>
                            @error('quantity')
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
