<main>
    <div class="box m-2">
        <div class="row">
            <div class="col-md-3">
                <h5 class="font-weight-bold my-2">Thông tin cơ bản</h5>
                <div class="md-form md-outline">
                    <input type="text" id="name" class="form-control" value="<?= OS_NAME ?>">
                    <label class="active" for="name">Tên website:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="owner" class="form-control" value="<?= OS_OWNER ?>">
                    <label class="active" for="owner">Tác giả:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="seo" class="form-control" value="<?= OS_SEO ?>">
                    <label class="active" for="seo">Từ khóa chính:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="subseo" class="form-control" value="<?= OS_SUBSEO ?>">
                    <label class="active" for="subseo">Từ khóa phụ:</label>
                </div>
                <select hidden id="lang" class="form-control">
                    <?php foreach(DEFAULT_COUNTRY as $ol):?>
                        <option value="<?= $ol[1] ?>" <?= $ol[1]==OS_LANG?'selected':'' ?>><?= $ol[0] ?></option>
                    <?php endforeach;?>
                </select>
                <select hidden id="lang_code" class="form-control">
                    <?php foreach(DEFAULT_LANGCODE as $k=>$dl):?>
                        <option value="<?= $dl ?>" <?= $dl==LANG_CODE?'selected':'' ?>><?= DEFAULT_LANGTEXT[$k] ?></option>
                    <?php endforeach;?>
                </select>
                <select hidden id="timezone" class="form-control">
                    <?php foreach(DEFAULT_TIMEZONE as $dt):?>
                        <option value="<?= $dt ?>" <?= $dt==OS_TIMEZONE?'selected':'' ?>><?= $dt ?></option>
                    <?php endforeach;?>
                </select>
                <input hidden type="text" id="unit_currency" class="form-control" value="<?= OS_UNIT_CURRENCY ?>">
                <input hidden type="text" id="foot" class="form-control" value="<?= URL_FOOT_OS ?>">
            </div>
            <div class="col-md-3">
                <h5 class="font-weight-bold my-2">Thông tin liên hệ</h5>
                <div class="md-form md-outline">
                    <input type="text" id="hotline" class="form-control" value="<?= OS_HOTLINE ?>">
                    <label class="active" for="hotline">Hotline:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="phone" class="form-control" value="<?= OS_PHONE ?>">
                    <label class="active" for="phone">Số điện thoại:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="address" class="form-control" value="<?= OS_ADDRESS ?>">
                    <label class="active" for="address">Địa chỉ nhà:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="email" class="form-control" value="<?= OS_EMAIL ?>">
                    <label class="active" for="email">Địa chỉ E-mail:</label>
                </div>
                <input hidden type="text" id="instagram" class="form-control" value="<?= OS_INSTAGRAM ?>">
                <input hidden type="text" id="map" class="form-control" value="<?= OS_MAP ?>">
                <input hidden type="text" id="zalo_oa" class="form-control" value="<?= OS_ZALO_OA ?>">
                <input hidden type="text" id="tiktok_video" class="form-control" value="<?= OS_TIKTOK_VIDEO ?>">
            </div>
            <div class="col-md-3">
                <h5 class="font-weight-bold my-2">Mạng xã hội</h5>
                <div class="md-form md-outline">
                    <input type="text" id="facbook" class="form-control" value="<?= OS_FACEBOOK ?>">
                    <label class="active" for="facbook">Link Facebook:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="youtube" class="form-control" value="<?= OS_YOUTUBE ?>">
                    <label class="active" for="youtube">Link Youtube:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="tiktok" class="form-control" value="<?= OS_TIKTOK ?>">
                    <label class="active" for="tiktok">Link Tiktok:</label>
                </div>
                <div class="md-form md-outline">
                    <input type="text" id="zalo" class="form-control" value="<?= OS_ZALO ?>">
                    <label class="active" for="zalo">Link Zalo:</label>
                </div>
                <input hidden type="text" id="linkedin" class="form-control" value="<?= OS_LINKEDIN ?>">
                <input hidden type="text" id="twitter" class="form-control" value="<?= OS_TWITTER ?>">
                <input hidden type="text" id="telegram" class="form-control" value="<?= OS_TELEGRAM ?>">
                <input hidden type="text" id="tumblr" class="form-control" value="<?= OS_TUMBLR ?>">
            </div>
            <div class="col-md-3">
                <div class="md-form md-outline">
                    <input type="file" id="icon" class="form-control" onchange="uploadIcon(this)">
                    <label class="active" for="icon">Icon:</label>
                </div>
                <span id="file_log_icon"></span>
                <div class="preview_icon flex-center" style="width: 100%; height:auto; max-width: 100px;">
                    <img onerror='this.style.display=`none`'id="preview_icon" src="<?= URL_PUBLIC.'/favicon.ico?v='.time() ?>" class="img-fluid">
                </div>
                <div class="md-form md-outline">
                    <input type="file" id="logo" class="form-control" onchange="uploadLogo(this)">
                    <label class="active" for="logo">Ảnh đại diện:</label>
                </div>
                <span id="file_log_logo"></span>
                <div class="preview_logo flex-center" style="width: 100%; height:auto; max-width: 200px;">
                    <img onerror='this.style.display=`none`'id="preview_logo" src="<?= URL_PUBLIC.'/logo.png?v='.time() ?>" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="text-center my-3">
            <button type="button" onclick="submit(this)" class="btn btn-primary mb-md-0 mb-2"><i class="fas fa-save"></i> Lưu cập nhật</button>
        </div>
    </div>
