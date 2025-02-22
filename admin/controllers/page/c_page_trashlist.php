<?php

include_once("models/m_page.php");
$Page = new Page();
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
    $pages = $Page->getAllPageSearchSortPage($keyword, $sort, $sby, $from, $perpage, "`page_stt`=3") ?? null;
    $count_pages = $Page->countPageSearch($keyword, "`page_stt`=3") ?? null;
    $total_page = ceil($count_pages / $perpage);
    if ($count_pages > 0) {
        include_once("views/page/v_page_trashlistdata.php");
    } else {
        echo "empty";
    }
}else if(@$_POST['action']=='restore'){ 
    $id = $_POST['id'] ?? null;
    $time = time();
    $page = $Page->getPageById($id) ?? null;
    if ($page!=null) {
        $res = $Page->setSTTPage($id, 1, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='delete'){ 
    $id = $_POST['id'] ?? null;
    $page = $Page->getPageById($id) ?? null;
    if ($page!=null) {
        $folder = DIR_PUBLIC.'/pages/'.substr($page['page_slug'],0,70);
        if (file_exists($folder)) {
            $Database->removeDirectory($folder) ?? false;
        }
        $res = $Page->deletePage($id) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    include_once("models/m_user.php");
    $User = new User();
    $list_user = $User->getAllUser() ?? null;
    $title = "Trang đã xóa";
    include_once("shared/layout.php");
}