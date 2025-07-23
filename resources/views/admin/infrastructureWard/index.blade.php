@extends('layouts.admin')

@section('title')
<title>Thành Phố</title>
@endsection
@section('content')
<div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Đường</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form action="{{route('admin.infrastructureWard.search')}}" method="GET">
                                                <div class="search_field">
                                                    <input type="text" placeholder="Bạn muốn tìm gì?" name="q" value="{{request()->q}}">

                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        @can('infrastructureWard-add')
                                            <a href="{{route('admin.infrastructureWard.create')}}" class="btn btn btn-primary" onclick="add_item(event,this)"><i class="ti-plus"></i></a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="QA_table ">
                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên Đường Phố</th>
                                            <th scope="col">Kinh Độ</th>
                                            <th scope="col">Vĩ Độ</th>
                                            <th scope="col">Ngày Tạo</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wards as $key => $ward)
                                        <tr>

                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>{{ $ward->name }}</td>
                                            <td>{{ $ward->lat }}</td>
                                            <td>{{ $ward->long }}</td>
                                            <td>{{ $ward->created_at }}</td>

                                            <td>
                                            @can('infrastructureWard-edit')
                                            <a href="{{route('admin.infrastructureWard.edit', ['id' =>$ward->id])}}" class="btn btn btn-outline-success" onclick="edit_item(event,this)"><i class="ti-pencil-alt"></i></a>
                                            @endcan
                                            @can('infrastructureWard-delete')
                                            <a href="{{route('admin.infrastructureWard.delete',['id' => $ward->id])}}" class="btn btn btn-outline-danger" onclick="delete_item(event,this)"><i class="ti-trash"></i></a>
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



        @include('admin.infrastructureWard.add')
        <div class="modal_edit"></div>
@endsection
@section('js')
<script>
    function delete_item(event,element) {
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
    function add_item(event,element){
        event.preventDefault();
        url = $(element).attr('href');
        $.ajax({
            type: 'GET',
            url: url,

            beforeSend: function() {
                $('#modal_loading').modal('show');
            },
            success: function(respone) {
                if (respone.status == true) {
                    $('#modal_loading').modal('hide');
                    $('#modalAdd').modal('show');

                }
            },
            complete: function(){
                $('#modal_loading').modal('hide');
            },
        });

    }


    function edit_item(event,element){
        event.preventDefault();
        url = $(element).attr('href');
        $.ajax({
            type: 'GET',
            url: url,
            beforeSend: function() {
                $('#modal_loading').modal('show');
            },
            success: function(respone) {
                if (respone.status == true) {
                    $('#modal_loading').modal('hide');
                    $('.modal_edit').html(respone.modal_edit)
                    $('#modalEdit').modal('show');

                }
            },
            complete: function(){
                $('#modal_loading').modal('hide');
            },
        });

    }

</script>
<script>
    $('.X_close').on('click',function(){
        $('#modalAdd').modal('hide');

    });
</script>
@endsection
