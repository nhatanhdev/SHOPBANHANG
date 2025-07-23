@extends('layouts.admin')

@section('title')
<title>Sản Phẩm</title>
@endsection
@section('content')
<div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4> Sản Phẩm</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form action="{{route('admin.product.search')}}" method="GET">
                                                <div class="search_field">
                                                        <input type="text" placeholder="Bạn muốn tìm gì?" name="q" value="{{request()->q}}">

                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        @can('product-add')
                                            <a href="{{route('admin.product.create')}}" class="btn btn btn-primary"><i class="ti-plus"></i></a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="QA_table ">

                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>

                                            <th scope="col">Tên Sản Phẩm</th>
                                            <th scope="col">Hình Ảnh</th>

                                            <th scope="col">Giá</th>
                                            <th scope="col">Giá Cũ</th>

                                            <th scope="col">Mô Tả</th>
                                            <th scope="col">Danh Mục</th>

                                            <th scope="col">Thời Gian Tạo</th>
                                            <th scope="col">Hành Động</th>

                                            <!-- <th scope="col">Trạng Thái</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                        <tr>



                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>{{ $product->name }}</td>
                                            <td style="width: 11%"><img src="{{ $product->feature_image }}" width="100%" alt=""></td>
                                            <td>{{ number_format($product->price) }}</td>
                                            <td>{{ $product->price_old ? number_format($product->price_old) : '' }}</td>
                                            <td class="d-flex flex-shrink-0" style="width: 200px;">{{ $product->description }}</td>
                                            <td class="text-nowrap">{{ optional($product->category)->name }}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td class="d-flex flex-nowrap">
                                                @can('product-edit')
                                                    <a  href="{{route('admin.product.edit', ['id' =>$product->id])}}" class="btn btn btn-outline-success">
                                                        <i class="ti-pencil-alt"></i>
                                                    </a>
                                                @endcan

                                                @can('product-delete')
                                                    <a href="{{ route('admin.product.delete', ['id' => $product->id]) }}" class="btn btn-outline-danger" onclick="delete_product(event,this)">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                @endcan
                                            </td>

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
@endsection
@section('js')
<script>
        function delete_product(event,element) {
            event.preventDefault();
            url_delete = $(element).attr('href');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url_delete,
                        type: 'GET',
                        dataType: 'json',
                        beforeSend: function(jqXHR, settings) {
                            $('.loading-js').show();
                        },
                        success: function(respone) {
                            if (respone.status == true) {
                                $(element).parents('tr').remove();
                                Swal.fire({
                                    title: "Success!",
                                    text: respone.message,
                                    icon: "success"
                                });

                            }
                            else{
                                Swal.fire({
                                    title: "Error!",
                                    text: respone.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                                    title: "Error!",
                                    text: error,
                                    icon: "error"
                                });
                        },
                        complete: function() {
                        // Hide loader after request completes
                            $('.loading-js').hide();
                        }

                    })

                }
            });
        }

</script>
@endsection
