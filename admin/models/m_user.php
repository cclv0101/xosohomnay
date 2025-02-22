<?php

class User extends Database {

    public function getAllUser($stt=1) {
        $sql = "SELECT * FROM `tbl_user` WHERE `user_stt`=$stt";
        return $this->select($sql) ?? null;
    }

    public function createUser($type, $username, $password, $fullname, $time) {
        $md5_password = md5($password);
        $sql = "INSERT INTO `tbl_user`(`user_id`, `user_stt`, `user_type`, `user_username`, `user_password`, `user_fullname`, `user_created`, `user_updated`) VALUES (NULL,2,$type,'$username','$md5_password','$fullname','$time','$time')";
        return $this->query($sql) ?? false;
    }

    public function getFirstUser($id) {
        $sql = "SELECT * FROM `tbl_user` WHERE `user_id`=$id LIMIT 1";
        return $this->select($sql)[0] ?? false;
    }

    public function updateUser($id, $type, $username, $password, $fullname, $time) {
        $hash_password = md5($password);
        $sql = "UPDATE `tbl_user` SET `user_type`='$type', `user_username`='$username', `user_password`='$hash_password', `user_fullname`='$fullname', `user_updated`=$time  WHERE `user_id`=$id";
        return $this->query($sql) ?? false;
    }

    public function updateUserNotPass($id, $type, $username, $fullname, $time) {
        $sql = "UPDATE `tbl_user` SET `user_type`='$type', `user_username`='$username', `user_fullname`='$fullname', `user_updated`=$time  WHERE `user_id`=$id";
        return $this->query($sql) ?? false;
    }

    public function setSTTUser($id, $stt) {
        $sql = "UPDATE `tbl_user` SET `user_stt`=$stt WHERE `user_id`=$id";
        return $this->query($sql) ?? null;
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM `tbl_user` WHERE `user_id`=$id";
        return $this->query($sql) ?? null;
    }

    public function checkUsername($username)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE `user_username`='$username'";
        return @$this->select($sql)[0] ? true : false;
    }
}
