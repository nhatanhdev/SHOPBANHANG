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
                        <h3 class="mb-0">Sửa Đơn</h3>
                    </div>
                </div>

                <form action="{{route('admin.order.update',['id'=>$order->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-lg-3">
                            <label class="form-label">Tên Khách Hàng</label>
                            <input type="text"
                            name="fullname"
                            value="{{$order->fullname}}"

                            class="form-control @error('fullname') is-invalid @enderror"
                            placeholder="">
                            @error('fullname')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-2">
                            <label class="form-label">Email</label>
                            <input type="text"
                             name="email"
                             value="{{$order->email}}"
                             class="form-control"
                             placeholder="">

                        </div>
                        <div class="mb-3 col-lg-2">
                            <label class="form-label">Số Điện Thoại</label>
                            <input type="text"
                            name="phone"
                            value="{{$order->phone}}"
                            class="form-control"
                            placeholder="">
                        </div>
                        <div class="mb-3 col-lg-2">
                            <label class="form-label">Địa Chỉ</label>
                            <input type="text"
                            name="address"
                            value="{{$order->address}}"
                            class="form-control"
                            placeholder="">
                        </div>
                        <div class="mb-3 col-lg-3">
                            <label class="form-label">Note</label>
                            <input type="text"
                            name="note"
                            value="{{$order->note}}"
                            class="form-control"
                            placeholder="">
                        </div>
                    </div>

                   @include('admin.order.table_edit')

                    <div style="text-align: end">
                        <button class="btn btn btn-outline-info" id="addRowBtn"><i class="ti-plus"> </i></button>
                    </div>


                    <div class="row">

                        <div class="mb-3 col-lg-4">
                            <label class="form-label" id="">Trạng Thái</label>
                            <select class="form-control select2on" name="status" style="width: 100%">
                                @foreach ( $statuses as $key1 )
                                <option value="{{$key1->id}}">{{$key1->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-lg-4">
                            <label class="form-label" id="">Phương Thức Thanh Toán</label>
                            <select class="form-control select2on" name="payment" style="width: 100%">
                                @foreach ( $payments as $key2 )
                                <option value="{{$key2->id}}">{{$key2->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-lg-4">
                            <label class="form-label" id="">Vận Chuyển</label>
                            <select class="form-control select2on" name="ship" style="width: 100%">
                                @foreach ( $ships as $key3 )
                                <option value="{{$key3->id}}">{{$key3->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                      <button type="submit" class="btn_1 full_width text-center">Thêm</button>
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
        $('#addRowBtn').click(function(event) {
            event.preventDefault();

            var newRowHtml = `
                <tr>
                    <td>
                        <select class="form-control select2" name="products[]" style="width: 100%">
                            <option value="">Chọn sản phẩm</option>
                            <?php foreach ($products as $item): ?>
                                <option value="<?= $item->id ?>" data-image="<?= $item->feature_image ?>"><?= $item->name ?></option>
                            <?php endforeach; ?>
                            <?php foreach ($variant_products as $item): ?>
                                <option value="<?= $item->product_variants->id ?>,<?= $item->children_id ?>" data-image="<?= $item->product_variants->feature_image ?>"><?= $item->product_variants->name ?> (<?= Array_ids($item->id) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="quantity[]" value="1" min="1" />
                    </td>
                </tr>
            `;

            // Thêm dòng mới vào tbody
            $('.new_rows').append(newRowHtml);

            // Khởi tạo lại Select2 cho tất cả các select trong .new_rows
            $('.new_rows .select2').select2({
                templateResult: formatOption,
                templateSelection: formatOption,
                placeholder: "Chọn Sản Phẩm",
            });

            // Điều chỉnh lại chiều cao của dropdown Select2
            $(".select2-selection--multiple, .select2-selection").css("height", "40px");
        });
    });
</script>
@endsection
