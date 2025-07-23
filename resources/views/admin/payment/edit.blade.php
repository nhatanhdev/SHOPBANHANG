<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditLabel">Sửa Phương Thức Thanh Toán</h5>
          <button type="button" class="close X_close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.payment.update',['id' =>$payment->id])}}" method="post">
        <div class="modal-body">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Phương Thức Thanh Toán <span style="color: red">*</span></label>
                    <input type="text"
                     name ="payment"
                     class="form-control"
                     value="{{$payment->name}}"
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
