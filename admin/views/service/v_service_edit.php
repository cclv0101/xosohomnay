<main>
    <div class="box m-2">
        <div class="row">
            <div class="col-md-4 px-md-4">
                <div class="md-form md-outline">
                    <input type="text" class="form-control" id="service_title" value="<?=$service['service_title']?>" onkeyup="toSlug('service_slug',this.value)">
                    <label class="active" for="service_title">Tiêu đề:</label>
                </div>
                <div class="input-group md-outline">
                    <input type="text" id="service_slug" value="<?=$service['service_slug']?>" class="form-control" disabled>
                </div>
                <div class="md-form md-outline">
                    <input type="text" class="form-control" id="service_tags" value="<?=$service['service_tags']?>">
                    <label class="active" for="service_tags">Các thẻ: (ngăn cách thẻ bằng dấu ,)</label>
                </div>
            </div>
            <div class="col-md-3 px-md-3">
                <div class="md-form md-outline">
                    <textarea id="service_desc" class="form-control" rows="5"><?= $service['service_desc'] ?? null ?></textarea>
                    <label class="active" for="service_desc">Mô tả ngắn:</label>
                </div>
            </div>
            <div class="col-md-2 px-md-2">
                <div class="md-form md-outline">
                    <input type="file" id="avatar" class="form-control" onchange="uploadAvatar(this)">
                    <label class="active" for="avatar">Ảnh bìa</label>
                </div>
                <a class="flex-center small text-link" href="https://studio.polotno.com" target="_blank" rel="noopener noreferrer">Thiết kế ảnh</a>
                <span id="file_log"></span>
            </div>
            <div class="col-md-3 px-md-3">
                <?php $service_image = URL_PUBLIC.'/services/'.substr($service['service_slug'],0,70).'/'.$service['service_slug'].'.webp?v='.time() ?>
                <div class="preview_avatar flex-center mt-2" style="height: auto; padding: 0 25px;">
                    <img onerror='this.style.display=`none`'id="preview_avatar" src="<?= $service_image ?>" class="img-fluid">
                </div>
            </div>
            <div class="col-md-12 px-md-3">
                <p class="grey-text my-2">Nội dung dịch vụ: <a class="only-pc small text-link" onclick="openEditorFullscreen()">Chỉnh sửa toàn màn hình</a></p>
                <div id="area_editor">
                    <div class="flex-center-center my-5 py-5">
                        <span class="spinner-border text-primary p-3"></span>
                    </div>
                </div>
                <p><small class="text-muted">* Không được có ký tự ngoặc đơn. </small><small class="text-muted">* Ctrl+L: chèn liên kết. </small><small class="text-muted">* Ctrl+Z: Hoàn tác. </small><small class="text-muted">* Ctrl+Y: Hủy hoàn tác. </small></p>
            </div>
        </div>
        <div class="text-center my-3">
            <a onclick="submitUpdate(this)" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật dịch vụ</a>
        </div>
    </div>
</main>
<script>
    var data_html_service = "<?= str_replace(array("\r", "\n"), '&lt;br&gt;', $service['service_content'] ?? '') ?>";
    $(document).ready(function() {
        loadEditor();
    });

    async function loadEditor() {
        await $.ajax({
            type: 'POST',
            url: "<?= URL_DOMAIN ?>/admin/editor<?= URL_FOOT ?>",
            data: {
                path: '<?=DIR_PUBLIC.'/services/'.substr($service['service_slug'],0,70)?>',
                folder: '<?=URL_PUBLIC.'/services/'.substr($service['service_slug'],0,70)?>',
                data: data_html_service
            },
            success: function(data) {
                $("#area_editor").html(data.toString());
            }
        });
    }

    async function submitUpdate(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        var service_title = $("#service_title").val();
        var service_desc = $("#service_desc").val();
        var service_content = quill.root.innerHTML.toString();
        var service_slug = $("#service_slug").val();
        var service_tags = $("#service_tags").val();
        if (service_content.includes("'")) {
            toastr.warning("Không được dùng dấu ngoặc đơn trong nội dung");
        } else if (service_title == '') {
            toastr.warning("Vui lòng nhập tiêu đề");
        } else if (service_desc == null) {
            toastr.warning("Vui lòng nhập mô tả");
        } else {
            await $.ajax({
                type: "POST",
                url: $(location).attr('href'),
                data: {
                    action: 'update',
                    service_title: service_title,
                    service_desc: service_desc,
                    service_content: service_content,
                    service_slug: service_slug,
                    service_tags: service_tags
                },
                success: function(data) { 
                    if (data.toString() == "slug isset") {
                        toastr.error("Đường mới dẫn tồn tại");
                    } else if (data.toString() == "success") {
                        toastr.success("Cập nhật thành công");
                    } else {
                        toastr.error("Lưu không thành công");
                    }
                }
            });
        }
        $(t).text('Cập nhật dịch vụ');
        $(t).removeAttr('disabled');
    }
    async function uploadAvatar(t) {
        $(t).attr('disabled','disabled');
        let preview_avatar = $("#preview_avatar").attr("src");
        $(".preview_avatar").html("<i class='spinner-border spinner-border-sm'></i>");
        var avatar = $('#avatar').prop('files')[0]; 
        let form_data = new FormData();
        form_data.append("avatar", avatar);
        form_data.append("service_id", '<?=$id?>');
        await $.ajax({
            method: 'POST',
            url: $(location).attr('href'),
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#preview_avatar').appendTo(data.toString());
                if (data.toString() == "success") {
                    toastr.success("Cập nhật thành công");
                    setTimeout(() => {
                        $(".preview_avatar").html("<img onerror='this.style.display=`none`'id='preview_avatar' src='"+preview_avatar+"?time="+new Date()+"' class='img-fluid'>");
                    }, 200);
                } else {
                    $('#file_log').html("Định dạng hình là JPG");
                    toastr.error("Cập nhật không thành công");
                }
            }
        });
        $(t).removeAttr('disabled');
    }
</script>