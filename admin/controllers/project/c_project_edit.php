<?php

include_once("models/m_project.php");
$Project = new Project();
if (isset($id) && isset($_FILES['avatar'])) { 
    $project = $Project->getProjectById($id) ?? null;
    if ($project!=null) {
        $project_slug= $project['project_slug'];
        $folder = DIR_PUBLIC.'/projects/'.substr($project['project_slug'],0,70);
        $file = $project_slug.'.webp';
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
    $project_title = $_POST['project_title'] ?? null;
    $project_slug = $_POST['project_slug'] ?? null;
    $project_tags = $_POST['project_tags'] ?? null;
    $project_desc = $_POST['project_desc'] ?? null;
    $project_content = $_POST['project_content'] ?? null;
    $time = time();
    $project = $Project->getProjectById($id) ?? null;
    if ($project!=null) {
        if($project['project_slug']!=$project_slug){
            $check_slug_project = $Project->getProjectBySlug($project_slug) ?? null;
            if ($check_slug_project==null) {
                $folder_old = DIR_PUBLIC.'/projects/'.substr($project['project_slug'],0,70);
                $file_old = $project['project_slug'].'.webp';
                $folder_new = DIR_PUBLIC.'/projects/'.substr($project_slug,0,70);
                $file_new = $project_slug.'.webp';
                if (file_exists($folder_old)&&!file_exists($folder_new)) {
                    @rename($folder_old, $folder_new);
                    @rename($folder_new.'/'.$file_old, $folder_new.'/'.$file_new);
                }
            }else{
                echo 'slug isset';exit;
            }
        }
        $res = $Project->updateProject($id, $project_title, $project_slug, $project_tags, $project_desc, $project_content, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    $project = $Project->getProjectById($id) ?? null;
    $title_back = "Danh sách CTKM";
    $link_title_back = URL_DOMAIN . '/admin/project/list' . URL_FOOT;
    $title = "Chỉnh sửa CTKM ".$project['project_title'];
    include_once("shared/layout.php");
}