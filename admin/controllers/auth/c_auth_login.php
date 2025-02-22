<?php

require_once('models/m_authencation.php');
$Authen = new Authen();
if ($Authen->getAuth()) {
    header('location: ' . URL_DOMAIN.'/admin/dashboard' . URL_FOOT);
} else {
    if (isset($_POST['username']) || isset($_POST['password'])) {
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $res = $Authen->loginByUsernamePassword($username, $password) ?? false;
        if ($res) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        $title = "Đăng nhập hệ thống";
        include_once("shared/layout.php");
    }
}