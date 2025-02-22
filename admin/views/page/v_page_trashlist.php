<main>
    <div class="box row flex-center-center m-2">
        <div class="col-md-4 col-8 px-1">
            <div class="md-form md-outline">
                <input id="txt_search" onkeyup="updateValueSearch(this.value)" type="text" class="form-control" value=" " />
                <label class="active" for="txt_search">Tìm kiếm:</label>
            </div>
        </div>
        <div class="col-md-8 col-6 px-1">
            <a href="<?= URL_DOMAIN.'/admin/page/list'.URL_FOOT ?>" class="btn btn-primary m-0"><i class="fas fa-newspaper"></i> <span class="clearfix d-none d-sm-inline-block">Các Trang</span></a>
            <a href="<?= URL_DOMAIN.'/admin/page/trashlist'.URL_FOOT ?>" class="btn btn-danger m-0"><i class="fas fa-trash"></i> <span class="clearfix d-none d-sm-inline-block"> Dọn rác</span></a>
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
                    <b>Xác nhận khôi phục trang?</b>
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
                <a type="button" class="btn btn-success" onclick="restorePageOk(this)"><b>Đồng ý</b></a>
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
                    <b>Xác nhận xoá trang?</b>
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
                <a type="button" class="btn btn-danger" onclick="deletePageOk(this)"><b>Đồng ý</b></a>
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
        $('#txt_filter_cate').select2();
        onPageLoadReady();
    });

    function onPageLoadReady(){
        let page_keyword = localStorage.getItem("page_keyword");
        $("#txt_search").val(page_keyword);
        $("#txt_filter_auth option").each(function()
        {
            if(this.value==page_keyword){
                this.selected = true;
                $('#select2-txt_filter_auth-container').text(this.text);
            }
        });
        $("#txt_filter_cate option").each(function()
        {
            if(this.value==page_keyword){
                this.selected = true;
                $('#select2-txt_filter_cate-container').text(page_keyword);
            }
        });
    }

    function loadListData() {
        $("#listdata").html(listdata);
        var current_page = localStorage.getItem("page_current_page");
        var sort_name = localStorage.getItem("page_sort_name");
        var sort_by = localStorage.getItem("page_sort_by");
        var keyword = localStorage.getItem("page_keyword");
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
                    $("#listdata").html("<p class='note note-warning m-5'><strong>Thông báo:</strong> Không có trang nào " + key + "</p>");
                } else {
                    $("#listdata").html(data.toString());
                    updateTimed();
                }
            },
        });
    }

    function restorePage(id) {
        $("#restore_review_id").text(id);
        $("#restore_review_title").text($("#page_title_"+id).text());
        $("#restore_review_description").text($("#page_desc_"+id).text());
        $("#restore_review_image").attr("src", $("#page_image_"+id).attr("src"));
    }

    function restorePageOk(t) {
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
                    toastr.success("Đã khôi phục trang");
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

    function deletePage(id) {
        $("#trash_review_id").text(id);
        $("#trash_review_title").text($("#page_title_"+id).text());
        $("#trash_review_description").text($("#page_desc_"+id).text());
        $("#trash_review_image").attr("src", $("#page_image_"+id).attr("src"));
    }

    function deletePageOk(t) {
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
        var my_value = localStorage.getItem("page_keyword");
        $("#txt_search").val(value);
        if (my_value != value) {
            localStorage.setItem("page_current_page", "1");
            localStorage.setItem("page_keyword", value);
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
        var val_name = localStorage.getItem("page_sort_name");
        var val_by = 'DESC';
        if (val_name == name) {
            val_by = localStorage.getItem("page_sort_by");
            if (val_by == 'DESC') {
                val_by = 'ASC';
            } else {
                val_by = 'DESC';
            }
        } else {
            localStorage.setItem("page_sort_name", name);
        }
        localStorage.setItem("page_sort_by", val_by);
        loadListData();
    }
</script> 