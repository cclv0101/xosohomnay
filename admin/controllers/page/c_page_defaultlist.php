<?php

include_once("models/m_page.php");
$Page = new Page();
if(@$_POST['action']=='listdata'){ 
    $pages=[];
    foreach(OS_URL_ARRAY as $p){
        $pages[]= $Page->getPageBySlug($p) ?? null;
    }
    include_once("views/page/v_page_defaultlistdata.php");
}else if(@$_POST['action']=='checkpage'){ 
    foreach(OS_URL_ARRAY as $p){
        $page = $Page->getPageBySlug($p) ?? null;
        $res = true;
        if ($page==null) {
            $page_title = strtoupper(str_replace('-',' ',$p));
            $page_slug = $p;
            $page_desc = $page_title;
            $time = time();
            $folder = DIR_PUBLIC.'/pages/'.substr($page_slug,0,70);
            $file = $page_slug.'.webp';
            if (!file_exists($folder)) {
                @mkdir($folder,0777);
            }
            $content_image = @file_get_contents(DIR_PUBLIC.'/default_thumbnail_page.webp');
            @file_put_contents($folder.'/'.$file, $content_image);
            @chmod($folder.'/'.$file, 0777);
            $r = $Page->createPage($page_title, $page_slug, $page_desc, $time) ?? false;
            $res = $r?$res:false;
        }
    }
    echo $res ? "success" : "error";
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
    $title = "Trang mặc định";
    include_once("shared/layout.php");
}