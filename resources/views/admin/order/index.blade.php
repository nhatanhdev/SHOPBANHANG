@extends('layouts.admin')

@section('title')
<title>Đơn Hàng</title>
@endsection

@section('css')
<style>
.loading-spinner{
  width:30px;
  height:30px;
  border:2px solid indigo;
  border-radius:50%;
  border-top-color:#0001;
  display:inline-block;
  animation:loadingspinner .7s linear infinite;
}
@keyframes loadingspinner{
  0%{
    transform:rotate(0deg)
  }
  100%{
    transform:rotate(360deg)
  }
}
</style>
@endsection
@section('content')

<div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4> Danh Sách Đơn Hàng</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form action="{{route('admin.order.search')}}" method="GET">
                                                <div class="search_field">
                                                <input type="text" placeholder="Bạn muốn tìm gì?" name="q" value="{{request()->q}}">

                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        @can('order-add')
                                            <a href="{{route('admin.order.create')}}" class="btn btn btn-primary"><i class="ti-plus"></i></a>

                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="QA_table ">

                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>

                                            <th scope="col">Mã Đơn Hàng</th>

                                            <th scope="col">Phương Thức Thanh Toán</th>
                                            <th scope="col">Tổng</th>

                                            <th scope="col">Trạng Thái</th>

                                            <th scope="col">Ngày Đặt</th>
                                            <th scope="col">Hành Động</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                        <tr>

                                            <th scope="row d-flex">

                                                {{  $key + 1 }}
                                            </th>
                                            <td>{{ $order->sku }}</td>
                                            <td>{{ $order->payments->name }}</td>
                                            <td> {{number_format($order->total_price)}}đ</td>
                                            <td>{{ $order->statuses->name }}</td>
                                            <td>{{ $order->created_at }}</td>

                                            <td class="d-flex">
                                                @can('order-list')
                                                    <button type="button" class="btn btn btn-outline-info btn-modal" onclick="Showdetail({{$order->id}})">
                                                        <i class="ti-eye"></i>
                                                    </button>
                                                @endcan
                                                @can('order-edit')
                                                    <a  href="{{route('admin.order.edit', ['id' =>$order->id])}}" class="btn btn btn-outline-success">
                                                        <i class="ti-pencil-alt"></i>
                                                    </a>
                                                @endcan
                                                @can('order-delete')
                                                    <a href="{{ route('admin.order.delete', ['id' => $order->id]) }}" class="btn btn-outline-danger" onclick="delete_order(event,this)">
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




<div class="modal_order">
</div>
<!-- Loading Modal -->


@endsection
@section('js')
<script>
        function delete_order(event,element) {
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
<script>
    function Showdetail(id){
        $.ajax({
            type: 'POST',
            url: '{{ route("admin.order.detail") }}',
            data: {
                id: id,
                '_token': '{{ csrf_token() }}'  // Include CSRF token
            },
            beforeSend: function() {
                $('#modal_loading').modal('show');
            },
            success: function(respone) {
                if (respone.status == true) {
                    $('#modal_loading').modal('hide');
                    $('.modal_order').html(respone.modal_page)
                    $('#exampleModal').modal('show');

                }
            },
            complete: function(){
                $('#modal_loading').modal('hide');
            },
        });

    }

</script>

<script>
$('.close').on('click',function(){
    $('#exampleModal').modal('hide');
});
</script>
@endsection
