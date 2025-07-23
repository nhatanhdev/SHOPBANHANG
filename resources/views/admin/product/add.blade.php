@extends('layouts.admin')
@section('title')
<title>Sản Phẩm</title>
@endsection
@section('css')
<style>
    .select2-container .select2-search--inline .select2-search__field {
        margin-top: 10px !important;
    }
    .tox-tinymce{
        width: 100% !important;
    }
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
    .nice-select.is-invalid{
        border: 1px solid red !important
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
                            <h3 class="mb-0">Thêm Sản Phẩm Mới</h3>
                        </div>
                    </div>

                    <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text"
                             name ="name"
                             class="form-control @error('name') is-invalid @enderror"
                             value="{{old('name')}}"
                             placeholder="">
                            @error('name')
                            <div class="message-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Giá</label>
                            <input type="text"
                             name="price"
                             value="{{old('price')}}"

                             class="form-control @error('price') is-invalid @enderror"
                             placeholder="">
                             @error('price')
                             <div class="message-error">{{ $message }}</div>
                             @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Giá Cũ</label>
                            <input type="text"
                             name="price_old"
                             value="{{old('price_old')}}"

                             class="form-control"
                             placeholder="">

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            @error('category_id')
                            <div class="message-error mb-2">{{ $message }}</div>
                            @enderror
                            <select class="default_sel mb_30 w-100  @error('category_id') is-invalid @enderror" name="category_id" style="display: none;">

                                <option value="">Chọn Danh Mục</option>
                                {!! $htmlOption !!}
                            </select>

                        </div>
                        <div class="mb-3">
                            <label class="form-label" id="id_label_multiple">Thêm Biến Thể</label>
                            <select class="form-control select2attr" name="attrs[]" style="width: 100%" multiple="multiple">
                                @foreach ($Attributes as $item )
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="Attrs_children"></div>
                        <div class="table-container"></div>

                        <div class="mb-3">
                            <label class="form-label" id="id_label_multiple">Tags</label>
                            <select class="form-control select2" name="tags[]" style="width: 100%" multiple="multiple">
                            </select>
                        </div>
                        <label class="form-label mb-2 mt-2">Ảnh đặc trưng</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('feature_image') is-invalid @enderror" name="feature_image">
                        </div>
                        @error('feature_image')
                        <div class="message-error">{{ $message }}</div>
                    @enderror
                        <label class="form-label mb-2 mt-4">Ảnh chi tiết</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="detail_image[]" multiple>
                        </div>

                        <label class="form-label mb-2 mt-4">Mô tả</label>
                        <div class="input-group mb-3">
                            <textarea class="form-control my-editor " name="description" rows="15"> {{old('description')}}</textarea>
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
<script src="{{asset('adminlte\vendors\select2\js\select2.js')}}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        width: 'resolve',
        theme: "classic",
        placeholder: "Chose the tags",
        tokenSeparators: [',', ' '],
        tags: true

    });
    $('.select2attr').select2({
        width: 'resolve',
        theme: "classic",
        placeholder: "Chose the attrs",

    });
    $(".select2-selection--multiple").css("height", "40px");
    $(".select2-selection").css("height", "40px");

});

</script>
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

<script>
    var selectedValues = [];
