<?php

class Authen extends Database
{
    public static $auth = NULL;

    public function __construct()
    {
        try {
            if (!self::$auth) {
                self::$auth = $this->getDataAuth() ?? null;
            }
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    public function getAuth()
    {
        return self::$auth;
    }

    public function getDataAuth()
    {
        $token = base64_decode(@$_COOKIE['DataTokenAuth'])??null;
        $sql = "SELECT * FROM `tbl_user` WHERE `user_username` = '$token'";
        return $this->select($sql)[0]??null;
    }

    public function loginByUsernamePassword($username, $password)
    {
        $has_password = md5($password);
        $sql = "SELECT * FROM `tbl_user` WHERE `user_username`='$username' AND `user_password`='$has_password' AND `user_stt`=1";
        $user = $this->select($sql)[0]??null;
        if ($user) {
            setcookie('DataTokenAuth', base64_encode($user['user_username']), time() + (86400 * 30), "/");
            return true;
        }else{
            return false;
        }
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE `user_username`='$username' AND `user_stt`=1";
        return $this->select($sql)[0]??null;
    }

    public function updateProfile($iduser, $fullname)
    {
        $time = time();
        $sql = "UPDATE `tbl_user` SET `user_fullname`='$fullname', `user_updated`='$time' WHERE `user_id`=$iduser";
        return $this->query($sql) ?? false;
    }

    public function rePassword($id, $password, $time)
    {
        $has_password = md5($password);
        $sql = "UPDATE `tbl_user` SET `user_password`='$has_password', `user_updated`='$time' WHERE `user_id`=$id";
        return $this->query($sql) ?? false;
    }

    public function checkPassword($id, $password)
    {
        $has_password = md5($password);
        $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '$id' AND `user_password` = '$has_password' ";
        $res = $this->select($sql)[0] ?? null;
        if ($res != null) {
            return true;
        } else {
            return false;
        }
    }
}
