<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditLabel">Sửa Thành Phố</h5>
          <button type="button" class="close X_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.infrastructureCity.update',['id' =>$city->id])}}" method="post">
        <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Thành Phố <span style="color: red">*</span></label>
                    <input type="text"
                     name ="name"
                     class="form-control"
                     value="{{$city->name}}"
                     placeholder="" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" >Kinh Độ<span style="color: red">*</span></label>
                    <input type="text"
                     name ="lat"
                     class="form-control"
                     value="{{$city->lat}}"
                     placeholder="" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" >Vĩ Độ<span style="color: red">*</span></label>
                    <input type="text"
                     name ="long"
                     class="form-control"
                     value="{{$city->long}}"
                     placeholder="" required>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary X_close text-center" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary text-center">Lưu Thay Đổi</button>
        </div>
        </form>

      </div>
    </div>
  </div>
<script>
    $('.X_close').on('click',function(){
    $('#modalEdit').modal('hide');
});
</script>
