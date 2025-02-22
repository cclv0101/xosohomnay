<?php

if(@$id){
    $article = $MyOS->getArticleBySlug($id) ?? null;
    if(@$article){
        $article_recomment = $MyOS->getRecommentArticles($article['article_id']) ?? null;
        $title = str_replace('"',"",$article['article_title']);
        $description = str_replace('"',"",$article['article_desc']);
        $keyword = $article['article_tags'];
        $image = URL_PUBLIC.'/articles/'.substr($article['article_slug'],0,70).'/'.$article['article_slug'].'.webp?v='.time();
        $author = $MyOS->getUserByID(@$article['article_user_id']);
        $subtitle='Tác giả: '.@$author['user_fullname'].' | Lượt xem: '.@$article['article_total_view'].' | Ngày đăng: '.date('H:i d/m/Y',$article['article_updated']);
        $MyOS->setViewArticle($article['article_id']);
        include_once("shared/layout.php");
    }else{
        header("location: ".URL_DOMAIN.'/'.OS_URL_ARTICLE.URL_FOOT_OS);
    }
}else{
    $title = 'Bài viết tin tức';
    $image = URL_ASSETS.'/index/img/hero_image.jpg';
    if (@$_POST['keyword']) {
        $articles = $MyOS->getArticlesSearch(@$_POST['keyword']) ?? null;
        include_once("shared/layout.php");
    } else {
        $page=intval(@$_POST['page']??'1') ?? 1;
        $perpage=10;
        $from=($page-1)*$perpage;
        $articles = $MyOS->getArticlesByPage($from,$perpage) ?? null;
        if ($page>1) {
            if (count($articles)>0) {
                include_once("views/article.php");
            } else {
                echo 'null';exit;
            }
        } else {
            include_once("shared/layout.php");
        }
    }
}