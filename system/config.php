<?php
class Config
{
    public function __construct()
    {
        require_once "setting/dbs.php";
        require_once "setting/url.php";
        require_once "setting/os.php";
        require_once "setting/ctn.php";
        require_once "setting/bke.php";
        require_once "setting/exe.php";
        require_once "setting/frl.php";
        require_once "setting/cate.php";
        @setlocale(LC_ALL,LANG_CODE);
        @date_default_timezone_set(OS_TIMEZONE);
    }
}
