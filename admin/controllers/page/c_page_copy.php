<?php

require_once('models/m_page.php');
$Page = new Page();
$page = $Page->getPageById($id) ?? null;
$page_title = 'Copy | '.$page['page_title'] ?? null;
$page_slug_old = $page['page_slug'];
$page_slug_new = $page_slug_old.'-'.rand(100,999);
$page_desc = $page['page_desc'] ?? null;
$time = time();
$check_page = $Page->getPageBySlug($page_slug_new) ?? null;
if ($check_page==null) {
    $folder_old = DIR_PUBLIC.'/pages/'.substr($page_slug_old,0,70);
    $file_old = $page_slug_old.'.webp';
    $folder_new = DIR_PUBLIC.'/pages/'.substr($page_slug_new,0,70);
    $file_new = $page_slug_new.'.webp';
    if (!file_exists($folder_new)) {
        @mkdir($folder_new,0777);
    }
    $content_image = @file_get_contents($folder_old.'/'.$file_old);
    @file_put_contents($folder_new.'/'.$file_new, $content_image);
    @chmod($folder_new.'/'.$file_new, 0777);
    $res = $Page->createPage($page_title, $page_slug_new, $page_desc, $time) ?? false;
    $new_page = $Page->getPageBySlug($page_slug_new) ?? null;
    echo $new_page ? $new_page['page_id'] : "error";
    header('location: ' . URL_DOMAIN . '/admin/page/edit/' . $new_page['page_id'] . URL_FOOT);
    exit;
}