$('.select2attr').change(function() {
    var id_parent = $(this).val();
    // Get the text of the selected option
    $.ajax({
        type: 'POST',
        url: '{{ route("admin.product.options") }}',
        data: {
            id: id_parent,
            _token: '{{ csrf_token() }}'
        },
        beforeSend: function() {
            $('.loading-js').show();
            },
        success: function(response) {
            var selectsHtml = '';
            // Loop through each item in response
            $.each(response.items, function(index, item) {
                var formHtml = '<label>' + item.name +'</label>';
                formHtml += '<select class="form-control select2child mb-3" name="select2child_' + id_parent + '"multiple="multiple>';
                // Add options
                $.each(item.attributes, function(index, attribute) {
                    formHtml += '<option value="' + attribute.id + '">' + attribute.name + '</option>';
                });
                formHtml += '</select>';
                selectsHtml += '<div class="mb-3">' + formHtml + '</div>';
            });
            $('.Attrs_children').html(selectsHtml);
            $('.select2child').select2({
                placeholder: 'Select a value',
                width: 'resolve',
                theme: "classic",
            });
            $(".select2-selection--multiple").css("height", "40px");
            $(".select2-selection").css("height", "40px");
        },
        error: function(xhr, status, error) {
            console.error('Failed to fetch child attributes:', error);
        },
        complete: function() {
            $('.loading-js').hide();
        }
    });
});
</script>
<script>
    $(document).ready(function() {
        // Event listener for change in .select2attr
        $('.select2attr').change(function() {
            var id_parent = $(this).val();

            // Ajax request to fetch child attributes
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.product.options") }}',
                data: {
                    id: id_parent,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    $('.loading-js').show();
                },
                success: function(response) {
                    var selectsHtml = '';
                    // Loop through each item in response
                    $.each(response.items, function(index, item) {
                        var formHtml = '<label>' + item.name + '</label>';
                        formHtml += '<select class="form-control select2child mb-3" name="select2child_' + id_parent + '[]" multiple="multiple">';
                        // Add options
                        $.each(item.attributes, function(index, attribute) {
                            formHtml += '<option value="' + attribute.id + '">' + attribute.name + '</option>';
                        });
                        formHtml += '</select>';
                        selectsHtml += '<div class="mb-3">' + formHtml + '</div>';
                    });
                    $('.Attrs_children').html(selectsHtml);

                    // Initialize Select2 for each new select element
                    $('.select2child').select2({
                        placeholder: 'Select a value',
                        width: 'resolve',
                        theme: "classic",
                    }).on('change', function() {
                        updateTable(); // Update table when select2child values change
                    });

                    // Initially update the table
                    updateTable();
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch child attributes:', error);
                },
                complete: function() {
                    $('.loading-js').hide();
                }
            });
        });

        // Function to update the table based on select2child values
        function updateTable() {
            var variants = [];
            var select2Children = $('.select2child');

            // Generate all possible combinations of selected values
            // console.log(select2Children)
            var combinations = generateCombinations(select2Children);
            // console.log(combinations)
            // Loop through combinations and create variants
            $.each(combinations, function(index, combination) {
                var variant = {};
                variant['Biến Thể'] = combination.label.join(', ') + '<input type="hidden" class="form-control" name="variants_children[]" value="' + combination.ids.join(',') + '">';
                variant['Trạng Thái (Kho)'] = '<input type="text" class="form-control" name="variants_status[]" value="1">';
                variant['Giá Cũ'] = '<input type="text" class="form-control" name="variants_price_old[]">';
                variant['Giá Mới'] = '<input type="text" class="form-control" name="variants_price[]">';
                variant['Ảnh'] = '<input type="file" class="form-control" name="variants_image_gallery[]" multiple>';
                variants.push(variant);


            });
            // console.log(variants)

            // Generate HTML for table
            var tableHtml = '<table class="table table-bordered">';
            tableHtml += '<thead><tr>';
            tableHtml += '<th>Biến Thể</th>';
            tableHtml += '<th>Trạng Thái (Kho)</th>';
            tableHtml += '<th>Giá Cũ</th>';
            tableHtml += '<th>Giá Mới</th>';
            tableHtml += '<th>Ảnh</th>';
            tableHtml += '</tr></thead>';
            tableHtml += '<tbody>';

            // Generate rows for each variant
            $.each(variants, function(i, variant) {
                tableHtml += '<tr>';
                tableHtml += '<td>' + variant['Biến Thể'] + '</td>';
                tableHtml += '<td>' + variant['Trạng Thái (Kho)'] + '</td>';
                tableHtml += '<td>' + variant['Giá Cũ'] + '</td>';
                tableHtml += '<td>' + variant['Giá Mới'] + '</td>';
                tableHtml += '<td>' + variant['Ảnh'] + '</td>';
                tableHtml += '</tr>';
            });

            tableHtml += '</tbody></table>';

            // Display generated table in .table-container
            $('.table-container').html(tableHtml);

            // Initialize Select2 for each new select element
            $('.select2child').select2({
                placeholder: 'Select a value',
                width: 'resolve',
                theme: "classic",
            });
        }

        // Function to generate all combinations of selected values
        function generateCombinations(select2Children) {
            var combinations = [];
            var currentArray = [];
            // Recursively generate combinations
            function generate(index) {

                if (index < select2Children.length) {

                    var options = $(select2Children[index]).val();
                    console.log(options)
                    if (options) {
                        $.each(options, function(i, option) {
                            currentArray[index] = option;
                            generate(index + 1);
                        });
                    } else {
                        generate(index + 1); // Continue even if no options selected
                    }
                } else {
                    // console.log(currentArray)
                    if (currentArray.length) {
                        var combination = {
                            label: currentArray.map(function(value, index) {
                                return $(select2Children[index]).find('option[value="' + value + '"]').text();
                            }),
                            ids: currentArray.slice(0) // clone array
                        };
                        combinations.push(combination);
                    }
                }
            }
            generate(0);
            // console.log(combinations)
            return combinations;

        }
    });
</script>





@endsection
