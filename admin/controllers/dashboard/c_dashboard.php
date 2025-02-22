<?php

if(@$_POST['action']){
    $action = $_POST['action']??'';
    include_once("controllers/dashboard/c_dashboard_$action.php");
}else{
    $title = "Bảng điều khiển";
    include_once("shared/layout.php");
}