<?php

if($id){
    $project = $MyOS->getProjectBySlug($id) ?? null;
    if(@$project){
        $project_recomment = $MyOS->getRecommentProjects($project['project_id']) ?? null;
        $title = str_replace('"',"",$project['project_title']);
        $description = str_replace('"',"",$project['project_desc']);
        $keyword = $project['project_tags'];
        $image = URL_PUBLIC.'/projects/'.substr($project['project_slug'],0,70).'/'.$project['project_slug'].'.webp';
        $author = $MyOS->getUserByID(@$project['project_user_id']);
        $subtitle='Tác giả: '.@$author['user_fullname'].' | Lượt xem: '.@$project['project_total_view'].' | Ngày đăng: '.date('H:i d/m/Y',$project['project_updated']);
        $MyOS->setViewProject($project['project_id']);
        include_once("shared/layout.php");
    }else{
        header("location: ".URL_DOMAIN.URL_FOOT_OS);
    }
}else{
    header("location: ".URL_DOMAIN.URL_FOOT_OS);
}