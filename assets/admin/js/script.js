function timestampToString(cur, pre) {
    if (!pre || !cur) {
        return 'Chưa xác định';
    }
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

function timestampToStrings(elapsed) {
    var msPerMinute = 60;
    var msPerHour = msPerMinute * 60;
    var msPerDay = msPerHour * 24;
    var msPerMonth = msPerDay * 30;
    var msPerYear = msPerDay * 365;
    var num = "1";
    var unit = "giây";
    if (elapsed < msPerMinute) {
        num = elapsed;
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
    var result = num + unit;
    return result;
}

function setCookie(cname, cvalue) {
    const d = new Date();
    d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function loadBarChart(id, name, arr_name, arr_data, options, arr_color, arr_color_opacity) {
    var ctxB = document.getElementById(id).getContext('2d');
    return new Chart(ctxB, {
        type: 'bar',
        data: {
            labels: arr_name,
            datasets: [{
                label: name,
                data: arr_data,
                backgroundColor: arr_color_opacity,
                borderColor: arr_color,
                hoverBackgroundColor: arr_color,
                borderWidth: 1
            }]
        },
        options: options
    });
}

function loadPieChart(id, name, arr_name, arr_data, options, arr_color, arr_color_opacity) {
    var ctxP = document.getElementById(id).getContext('2d');
    return new Chart(ctxP, {
        type: 'doughnut',
        data: {
            labels: arr_name,
            datasets: [{
                label: name,
                data: arr_data,
                backgroundColor: arr_color_opacity,
                borderColor: arr_color,
                hoverBackgroundColor: arr_color
            }]
        },
        options: options
    });
}

function loadLineChart(id, name, arr_name, arr_data, options, color, color_opacity) {
    const lit = (window.screen.width/100 + 5)/arr_name.length;
    var new_arr_name = [];
    for (let index = 0; index < arr_name.length; index++) {
        new_arr_name.push(truncate(arr_name[index], lit,''));
    }
    var ctxL = document.getElementById(id).getContext('2d');
    return new Chart(ctxL, {
        type: 'line',
        data: {
            labels: new_arr_name,
            datasets: [{
                label: name,
                backgroundColor: color_opacity,
                borderColor: color,
                borderWidth: 2,
                data: arr_data
            }]
        },
        options: options
    });
}

function truncate(text, limit, append) {
    if (typeof text !== 'string')
        return '';
    if (typeof append == 'undefined')
        append = '...';
    var parts = text.split(' ');
    if (parts.length > limit) {
        // loop backward through the string
        for (var i = parts.length - 1; i > -1; --i) {
            // if i is over limit, drop this word from the array
            if (i+1 > limit) {
                parts.length = i;
            }
        }
        // add the truncate append text
        parts.push(append);
    }
    // join the array back into a string
    return parts.join(' ');
}