<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddLabel">Thêm</h5>
          <button type="button" class="close X_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.infrastructureDistrict.store')}}" method="post">
            <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label class="form-label" >Tên<span style="color: red">*</span></label>
                    <input type="text"
                     name ="name"
                     class="form-control"
                     placeholder="" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" >Kinh Độ<span style="color: red">*</span></label>
                    <input type="text"
                     name ="lat"
                     class="form-control"
                     placeholder="" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" >Vĩ Độ<span style="color: red">*</span></label>
                    <input type="text"
                     name ="long"
                     class="form-control"
                     placeholder="" required>
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
