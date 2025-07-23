@extends('layouts.admin')
@section('title')
<title>Slider</title>
@endsection
@section('css')
<style>
    .message-error{
        margin-top: 5px !important;
        color:red;
        font-size: 12px;
    }
    .message-error{
        margin-top: 5px !important;
        color:red;
        font-size: 12px;
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
                            <h3 class="mb-0">Thêm Slider</h3>
                        </div>
                    </div>

                    <form action="{{route('admin.slider.store')}}" method="post" enctype="multipart/form-data">
                        @csrf


                        <div class="mb-3">
                            <label class="form-label">Tiêu Đề</label>
                            <textarea  id="text_editor" class="form-control  @error('title') is-invalid @enderror" name="title" rows="4">{{old('title')}}</textarea>
                            @error('title')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>


                        <label class="form-label mb-2 mt-2">Ảnh slider</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                        </div>
                        @error('image')
                        <div class="message-error">{{ $message }}</div>
                        @enderror
                        <div class="mb-3 mt-3">
                            <label class="form-label">Đường Dẫn  </label>
                            <input type="text"
                             name ="url"
                             class="form-control @error('url') is-invalid @enderror"
                             value="{{old('url')}}"
                             placeholder="">
                            @error('url')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>

                          <button type="submit" class="btn_1 full_width text-center">Thêm</button>
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
    selector: '#text_editor',
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
