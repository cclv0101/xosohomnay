<div id="editor">
    <?= html_entity_decode($_POST['data'] ?? "") ?>
</div>
<link href="<?= URL_ASSETS ?>/admin/css/quill.snow.css" rel="stylesheet">
<div class="modal fade right" id="modalImageEditor" tabindex="-8888" role="dialog" aria-labelledby="openImageEditor" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-primary" role="document">
        <div class="modal-content" id="openImageEditor">
            <div class="flex-center-center my-5 py-5">
                <div class="flex-center-center my-5 py-5">
                    <span class="spinner-border text-primary p-3"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade right" id="modalVediaEditor" tabindex="-8888" role="dialog" aria-labelledby="openVediaEditor" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-primary" role="document">
        <div class="modal-content" id="openVediaEditor">
            <div class="flex-center-center my-5 py-5">
                <div class="flex-center-center my-5 py-5">
                    <span class="spinner-border text-primary p-3"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= URL_ASSETS ?>/admin/js/quill.js"></script>
<script>
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        ['clean'],
        [{
            'script': 'sub'
        }, {
            'script': 'super'
        }],
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }],
        [{
            'direction': 'rtl'
        }],
        [{
            'align': []
        }],
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],
        [{
            'size': ['small', false, 'large', 'huge']
        }],
        [{
            'color': []
        }, {
            'background': []
        }],
        ['link', 'formula'],
        ['media', 'vedia']
    ];
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions,
        },
        theme: 'snow'
    });

    $(document).ready(function() {
        $("#editor img").removeAttr('id');
        $('#modalImageEditor').on('hidden.bs.modal', function() {
            if($("#this_is_quill_temp_image_form_editor").attr("src")=='https://www.webpkey.com/png/detail/233-2332677_image-500580-placeholder-transparent.webp'){
                $("#this_is_quill_temp_image_form_editor").remove();
            }
        });
        $('#modalVediaEditor').on('hidden.bs.modal', function() {
            if($("#this_is_quill_temp_video_form_editor").attr("src")=='https://www.w3schools.com/html/mov_bbb.mp4'){
                $("#this_is_quill_temp_video_form_editor").remove();
            }
        });
        loadAddImage();
        loadAddVideo();
        $("#editor img").on("click", function() {
            $(this).attr('id', 'this_is_quill_temp_image_form_editor');
            $('#modalImageEditor').modal();
        });
        $("#editor video").on("click", function() {
            $(this).attr('id', 'this_is_quill_temp_video_form_editor');
            $('#modalVediaEditor').modal();
        });
    });

    function removeTempMedia(){
        $("#this_is_quill_temp_image_form_editor").remove();
        $("#this_is_quill_temp_video_form_editor").remove();
    }

    async function loadAddImage() {
        await $.ajax({
            method: 'POST',
            url: "<?= URL_DOMAIN ?>/admin/editor<?= URL_FOOT ?>",
            data: {
                path: '<?=$_POST['path']?>',
                folder: '<?=$_POST['folder']?>',
                media_type: 'image'
            },
            success: function(data) {
                $("#openImageEditor").html(data.toString());
            }
        });
    }

    async function loadAddVideo() {
        await $.ajax({
            method: 'POST',
            url: "<?= URL_DOMAIN ?>/admin/editor<?= URL_FOOT ?>",
            data: {
                path: '<?=$_POST['path']?>',
                folder: '<?=$_POST['folder']?>',
                media_type: 'video'
            },
            success: function(data) {
                $("#openVediaEditor").html(data.toString());
            }
        });
    }

    function chooseImageEditor(val_src){
        $("#this_is_quill_temp_image_form_editor").on("click", function() {
            $(this).attr('id', 'this_is_quill_temp_image_form_editor');
            $('#modalImageEditor').modal();
        });
        $("#this_is_quill_temp_image_form_editor").attr("src", val_src);
        $("#this_is_quill_temp_image_form_editor").removeAttr('id');
        $('#modalImageEditor').modal('toggle'); 
    }

    function chooseVideoEditor(val_src){
        $("#this_is_quill_temp_video_form_editor").on("click", function() {
            $(this).attr('id', 'this_is_quill_temp_video_form_editor');
            $('#modalVediaEditor').modal();
        });
        $("#this_is_quill_temp_video_form_editor").attr("src", val_src);
        $("#this_is_quill_temp_video_form_editor").removeAttr('id');
        $('#modalVediaEditor').modal('toggle'); 
    }

    function renameFile(id_file) {
        $("#val_old_name").val($("#name_"+id_file).text());
        $("#val_new_name").val($("#name_"+id_file).text());
    }
    function deleteFile(id_file) {
        $("#text_del_name").text($("#name_"+id_file).text());
    }

    async function uploadFile(t) {
        $(t).attr('disabled','disabled');
        var upload = $('#upload').prop('files')[0]; 
        let form_data = new FormData();
        form_data.append("upload", upload);
        form_data.append("path", '<?=$_POST['path']?>');
        form_data.append("action", 'upload');
        await $.ajax({
            method: 'POST',
            url: "<?= URL_DOMAIN ?>/admin/editor<?= URL_FOOT ?>",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.toString() === "success") {
                    toastr.success("Tải file thành công");
                    loadAddImage();
                } else {
                    toastr.error("Tải file không thành công");
                }
            }
        });
        $(t).removeAttr('disabled');
    }

    async function renameFileOK(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        let oldname = $("#val_old_name").val();
        let newname = $("#val_new_name").val();
        await $.ajax({
            method: 'POST',
            url: "<?= URL_DOMAIN ?>/admin/editor<?= URL_FOOT ?>",
            data: {
                path: '<?=$_POST['path']?>',
                action: 'rename',
                oldname: oldname,
                newname: newname
            },
            success: function(data) {
                if (data.toString() == "success") {
                    toastr.success("Đổi tên file thành công!");
                    $('#modalRename').modal('toggle'); 
                    loadAddImage();
                } else {
                    toastr.error("Đã xảy ra lỗi nghiêm trọng");
                }
            }
        });
        $(t).text('Đồng ý');
        $(t).removeAttr('disabled');
    }
    async function deleteFileOK(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        let filename = $("#text_del_name").text();
        await $.ajax({
            method: 'POST',
            url: "<?= URL_DOMAIN ?>/admin/editor<?= URL_FOOT ?>",
            data: {
                path: '<?=$_POST['path']?>',
                action: 'delete',
                filename: filename
            },
            success: function(data) {
                if (data.toString() == "success") {
                    toastr.success("Xóa file thành công!");
                    $('#modalDelete').modal('toggle'); 
                    loadAddImage();
                } else {
                    toastr.error("Đã xảy ra lỗi nghiêm trọng");
                }
            }
        });
        $(t).text('Đồng ý');
        $(t).removeAttr('disabled');
    }
</script>

<div class="modal fade right" id="modalRename" tabindex="-9999" role="dialog" aria-labelledby="openRename" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-success modal-sm" role="document">
        <div class="modal-content mt-5">
            <div class="modal-header">
                <p class="heading lead">Đổi tên file</p>
            </div>
            <div class="modal-body text-center">
                <input type="text" id="val_old_name" value="" class="form-control">
                <div class="md-form md-outline">
                    <input type="text" id="val_new_name" value="" class="form-control">
                    <label class="active" for="val_new_name">Tên mới: </label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="renameFileOK(this)">Đồng ý</button>
                <button class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade right" id="modalDelete" tabindex="-9999" role="dialog" aria-labelledby="openDelete" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-danger modal-sm" role="document">
        <div class="modal-content mt-5">
            <div class="modal-header">
                <p class="heading lead">Xóa file</p>
            </div>
            <div class="modal-body text-center">
                Bạn có chắc sẽ xóa <b id="text_del_name"></b>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" onclick="deleteFileOK(this)">Đồng ý</button>
                <button class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div>