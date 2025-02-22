<main>
    <div class="mt-2">
        <div class="row">
            <div class="col-xl-4 col-md-12 mb-2">
                <div class="card">
                    <h4 class="card-header primary-color text-center white-text"><?= $title ?? null ?></h4>
                    <div class="card-body">
                        <div class="profile-avatar preview_avatar text-center">
                            <img onerror='this.style.display=`none`'id="preview_avatar" src="<?= URL_PUBLIC ?>/users/<?= $auth['user_username'].'/avatar.webp?v='.time() ?>" class="rounded-circle" alt="<?= $auth['user_fullname'] ?>" style="width: 120px;">
                        </div>
                        <div class="list-group list-panel">
                            <span class="list-group-item d-flex justify-content-between dark-grey-text p-2">
                                ID Code: <b><?= base64_encode($auth['user_username']) ?></b>
                            </span>
                            <span class="list-group-item d-flex justify-content-between dark-grey-text p-2">
                                Tài khoản: <b><?= $auth['user_username'] ?></b>
                            </span>
                            <span class="list-group-item d-flex justify-content-between dark-grey-text p-2">
                                Họ và tên: <b><?= $auth['user_fullname'] ?></b>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-12">
                <div class="card">
                    <h4 class="card-header primary-color text-center white-text"><?= $title ?? null ?></h4>
                    <div class="card-body">
                        <input type="text" id="id" value="<?= $auth['user_id'] ?>" hidden>
                        <div class="md-form md-outline">
                            <input type="text" id="username" value="<?= $auth['user_username'] ?>" class="form-control" disabled>
                            <label class="active" for="username">Tài khoản: </label>
                        </div>
                        <div class="md-form md-outline">
                            <input type="text" id="fullname" value="<?= $auth['user_fullname'] ?>" class="form-control">
                            <label class="active" for="fullname">Họ và tên:</label>
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
    async function submit(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        var fullname = $("#fullname").val();
        if(fullname.length<6){
            toastr.warning("Vui lòng nhập họ tên đầy đủ");
        }else{
            await $.ajax({
                type: 'POST',
                url: $(location).attr('href'),
                data: {
                    fullname: fullname
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