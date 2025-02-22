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
    $services = $Service->getAllServiceSearchSortPage($keyword, $sort, $sby, $from, $perpage) ?? null;
    $count_services = $Service->countServiceSearch($keyword) ?? null;
    $total_page = ceil($count_services / $perpage);
    if ($count_services > 0) {
        include_once("views/service/v_service_listdata.php");
    } else {
        echo "empty";
    }
}else if(@$_POST['action']=='create'){ 
    $service_user_id = $auth['user_id'];
    $service_title = $_POST['service_title'] ?? null;
    $service_slug = $_POST['service_slug'] ?? null;
    $service_tags = $_POST['service_tags'] ?? null;
    $service_desc = $_POST['service_desc'] ?? null;
    $time = time();
    $service = $Service->getServiceBySlug($service_slug) ?? null;
    if ($service==null) {
        $folder = DIR_PUBLIC.'/services/'.substr($service_slug,0,70);
        $file = $service_slug.'.webp';
        if (!file_exists($folder)) {
            @mkdir($folder,0777);
        }
        $content_image = @file_get_contents(DIR_PUBLIC.'/default_thumbnail_service.webp');
        @file_put_contents($folder.'/'.$file, $content_image);
        @chmod($folder.'/'.$file, 0777);
        $res = $Service->createService($service_user_id, $service_title, $service_slug, $service_tags, $service_desc, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='trash'){ 
    $id = $_POST['id'] ?? null;
    $time = time();
    $service = $Service->getServiceById($id) ?? null;
    if ($service!=null) {
        $res = $Service->setSTTService($id, 3, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='stt'){ 
    $id = $_POST['id'] ?? null;
    $stt = $_POST['stt'] ?? null;
    $time = time();
    $service = $Service->getServiceById($id) ?? null;
    if ($service!=null) {
        $res = $Service->setSTTService($id, $stt, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    include_once("models/m_user.php");
    $User = new User();
    $list_user = $User->getAllUser() ?? null;
    $title = "Danh sách dịch vụ";
    include_once("shared/layout.php");
}