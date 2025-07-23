@extends('layouts.admin')
@section('title')
<title>Tạo Mã Giảm Giá</title>
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
<div class="main_content_iner">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_box mb_30">
                <div class="box_header ">
                    <div class="main-title">
                        <h3 class="mb-0">Thêm Mã Mới</h3>
                    </div>
                </div>
                <form action="{{route('admin.voucher.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label class="form-label">Mã Giảm Giá</label>
                            <input type="text"
                             name="code"
                             value="{{old('code')}}"
                             class="form-control"
                             placeholder="">

                        </div>
                        <div class="mb-3 col-lg-4">
                            <label class="form-label">Lượt Sử Dụng</label>
                            <input type="text"
                             name="time"
                             value="{{old('time')}}"
                             class="form-control"
                             placeholder="">

                        </div>
                        <div class="mb-3 col-lg-4">
                            <label class="form-label">Giảm Theo</label>
                            <select class="form-select form-control-lg select_giam" name="check">
                                <option>Chọn</option>
                                <option value="1">Giảm Theo %</option>
                                <option value="2">Giảm Theo Giá Tiền</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="discount mb-3 col-lg-4"></div>

                        <div class="mb-3 col-lg-4">
                            <label class="form-label">Điều Kiện</label>
                            <input type="text"
                            name="condition"
                            value="{{old('condition')}}"
                            class="form-control"
                            placeholder="">
                        </div>


                        <div class="mb-3 col-lg-4  common_date_picker mb_20">
                            <label class="form-label">Thời Gian Hiệu Lực</label>
                            <input class="input_form" id="start_datepicker" name="expiration_date" placeholder="pick a date" >
                        </div>
                    </div>
                    <div class="mb-3 ">
                        <label class="form-label">Mô Tả</label>
                        <textarea class="form-control my-editor" name="name">
                        </textarea>
                    </div>

                      <button type="submit" class="btn_1 full_width text-center">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('.select_giam').change(function(){
        var input_discount = `
            <label class="form-label">Phân Trăm</label>
            <input type="text"
            name="discount"
            value="{{old('discount')}}"
            class="form-control"
            placeholder="">
        `
        var input_money = `
            <label class="form-label">Giá</label>
            <input type="text"
            name="money"
            value="{{old('money')}}"
            class="form-control"
            placeholder="">
        `
        if($(this).val() == 1){
            $('.discount').html('');
            $('.discount').append(input_discount);
        }
        else if($(this).val() == 2){
            $('.discount').html('');
            $('.discount').append(input_money);
        }
        else {
            $('.discount').html('');

        }
    })
</script>


<script>

        $('#start_datepicker').datepicker({
            format: 'dd/mm/yyyy', // Date format
            minDate: new Date() // Disable past dates
        });
 </script>
@endsection
