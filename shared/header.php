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
        let val=$('#box_kqxs_dai_3').val();
        window.location.href = "<?=URL_DOMAIN.'/'.OS_URL_HOME.'/'?>"+val+"<?=URL_FOOT_OS?>";
    }
    function onChangeDay() {
        let val=$('#box_kqxs_ngay_3').val();
        window.location.href = "<?=URL_DOMAIN.'/'.OS_URL_HOME.'/'.@$id.'/'?>"+val+"<?=URL_FOOT_OS?>";
    }
    function onChangeNumber() {
        let val=$('#box_kqxs_so_3').val();
        if(val.length>0){
            val=parseInt(val);
            $('#box_kqxs_so_3').val(val);
            if(val.length>1){
                
            }
        }
    }
</script>