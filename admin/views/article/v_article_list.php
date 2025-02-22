<main>
    <div class="box row flex-center-center m-2">
        <div class="col-md-3 col-6 px-1">
            <div class="md-form md-outline">
                <select class="form-control" id="search_article_stt" onchange="updateValueSearch(this.value)">
                    <option value="">Tất cả</option>
                    <option value="Trang thai: 0">Riêng tư</option>
                    <option value="Trang thai: 1">Công khai</option>
                    <option value="Trang thai: 2">Bản nháp</option>
                </select>
                <label class="active" for="search_article_stt">Trạng thái:</label>
            </div>
        </div>
        <div class="col-md-3 col-6 px-1">
            <div class="md-form md-outline">
                <select class="form-control" id="txt_filter_auth" onchange="updateValueSearch(this.value)">
                    <option value="">Chọn tất cả</option>
                    <?php foreach($list_user as $user):?>
                        <option value="Tac gia: #<?= base64_encode($user['user_id']) ?>"><?= $user['user_fullname'] ?></option>
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
            <a class="btn btn-success m-0" data-toggle="modal" data-target="#modalCreate"><i class="fas fa-plus"></i> <span class="clearfix d-none d-sm-inline-block"> Thêm mới</span></a>
            <a href="<?= URL_DOMAIN.'/admin/article/trashlist'.URL_FOOT ?>" class="btn btn-danger m-0"><i class="fas fa-trash"></i> <span class="clearfix d-none d-sm-inline-block"> Thùng rác</span></a>
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
                    <b>Xác nhận xoá bài viết?</b>
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
                <a type="button" class="btn btn-danger" onclick="trashArticleOk(this)"><b>Đồng ý</b></a>
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
                    <b>Bình luận trên <span id="article_id"></span></b>
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
        $('#search_article_stt').select2();
        onPageLoadReady();
    });

    function onPageLoadReady(){
        let article_keyword = localStorage.getItem("article_keyword");
        $("#txt_search").val(article_keyword);
    }

    async function loadListData() {
        $("#listdata").html(listdata);
        var current_page = localStorage.getItem("article_current_page");
        var sort_name = localStorage.getItem("article_sort_name");
        var sort_by = localStorage.getItem("article_sort_by");
        var keyword = localStorage.getItem("article_keyword");
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
                    $("#listdata").html("<p class='note note-warning m-5'><strong>Thông báo:</strong> Không có bài viết nào " + key + "</p>");
                } else {
                    $("#listdata").html(data.toString());
                    updateUser();
                    updateTimed();
                    updateSTT();
                }
            },
        });
    }
    function updateSTT() {
        $(".article_stt_0").html('<span class="badge black m-0">Riêng tư</span>');
        $(".article_stt_1").html('<span class="badge green m-0">Công khai</span>');
        $(".article_stt_2").html('<span class="badge grey m-0">Bản nháp</span>');
    }

    function trashArticle(id) {
        $("#trash_review_id").text(id);
        $("#trash_review_title").text($("#article_title_"+id).text());
        $("#trash_review_description").text($("#article_desc_"+id).text());
        $("#trash_review_image").attr("src", $("#article_image_"+id).attr("src"));
    }

    async function trashArticleOk(t) {
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

    async function changeSTTArticle(t, id, stt) {
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

    function updateValueSearch(value) {
        var my_value = localStorage.getItem("article_keyword");
        $("#txt_search").val(value);
        if (my_value != value) {
            localStorage.setItem("article_current_page", "1");
            localStorage.setItem("article_keyword", value);
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
        var val_name = localStorage.getItem("article_sort_name");
        var val_by = 'DESC';
        if (val_name == name) {
            val_by = localStorage.getItem("article_sort_by");
            if (val_by == 'DESC') {
                val_by = 'ASC';
            } else {
                val_by = 'DESC';
            }
        } else {
            localStorage.setItem("article_sort_name", name);
        }
        localStorage.setItem("article_sort_by", val_by);
        loadListData();
    }

    function updateUser() {
        <?php foreach ($list_user as $user) : ?>
            $(".user_<?= md5($user['user_id']); ?>").text("<?= $user['user_fullname']; ?>");
        <?php endforeach; ?>
    }

    async function submitCreate(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        var article_title = $("#article_title").val();
        var article_slug = $("#article_slug").val();
        var article_tags = $("#article_tags").val();
        var article_desc = $("#article_desc").val();
        if(article_title.length<10){
            toastr.warning("Vui lòng nhập tiêu đề dài hơn");
        }else{
            await $.ajax({
                type: 'POST',
                url: $(location).attr('href'),
                data: {
                    action: 'create',
                    article_title: article_title,
                    article_slug: article_slug,
                    article_tags: article_tags,
                    article_desc: article_desc
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
                <p class="heading lead">Tạo mới bài viết</p>
            </div>
            <div class="modal-body text-center">
                <div class="md-form md-outline">
                    <input type="text" id="article_title" value="" class="form-control" onkeyup="toSlug('article_slug',this.value)">
                    <label class="active" for="article_title">Tiêu đề: </label>
                </div>
                <div class="input-group md-outline">
                    <input type="text" id="article_slug" value="" class="form-control" disabled>
                </div>
                <div class="md-form md-outline">
                    <input type="text" class="form-control" id="article_tags" value="">
                    <label class="active" for="article_tags">Các thẻ: (ngăn cách thẻ bằng dấu ,)</label>
                </div>
                <div class="md-form md-outline">
                    <textarea id="article_desc" rows="4" class="form-control"></textarea>
                    <label class="active" for="article_desc">Mô tả ngắn:</label>
                </div> 
            </div>
            <div class="modal-footer justify-content-center">
                <a class="btn btn-success" onclick="submitCreate(this)"><i class="fas fa-save"></i> Tạo mới bài viết</a>
            </div>
        </div>
    </div>
</div>