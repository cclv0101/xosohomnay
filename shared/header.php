<div id="header">
    <div class="pcontent">
        <div class="h_banner">
            <div class="logo">
                <a href="<?=URL_DOMAIN?>">
                    <img alt="<?=OS_SEO?>" height="50" hspace="0" src="<?= URL_PUBLIC ?>/logo.png" vspace="0" />
                    <h1><?=OS_SEO?></h1>
                </a>
            </div>
            <div class="header_domain"></div>
            <div class="header_ext">
                <div class="boxdoveso">
                    <table cellpadding="0" cellspacing="10">
                        <tr>
                            <td valign="bottom" nowrap="nowrap">
                                <select id="box_kqxs_dai_3" onchange="onChangeDai()" style="width:120px;padding:0 5px !important">
                                    <?php foreach($arrDai as $kD=>$tD):?>
                                    <option <?=@$id==$kD?'selected':''?> value="<?=$kD?>"><?=$tD?></option>
                                    <?php endforeach;?>
                                </select>
                            </td>
                            <td valign="bottom" nowrap="nowrap">
                                <select onchange="onChangeDay()" id="box_kqxs_ngay_3" style="width:120px;padding:0 5px !important"></select>
                            </td>
                            <td valign="bottom" nowrap="nowrap">
                                <input onkeyup="onChangeNumber()" type="text" id="box_kqxs_so_3" title="Nhập số" placeholder="Nhập số" class="defaulttext" size="10" maxlength="6" value="" />
                            </td>
                            <td valign="bottom" nowrap="nowrap">
                                <span id="log"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function onChangeDai() {
        ads('searchDai')
        let val=$('#box_kqxs_dai_3').val();
        window.location.href = "<?=URL_DOMAIN.'/'.OS_URL_HOME.'/'?>"+val+"<?=URL_FOOT_OS?>";
    }
    function onChangeDay() {
        ads('searchDay')
        let val=$('#box_kqxs_ngay_3').val();
        window.location.href = "<?=URL_DOMAIN.'/'.OS_URL_HOME.'/'.@$id.'/'?>"+val+"<?=URL_FOOT_OS?>";
    }
    function onChangeNumber() {
        let val=$('#box_kqxs_so_3').val();
        let res='Chúc bạn may mắn lần sau';
        let color='grey';
        let weight='normal';
        $('#ketquadoNum').html(val);
        $('#ketquadoCheck').html('<span class="loader"></span>');
        if(val.length >= 6){
            val=val.replace(/\D/g,'');
            $('#box_kqxs_so_3').val(val);
            if(checkGiaiTam(val.substr(4, 5))){
                res='Chúc mừng bạn trúng giải Tám';
                color='green';
                weight='bold';
            }
            if(checkGiaiBay(val.substr(3, 5))){
                res='Chúc mừng bạn trúng giải Bảy';
                color='green';
                weight='bold';
            }
            if(checkGiaiSau(val.substr(2, 5))){
                res='Chúc mừng bạn trúng giải Sáu';
                color='green';
                weight='bold';
            }
            if(checkGiaiNam(val.substr(2, 5))){
                res='Chúc mừng bạn trúng giải Năm';
                color='green';
                weight='bold';
            }
            if(checkGiaiTu(val.substr(1, 5))){
                res='Chúc mừng bạn trúng giải Tư';
                color='green';
                weight='bold';
            }
            if(checkGiaiBa(val.substr(1, 5))){
                res='Chúc mừng bạn trúng giải Ba';
                color='green';
                weight='bold';
            }
            if(checkGiaiNhi(val.substr(1, 5))){
                res='Chúc mừng bạn trúng giải Nhì';
                color='green';
                weight='bold';
            }
            if(checkGiaiNhat(val.substr(1, 5))){
                res='Chúc mừng bạn trúng giải Nhất';
                color='green';
                weight='bold';
            }
            if(checkGiaiDacbiet(val)){
                res='Chúc mừng bạn trúng giải đặc biệt';
                color='green';
                weight='bolder';
            }
            $('#ketquadoCheck').html(res);
            $('#ketquadoCheck').css('color',color);
            $('#ketquadoCheck').css('font-weight',weight);
            $('#ketquado').css('margin','30px 10px');
        }else if(val.length >= 1){
            $('#ketquado').css('margin','10px 10px');
            $('#ketquadoCheck').html('<span class="loader"></span>');
        }else{
            $('#ketquadoCheck').html('');
            $('#ketquado').css('margin','0px');
        }
    }
    function checkGiaiTam(val) {
        return val==$('.giai8').text().trim();
    }
    function checkGiaiBay(val) {
        return val==$('.giai7').text().trim();
    }
    function checkGiaiSau(val) {
        let giai6s=$('.giai6').text().trim().split('-');
        for (let index = 0; index < giai6s.length; index++) {
            const giai6 = giai6s[index].trim();
            if (giai6==val) {
                return true;
            }
        }
        return false;
    }
    function checkGiaiNam(val) {
        return val==$('.giai5').text().trim();
    }
    function checkGiaiTu(val) {
        let giai4s=$('.giai4').text().trim().split('-');
        for (let index = 0; index < giai4s.length; index++) {
            const giai4 = giai4s[index].trim();
            if (giai4==val) {
                return true;
            }
        }
        return false;
    }
    function checkGiaiBa(val) {
        let giai3s=$('.giai3').text().trim().split('-');
        for (let index = 0; index < giai3s.length; index++) {
            const giai3 = giai3s[index].trim();
            if (giai3==val) {
                return true;
            }
        }
        return false;
    }
    function checkGiaiNhi(val) {
        return val==$('.giai2').text().trim();
    }
    function checkGiaiNhat(val) {
        return val==$('.giai1').text().trim();
    }
    function checkGiaiDacbiet(val) {
        return val==$('.giaidb').text().trim();
    }
</script>