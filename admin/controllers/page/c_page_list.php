<?php

include_once("models/m_page.php");
$Page = new Page();
if(@$_POST['action']=='listdata'){ 
    $keyword = $_POST["keyword"] ?? "";
    $sort = $_POST["sort_name"] ?? "";
    $sby = $_POST["sort_by"] ?? "DESC";
    $p = $_POST["current_page"] ?? "1";
    $from = 0;
    $perpage = 30;
    if ($p == "" || $p == null) {
        $p = "1";
    }
    $from = ($p - 1) * $perpage;
    $pages = $Page->getAllPageSearchSortPage($keyword, $sort, $sby, $from, $perpage) ?? null;
    $count_pages = $Page->countPageSearch($keyword) ?? null;
    $total_page = ceil($count_pages / $perpage);
    if ($count_pages > 0) { 
        include_once("views/page/v_page_listdata.php");
    } else {
        echo "empty";
    }
}else if(@$_POST['action']=='create'){ 
    $page_title = $_POST['page_title'] ?? null;
    $page_slug = $_POST['page_slug'] ?? null;
    $page_desc = $_POST['page_desc'] ?? null;
    $time = time();
    $page = $Page->getPageBySlug($page_slug) ?? null;
    if ($page==null&& !in_array($page_slug,OS_URL_ARRAY)) {
        $folder = DIR_PUBLIC.'/pages/'.substr($page_slug,0,70);
        $file = $page_slug.'.webp';
        if (!file_exists($folder)) {
            @mkdir($folder,0777);
        }
        $content_image = @file_get_contents(DIR_PUBLIC.'/default_thumbnail_page.webp');
        @file_put_contents($folder.'/'.$file, $content_image);
        @chmod($folder.'/'.$file, 0777);
        $res = $Page->createPage($page_title, $page_slug, $page_desc, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='trash'){ 
    $id = $_POST['id'] ?? null;
    $time = time();
    $page = $Page->getPageById($id) ?? null;
    if ($page!=null) {
        $res = $Page->setSTTPage($id, 3, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='stt'){ 
    $id = $_POST['id'] ?? null;
    $stt = $_POST['stt'] ?? null;
    $time = time();
    $page = $Page->getPageById($id) ?? null;
    if ($page!=null) {
        $res = $Page->setSTTPage($id, $stt, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    $title = "Danh sách trang";
    include_once("shared/layout.php");
}