<main>
    <div class="box m-2">
        <div class="row">
            <div class="col-md-4 px-md-4">
                <div class="md-form md-outline">
                    <input type="text" class="form-control" id="article_title" value="<?=$article['article_title']?>" onkeyup="toSlug('article_slug',this.value)">
                    <label class="active" for="article_title">Tiêu đề:</label>
                </div>
                <div class="input-group md-outline">
                    <input type="text" id="article_slug" value="<?=$article['article_slug']?>" class="form-control" disabled>
                </div>
                <div class="md-form md-outline">
                    <input type="text" class="form-control" id="article_tags" value="<?=$article['article_tags']?>">
                    <label class="active" for="article_tags">Các thẻ: (ngăn cách thẻ bằng dấu ,)</label>
                </div>
            </div>
            <div class="col-md-3 px-md-3">
                <div class="md-form md-outline">
                    <textarea id="article_desc" class="form-control" rows="5"><?= $article['article_desc'] ?? null ?></textarea>
                    <label class="active" for="article_desc">Mô tả ngắn:</label>
                </div>
            </div>
            <div class="col-md-2 px-md-2">
                <div class="md-form md-outline">
                    <input type="file" id="avatar" class="form-control" onchange="uploadAvatar(this)">
                    <label class="active" for="avatar">Ảnh bìa</label>
                </div>
                <span id="file_log"></span>
                <a class="text-center" href="https://studio.polotno.com" target="_blank" rel="noopener noreferrer">Thiết kế ảnh</a>
            </div>
            <div class="col-md-3 px-md-3">
                <?php $article_image = URL_PUBLIC.'/articles/'.substr($article['article_slug'],0,70).'/'.$article['article_slug'].'.webp?v='.time() ?>
                <div class="preview_avatar flex-center mt-2" style="height: auto; padding: 0 25px;">
                    <img onerror='this.style.display=`none`'id="preview_avatar" src="<?= $article_image ?>" class="img-fluid">
                </div>
            </div>
            <div class="col-md-12 px-md-3">
                <p class="grey-text my-2">Nội dung bài viết: <a class="only-pc small text-link" onclick="openEditorFullscreen()">Chỉnh sửa toàn màn hình</a></p>
                <div id="area_editor">
                    <div class="flex-center-center my-5 py-5">
                        <span class="spinner-border text-primary p-3"></span>
                    </div>
                </div>
                <p><small class="text-muted">* Không được có ký tự ngoặc đơn. </small><small class="text-muted">* Ctrl+L: chèn liên kết. </small><small class="text-muted">* Ctrl+Z: Hoàn tác. </small><small class="text-muted">* Ctrl+Y: Hủy hoàn tác. </small></p>
            </div>
        </div>
        <div class="text-center my-3">
            <a onclick="submitUpdate(this)" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật bài viết</a>
        </div>
    </div>
</main>
<script>
    var data_html_article = "<?= str_replace(array("\r", "\n"), '&lt;br&gt;', $article['article_content'] ?? '') ?>";
    $(document).ready(function() {
        loadEditor();
    });

    async function loadEditor() {
        await $.ajax({
            type: 'POST',
            url: "<?= URL_DOMAIN ?>/admin/editor<?= URL_FOOT ?>",
            data: {
                path: '<?=DIR_PUBLIC.'/articles/'.substr($article['article_slug'],0,70)?>',
                folder: '<?=URL_PUBLIC.'/articles/'.substr($article['article_slug'],0,70)?>',
                data: data_html_article
            },
            success: function(data) {
                $("#area_editor").html(data.toString());
            }
        });
    }

    async function submitUpdate(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        var article_title = $("#article_title").val();
        var article_desc = $("#article_desc").val();
        var article_content = quill.root.innerHTML.toString();
        var article_slug = $("#article_slug").val();
        var article_tags = $("#article_tags").val();
        if (article_content.includes("'")) {
            toastr.warning("Không được dùng dấu ngoặc đơn trong nội dung");
        } else if (article_title == '') {
            toastr.warning("Vui lòng nhập tiêu đề");
        } else if (article_desc == null) {
            toastr.warning("Vui lòng nhập mô tả");
        } else {
            await $.ajax({
                type: "POST",
                url: $(location).attr('href'),
                data: {
                    action: 'update',
                    article_title: article_title,
                    article_desc: article_desc,
                    article_content: article_content,
                    article_slug: article_slug,
                    article_tags: article_tags
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
        $(t).text('Cập nhật bài viết');
        $(t).removeAttr('disabled');
    }
    async function uploadAvatar(t) {
        $(t).attr('disabled','disabled');
        let preview_avatar = $("#preview_avatar").attr("src");
        $(".preview_avatar").html("<i class='spinner-border spinner-border-sm'></i>");
        var avatar = $('#avatar').prop('files')[0]; 
        let form_data = new FormData();
        form_data.append("avatar", avatar);
        form_data.append("article_id", '<?=$id?>');
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