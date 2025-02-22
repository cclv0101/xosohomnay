<main>
    <div class="box row flex-center-center m-2">
        <div class="col-md-4 col-6 px-1">
            <div class="md-form md-outline">
                <input id="txt_search" onkeyup="updateValueSearch(this.value)" type="text" class="form-control" value=" " />
                <label class="active" for="txt_search">Tìm kiếm:</label>
            </div>
        </div>
        <div class="col-md-8 col-6 px-1">
            <a href="<?= URL_DOMAIN.'/admin/page/list'.URL_FOOT ?>" class="btn btn-primary m-0"><i class="fas fa-pager"></i> <span class="clearfix d-none d-sm-inline-block"> Landing Page</span></a>
            <a class="btn btn-success m-0" onclick="checkPage(this)"><i class="fas fa-check"></i> <span class="clearfix d-none d-sm-inline-block"> Kiểm tra trang</span></a>
            <a href="<?= URL_DOMAIN.'/admin/page/trashlist'.URL_FOOT ?>" class="btn btn-danger m-0"><i class="fas fa-trash"></i> <span class="clearfix d-none d-sm-inline-block"> Thùng rác</span></a>
        </div>
    </div>
    <div id="listdata" class="box m-2">
        <div class="flex-center-center my-5 py-5">
            <span class="spinner-border text-primary p-3"></span>
        </div>
    </div>
</main>
<script>
    const listdata = $("#listdata").html();
    $(document).ready(function() {
        loadListData();
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
    
    async function checkPage(t) {
        let btn = $(t).html();
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        await $.ajax({
            type: 'POST',
            url: $(location).attr('href'),
            data: {
                action: 'checkpage'
            },
            success: function(data) { 
                if (data.toString() == "success") {
                    loadListData();
                    $(t).html(btn);
                } else {
                    toastr.error('Có lỗi xảy ra!');
                }
            },
        });
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