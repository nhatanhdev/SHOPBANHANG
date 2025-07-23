@extends('layouts.admin')
@section('title')
<title>Đơn Hàng</title>
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
                        <h3 class="mb-0">Thêm Flash Sale</h3>
                    </div>
                </div>

                <form action="{{route('admin.flashSale.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row ">
                        <div class="col-lg-12">
                            <table class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Giá Giảm</th>
                                        <th>Số Lượng</th>
                                    </tr>
                                </thead>
                                <tbody class="">

                                    <tr>
                                        <td >
                                            <select class="form-control select2" name="product_id" style="width: 100%">
                                                @foreach ($products as $item )
                                                <option value="{{ $item->id}}" {{ $flashSale->product_id == $item->id ? 'selected' : '' }}  data-image="{{ $item->feature_image }}">{{ $item->name }}</option>
                                                @endforeach

                                            </select>

                                        </td>
                                        <td class="">
                                            <input
                                                type="number"
                                                class="form-control"
                                                name="reduce_price"
                                                value="{{ $flashSale->reduce_price }}"
                                            />
                                        </td>
                                        <td class="">
                                            <input
                                                type="number"
                                                class="form-control"
                                                name="quantity"
                                                value="{{ $flashSale->quantity }}"
                                                min="1"
                                            />
                                        </td>

                                    </tr>

                                </tbody>
                                <tbody class="new_rows">
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="row">
                        <div class="mb-3 col-lg-6  common_date_picker mb_20">
                            <label class="form-label">Thời Gian Bắt Đầu</label>
                            <input class="input_form" id="start_datepicker" name="start_date" value="{{ $flashSale->start_date }}" placeholder="pick a date" >
                        </div>
                        <div class="mb-3 col-lg-6  common_date_picker mb_20">
                            <label class="form-label">Thời Gian Kết Thúc</label>
                            <input class="input_form" id="end_datepicker" name="end_date"  value="{{ $flashSale->end_date }}" placeholder="pick a date" >
                        </div>

                    </div>
                      <button type="submit" class="btn_1 full_width text-center">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('adminlte\vendors\select2\js\select2.js')}}"></script>
<script>
    $(document).ready(function() {
        // Function để định dạng option của Select2
        function formatOption(option) {
            if (!option.id) {
                return option.text;
            }
            var $option = $(
                '<span><img src="' + $(option.element).data('image') + '" class="img-thumbnail" style="width:25px; height:25px;" /> ' + option.text + '</span>'
            );
            return $option;
        }

        // Khởi tạo Select2 cho các select ban đầu có class 'select2'
        $('.select2').select2({
            templateResult: formatOption,
            templateSelection: formatOption,
            placeholder: "Chọn Sản Phẩm",
        });

        // Khởi tạo Select2 cho các select có class 'select2on'
        $('.select2on').select2({
            placeholder: "Chọn tùy chọn",
        });

        // Điều chỉnh chiều cao của dropdown Select2
        $(".select2-selection--multiple, .select2-selection").css("height", "40px");

        // Xử lý sự kiện khi click vào nút thêm dòng

    });
</script>
@endsection
