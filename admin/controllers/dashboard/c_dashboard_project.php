<?php

include_once("models/m_dashboard.php");
$Dashboard = new Dashboard();
$array_users = $Dashboard->getAllUserIDKey()??null;

$project_tag = $Dashboard->getProjectsTag() ?? null;
$str_name_projects = '[';
$str_total_projects = '[';
foreach(array_reverse($project_tag) as $k=>$project){
    $str_name_projects .= ($k!=0?',':'') . '"'.$project['project_tags'].'"';
    $str_total_projects .= ($k!=0?',':'') . '"'.$project['total'].'"';
}
$str_name_projects .= ']';
$str_total_projects .= ']';

$project_user = $Dashboard->getProjectUser() ?? null;
$str_name_users = '[';
$str_total_users = '[';
foreach(array_reverse($project_user) as $k=>$project){
    $str_name_users .= ($k!=0?',':'') . '"'.$array_users[$project['project_user_id']]['user_fullname'].'"';
    $str_total_users .= ($k!=0?',':'') . '"'.$project['total'].'"';
}
$str_name_users .= ']';
$str_total_users .= ']';

$limit = 5;
$project_view = $Dashboard->getProjectsView($limit) ?? null;
$str_title_projects = '[';
$str_view_projects = '[';
foreach(array_reverse($project_view) as $k=>$project){
    $str_title_projects .= ($k!=0?',':'') . '"'.$project['project_title'].'"';
    $str_view_projects .= ($k!=0?',':'') . '"'.$project['project_total_view'].'"';
}
$str_title_projects .= ']';
$str_view_projects .= ']';
include_once("views/dashboard/v_dashboard_project.php");