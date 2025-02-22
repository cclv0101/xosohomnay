<?php

require_once('models/m_service.php');
$Service = new Service();
$service = $Service->getServiceById($id) ?? null;
$service_user_id = $auth['user_id'];
$service_title = 'Copy | '.$service['service_title'] ?? null;
$service_slug_old = $service['service_slug'];
$service_slug_new = $service_slug_old.'-'.rand(100,999);
$service_tags = $service['service_tags'] ?? null;
$service_desc = $service['service_desc'] ?? null;
$time = time();
$check_service = $Service->getServiceBySlug($service_slug_new) ?? null;
if ($check_service==null) {
    $folder_old = DIR_PUBLIC.'/services/'.substr($service_slug_old,0,70);
    $file_old = $service_slug_old.'.webp';
    $folder_new = DIR_PUBLIC.'/services/'.substr($service_slug_new,0,70);
    $file_new = $service_slug_new.'.webp';
    if (!file_exists($folder_new)) {
        @mkdir($folder_new,0777);
    }
    $content_image = @file_get_contents($folder_old.'/'.$file_old);
    @file_put_contents($folder_new.'/'.$file_new, $content_image);
    @chmod($folder_new.'/'.$file_new, 0777);
    $res = $Service->createService($service_user_id, $service_title, $service_slug_new, $service_tags, $service_desc, $time) ?? false;
    $new_service = $Service->getServiceBySlug($service_slug_new) ?? null;
    echo $new_service ? $new_service['service_id'] : "error";
    header('location: ' . URL_DOMAIN . '/admin/service/edit/' . $new_service['service_id'] . URL_FOOT);
    exit;
}