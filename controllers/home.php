<?php
if (@$id=='') {
    $weekday = date("l");
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $id = 'tp-hcm';
            break;
        case 'tuesday':
            $id = 'vung-tau';
            break;
        case 'wednesday':
            $id = 'dong-nai';
            break;
        case 'thursday':
            $id = 'tay-ninh';
            break;
        case 'friday':
            $id = 'binh-duong';
            break;
        case 'saturday':
            $id = 'long-an';
            break;
        default:
            $id = 'tien-giang';
            break;
    }
}
$day=@$_GET['day']??null;
$province=$arrDai[$id];
$pvA=str_contains($province,'Miền')?'':'Tỉnh ';
$newTextToday=$day?(' ngày '.$day):(' mới nhất '.$day);
$title='Kết quả xổ số kiến thiết '.$pvA.$province.$newTextToday;
$description=$title.' | KQXS '.$province;
include_once("shared/layout.php");