</main>
<script>
    async function uploadIcon(t) {
        $(t).attr('disabled','disabled');
        let preview_icon = $("#preview_icon").attr("src");
        $(".preview_icon").html("<i class='spinner-border spinner-border-sm'></i>");
        var icon = $('#icon').prop('files')[0]; 
        let form_data = new FormData();
        form_data.append("icon", icon);
        await $.ajax({
            method: 'POST',
            url: $(location).attr('href'),
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.toString() === "success") {
                    toastr.success("Cập nhật thành công");
                    setTimeout(() => {
                        $(".preview_icon").html("<img onerror='this.style.display=`none`'id='preview_icon' src='"+preview_icon+"?time="+new Date()+"' class='img-fluid'>");
                    }, 200);
                } else {
                    $('#file_log_icon').html("Định dạng hình là ICO");
                    toastr.error("Cập nhật không thành công");
                }
            }
        });
        $(t).removeAttr('disabled');
    }
    async function uploadLogo(t) {
        $(t).attr('disabled','disabled');
        let preview_logo = $("#preview_logo").attr("src");
        $(".preview_logo").html("<i class='spinner-border spinner-border-sm'></i>");
        var logo = $('#logo').prop('files')[0]; 
        let form_data = new FormData();
        form_data.append("logo", logo);
        await $.ajax({
            method: 'POST',
            url: $(location).attr('href'),
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.toString() === "success") {
                    toastr.success("Cập nhật thành công");
                    setTimeout(() => {
                        $(".preview_logo").html("<img onerror='this.style.display=`none`'id='preview_logo' src='"+preview_logo+"?time="+new Date()+"' class='img-fluid'>");
                    }, 200);
                } else {
                    $('#file_log_logo').html("Định dạng hình là PNG");
                    toastr.error("Cập nhật không thành công");
                }
            }
        });
        $(t).removeAttr('disabled');
    }
    
    async function submit(t) {
        $(t).attr('disabled','disabled');
        $(t).html("<i class='spinner-border spinner-border-sm'></i>");
        let value = `<` + `?php
 define('LANG_CODE', '`+$('#lang_code').val().replace(/'/g, '"')+`');
 define('OS_NAME', '`+$('#name').val().replace(/'/g, '"')+`');
 define('OS_HOTLINE', '`+$('#hotline').val().replace(/'/g, '"')+`');
 define('OS_PHONE', '`+$('#phone').val().replace(/'/g, '"')+`');
 define('OS_EMAIL', '`+$('#email').val().replace(/'/g, '"')+`');
 define('OS_ADDRESS', '`+$('#address').val().replace(/'/g, '"')+`');
 define('OS_FACEBOOK', '`+$('#facbook').val().replace(/'/g, '"')+`');
 define('OS_YOUTUBE', '`+$('#youtube').val().replace(/'/g, '"')+`');
 define('OS_TIKTOK', '`+$('#tiktok').val().replace(/'/g, '"')+`');
 define('OS_INSTAGRAM', '`+$('#instagram').val().replace(/'/g, '"')+`');
 define('OS_LINKEDIN', '`+$('#linkedin').val().replace(/'/g, '"')+`');
 define('OS_TWITTER', '`+$('#twitter').val().replace(/'/g, '"')+`');
 define('OS_TELEGRAM', '`+$('#telegram').val().replace(/'/g, '"')+`');
 define('OS_TUMBLR', '`+$('#tumblr').val().replace(/'/g, '"')+`');
 define('OS_ZALO', '`+$('#zalo').val().replace(/'/g, '"')+`');
 define('OS_ZALO_OA', '`+$('#zalo_oa').val().replace(/'/g, '"')+`');
 define('OS_TIKTOK_VIDEO', '`+$('#tiktok_video').val().replace(/'/g, '"')+`');
 define('OS_OWNER', '`+$('#owner').val().replace(/'/g, '"')+`');
 define('OS_MAP', '`+$('#map').val().replace(/'/g, '"')+`');
 define('OS_LANG', '`+$('#lang').val().replace(/'/g, '"')+`');
 define('OS_UNIT_CURRENCY', '`+$('#unit_currency').val().replace(/'/g, '"')+`');
 define('OS_TIMEZONE', '`+$('#timezone').val().replace(/'/g, '"')+`');
 define('OS_SEO', '`+$('#seo').val().replace(/'/g, '"')+`');
 define('OS_SUBSEO', '`+$('#subseo').val().replace(/'/g, '"')+`');
 define('URL_FOOT_OS', '`+$('#foot').val().replace(/'/g, '"')+`');
 define('URL_GPT_API', '');
 define('ADMIN_CAPTCHA', false); `;
        await $.ajax({
            type: 'POST',
            url: $(location).attr('href'),
            data: {
                value: value
            },
            success: function(data) { 
                if (data.toString() == "success") {
                    toastr.success("Đã lưu thành công");
                } else {
                    toastr.error("Lưu không thành công");
                }
            }
        });
        $(t).html('<i class="fas fa-save"></i> Lưu cập nhật');
        $(t).removeAttr('disabled');
    }
</script>