<?php

if (in_array($type, array(0))) {
    include_once("models/m_user.php");
    $User = new User();
    if (isset($id) && isset($_FILES['avatar'])) {
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
    }else if (isset($id) && isset($_POST['fullname'])) {
        $username = $_POST['username'] ?? null;
        $fullname = $_POST['fullname'] ?? null;
        $password = $_POST['password'] ?? null;
        $type = $_POST['type'] ?? null;
        $time = time();
        if ($password != null) {
            $res = $User->updateUser($id, $type, $username, $password, $fullname, $time) ?? false;
        } else {
            $res = $User->updateUserNotPass($id, $type, $username, $fullname, $time) ?? false;
        }
        echo $res ? 'success' : '';
    } else if(isset($id)){
        $user = $User->getFirstUser($id) ?? null;
        $title_back = "Tài khoản nhân viên";
        $link_title_back = URL_DOMAIN . '/admin/user/list' . URL_FOOT;
        $title = "Chỉnh sửa ".$user['user_fullname'];
        include_once("shared/layout.php");
    }
}