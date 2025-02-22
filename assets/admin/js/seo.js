
function getSEO() {
    var image = document.getElementById('txt_image').value;
    var tittle = document.getElementById('txt_tittle').value;
    var des = document.getElementById('txt_description').value;
    var htmlEditor = CKEDITOR.instances['txt_content'].getData();
    var content = htmlEditor;
    var keyword = document.getElementById('txt_keyword').value;
    var coreGroupImage = 0;
    var coreImage = 0;
    var coreGroupTitle = 0;
    var coreTitleNum = 0;
    var coreTitleKey = 0;
    var coreGroupDes = 0;
    var coreDesNum = 0;
    var coreDesKey = 0;
    var coreGroupContent = 0;
    var coreContentNum = 0;
    var coreContentKey = 0;
    var coreContentImg = 0;
    var coreContentSpam = 0;
    //Image
    if (image != null && image !== "" && image !== urlImageView) {
        coreImage = 10;
    }
    coreGroupImage = coreImage;
    // Title
    var l_tittle = tittle.length;
    if (l_tittle >= 30 && l_tittle <= 60) {
        coreTitleNum = 10;
    } else if ((l_tittle > 25 && l_tittle < 30) || l_tittle > 60 && l_tittle < 80) {
        coreTitleNum = 8;
    } else if ((l_tittle > 20 && l_tittle < 25) || l_tittle > 80 && l_tittle < 100) {
        coreTitleNum = 6;
    } else if ((l_tittle > 15 && l_tittle < 20) || l_tittle > 100 && l_tittle < 120) {
        coreTitleNum = 4;
    } else if ((l_tittle > 10 && l_tittle < 15) || l_tittle > 120 && l_tittle < 150) {
        coreTitleNum = 2;
    } else if ((l_tittle > 1 && l_tittle < 10) || l_tittle > 150 && l_tittle < 200) {
        coreTitleNum = 1;
    }
    if (keyword.length > 0 && change_alias(tittle.toLowerCase()).includes(change_alias(keyword.toLowerCase()))) {
        coreTitleKey = 10;
    }
    coreGroupTitle = coreTitleNum + coreTitleKey;
    //Des
    var count_des = count_words(des);
    if (count_des >= 30 && count_des <= 100) {
        coreDesNum = 10;
    } else if ((count_des > 20 && count_des < 30) || count_des > 100 && count_des < 150) {
        coreDesNum = 8;
    } else if ((count_des > 15 && count_des < 20) || count_des > 150 && count_des < 250) {
        coreDesNum = 6;
    } else if ((count_des > 10 && count_des < 15) || count_des > 250 && count_des < 500) {
        coreDesNum = 4;
    } else if ((count_des > 5 && count_des < 10) || count_des > 500 && count_des < 800) {
        coreDesNum = 2;
    } else if ((count_des > 1 && count_des < 5) || count_des > 800 && count_des < 1500) {
        coreDesNum = 1;
    }
    if (keyword.length > 0 && des.includes(keyword)) {
        coreDesKey = 10;
    }
    coreGroupDes = coreDesNum + coreDesKey;
    //Content
    var count_word_content = count_words(content);
    if (count_word_content >= 250 && count_word_content <= 1000) {
        coreContentNum = 20;
    } else if ((count_word_content > 200 && count_word_content < 250) || count_word_content > 1000 && count_word_content < 2000) {
        coreContentNum = 16;
    } else if ((count_word_content > 150 && count_word_content < 200) || count_word_content > 2000 && count_word_content < 3000) {
        coreContentNum = 12;
    } else if ((count_word_content > 100 && count_word_content < 150) || count_word_content > 3000 && count_word_content < 5000) {
        coreContentNum = 8;
    } else if ((count_word_content > 50 && count_word_content < 100) || count_word_content > 5000 && count_word_content < 10000) {
        coreContentNum = 4;
    } else if ((count_word_content > 30 && count_word_content < 50) || count_word_content > 10000 && count_word_content < 50000) {
        coreContentNum = 2;
    } else if ((count_word_content > 1 && count_word_content < 30) || count_word_content > 50000 && count_word_content < 100000) {
        coreContentNum = 1;
    }
    if (keyword.length > 0 && content.includes(keyword)) {
        var i = 0;
        var temp = content;
        if (temp.includes(keyword)) {
            i = 1;
            temp = temp.substr(temp.search(keyword) + 2, temp.length);
            if (temp.includes(keyword)) {
                i = 2;
                temp = temp.substr(temp.search(keyword) + 2, temp.length);
                if (temp.includes(keyword)) {
                    i = 3;
                }
            }
        }
        coreContentKey = i * 5;
    }
    var count_img = htmlEditor.indexOf('<img');
    var total_img = 0;
    while (count_img !== -1) {
        total_img++;
        count_img = htmlEditor.indexOf('<img', count_img + 1);
    }
    if (total_img >= 3 && total_img <= 10) {
        coreContentImg = 10;
    } else if ((total_img > 1 && total_img < 3) || count_word_content > 10 && count_word_content < 20) {
        coreContentImg = 5;
    } else if ((total_img <= 1) || count_word_content > 50) {
        coreContentImg = 0;
    }
    coreGroupContent = coreContentNum + coreContentKey + coreContentImg;
    
    document.getElementById('coreImage').innerText = coreImage;
    document.getElementById('coreGroupImage').innerText = coreGroupImage;
    document.getElementById('coreTitleNum').innerText = coreTitleNum;
    document.getElementById('coreTitleKey').innerText = coreTitleKey;
    document.getElementById('coreGroupTitle').innerText = coreGroupTitle;
    document.getElementById('coreDesNum').innerText = coreDesNum;
    document.getElementById('coreDesKey').innerText = coreDesKey;
    document.getElementById('coreGroupDes').innerText = coreGroupDes;
    document.getElementById('coreContentKey').innerText = coreContentKey;
    document.getElementById('coreContentNum').innerText = coreContentNum;
    document.getElementById('coreContentImg').innerText = coreContentImg;
    document.getElementById('coreGroupContent').innerText = coreGroupContent;
    return coreGroupImage + coreGroupTitle + coreGroupDes + coreGroupContent;
}

function wordTrim(value, length) {
    value = value.trim();
    if (value.length <= length) return value;
    var strAry = value.split(' ');
    var retString = strAry[0];
    for (var i = 1; i < strAry.length; i++) {
        if (retString.length >= length || retString.length + strAry[i].length + 1 > length) break;
        retString += " " + strAry[i];
    }
    return retString;
}

function count_words(str) {
    str = str.replace(/(^\s*)|(\s*$)/gi, "");
    str = str.replace(/[ ]{2,}/gi, " ");
    str = str.replace(/\n /, "\n");
    return str.split(' ').length;
}

function change_alias(alias) {
    var str = alias;
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g, " ");
    str = str.replace(/ + /g, " ");
    str = str.trim();
    return str;
}