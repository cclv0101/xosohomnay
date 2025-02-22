<?php
if (isset($_POST['oldpass']) && isset($_POST['oldpass']) && isset($_POST['oldpass'])) {
    require_once('models/m_authencation.php');
    $Authen = new Authen();
    $iduser = $auth['user_id'] ?? null;
    $oldpass = $_POST['oldpass'] ?? null;
    $pass1 = $_POST['pass1'] ?? null;
    $pass2 = $_POST['pass2'] ?? null;
    if ($Authen->checkPassword($iduser, $oldpass)) {
        if ($pass1 === $pass2) {
            $time = time();
            $res = $Authen->rePassword($iduser, $pass1, $time) ?? false;
            if ($res != false) {
                echo 'success';
            } else {
                echo 'Đã xảy ra lỗi hệ thống';
            }
        } else {
            echo 'Bạn đã nhập sai mật khẩu của mình';
        }
    } else {
        echo 'Mật khẩu hiện tại không đúng';
    }
} else {
    $title = "Đổi mật khẩu";
    include_once("shared/layout.php");
}