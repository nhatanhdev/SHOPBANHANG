@extends('layouts.admin')
@section('title')
<title>Thuộc Tính</title>
@endsection
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="white_box_tittle list_header">
                        <h4>Thuộc Tính Sản Phẩm</h4>
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form action="" method="GET">
                                        <div class="search_field">
                                            <input type="text" placeholder="Bạn muốn tìm gì?">
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
                    <form action="{{route('admin.attribute.update',['id' => $attribute->id])}}" method="post">

                        @csrf
                        <div class="mb-3">
                            <label class="form-label" >Tên Thuộc Tính</label>
                            <input type="text"
                             name ="name_attribute"
                             value="{{$attribute->name}}"
                             class="form-control"
                             placeholder="">
                        </div>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Giá Trị Con</th>
                                <th scope="col">Thứ Tự</th>
                                <th scope="col">Thời Gian Tạo</th>
                                <th scope="col">Hành Động</th>

                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($chil_attributes as $key => $item )
                              <tr>
                                <th scope="row">{{$key + 1}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->rank}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    @can('attribute-edit')
                                    <a href="{{route('admin.attribute.edit1', ['id' =>$item->id])}}" class="btn btn btn-outline-success" onclick="edit_item(event,this)"><i class="ti-pencil-alt"></i></a>
                                    @endcan
                                    @can('attribute-delete')
                                    <a href="{{route('admin.attribute.delete',['id' => $item->id])}}" class="btn btn btn-outline-danger"onclick="delete_item(event,this)" ><i class="ti-trash"></i></a>

                                    @endcan

                                    </td>
                              </tr>
                              @endforeach

                            </tbody>
                          </table>
                          <button type="submit" class="btn_1 full_width text-center">Lưu Thay Đổi</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.attribute.add1')
<div class="modal_edit">

</div>
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
