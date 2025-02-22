<?php

include_once("models/m_service.php");
$Service = new Service();
if (isset($id) && isset($_FILES['avatar'])) { 
    $service = $Service->getServiceById($id) ?? null;
    if ($service!=null) {
        $service_slug= $service['service_slug'];
        $folder = DIR_PUBLIC.'/services/'.substr($service['service_slug'],0,70);
        $file = $service_slug.'.webp';
        if (!file_exists($folder)) {
            @mkdir($folder,0777);
        }
        $tmp_name = $_FILES['avatar']['tmp_name'];
        if (@move_uploaded_file($tmp_name, $folder.'/'.$file)) {
           @chmod($folder.'/'.$file, 0777);
            echo 'success';
            exit;
        }
    }
}else if(@$_POST['action']=='update'){ 
    $service_title = $_POST['service_title'] ?? null;
    $service_slug = $_POST['service_slug'] ?? null;
    $service_tags = $_POST['service_tags'] ?? null;
    $service_desc = $_POST['service_desc'] ?? null;
    $service_content = $_POST['service_content'] ?? null;
    $time = time();
    $service = $Service->getServiceById($id) ?? null;
    if ($service!=null) {
        if($service['service_slug']!=$service_slug){
            $check_slug_service = $Service->getServiceBySlug($service_slug) ?? null;
            if ($check_slug_service==null) {
                $folder_old = DIR_PUBLIC.'/services/'.substr($service['service_slug'],0,70);
                $file_old = $service['service_slug'].'.webp';
                $folder_new = DIR_PUBLIC.'/services/'.substr($service_slug,0,70);
                $file_new = $service_slug.'.webp';
                if (file_exists($folder_old)&&!file_exists($folder_new)) {
                    @rename($folder_old, $folder_new);
                    @rename($folder_new.'/'.$file_old, $folder_new.'/'.$file_new);
                }
            }else{
                echo 'slug isset';exit;
            }
        }
        $res = $Service->updateService($id, $service_title, $service_slug, $service_tags, $service_desc, $service_content, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    $service = $Service->getServiceById($id) ?? null;
    $title_back = "Danh sách dịch vụ";
    $link_title_back = URL_DOMAIN . '/admin/service/list' . URL_FOOT;
    $title = "Chỉnh sửa dịch vụ ".$service['service_title'];
    include_once("shared/layout.php");
}