<style>
    .modal-with {
        max-width: inherit;
        width: 70%;

    }

    .lable_table th {
        padding: 10px 2px;
        text-align: center;
    }
    .product_detail th {
        text-align: center;
    }

    @media only screen and (max-width: 840px) {
        .modal-with {
            margin-top: 20px;
            width: 90%;
        }
    }

    @media only screen and (max-width: 500px) {
        .modal-with {
            width: 98%;
        }

    }
</style>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-with" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">CHI TIẾT ĐƠN HÀNG</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-center">THÔNG TIN KHÁCH HÀNG</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="lable_table">
                                            <th scope="col">#</th>
                                            <th scope="col">Khách Hàng</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Số Điện Thoại</th>
                                            <th scope="col">Địa Chỉ</th>
                                            <th scope="col">Ghi Chú</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <th scope="row">1</th>
                                            <th>{{ $order->fullname }}</th>
                                            <th>{{ $order->email }}</th>
                                            <th>{{ $order->phone }}</th>
                                            <th>{{ $order->address }}</th>
                                            <th>{{ $order->note }}</th>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="text-center">TRẠNG THÁI</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="lable_table">
                                            <th scope="col">#</th>
                                            <th scope="col">Mã Đơn Hàng</th>
                                            <th scope="col">Trạng Thái</th>
                                            <th scope="col">Phương Thức Thanh Toán</th>
                                            {{-- <th scope="col">Vận Chuyển</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <th>{{ $order->sku }}</th>
                                            <th>{{ $order->statuses->name ?? '' }}</th>
                                            <th>{{ $order->payments->name ?? '' }}</th>
                                            {{-- <th>{{$order->ship}}</th> --}}

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h6 class="text-center">CHI TIẾT SẢN PHẨM</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="lable_table">
                                            <th scope="col">#</th>
                                            <th scope="col">Tên Sản Phẩm</th>
                                            <th scope="col">Hình Ảnh</th>
                                            <th scope="col">Số Lượng</th>
                                            <th scope="col">Đơn Giá</th>
                                            <th scope="col">Tổng Cộng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $index => $item)
                                            <tr class="product_detail">
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <th>{{ $item->product->name ?? '' }}</th>
                                                <th><img src="{{ asset($item->product->feature_image ?? '') }}"
                                                        alt="" width="50px"></th>
                                                <th>{{ $item->quantity }}</th>
                                                <th>{{ number_format($item->product->price ?? 0) }}đ</th>
                                                <th>{{ number_format($item->quantity * $item->product->price ?? 0) }}đ
                                                </th>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
</div>
<script>
    $('.close').on('click', function() {
        $('#exampleModal').modal('hide');
    });
</script>
