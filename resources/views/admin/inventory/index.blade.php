@extends('layouts.admin')

@section('title')
<title>Vai Trò</title>
@endsection
@section('content')
<div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4> Kho Hàng </h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form action="{{route('admin.inventory.search')}}" method="GET">
                                                <div class="search_field">
                                                    <input type="text" placeholder="Bạn muốn tìm gì?" name="q" value="{{request()->q}}">

                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        @can('inventory-add')
                                            <a href="{{route('admin.inventory.create')}}" class="btn btn btn-primary"><i class="ti-plus"></i></a>
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
                                            <th scope="col">Giá Nhập</th>
                                            <th scope="col">Số Lượng</th>
                                            <th scope="col">Thời Gian Tạo</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inventorys as $key => $inventory)


                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>{{ $inventory->products->name }}</td>
                                            <td>{{ $inventory->price_wholesale ? number_format($inventory->price_wholesale) . 'đ' : 0}}</td>
                                            <td>{{$inventory->quantity  }}</td>
                                            <td>{{ $inventory->created_at }}</td>
                                            <td class="">
                                                @can('inventory-edit')
                                                    <a  href="{{route('admin.inventory.edit', ['id' =>$inventory->id])}}" class="btn btn btn-outline-success">
                                                        <i class="ti-pencil-alt"></i>
                                                    </a>
                                                @endcan
                                                @can('inventory-delete')
                                                    <a href="{{ route('admin.inventory.delete', ['id' => $inventory->id]) }}" class="btn btn-outline-danger" onclick="delete_inventory(event,this)">
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
        function delete_inventory(event,element) {
            event.preventDefault();
            url_delete = $(element).attr('href');
            Swal.fire({
                title: "Bạn Chắc Chứ",
                text: "Hành động này sẽ xóa luôn cả sản phẩm",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Vâng",
                cancelButtonText: "Huỷ"
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
