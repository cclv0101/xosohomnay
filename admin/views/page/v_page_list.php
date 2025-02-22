<main>
    <div class="box row flex-center-center m-2">
        <div class="col-md-4 col-6 px-1">
            <div class="md-form md-outline">
                <input id="txt_search" onkeyup="updateValueSearch(this.value)" type="text" class="form-control" value=" " />
                <label class="active" for="txt_search">Tìm kiếm:</label>
            </div>
        </div>
        <div class="col-md-8 col-6 px-1">
            <a href="<?= URL_DOMAIN.'/admin/page/defaultlist'.URL_FOOT ?>" class="btn btn-primary m-0"><i class="fas fa-list"></i> <span class="clearfix d-none d-sm-inline-block"> Trang mặc định</span></a>
            <a class="btn btn-success m-0" data-toggle="modal" data-target="#modalCreate"><i class="fas fa-plus"></i> <span class="clearfix d-none d-sm-inline-block"> Thêm mới</span></a>
            <a href="<?= URL_DOMAIN.'/admin/page/trashlist'.URL_FOOT ?>" class="btn btn-danger m-0"><i class="fas fa-trash"></i> <span class="clearfix d-none d-sm-inline-block"> Thùng rác</span></a>
        </div>
    </div>
    <div id="listdata" class="box m-2">
        <div class="flex-center-center my-5 py-5">
            <span class="spinner-border text-primary p-3"></span>
        </div>
    </div>
</main>
<div class="modal fade" id="confirmTrash" tabindex="-1" role="dialog" aria-labelledby="myConfirmTrash" aria-hidden="true">
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
                <a type="button" class="btn btn-danger" onclick="trashPageOk(this)"><b>Đồng ý</b></a>
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalComment" tabindex="-1" role="dialog" aria-labelledby="mymodalComment" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-primary" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="heading">
                    <b>Bình luận trên <span id="page_id"></span></b>
                </div>
            </div>
            <div class="comments scroll-y py-2 px-3">
                <div id="comments"></div>
            </div>
            <div class="modal-footer justify-content-center">
                <form id="comment">
                    <div class="md-form md-outline">
                        <input type="text" id="comment-input" class="form-control" value="" autofocus>
                        <label for="comment-input" class="active">Nội dung bình luận</label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const username = "<?= $auth['user_username'] ?>";
    const fullname = "<?= $auth['user_fullname'] ?>";
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
    }

    async function loadListData() {
        $("#listdata").html(listdata);
        var current_page = localStorage.getItem("page_current_page");
        var sort_name = localStorage.getItem("page_sort_name");
        var sort_by = localStorage.getItem("page_sort_by");
        var keyword = localStorage.getItem("page_keyword");
        await $.ajax({
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
                    updateSTT();
                }
            },
        });
    }
    function updateSTT() {
        $(".page_stt_0").html('<span class="badge black m-0">Riêng tư</span>');
        $(".page_stt_1").html('<span class="badge green m-0">Công khai</span>');
        $(".page_stt_2").html('<span class="badge grey m-0">Bản nháp</span>');
    }

    async function changeSTTPage(t, id, stt) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        await $.ajax({
            type: 'POST',
            url: $(location).attr('href'),
            data: {
                action: 'stt',
                id: id,
                stt: stt
            },
            success: function(data) {
                if (data.toString() == "success") {
                    loadListData();
                } else {
                    toastr.error(data.toString());
                }
            },
        });
    }

    function trashPage(id) {
        $("#trash_review_id").text(id);
        $("#trash_review_title").text($("#page_title_"+id).text());
        $("#trash_review_description").text($("#page_desc_"+id).text());
        $("#trash_review_image").attr("src", $("#page_image_"+id).attr("src"));
    }

    async function trashPageOk(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        var id = $("#trash_review_id").text();
        await $.ajax({
            type: 'POST',
            url: $(location).attr('href'),
            data: {
                action: 'trash',
                id: id
            },
            success: function(data) {
                if (data.toString() == "success") {
                    toastr.success("Đã đưa vào thùng rác");
                    $('#confirmTrash').modal('toggle');
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

    async function submitCreate(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        var page_title = $("#page_title").val();
        var page_slug = $("#page_slug").val();
        var page_desc = $("#page_desc").val();
        if(page_title.length<5){
            toastr.warning("Vui lòng nhập tiêu đề dài hơn");
        }else{
            await $.ajax({
                type: 'POST',
                url: $(location).attr('href'),
                data: {
                    action: 'create',
                    page_title: page_title,
                    page_slug: page_slug,
                    page_desc: page_desc
                },
                success: function(data) {
                    if (data.toString() == "success") {
                        toastr.success("Tạo mới thành công");
                        loadListData();
                        $('#modalCreate').modal('toggle');
                    } else {
                        toastr.error("Tạo mới thất bại");
                        toastr.warning("Có thể đường dẫn đã được đặc");
                    }
                }
            });
        }
        $(t).removeAttr('disabled');
        $(t).html("Tạo mới");
    }
</script> 
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading lead">Tạo mới trang</p>
            </div>
            <div class="modal-body text-center">
                <div class="md-form md-outline">
                    <input type="text" id="page_title" value="" class="form-control" onkeyup="toSlug('page_slug',this.value)">
                    <label class="active" for="page_title">Tiêu đề: </label>
                </div>
                <div class="input-group md-outline">
                    <input type="text" id="page_slug" value="" class="form-control" disabled>
                </div>
                <div class="md-form md-outline">
                    <textarea id="page_desc" rows="4" class="form-control"></textarea>
                    <label class="active" for="page_desc">Mô tả ngắn:</label>
                </div> 
            </div>
            <div class="modal-footer justify-content-center">
                <a class="btn btn-success" onclick="submitCreate(this)"><i class="fas fa-save"></i> Tạo mới trang</a>
            </div>
        </div>
    </div>
</div>