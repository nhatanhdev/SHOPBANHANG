@extends('layouts.admin')

@section('title')
<title>Thuộc Tính</title>
@endsection

@section('content')
<div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Thuộc Tính Sản Phẩm</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form action="{{route('admin.attribute.search')}}" method="GET">
                                                <div class="search_field">
                                                <input type="text" placeholder="Bạn muốn tìm gì?" name="q" value="{{request()->q}}">

                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        @can('attribute-add')
                                        <a href="{{route('admin.attribute.create')}}" class="btn btn btn-primary" onclick="add_item(event,this)"><i class="ti-plus"></i></a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="QA_table ">

                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>

                                            <th scope="col">Thuộc Tính </th>
                                            <th scope="col">Giá Trị Con</th>
                                            <th scope="col">Thời Gian Tạo</th>
                                            <th scope="col">Hành Động</th>
                                            <!-- <th scope="col">Trạng Thái</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attributes as $key => $attribute)
                                        <tr>


                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>{{ $attribute->name }}</td>

                                            <td>{{Get_attribute($attribute->id)}}
                                                <br>
                                                <a href="{{route('admin.attribute.edit', ['id' =>$attribute->id])}}" class="configure-terms">Cấu hình chủng loại của thuộc tính sản phẩm</a>

                                            </td>
                                            <td>{{ $attribute->created_at }}</td>

                                            <td>
                                                @can('attribute-edit')
                                                <a href="{{route('admin.attribute.edit', ['id' =>$attribute->id])}}" class="btn btn btn-outline-success"><i class="ti-pencil-alt"></i></a>
                                                @endcan
                                                @can('attribute-delete')
                                                <a href="{{route('admin.attribute.delete',['id' => $attribute->id])}}" class="btn btn btn-outline-danger"><i class="ti-trash"></i></a>
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

    @include('admin.attribute.add')
@endsection
@section('js')
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
