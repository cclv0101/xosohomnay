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
    $articles = $Article->getAllArticleSearchSortPage($keyword, $sort, $sby, $from, $perpage, "`article_stt`=3") ?? null;
    $count_articles = $Article->countArticleSearch($keyword, "`article_stt`=3") ?? null;
    $total_page = ceil($count_articles / $perpage);
    if ($count_articles > 0) {
        include_once("views/article/v_article_trashlistdata.php");
    } else {
        echo "empty";
    }
}else if(@$_POST['action']=='restore'){ 
    $id = $_POST['id'] ?? null;
    $time = time();
    $article = $Article->getArticleById($id) ?? null;
    if ($article!=null) {
        $res = $Article->setSTTArticle($id, 1, $time) ?? false;
        echo $res ? "success" : "error";
    }
}else if(@$_POST['action']=='delete'){ 
    $id = $_POST['id'] ?? null;
    $article = $Article->getArticleById($id) ?? null;
    if ($article!=null) {
        $folder = DIR_PUBLIC.'/articles/'.substr($article['article_slug'],0,70);
        if (file_exists($folder)) {
            $Database->removeDirectory($folder) ?? false;
        }
        $res = $Article->deleteArticle($id) ?? false;
        echo $res ? "success" : "error";
    }
}else {
    include_once("models/m_user.php");
    $User = new User();
    $list_user = $User->getAllUser() ?? null;
    $title = "Bài viết đã xóa";
    include_once("shared/layout.php");
}