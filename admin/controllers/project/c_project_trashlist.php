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
    $projects = $Project->getAllProjectSearchSortPage($keyword, $sort, $sby, $from, $perpage, '`project_stt`=3') ?? null;
    $count_projects = $Project->countProjectSearch($keyword, '`project_stt`=3') ?? null;
    $total_page = ceil($count_projects / $perpage);
    if ($count_projects > 0) {
        include_once("views/project/v_project_trashlistdata.php");
    } else {
        echo "empty";
    }
}else if(@$_POST['action']=='restore'){ 
    $id = $_POST['id'] ?? null;
    $time = time();
    $project = $Project->getProjectById($id) ?? null;
    if ($project!=null) {
        $res = $Project->setSTTProject($id, 1, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='delete'){ 
    $id = $_POST['id'] ?? null;
    $project = $Project->getProjectById($id) ?? null;
    if ($project!=null) {
        $folder = DIR_PUBLIC.'/projects/'.substr($project['project_slug'],0,70);
        if (file_exists($folder)) {
            $Database->removeDirectory($folder) ?? false;
        }
        $res = $Project->deleteProject($id) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    include_once("models/m_user.php");
    $User = new User();
    $list_user = $User->getAllUser() ?? null;
    $title = "CTKM đã xóa";
    include_once("shared/layout.php");
}