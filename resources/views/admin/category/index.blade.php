@extends('layouts.admin')

@section('title')
<title>Danh Mục</title>
@endsection
@section('content')
<div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Danh Mục Sản Phẩm</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="serach_field_2">
                                        <div class="search_inner">
                                            <form action="{{route('admin.category.search')}}" method="GET">
                                                <div class="search_field">
                                                <input type="text" placeholder="Bạn muốn tìm gì?" name="q" value="{{request()->q}}">

                                                </div>
                                                <button type="submit"> <i class="ti-search"></i> </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="add_button ms-2">
                                        @can('category-add')
                                            <a href="{{route('admin.category.create')}}" class="btn btn btn-primary"><i class="ti-plus"></i></a>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="QA_table ">

                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>

                                            <th scope="col">Tên Danh Mục</th>
                                            <th scope="col">Hành Động</th>
                                            <!-- <th scope="col">Trạng Thái</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $key => $category)
                                        <tr>


                                            <!--
                                            <th scope="row" tabindex="0" class="sorting_1" style="">
                                            <label class="form-label primary_checkbox d-flex me-12 ">
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                            </label>
                                            </th> -->

                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @can('category-edit')
                                                    <a href="{{route('admin.category.edit', ['id' =>$category->id])}}" class="btn btn btn-outline-success"><i class="ti-pencil-alt"></i></a>
                                                @endcan
                                                @can('category-delete')
                                                    <a href="{{route('admin.category.delete',['id' => $category->id])}}" class="btn btn btn-outline-danger"><i class="ti-trash"></i></a>
                                                @endcan

                                            </td>
                                            <!-- <td><a href="#" class="status_btn">Active</a></td> -->

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
