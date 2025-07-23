@extends('layouts.admin')

@section('title')
<title>Roles</title>
@endsection
@section('content')
<div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4> Quyền Hạn </h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form action="{{route('admin.permission.search')}}" method="GET">
                                                <div class="search_field">
                                                    <input type="text" placeholder="Bạn muốn tìm gì?" name="q" value="{{request()->q}}">

                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        @can('permission-add')
                                            <a href="{{route('admin.permission.create')}}" class="btn btn btn-primary"><i class="ti-plus"></i></a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="QA_table ">

                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên Model</th>
                                            <th scope="col">Thời Gian Tạo</th>
                                            <th scope="col">Hành Động</th>
                                            <!-- <th scope="col">Trạng Thái</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->created_at }}</td>
                                            <td class="">
                                                @can('permission-edit')
                                                    <a  href="{{route('admin.permission.edit', ['id' =>$permission->id])}}" class="btn btn btn-outline-success">
                                                        <i class="ti-pencil-alt"></i>
                                                    </a>
                                                @endcan
                                                @can('permission-delete')
                                                    <a href="{{ route('admin.permission.delete', ['id' => $permission->id]) }}" class="btn btn-outline-danger" onclick="delete_permission(event,this)">
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
        function delete_permission(event,element) {
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
