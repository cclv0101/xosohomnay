<main>
    <div class="m-2">
        <div class="text-center">
            <a class="btn btn-primary mx-md-2 mx-0 my-1" onclick="loadListData(1,this)"><i class="fa fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Hoạt động</span></a>
            <a class="btn btn-secondary mx-md-2 mx-0 my-1" onclick="loadListData(0,this)"><i class="fa fa-lock"></i> <span class="clearfix d-none d-sm-inline-block">Tạm ngưng</span></a>
            <a class="btn btn-warning mx-md-2 mx-0 my-1" onclick="loadListData(2,this)"><i class="fa fa-paper-plane"></i> <span class="clearfix d-none d-sm-inline-block">Bản nháp</span></a>
            <a class="btn btn-danger mx-md-2 mx-0 my-1" onclick="loadListData(3,this)"><i class="fa fa-trash"></i> <span class="clearfix d-none d-sm-inline-block">Đã xóa</span></a>
            <a class="btn btn-success mx-md-2 mx-0 my-1" data-toggle="modal" data-target="#modalCreate"><i class="fa fa-plus"></i> <span class="clearfix d-none d-sm-inline-block"> Thêm mới</span></a>
        </div>
        <div id="listdata" class="m-0">
            <div class="flex-center-center my-5 py-5">
                <i class='spinner-border spinner-border'></i>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        loadListData(1);
    });

    async function loadListData(stt, t='') {
        $("#listdata").html("<div class='flex-center-center my-5 py-5'><i class='spinner-border spinner-border'></i></div>");
        $("#sub_title").text($(t).text());
        await $.ajax({
            type: "POST",
            url: $(location).attr('href'),
            data: {
                action: 'listdata',
                stt: stt
            },
            success: function(data) {
                if (data.toString() === "empty") {
                    $("#listdata").html("<p class='note note-warning m-5'><strong>Thông báo:</strong> Không có dữ liệu</p>");
                } else {
                    $("#listdata").html(data.toString());
                    updateTimed();
                }
            }
        });
    }

    function modalAction(t, id, fullname, avartar, username) {
        $("#modal_review_stt").text(t);
        if(t==0){
            $("#modal_class").addClass('modal-secondary').removeClass('modal-primary').removeClass('modal-warning').removeClass('modal-danger');
            $("#btn_class").addClass('btn-secondary').removeClass('btn-primary').removeClass('btn-warning').removeClass('btn-danger');
            $("#modal_review_avartar").addClass('rounded-circle-secondary').removeClass('rounded-circle-primary').removeClass('rounded-circle-warning').removeClass('rounded-circle-danger');
            $("#modal_review_username").addClass('text-secondary').removeClass('text-primary').removeClass('text-warning').removeClass('text-danger');
            $("#modal_review_action").text('Tạm ngưng');
        }else if(t==1){
            $("#modal_class").removeClass('modal-secondary').addClass('modal-primary').removeClass('modal-warning').removeClass('modal-danger');
            $("#btn_class").removeClass('btn-secondary').addClass('btn-primary').removeClass('btn-warning').removeClass('btn-danger');
            $("#modal_review_avartar").removeClass('rounded-circle-secondary').addClass('rounded-circle-primary').removeClass('rounded-circle-warning').removeClass('rounded-circle-danger');
            $("#modal_review_username").removeClass('text-secondary').addClass('text-primary').removeClass('text-warning').removeClass('text-danger');
            $("#modal_review_action").text('Hoạt động');
        }else if(t==2){
            $("#modal_class").removeClass('modal-secondary').removeClass('modal-primary').addClass('modal-warning').removeClass('modal-danger');
            $("#btn_class").removeClass('btn-secondary').removeClass('btn-primary').addClass('btn-warning').removeClass('btn-danger');
            $("#modal_review_avartar").removeClass('rounded-circle-secondary').removeClass('rounded-circle-primary').addClass('rounded-circle-warning').removeClass('rounded-circle-danger');
            $("#modal_review_username").removeClass('text-secondary').removeClass('text-primary').addClass('text-warning').removeClass('text-danger');
            $("#modal_review_action").text('Soạn thảo');
        }else if(t==3){
            $("#modal_class").removeClass('modal-secondary').removeClass('modal-primary').removeClass('modal-warning').addClass('modal-danger');
            $("#btn_class").removeClass('btn-secondary').removeClass('btn-primary').removeClass('btn-warning').addClass('btn-danger');
            $("#modal_review_avartar").removeClass('rounded-circle-secondary').removeClass('rounded-circle-primary').removeClass('rounded-circle-warning').addClass('rounded-circle-danger');
            $("#modal_review_username").removeClass('text-secondary').removeClass('text-primary').removeClass('text-warning').addClass('text-danger');
            $("#modal_review_action").text('Thùng rác');
        }else if(t==4){
            $("#modal_class").removeClass('modal-secondary').removeClass('modal-primary').removeClass('modal-warning').addClass('modal-danger');
            $("#btn_class").removeClass('btn-secondary').removeClass('btn-primary').removeClass('btn-warning').addClass('btn-danger');
            $("#modal_review_avartar").removeClass('rounded-circle-secondary').removeClass('rounded-circle-primary').removeClass('rounded-circle-warning').addClass('rounded-circle-danger');
            $("#modal_review_username").removeClass('text-secondary').removeClass('text-primary').removeClass('text-warning').addClass('text-danger');
            $("#modal_review_action").text('Xóa vĩnh viễn');
        }
        $("#modal_review_id").text(id);
        $("#modal_review_fullname").text(fullname);
        $("#modal_review_username").text(username);
        $("#modal_review_avartar").attr('src', avartar);
    }

    async function modalActionOK(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        let user_id = $("#modal_review_id").text();
        let user_stt = $("#modal_review_stt").text();
        await $.ajax({
            type: "POST",
            url: $(location).attr('href'),
            data: {
                action: 'action',
                user_id: user_id,
                user_stt: user_stt
            },
            success: function(data) {
                if (data.toString() == "success") {
                    toastr.success("Đã lưu cập nhật");
                    loadListData(user_stt);
                } else {
                    toastr.error('Có lỗi xảy ra');
                }
            }
        });
        $(t).removeAttr('disabled');
        $(t).html('Đồng ý');
    }
    function submitCreate(t) {
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
                    action: 'create',
                    username: username,
                    fullname: fullname,
                    password: password,
                    type: type
                },
                success: function(data) {
                    if (data.toString() === "success") {
                        toastr.success("Tạo mới thành công");
                    } else {
                        toastr.error("Tạo mới thành công");
                    }
                }
            });
        }
        $(t).removeAttr('disabled');
        $(t).html("Tạo mới");
    }
