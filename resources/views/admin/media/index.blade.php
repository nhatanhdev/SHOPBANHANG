
@extends('layouts.admin')
@section('title')
<title>File</title>
@endsection
@section('content')
<div class="main_content_iner ">
            <div class="container-fluid plr_30 body_white_bg pt_30">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4> File </h4>
                            </div>
                            <div class="QA_table ">
                                <iframe src="{{ url('laravel-filemanager') }}" style="width: 100%; height: 81vh; overflow: hidden; border: none;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

