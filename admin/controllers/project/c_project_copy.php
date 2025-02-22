<?php

require_once('models/m_project.php');
$Project = new Project();
$project = $Project->getProjectById($id) ?? null;
$project_user_id = $auth['user_id'];
$project_title = 'Copy | '.$project['project_title'] ?? null;
$project_slug_old = $project['project_slug'];
$project_slug_new = $project_slug_old.'-'.rand(100,999);
$project_tags = $project['project_tags'] ?? null;
$project_desc = $project['project_desc'] ?? null;
$time = time();
$check_project = $Project->getProjectBySlug($project_slug_new) ?? null;
if ($check_project==null) {
    $folder_old = DIR_PUBLIC.'/projects/'.substr($project_slug_old,0,70);
    $file_old = $project_slug_old.'.webp';
    $folder_new = DIR_PUBLIC.'/projects/'.substr($project_slug_new,0,70);
    $file_new = $project_slug_new.'.webp';
    if (!file_exists($folder_new)) {
        @mkdir($folder_new,0777);
    }
    $content_image = @file_get_contents($folder_old.'/'.$file_old);
    @file_put_contents($folder_new.'/'.$file_new, $content_image);
    @chmod($folder_new.'/'.$file_new, 0777);
    $res = $Project->createProject($project_user_id, $project_title, $project_slug_new, $project_tags, $project_desc, $time) ?? false;
    $new_project = $Project->getProjectBySlug($project_slug_new) ?? null;
    echo $new_project ? $new_project['project_id'] : "error";
    header('location: ' . URL_DOMAIN . '/admin/project/edit/' . $new_project['project_id'] . URL_FOOT);
    exit;
}