</script>
<div class="modal fade" id="modalAction" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify" id="modal_class" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead"><span id="modal_review_action"></span> tài khoản</p>
                <span id="modal_review_stt" hidden></span>
                <span id="modal_review_id" hidden></span>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img onerror='this.style.display=`none`'id="modal_review_avartar" class="rounded-circle img-fluid" style="height: 110px;">
                <h4 id="modal_review_fullname" class="card-title dark-grey-text"></h4>
                <h6 id="modal_review_username" class="card-text text-primary"></h6>
            </div>
            <div class="modal-footer justify-content-center">
                <a class="btn btn-primary" id="btn_class" onclick="modalActionOK(this)" data-dismiss="modal">Đồng ý</a>
                <a class="btn btn-outline-secondary" data-dismiss="modal">Đóng</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead">Tạo mới tài khoản</p>
            </div>
            <div class="modal-body text-center">
                <div class="md-form md-outline">
                    <input type="text" id="username" value="" class="form-control">
                    <label class="active" for="username">Tài khoản: </label>
                </div>
                <div class="md-form md-outline">
                    <select id="type" class="form-control">
                        <option value="0">Kỹ thuật viên</option>
                        <option value="1">Quản trị viên</option>
                        <option value="2">Người kiểm duyệt</option>
                        <option value="3">Người đăng bài</option>
                    </select>
                    <label class="active" for="type">Loại tài khoản:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="fullname" value="" class="form-control">
                    <label class="active" for="fullname">Họ và tên:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="password" value="" class="form-control">
                    <label class="active" for="password">Mật khẩu:</label>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <a class="btn btn-success" onclick="submitCreate(this)"><i class="fas fa-save"></i> Tạo mới tài khoản</a>
            </div>
        </div>
    </div>
</div>