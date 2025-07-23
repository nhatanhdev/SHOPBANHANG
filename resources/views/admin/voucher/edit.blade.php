@extends('layouts.admin')
@section('title')
<title>Sửa Mã Giảm Giá</title>
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
                        <h3 class="mb-0">Sửa Mã Giảm Giá</h3>
                    </div>
                </div>
                <form action="{{route('admin.voucher.update',['id' => $voucher->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-lg-4">
                            <label class="form-label">Mã Giảm Giá</label>
                            <input type="text"
                             name="code"
                             value="{{$voucher->code}}"
                             class="form-control"
                             placeholder="">

                        </div>
                        <div class="mb-3 col-lg-4">
                            <label class="form-label">Lượt Sử Dụng</label>
                            <input type="text"
                             name="time"
                             value="{{$voucher->time}}"
                             class="form-control"
                             placeholder="">

                        </div>
                        <div class="mb-3 col-lg-4">
                            <label class="form-label">Giảm Theo</label>
                            <select class="form-select form-control-lg select_giam" name="check">
                                <option>Chọn</option>
                                <option value="1" {{ $voucher->discount > $voucher->money ? 'selected' : ''}}>Giảm Theo %</option>
                                <option value="2" {{ $voucher->discount > $voucher->money ? '' : 'selected'}}>Giảm Theo Giá Tiền</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="discount mb-3 col-lg-4"></div>

                        <div class="mb-3 col-lg-4">
                            <label class="form-label">Điều Kiện</label>
                            <input type="text"
                            name="condition"
                            value="{{$voucher->condition}}"
                            class="form-control"
                            placeholder="">
                        </div>


                        <div class="mb-3 col-lg-4  common_date_picker mb_20">
                            <label class="form-label">Thời Gian Hiệu Lực</label>
                            <input class="input_form" id="start_datepicker" name="expiration_date" placeholder="pick a date"
                            value="{{ date('d-m-Y',strtotime($voucher->expiration_date))}}"
                            >
                        </div>
                    </div>
                    <div class="mb-3 ">
                        <label class="form-label">Mô Tả</label>
                        <textarea class="form-control my-editor" name="name">{{$voucher->name}}
                        </textarea>
                    </div>

                      <button type="submit" class="btn_1 full_width text-center">Cập Nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var input_discount = `
        <label class="form-label">Phân Trăm</label>
        <input type="text"
        name="discount"
        value="{{$voucher->discount}}"
        class="form-control"
        placeholder="">
    `;

    var input_money = `
        <label class="form-label">Giá</label>
        <input type="text"
        name="money"
        value="{{$voucher->money}}"
        class="form-control"
        placeholder="">
    `;

    // Initial check if there's an initial selected value
    var valuese = $('.select_giam').val();
    if (valuese) {
        updateDiscountInput(valuese);
    }

    // Handle change event on .select_giam
    $('.select_giam').change(function () {
        var selectedValue = $(this).val();
        updateDiscountInput(selectedValue);
    });

    function updateDiscountInput(value) {
        $('.discount').html(''); // Clear previous content

        if (value == 1) {
            $('.discount').append(input_discount);
        } else if (value == 2) {
            $('.discount').append(input_money);
        }
        // No need for an else case if you just want to clear '.discount'
    }

</script>


<script>

        $('#start_datepicker').datepicker({
            format: 'dd/mm/yyyy', // Date format
            minDate: new Date() // Disable past dates
        });
 </script>
@endsection
