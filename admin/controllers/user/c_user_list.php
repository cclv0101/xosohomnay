<?php

if (in_array($type, array(0))) {
    include_once("models/m_user.php");
    $User = new User();
    if(@$_POST['action']=='listdata'){ 
        $stt = @$_POST['stt']??2;
        $stt_color = $stt==0?'secondary':($stt==1?'primary':($stt==3?'danger':'warning'));
        $users = $User->getAllUser(@$_POST['stt']) ?? null;
        if (count($users) > 0) {
            include_once("views/user/v_user_listdata.php");
        } else {
            echo "empty";
        }
    }else if(@$_POST['action']=='create'){ 
        $type = $_POST['type'] ?? null;
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $fullname = $_POST['fullname'] ?? null;
        $time = time();
        $check_username = $User->checkUsername($username) ?? true;
        if (!$check_username) {
            $folder = DIR_PUBLIC.'/users/'.$username;
            $file = 'avatar.webp';
            if (!file_exists($folder)) {
                @mkdir($folder,0777);
            }
            $content_image = @file_get_contents(DIR_PUBLIC.'/default_thumbnail_user.webp');
            @file_put_contents($folder.'/'.$file, $content_image);
            @chmod($folder.'/'.$file, 0777);
            $res = $User->createUser($type, $username, $password, $fullname, $time) ?? false;
            echo $res ? "success" : "error";
        }
    }else if(@$_POST['action']=='action' && @$_POST['user_id']){
        if(@$_POST['user_stt']==4){
            $user = $User->getFirstUser(@$_POST['user_id']) ?? true;
            $dirname = DIR_PUBLIC.'/users/'.$user['user_username'];
            array_map('unlink', glob("$dirname/*.*"));
            @rmdir($dirname);
            $res = $User->deleteUser($_POST['user_id']) ?? false;
            echo $res?'success':'error';
        }else{
            $res = $User->setSTTUser($_POST['user_id'],@$_POST['user_stt']) ?? false;
            echo $res?'success':'error';
        }
    }else{
        $title = "Tài khoản nhân viên";
        include_once("shared/layout.php");
    }
}