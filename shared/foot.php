<div id="adv_left" style=" top:0px; right:50%; margin-right:510px; z-index:100; position: fixed; float:left">
</div>
<div id="adv_right" style=" top:0px; left:50%; margin-left:510px; z-index:100; position: fixed; float:right">
</div>
<script type="text/javascript">
    document.querySelector(
        "#playout").style.display = "none";
    const currency_format = Intl.NumberFormat('en-US');
    const currency_unit = ' <?=OS_UNIT_CURRENCY?>';
    $(document).ready(function() {
        setTimeout(() => {
            updateUsered();
            updateTimed();
        }, 500);
        $('.phone').text(function(i, text) {
            return text.replace(/(\d{4})(\d{3})(\d{3})/, '$1.$2.$3');
        });
        for (const li of document.querySelectorAll('.money')) {
            let value = $(li).text();
            $(li).text(currency_format.format(value)+currency_unit);
        }
    });
    
    function updateUsered() {
        for (const li of document.querySelectorAll('.usered')) {
            <?php foreach($usered as $u):?>
            if(li.textContent == '<?=$u['user_id']?>'){
                li.textContent = '<?=$u['user_fullname']?>';
            }
            <?php endforeach;?>
        }
        return 0;
    }

    function updateTimed() {
        for (const li of document.querySelectorAll('.timed')) {
            li.textContent = timestampToString(<?= time(); ?>, li.textContent);
        }
        return 0;
    }
    function timestampToString(cur, pre) {
        var icur = parseInt(cur);
        var ipre = parseInt(pre);
        var elapsed = 0;
        var msPerMinute = 60;
        var msPerHour = msPerMinute * 60;
        var msPerDay = msPerHour * 24;
        var msPerMonth = msPerDay * 30;
        var msPerYear = msPerDay * 365;
        var num = "1";
        var unit = "giây";
        var be = "trước";
        if (icur > ipre) {
            elapsed = icur - ipre;
        } else {
            elapsed = ipre - icur;
            be = "sau";
        }
        if (elapsed < msPerMinute) {
            num = Math.round(elapsed / 1000);
            unit = ' giây ';
        } else if (elapsed < msPerHour) {
            num = Math.round(elapsed / msPerMinute);
            unit = ' phút ';
        } else if (elapsed < msPerDay) {
            num = Math.round(elapsed / msPerHour);
            unit = ' giờ ';
        } else if (elapsed < msPerMonth) {
            num = Math.round(elapsed / msPerDay);
            unit = ' ngày ';
        } else if (elapsed < msPerYear) {
            num = Math.round(elapsed / msPerMonth);
            unit = ' tháng ';
        } else {
            num = Math.round(elapsed / msPerYear);
            unit = ' năm ';
        }
        var result = (elapsed < msPerMinute && Math.round(elapsed / 1000) < 2) ? " vừa xong " : num + unit + be;
        return result;
    }

    async function sendContactFast(t){
        $(t).attr('disabled','disabled');
        $(t).html('<i class="fa fa-spinner"></i>');
        var fullname = $("#fullname").val();
        var phone = $("#phone").val();
        var note = $("#note").val();
        if(fullname.length<2){
            $('#alert_form').html("Vui lòng nhập họ tên");
            $(t).html('<span class="text">Gửi tin nhắn</span><span class="arrow"></span>');
            $(t).removeAttr('disabled');
        }else if(phone.length<2){
            $('#alert_form').html("Vui lòng đúng số điện thoại");
            $(t).html('<span class="text">Gửi tin nhắn</span><span class="arrow"></span>');
            $(t).removeAttr('disabled');
        }else{
            await $.ajax({
                type: "POST",
                url: $(location).attr('href'),
                data: {
                    fullname: fullname,
                    phonenumber: phone,
                    email: '',
                    note: note
                },
                success: function(data) {
                    if (data.toString() === "success") {
                        $(t).html('Đã gửi thành công <i class="fa fa-check"></i>');
                        $('#alert_form').html("Tin nhắn của bạn đã được tôi tiếp nhận, tôi sẽ liên hệ sớm thôi.");
                    }else{
                        $(t).removeAttr('disabled');
                        $(t).html('<i class="fa fa-location-arrow"></i>');
                        $('#alert_form').html("Tin nhắn của bạn chưa được gửi đi, Hãy thử lại hoặc liên hệ cách khác.");
                    }
                },
            });
        }
    }
</script>