<?php

if(@$id){
    $service = $MyOS->getServiceBySlug($id) ?? null;
    if(@$service){
        $service_recomment = $MyOS->getRecommentServices($service['service_id']) ?? null;
        $title = str_replace('"',"",$service['service_title']);
        $description = str_replace('"',"",$service['service_desc']);
        $keyword = $service['service_tags'];
        $image = URL_PUBLIC.'/services/'.substr($service['service_slug'],0,70).'/'.$service['service_slug'].'.webp';
        $author = $MyOS->getUserByID(@$service['service_user_id']);
        $subtitle='Tác giả: '.@$author['user_fullname'].' | Lượt xem: '.@$service['service_total_view'].' | Ngày đăng: '.date('H:i d/m/Y',$service['service_updated']);
        $MyOS->setViewService($service['service_id']);
        include_once("shared/layout.php");
    }else{
        header("location: ".URL_DOMAIN.URL_FOOT_OS);
    }
}else{
    header("location: ".URL_DOMAIN.URL_FOOT_OS);
}