<?php

include_once("models/m_article.php");
$Article = new Article();
if (isset($id) && isset($_FILES['avatar'])) { 
    $article = $Article->getArticleById($id) ?? null;
    if ($article!=null) {
        $article_slug= $article['article_slug'];
        $folder = DIR_PUBLIC.'/articles/'.substr($article['article_slug'],0,70);
        $file = $article_slug.'.webp';
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
    $article_title = $_POST['article_title'] ?? null;
    $article_slug = $_POST['article_slug'] ?? null;
    $article_tags = $_POST['article_tags'] ?? null;
    $article_desc = $_POST['article_desc'] ?? null;
    $article_content = $_POST['article_content'] ?? null;
    $time = time();
    $article = $Article->getArticleById($id) ?? null;
    if ($article!=null) {
        if($article['article_slug']!=$article_slug){
            $check_slug_article = $Article->getArticleBySlug($article_slug) ?? null;
            if ($check_slug_article==null) {
                $folder_old = DIR_PUBLIC.'/articles/'.substr($article['article_slug'],0,70);
                $file_old = $article['article_slug'].'.webp';
                $folder_new = DIR_PUBLIC.'/articles/'.substr($article_slug,0,70);
                $file_new = $article_slug.'.webp';
                if (file_exists($folder_old)&&!file_exists($folder_new)) {
                    @rename($folder_old, $folder_new);
                    @rename($folder_new.'/'.$file_old, $folder_new.'/'.$file_new);
                }
            }else{
                echo 'slug isset';exit;
            }
        }
        $res = $Article->updateArticle($id, $article_title, $article_slug, $article_tags, $article_desc, $article_content, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    $article = $Article->getArticleById($id) ?? null;
    $title_back = "Danh sách bài viết";
    $link_title_back = URL_DOMAIN . '/admin/article/list' . URL_FOOT;
    $title = "Chỉnh sửa bài viết ".$article['article_title'];
    include_once("shared/layout.php");
}