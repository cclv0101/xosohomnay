<main>
    <div class="box row flex-center-center m-2">
        <div class="col-md-3 col-6 px-1">
            <div class="md-form md-outline">
                <select class="form-control" id="search_searvice_stt" onchange="updateValueSearch(this.value)">
                    <option value="Trang thai: 3" selected>Thùng rác</option>
                </select>
                <label class="active" for="search_searvice_stt">Trạng thái:</label>
            </div>
        </div>
        <div class="col-md-3 col-6 px-1">
            <div class="md-form md-outline">
                <select class="form-control" id="txt_filter_auth" onchange="updateValueSearch(this.value)">
                    <option value="">Chọn tất cả</option>
                    <?php foreach($list_user as $user):?>
                        <option value="Tac gia: #<?= $user['user_id'] ?>"><?= $user['user_fullname'] ?></option>
                    <?php endforeach;?>
                <select>
                <label class="active" for="txt_filter_auth">Tác giả:</label>
            </div>
        </div>
        <div class="col-md-3 col-8 px-1">
            <div class="md-form md-outline">
                <input id="txt_search" onkeyup="updateValueSearch(this.value)" type="text" class="form-control" value=" " />
                <label class="active" for="txt_search">Tìm kiếm:</label>
            </div>
        </div>
        <div class="col-md-3 col-4 px-1">
            <a href="<?= URL_DOMAIN.'/admin/service/list'.URL_FOOT ?>" class="btn btn-primary m-0"><i class="fas fa-newspaper"></i> <span class="clearfix d-none d-sm-inline-block"> Danh sách</span></a>
            <a href="<?= URL_DOMAIN.'/admin/service/trashlist'.URL_FOOT ?>" class="btn btn-danger m-0"><i class="fas fa-trash"></i> <span class="clearfix d-none d-sm-inline-block"> Dọn rác</span></a>
        </div>
    </div>
    <div id="listdata" class="box m-2">
        <div class="flex-center-center my-5 py-5">
            <span class="spinner-border text-primary p-3"></span>
        </div>
    </div>
</main>
<div class="modal fade" id="confirmRestore" tabindex="-1" role="dialog" aria-labelledby="myconfirmRestore" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="heading">
                    <b>Xác nhận khôi phục dịch vụ?</b>
                </div>
            </div>
            <div class="scroll-y">
                <div class="view overlay">
                    <img onerror='this.style.display=`none`'id="restore_review_image" src="" class="card-img-top" alt="<?=OS_NAME?>">
                </div>
                <div class="px-3 py-2">
                    <p id="restore_review_id" hidden></p>
                    <h4 class="card-title" id="restore_review_title"></h4>
                    <p class="card-text" id="restore_review_description"></p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-success" onclick="restoreServiceOk(this)"><b>Đồng ý</b></a>
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="myConfirmTrash" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="heading">
                    <b>Xác nhận xoá dịch vụ?</b>
                </div>
            </div>
            <div class="scroll-y">
                <div class="view overlay">
                    <img onerror='this.style.display=`none`'id="trash_review_image" src="" class="card-img-top" alt="<?=OS_NAME?>">
                </div>
                <div class="px-3 py-2">
                    <p id="trash_review_id" hidden></p>
                    <h4 class="card-title" id="trash_review_title"></h4>
                    <p class="card-text" id="trash_review_description"></p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-danger" onclick="deleteServiceOk(this)"><b>Đồng ý</b></a>
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</a>
            </div>
        </div>
    </div>
