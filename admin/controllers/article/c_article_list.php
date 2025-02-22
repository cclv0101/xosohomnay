<?php

include_once("models/m_article.php");
$Article = new Article();
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
    $articles = $Article->getAllArticleSearchSortPage($keyword, $sort, $sby, $from, $perpage) ?? null;
    $count_articles = $Article->countArticleSearch($keyword) ?? null;
    $total_page = ceil($count_articles / $perpage);
    if ($count_articles > 0) {
        include_once("views/article/v_article_listdata.php");
    } else {
        echo "empty";
    }
}else if(@$_POST['action']=='create'){ 
    $article_user_id = $auth['user_id'];
    $article_title = $_POST['article_title'] ?? null;
    $article_slug = $_POST['article_slug'] ?? null;
    $article_tags = $_POST['article_tags'] ?? null;
    $article_desc = $_POST['article_desc'] ?? null;
    $time = time();
    $article = $Article->getArticleBySlug($article_slug) ?? null;
    if ($article==null) {
        $folder = DIR_PUBLIC.'/articles/'.substr($article_slug,0,70);
        $file = $article_slug.'.webp';
        if (!file_exists($folder)) {
            @mkdir($folder,0777);
        }
        $content_image = @file_get_contents(DIR_PUBLIC.'/default_thumbnail_article.webp');
        @file_put_contents($folder.'/'.$file, $content_image);
        @chmod($folder.'/'.$file, 0777);
        $res = $Article->createArticle($article_user_id, $article_title, $article_slug, $article_tags, $article_desc, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='trash'){ 
    $id = $_POST['id'] ?? null;
    $time = time();
    $article = $Article->getArticleById($id) ?? null;
    if ($article!=null) {
        $res = $Article->setSTTArticle($id, 3, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='stt'){ 
    $id = $_POST['id'] ?? null;
    $stt = $_POST['stt'] ?? null;
    $time = time();
    $article = $Article->getArticleById($id) ?? null;
    if ($article!=null) {
        $res = $Article->setSTTArticle($id, $stt, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    include_once("models/m_user.php");
    $User = new User();
    $list_user = $User->getAllUser() ?? null;
    $title = "Danh sách bài viết";
    include_once("shared/layout.php");
}