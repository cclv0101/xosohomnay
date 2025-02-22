<div class="mt-2">
    <div class="text-center profile-card">
        <div class="avatar z-depth-1-half">
            <img onerror='this.style.display=`none`' src="<?= URL_PUBLIC.'/favicon.ico/avatar.webp?v='.time() ?>" class="rounded-circle img-fluid" style="object-fit: cover;width: 150px;height: 150px;" alt="<?= OS_NAME ?>">
        </div>
    </div>
    <div class="row mt-5 flex-center-center">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <h4 class="card-header primary-color text-center white-text"><?= $title ?? null ?></h4>
                <div class="card-body">
                    <div class="md-form md-outline md-outline">
                        <input type="text" id="usernameLogin" class="form-control" />
                        <label class="active" for="usernameLogin">Tài khoản:</label>
                    </div>
                    <div class="md-form md-outline md-outline">
                        <input type="password" id="passwordLogin" class="form-control" />
                        <label class="active" for="passwordLogin">Mật khẩu:</label>
                    </div>
                    <button onclick="submit(this)" class="btn btn-primary btn-block">Đăng nhập</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    async function submit(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        var username = $("#usernameLogin").val();
        var password = $("#passwordLogin").val();
        var captcha = $("#captcha").val();
        if(username.length<2){
            toastr.warning("Vui lòng nhập tài khoản");
        }else if(password.length<2){
            toastr.warning("Vui lòng nhập mật khẩu");
        }else{
            await $.ajax({
                type: "POST",
                url: $(location).attr('href'),
                data: {
                    username: username,
                    password: password,
                    captcha: captcha
                },
                success: function(data) {
                    if (data.toString() === "notcaptcha") {
                        toastr.warning("Mã captcha không đúng");
                    } else if (data.toString() === "success") {
                        toastr.success("Đang nhập thành công");
                        location.reload();
                    } else {
                        toastr.error("Sai tài khoản hoặc mật khẩu");
                    }
                },
            });
        }
        $(t).removeAttr('disabled');
        $(t).html('Đăng nhập');
    }

</script>