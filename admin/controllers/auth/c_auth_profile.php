<?php
if (isset($_FILES['avatar'])) {
    $folder = DIR_PUBLIC.'/users/'.$_POST['username'];
    if (!file_exists($folder)) {
        @mkdir($folder,0777);
    }
    $tmp_name = $_FILES['avatar']['tmp_name'];
    $file_name = $_FILES['avatar']['name'];
    if (@move_uploaded_file($tmp_name, $folder.'/avatar.webp')) {
       @chmod($folder.'/avatar.webp', 0777);
        echo 'success';
        exit;
    }
}else if (isset($_POST['fullname'])) {
    require_once('models/m_authencation.php');
    $Authen = new Authen();
    $iduser = $auth['user_id'] ?? null;
    $fullname = $_POST['fullname'] ?? null;
    $res = $Authen->updateProfile($iduser, $fullname) ?? false;
    echo $res ? 'success' : 'danger';
} else {
    $title = "Thông tin ".$auth['user_fullname'];
    include_once("shared/layout.php");
}
