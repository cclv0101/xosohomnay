<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
try {
    if (@session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    $ctl = $_GET['ctl'] ?? "ket-qua-xo-so";
    $id = $_GET['id'] ?? '';
    require_once('system/config.php');
    $Config = new Config();
    require_once('system/database.php');
    $Database = new Database();
    require_once('models/myos.php');
    $MyOS = new MyOS();
    switch ($ctl) {
        case OS_URL_HOME:
            $name_file_ctl = "home.php";
            break;
        default:
            $name_file_ctl = "error.php";
    }
    $arrDai=[
        "mien-bac"=>"Miền bắc",
        "an-giang"=>"An Giang",
        "bac-lieu"=>"Bạc Liêu",
        "ben-tre"=>"Bến Tre",
        "binh-dinh"=>"Bình Định",
        "binh-duong"=>"Bình Dương",
        "binh-phuoc"=>"Bình Phước",
        "binh-thuan"=>"Bình Thuận",
        "ca-mau"=>"Cà Mau",
        "can-tho"=>"Cần Thơ",
        "da-lat"=>"Đà Lạt",
        "da-nang"=>"Đà Nẵng",
        "dak-lak"=>"Đắk Lắk",
        "dak-nong"=>"Đắk Nông",
        "dong-nai"=>"Đồng Nai",
        "dong-thap"=>"Đồng Tháp",
        "gia-lai"=>"Gia Lai",
        "hau-giang"=>"Hậu Giang",
        "khanh-hoa"=>"Khánh Hòa",
        "kien-giang"=>"Kiên Giang",
        "kon-tum"=>"Kon Tum",
        "long-an"=>"Long An",
        "ninh-thuan"=>"Ninh Thuận",
        "phu-yen"=>"Phú Yên",
        "quang-binh"=>"Quảng Bình",
        "quang-nam"=>"Quảng Nam",
        "quang-ngai"=>"Quảng Ngãi",
        "quang-tri"=>"Quảng Trị",
        "soc-trang"=>"Sóc Trăng",
        "tay-ninh"=>"Tây Ninh",
        "thua-thien-hue"=>"Thừa T. Huế",
        "tien-giang"=>"Tiền Giang",
        "tp-hcm"=>"TP. HCM",
        "tra-vinh"=>"Trà Vinh",
        "vinh-long"=>"Vĩnh Long",
        "vung-tau"=>"Vũng Tàu",
    ];
    @include_once("controllers/" . $name_file_ctl);
} catch (Exception $ex) {
    header("location: ".URL_DOMAIN.'/'.OS_URL_HOME.URL_FOOT_OS);
    exit;
}

