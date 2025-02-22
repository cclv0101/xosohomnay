<?php

include_once("models/m_service.php");
$Service = new Service();
if(@$_POST['action']=='listdata'){ 
    $keyword = $_POST["keyword"] ?? "";
    $sort = $_POST["sort_name"] ?? "";
    $sby = $_POST["sort_by"] ?? "DESC";
    $page = $_POST["current_page"] ?? "1";
    $from = 0;
    $perpage = 10;
    if ($page == "" || $page == null) {
        $page = "1";
    }
    $from = ($page - 1) * $perpage;
    $services = $Service->getAllServiceSearchSortPage($keyword, $sort, $sby, $from, $perpage, '`service_stt`=3') ?? null;
    $count_services = $Service->countServiceSearch($keyword, '`service_stt`=3') ?? null;
    $total_page = ceil($count_services / $perpage);
    if ($count_services > 0) {
        include_once("views/service/v_service_trashlistdata.php");
    } else {
        echo "empty";
    }
}else if(@$_POST['action']=='restore'){ 
    $id = $_POST['id'] ?? null;
    $time = time();
    $service = $Service->getServiceById($id) ?? null;
    if ($service!=null) {
        $res = $Service->setSTTService($id, 1, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='delete'){ 
    $id = $_POST['id'] ?? null;
    $service = $Service->getServiceById($id) ?? null;
    if ($service!=null) {
        $folder = DIR_PUBLIC.'/services/'.substr($service['service_slug'],0,70);
        if (file_exists($folder)) {
            $Database->removeDirectory($folder) ?? false;
        }
        $res = $Service->deleteService($id) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    include_once("models/m_user.php");
    $User = new User();
    $list_user = $User->getAllUser() ?? null;
    $title = "Dịch vụ đã xóa";
    include_once("shared/layout.php");
}