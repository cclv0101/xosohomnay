<div id="main">
    <div class="pcontent">
        <div class="dnw-content-main" id="dnw-content-main">
            <div id="leftmodule" class="box">
                <div id="parent" style="position:relative; clear:both">
                    <div id="sidebar_right" style="position:relative; top: 0px;">
                        <div class="module">
                            <div class="">
                                <a href="https://cclvapp.com" target="_blank">
                                    <img src="https://img.cclvapp.com/577a2a4b16b4c33d8abdafbaa96e18de" alt="Truy cập CCLVAPP" width="160" height="160"/>
                                </a>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="righttop">
                    <div class="module">
                        <div class="modulesLR black">
                            <h2 class="mdtitle">Đài xổ số</h2>
                            <div class="mdcontent" style="height: 240px;overflow-y: scroll;">
                                <ul class="menu2 menuxosott">
                                    <?php foreach($arrDai as $kD=>$tD):?>
                                    <li style="background-color:<?=@$id==$kD?'red':''?>">
                                        <a style="color:<?=@$id==$kD?'white':''?>" href="<?=URL_DOMAIN.'/'.OS_URL_HOME.'/'.$kD.URL_FOOT_OS?>" title="Trực Tiếp Xổ Số <?=$tD?>">
                                            KQXS <?=$tD?>
                                        </a>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div id="parent" style="position:relative; clear:both">
                    <div id="sidebar_right" style="position:relative; top: 0px;">
                        <div class="module">
                            <div class="">
                                <a href="https://cclvapp.com" target="_blank">
                                    <img src="https://img.cclvapp.com/577a2a4b16b4c33d8abdafbaa96e18de" alt="Truy cập CCLVAPP" width="160" height="160"/>
                                </a>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="contentmodule" class="box">
                <a href="https://cclvapp.com" target="_blank">
                    <img src="https://img.cclvapp.com/577a2a4b16b4c33d8abdafbaa96e18de" alt="Truy cập CCLVAPP" height="160" style="width: 100%;height: 180px;"/>
                </a>
                <div class="mainbody">
                    <div id="noidung">
                        <div class="box_kqxs" id="box_kqxs_minhngoc">
                            <script> bgcolor="#ccc";titlecolor="#fff";dbcolor="red";fsize="16px"; kqwidth="100%"; </script>
                            <script language="javascript" src="https://www.minhngoc.net.vn/getkqxs/<?=@$id?>.js">
                            </script>
                        </div>
                    </div>
                </div>
                <a href="https://cclvapp.com" target="_blank">
                    <img src="https://img.cclvapp.com/577a2a4b16b4c33d8abdafbaa96e18de" alt="Truy cập CCLVAPP" height="160" style="width: 100%;height: 180px;"/>
                </a>
            </div>
            <div id="rightmodule" class="box">
                <div id="parent" style="position:relative; clear:both">
                    <div id="sidebar_right" style="position:relative; top: 0px;">
                        <div class="module">
                            <div class="">
                                <a href="https://cclvapp.com" target="_blank">
                                    <img src="https://img.cclvapp.com/577a2a4b16b4c33d8abdafbaa96e18de" alt="Truy cập CCLVAPP" width="160" height="160"/>
                                </a>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="righttop">
                    <div class="module">
                        <div class="modulesLR black">
                            <h2 class="mdtitle">Ngày xổ số</h2>
                            <div class="mdcontent" style="height: 240px;overflow-y: scroll;">
                                <ul id="box_kqxs_ngay_2" class="menu2 menuxosott">
                                </ul>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div id="parent" style="position:relative; clear:both">
                    <div id="sidebar_right" style="position:relative; top: 0px;">
                        <div class="module">
                            <div class="">
                                <a href="https://cclvapp.com" target="_blank">
                                    <img src="https://img.cclvapp.com/577a2a4b16b4c33d8abdafbaa96e18de" alt="Truy cập CCLVAPP" width="160" height="160"/>
                                </a>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $("#box_kqxs_minhngoc table:first").css('display','none');
        $("#box_kqxs_minhngoc table:first a").html('');
        var opts=$("#box_kqxs_minhngoc #box_kqxs_ngay option");
        const curDay='<?=@$day?>';
        for (let index = 0; index < opts.length; index++) {
            let opt = opts[index];
            let val=$(opt).val();
            let title=$(opt).text();
            let url="<?=URL_DOMAIN.'/'.OS_URL_HOME.'/'.@$id.'/'?>"+val+"<?=URL_FOOT_OS?>";
            $("#box_kqxs_ngay_2").append(`<li style="background-color:`+(curDay==val?`red`:`transparent`)+`"><a href="`+url+`" title="Trực Tiếp Xổ Số <?=@$title?> `+title+`"><span style="color:`+(curDay==val?`white`:`#333`)+`"> Ngày `+title+`</span></a></li>`);
            $("#box_kqxs_ngay_3").append(`<option `+(curDay==val?`selected`:``)+` value="`+val+`">`+title+`</option>`);
        }
        if(curDay!=''){
            $('#box_kqxs_ngay').val(curDay);
            getnew_boxkqxs_ngay();
        }
        setTimeout(() => {
            $("#box_kqxs_minhngoc table:first").css('display','none');
            $("#box_kqxs_minhngoc table:first a").html('');
        },1000);
    });
</script>