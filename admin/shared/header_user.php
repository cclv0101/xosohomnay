
<nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav py-0">
    <div class="float-left pl-3">
        <div class="button-title mr-5">
            <span class="text-truncate-1">
            <?=$link_title_back?"<a class='text-primary' href='$link_title_back'>$title_back</a> / ":""?> <?=$title??""?> <span id="sub_title"></span></span>
        </div>
        <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fas fa-bars"></i></a>
    </div>
    <ul class="nav navbar-nav nav-flex-icons ml-auto">
        <li class="nav-item my-2 dropdown">
            <a class="nav-link dropdown-toggle waves-effect py-0" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img onerror='this.style.display=`none`'class="rounded-circle" src="<?= URL_PUBLIC ?>/users/<?= $auth['user_username'].'/avatar.webp?v='.time() ?>" style="width: 35px; height: 35px;">
                <span class="clearfix d-none d-sm-inline-block"><?= $auth['user_fullname'] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= URL_DOMAIN . '/admin/auth/profile' . URL_FOOT ?>">
                    <i class="fas fa-user-md"></i> Trang cá nhân
                </a>
                <a class="dropdown-item" href="<?= URL_DOMAIN . '/admin/auth/repass' . URL_FOOT ?>">
                    <i class="fas fa-lock"></i> Đổi mật khẩu
                </a>
                <a class="dropdown-item" onclick="logoutSubmit(this)">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a>
            </div>
        </li>
    </ul>
</nav>
<script>
function logoutSubmit(t) {
    $(t).html("<i class='spinner-border spinner-border-sm'></i>");
    toastr.info("Đăng xuất khỏi trình duyệt...");
    $.ajax({
        type: "POST",
        url: "<?= URL_DOMAIN ?>/admin/auth/logout<?= URL_FOOT ?>",
        success: function(data) {
            if (data.toString() === "success") {
                setTimeout(function() {
                    location.reload();
                }, 500);
            } else {
                toastr.error("Có lỗi xảy ra vui lòng thử lại");
            }
        },
    });
}
</script>