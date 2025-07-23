<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="min-height:900px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddLabel">Thuộc Tính Mới</h5>
          <button type="button" class="close X_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.attribute.store')}}" method="post">
            <div class="modal-body">
                @csrf
               <div class="row">
                <div class="mb-3 col-sm-6">
                    <label class="form-label" >Thuộc Tính <span style="color: red">*</span></label>
                    <input type="text"
                     name ="name_attribute"
                     class="form-control"
                     placeholder="" required>
                </div>
                <div class="mb-3 col-sm-6">
                    <label class="form-label" >Thứ Tự <span style="color: red">*</span></label>
                    <input type="text"
                     name ="rank"
                     class="form-control"
                     placeholder="" required>
                </div>
                <input type="hidden" name="parent_id" value="{{$attribute->id}}">
               </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary X_close text-center" data-dismiss="modal">Đóng</button>
            <button type="submit" class="btn btn-primary text-center">Lưu</button>
        </div>
        </form>

      </div>
    </div>
  </div>