</div>
<script>
    const listdata = $("#listdata").html();
    $(document).ready(function() {
        loadListData();
        $('#txt_filter_auth').select2();
        $('#search_searvice_stt').select2();
        onPageLoadReady();
    });

    function onPageLoadReady(){
        let service_keyword = localStorage.getItem("service_keyword");
        $("#txt_search").val(service_keyword);
        $("#txt_filter_auth option").each(function()
        {
            if(this.value==service_keyword){
                this.selected = true;
                $('#select2-txt_filter_auth-container').text(this.text);
            }
        });
        $("#txt_filter_cate option").each(function()
        {
            if(this.value==service_keyword){
                this.selected = true;
                $('#select2-txt_filter_cate-container').text(service_keyword);
            }
        });
    }

    function loadListData() {
        $("#listdata").html(listdata);
        var current_page = localStorage.getItem("service_current_page");
        var sort_name = localStorage.getItem("service_sort_name");
        var sort_by = localStorage.getItem("service_sort_by");
        var keyword = localStorage.getItem("service_keyword");
        $.ajax({
            type: 'POST',
            url: $(location).attr('href'),
            data: {
                action: 'listdata',
                current_page: current_page,
                sort_name: sort_name,
                sort_by: sort_by,
                keyword: keyword
            },
            success: function(data) {
                if (data.toString() == "empty") {
                    var key = "";
                    if (keyword != "") {
                        key = " cho kết quả <cite>" + keyword + "</cite>";
                    }
                    $("#listdata").html("<p class='note note-warning m-5'><strong>Thông báo:</strong> Không có dịch vụ nào " + key + "</p>");
                } else {
                    $("#listdata").html(data.toString());
                    updateUser();
                    updateTimed();
                }
            },
        });
    }

    function restoreService(id) {
        $("#restore_review_id").text(id);
        $("#restore_review_title").text($("#service_title_"+id).text());
        $("#restore_review_description").text($("#service_desc_"+id).text());
        $("#restore_review_image").attr("src", $("#service_image_"+id).attr("src"));
    }

    function restoreServiceOk(t) {
        $(t).attr('disabled','disabled');
        $(t).text('Đang xóa');
        var id = $("#restore_review_id").text();
        $.ajax({
            type: 'POST',
            url: $(location).attr('href'),
            data: {
                action: 'restore',
                id: id
            },
            success: function(data) {
                if (data.toString() == "success") {
                    toastr.success("Đã khôi phục dịch vụ");
                    $('#confirmRestore').modal('toggle'); 
                    loadListData();
                } else {
                    toastr.error(data.toString());
                }
            },
        });
        $(t).text('Đồng ý');
        $(t).removeAttr('disabled');
    }

    function deleteService(id) {
        $("#trash_review_id").text(id);
        $("#trash_review_title").text($("#service_title_"+id).text());
        $("#trash_review_description").text($("#service_desc_"+id).text());
        $("#trash_review_image").attr("src", $("#service_image_"+id).attr("src"));
    }

    function deleteServiceOk(t) {
        $(t).attr('disabled','disabled');
        $(t).text('Đang xóa');
        var id = $("#trash_review_id").text();
        $.ajax({
            type: 'POST',
            url: $(location).attr('href'),
            data: {
                action: 'delete',
                id: id
            },
            success: function(data) {
                if (data.toString() == "success") {
                    toastr.success("Đã xóa vĩnh viễn");
                    $('#confirmDelete').modal('toggle'); 
                    loadListData();
                } else {
                    toastr.error(data.toString());
                }
            },
        });
        $(t).text('Đồng ý');
        $(t).removeAttr('disabled');
    }

    function updateValueSearch(value) {
        var my_value = localStorage.getItem("service_keyword");
        $("#txt_search").val(value);
        if (my_value != value) {
            localStorage.setItem("service_current_page", "1");
            localStorage.setItem("service_keyword", value);
            loadListData();
            $('#txt_search').val(value);
        }
    }

    function updateValue(name, value) {
        var my_value = localStorage.getItem(name);
        if (my_value != value) {
            localStorage.setItem(name, value);
            loadListData();
        }
    }

    function clickSort(name) {
        var val_name = localStorage.getItem("service_sort_name");
        var val_by = 'DESC';
        if (val_name == name) {
            val_by = localStorage.getItem("service_sort_by");
            if (val_by == 'DESC') {
                val_by = 'ASC';
            } else {
                val_by = 'DESC';
            }
        } else {
            localStorage.setItem("service_sort_name", name);
        }
        localStorage.setItem("service_sort_by", val_by);
        loadListData();
    }

    function updateUser() {
        <?php foreach ($list_user as $user) : ?>
            $(".user_<?= md5($user['user_id']); ?>").text("<?= $user['user_fullname']; ?>");
        <?php endforeach; ?>
    }
</script> 