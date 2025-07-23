@extends('layouts.admin')

@section('title')
<title>Cài Đặt</title>
@endsection
@section('content')
<div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4> Cài Đặt </h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form action="{{route('admin.setting.search')}}" method="GET">
                                                <div class="search_field">
                                                <input type="text" placeholder="Bạn muốn tìm gì?" name="q" value="{{request()->q}}">
                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        @can('setting-add')
                                            <a href="{{route('admin.setting.create')}}" class="btn btn btn-primary"><i class="ti-plus"></i></a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="QA_table ">

                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Key Config</th>
                                            <th scope="col">Key Value</th>
                                            <th scope="col">Thời Gian Tạo</th>
                                            <th scope="col">Hành Động</th>
                                            <!-- <th scope="col">Trạng Thái</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($settings as $key => $setting)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>{{ $setting->config_key }}</td>
                                            <td class="w-50">{{$setting->config_value }}</td>
                                            <td>{{ $setting->created_at }}</td>
                                            <td class="">
                                                @can('setting-edit')
                                                    <a  href="{{route('admin.setting.edit', ['id' =>$setting->id])}}" class="btn btn btn-outline-success">
                                                        <i class="ti-pencil-alt"></i>
                                                    </a>
                                                @endcan

                                                @can('setting-delete')
                                                    <a href="{{ route('admin.setting.delete', ['id' => $setting->id]) }}" class="btn btn-outline-danger" onclick="delete_setting(event,this)">
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
        function delete_setting(event,element) {
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
