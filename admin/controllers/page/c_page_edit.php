<?php

include_once("models/m_page.php");
$Page = new Page();
if (isset($id) && isset($_FILES['avatar'])) { 
    $page = $Page->getPageById($id) ?? null;
    if ($page!=null) {
        $page_slug= $page['page_slug'];
        $folder = DIR_PUBLIC.'/pages/'.substr($page['page_slug'],0,70);
        $file = $page_slug.'.webp';
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
    $page_title = $_POST['page_title'] ?? null;
    $page_slug = $_POST['page_slug'] ?? null;
    $page_desc = $_POST['page_desc'] ?? null;
    $page_content = $_POST['page_content'] ?? null;
    $time = time();
    $page = $Page->getPageById($id) ?? null;
    if ($page!=null) {
        if($page['page_slug']!=$page_slug){
            $check_slug_page = $Page->getPageBySlug($page_slug) ?? null;
            if ($check_slug_page==null) {
                $folder_old = DIR_PUBLIC.'/pages/'.substr($page['page_slug'],0,70);
                $file_old = $page['page_slug'].'.webp';
                $folder_new = DIR_PUBLIC.'/pages/'.substr($page_slug,0,70);
                $file_new = $page_slug.'.webp';
                if (file_exists($folder_old)&&!file_exists($folder_new)) {
                    @rename($folder_old, $folder_new);
                    @rename($folder_new.'/'.$file_old, $folder_new.'/'.$file_new);
                }
            }else{
                echo 'slug isset';exit;
            }
        }
        $res = $Page->updatePage($id, $page_title, $page_slug, $page_desc, $page_content, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    $page = $Page->getPageById($id) ?? null;
    $title_back = "Danh sách trang";
    $link_title_back = URL_DOMAIN . '/admin/page/list' . URL_FOOT;
    $title = "Chỉnh sửa trang ".$page['page_title'];
    include_once("shared/layout.php");
}