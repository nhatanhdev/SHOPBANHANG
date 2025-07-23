@extends('layouts.admin')
@section('title')
<title>Cài Đặt</title>
@endsection
@section('css')
<style>

    .nice-select.is-invalid{
        border: 1px solid red !important
    }
    input[type="checkbox"] {
        width: 13px;
        height: 13px;
    }

</style>
@endsection
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid plr_30 body_white_bg pt_30">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_box mb_30">
                    <div class="box_header ">
                        <div class="main-title">
                            <h3 class="mb-0">Sửa Cài Đặt</h3>
                        </div>
                    </div>

                    <form action="{{route('admin.setting.update',['id' => $setting->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Config key </label>
                            <input type="text"
                             name ="config_key"
                             class="form-control @error('config_key') is-invalid @enderror"
                             value="{{$setting->config_key}}"
                             placeholder="">
                            @error('config_key"')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Config value</label>
                            <textarea class="form-control my-editor @error('config_value') is-invalid @enderror" name="config_value" rows="4">{{$setting->config_value}}</textarea>
                            @error('config_value')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>
                          <button type="submit" class="btn_1 full_width text-center">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

<script src="{{asset('adminlte\vendors\tinymce\tinymce.min.js')}}"></script>
<script>
  var editor_config = {
    path_absolute : "/",
    selector: 'textarea.my-editor',
    relative_urls: false,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endsection
