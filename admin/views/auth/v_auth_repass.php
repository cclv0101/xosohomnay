<div class="mt-2">
    <div class="row pt-5 flex-center-center">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <h4 class="card-header primary-color text-center white-text"><?= $title ?? null ?></h4>
                <div class="card-body">
                    <div class="md-form md-outline">
                        <input type="password" id="password0" class="form-control">
                        <label class="active" for="password0">Mật khẩu cũ</label>
                    </div>
                    <div class="md-form md-outline">
                        <input type="password" id="password1" class="form-control">
                        <label class="active" for="password1">Mật khẩu mới</label>
                    </div>
                    <div class="md-form md-outline">
                        <input type="password" id="password2" class="form-control">
                        <label class="active" for="password2">Xác nhận mật khẩu</label>
                    </div>
                    <div class="flex-center">
                        <button type="button" class="btn btn-primary" onclick="submit(this)">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submit(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        var val_oldpass = $('#password0').val();
        var val_pass1 = $('#password1').val();
        var val_pass2 = $('#password2').val();
        if (val_pass1 === val_oldpass) {
            toastr.warning("Mật khẩu mới phải khác với mật khẩu cũ");
        } else if (val_pass2 !== val_pass1) {
            toastr.warning("Mật khẩu mới nhập lại không khớp");
        } else {
            $.ajax({
                type: 'POST',
                url: $(location).attr('href'),
                data: {
                    oldpass: val_oldpass,
                    pass1: val_pass1,
                    pass2: val_pass2
                },
                success: function(data) {
                    if (data.toString() === "success") {
                        toastr.success('Đã cập nhật thành công');
                    } else {
                        toastr.error(data.toString());
                    }
                }
            });
        }
        $(t).removeAttr('disabled');
        $(t).html("Cập nhật");
    }
</script>