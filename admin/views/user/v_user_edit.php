<main>
    <div class="mt-2">
        <div class="row">
            <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                    <h4 class="card-header primary-color text-center white-text"><?= $title ?? null ?></h4>
                    <div class="card-body">
                        <div class="profile-avatar preview_avatar text-center">
                            <img onerror='this.style.display=`none`'id="preview_avatar" src="<?= URL_PUBLIC ?>/users/<?= $user['user_username'] ?>/avatar.webp" class="rounded-circle" alt="<?= $user['user_fullname'] ?>" style="width: 120px;">
                        </div>
                        <div class="list-group list-panel">
                            <span class="list-group-item d-flex justify-content-between dark-grey-text p-2">
                                ID Code: <b><?= base64_encode($user['user_username']) ?></b>
                            </span>
                            <span class="list-group-item d-flex justify-content-between dark-grey-text p-2">
                                Tài khoản: <b><?= $user['user_username'] ?></b>
                            </span>
                            <span class="list-group-item d-flex justify-content-between dark-grey-text p-2">
                                Họ và tên: <b><?= $user['user_fullname'] ?></b>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-12">
                <div class="card">
                    <h4 class="card-header primary-color text-center white-text"><?= $title ?? null ?></h4>
                    <div class="card-body">
                        <div class="md-form md-outline">
                            <input type="text" id="username" value="<?= $user['user_username'] ?>" class="form-control" disabled>
                            <label class="active" for="username">Tài khoản: </label>
                        </div>
                        <div class="md-form md-outline">
                            <select id="type" class="form-control">
                                <option value="0" <?= $user['user_type']==0?'selected':'' ?>>Kỹ thuật viên</option>
                                <option value="1" <?= $user['user_type']==1?'selected':'' ?>>Quản trị viên</option>
                                <option value="2" <?= $user['user_type']==2?'selected':'' ?>>Người kiểm duyệt</option>
                                <option value="3" <?= $user['user_type']==3?'selected':'' ?>>Người đăng bài</option>
                            </select>
                            <label class="active" for="type">Loại tài khoản:</label>
                        </div>
                        <div class="md-form md-outline">
                            <input type="text" id="fullname" value="<?= $user['user_fullname'] ?>" class="form-control">
                            <label class="active" for="fullname">Họ và tên:</label>
                        </div>
                        <div class="md-form md-outline">
                            <input type="text" id="password" value="" class="form-control">
                            <label class="active" for="password">Mật khẩu (bỏ trống nếu k đổi):</label>
                        </div>
                        <div class="md-form md-outline">
                            <input type="file" id="avatar" class="form-control" onchange="uploadAvatar(this)">
                            <label class="active" for="avatar">Ảnh bìa</label>
                        </div>
                        <span class="" id="file_log"></span>
                        <div class="text-center mt-3">
                            <button class="btn btn-primary" onclick="submit(this)">
                                Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function submit(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        var username = $("#username").val();
        var fullname = $("#fullname").val();
        var password = $("#password").val();
        var type = $("#type").val();
        if(fullname.length<6){
            toastr.warning("Vui lòng nhập họ tên đầy đủ");
        }else{
            $.ajax({
                type: 'POST',
                url: $(location).attr('href'),
                data: {
                    username: username,
                    fullname: fullname,
                    password: password,
                    type: type
                },
                success: function(data) {
                    if (data.toString() === "success") {
                        toastr.success("Đã lưu thành công");
                    } else {
                        toastr.error("Lưu không thành công");
                    }
                }
            });
        }
        $(t).removeAttr('disabled');
        $(t).html("Cập nhật");
    }
    async function uploadAvatar(t) {
        $(t).attr('disabled','disabled');
        let preview_avatar = $("#preview_avatar").attr("src");
        $(".preview_avatar").html("<i class='spinner-border spinner-border-sm'></i>");
        var avatar = $('#avatar').prop('files')[0]; 
        let form_data = new FormData();
        form_data.append("avatar", avatar);
        form_data.append("username", $('#username').val());
        await $.ajax({
            url: $(location).attr('href'),
            method: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.toString() === "success") {
                    toastr.success("Cập nhật thành công");
                    setTimeout(() => {
                        $(".preview_avatar").html("<img onerror='this.style.display=`none`'id='preview_avatar' src='"+preview_avatar+"?time="+new Date()+"' class='rounded-circle' style='width: 120px;'>");
                    }, 200);
                } else {
                    $('#file_log').html("Định dạng hình là PNG");
                    toastr.error("Cập nhật không thành công");
                }
            }
        });
        $(t).removeAttr('disabled');
    }
</script>