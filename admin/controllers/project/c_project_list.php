<?php

include_once("models/m_project.php");
$Project = new Project();
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
    $projects = $Project->getAllProjectSearchSortPage($keyword, $sort, $sby, $from, $perpage) ?? null;
    $count_projects = $Project->countProjectSearch($keyword) ?? null;
    $total_page = ceil($count_projects / $perpage);
    if ($count_projects > 0) {
        include_once("views/project/v_project_listdata.php");
    } else {
        echo "empty";
    }
}else if(@$_POST['action']=='create'){ 
    $project_user_id = $auth['user_id'];
    $project_title = $_POST['project_title'] ?? null;
    $project_slug = $_POST['project_slug'] ?? null;
    $project_tags = $_POST['project_tags'] ?? null;
    $project_desc = $_POST['project_desc'] ?? null;
    $time = time();
    $project = $Project->getProjectBySlug($project_slug) ?? null;
    if ($project==null) {
        $folder = DIR_PUBLIC.'/projects/'.substr($project_slug,0,70);
        $file = $project_slug.'.webp';
        if (!file_exists($folder)) {
            @mkdir($folder,0777);
        }
        $content_image = @file_get_contents(DIR_PUBLIC.'/default_thumbnail_project.webp');
        @file_put_contents($folder.'/'.$file, $content_image);
        @chmod($folder.'/'.$file, 0777);
        $res = $Project->createProject($project_user_id, $project_title, $project_slug, $project_tags, $project_desc, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='trash'){ 
    $id = $_POST['id'] ?? null;
    $time = time();
    $project = $Project->getProjectById($id) ?? null;
    if ($project!=null) {
        $res = $Project->setSTTProject($id, 3, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='stt'){ 
    $id = $_POST['id'] ?? null;
    $stt = $_POST['stt'] ?? null;
    $time = time();
    $project = $Project->getProjectById($id) ?? null;
    if ($project!=null) {
        $res = $Project->setSTTProject($id, $stt, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    include_once("models/m_user.php");
    $User = new User();
    $list_user = $User->getAllUser() ?? null;
    $title = "Danh sách CTKM";
    include_once("shared/layout.php");
}