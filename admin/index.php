<?php
try {
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    require_once('../system/config.php');
    $Config = new Config();
    require_once('../system/database.php');
    $Database = new Database();
    require_once('../system/setting/os.php');
    $ctl = $_GET['ctl'] ?? "dashboard";
    $act = $_GET['act'] ?? null;
    $id = $_GET['id'] ?? null;
    if ($ctl . $act == 'authlogin') {
        include_once("controllers/auth/c_auth_login.php");
    } else {
        require_once('models/m_authencation.php');
        $Authen = new Authen();
        $auth = $Authen->getAuth()??null;
        $type = $auth['user_type']??3;
        if ($auth == false) {
            header('location: ' . URL_DOMAIN . '/admin/auth/login' . URL_FOOT);
            exit;
        } else {
            if ($act == null) {
                $name_file_ctl = "c_" . $ctl . ".php";
                @include_once("controllers/" . $ctl . "/" . $name_file_ctl);
            } else {
                $name_file_ctl = "c_" . $ctl . "_" . $act . ".php";
                @include_once("controllers/" . $ctl . "/" . $name_file_ctl);
            }
        }
    }
} catch (Exception $ex) {
    echo $ex;
    exit;
}
