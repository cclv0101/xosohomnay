<?php

require_once('models/m_article.php');
$Article = new Article();
$article = $Article->getArticleById($id) ?? null;
$article_user_id = $auth['user_id'];
$article_title = 'Copy | '.$article['article_title'] ?? null;
$article_slug_old = $article['article_slug'];
$article_slug_new = $article_slug_old.'-'.rand(100,999);
$article_tags = $article['article_tags'] ?? null;
$article_desc = $article['article_desc'] ?? null;
$time = time();
$check_article = $Article->getArticleBySlug($article_slug_new) ?? null;
if ($check_article==null) {
    $folder_old = DIR_PUBLIC.'/articles/'.substr($article_slug_old,0,70);
    $file_old = $article_slug_old.'.webp';
    $folder_new = DIR_PUBLIC.'/articles/'.substr($article_slug_new,0,70);
    $file_new = $article_slug_new.'.webp';
    if (!file_exists($folder_new)) {
        @mkdir($folder_new,0777);
    }
    $content_image = @file_get_contents($folder_old.'/'.$file_old);
    @file_put_contents($folder_new.'/'.$file_new, $content_image);
    @chmod($folder_new.'/'.$file_new, 0777);
    $res = $Article->createArticle($article_user_id, $article_title, $article_slug_new, $article_tags, $article_desc, $time) ?? false;
    $new_article = $Article->getArticleBySlug($article_slug_new) ?? null;
    echo $new_article ? $new_article['article_id'] : "error";
    header('location: ' . URL_DOMAIN . '/admin/article/edit/' . $new_article['article_id'] . URL_FOOT);
    exit;
}