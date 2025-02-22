<?php

include_once("models/m_dashboard.php");
$Dashboard = new Dashboard();
$array_users = $Dashboard->getAllUserIDKey()??null;

$article_tag = $Dashboard->getArticlesTag() ?? null;
$str_name_articles = '[';
$str_total_articles = '[';
foreach(array_reverse($article_tag) as $k=>$article){
    $str_name_articles .= ($k!=0?',':'') . '"'.$article['article_tags'].'"';
    $str_total_articles .= ($k!=0?',':'') . '"'.$article['total'].'"';
}
$str_name_articles .= ']';
$str_total_articles .= ']';

$article_user = $Dashboard->getArticleUser() ?? null;
$str_name_users = '[';
$str_total_users = '[';
foreach(array_reverse($article_user) as $k=>$article){
    $str_name_users .= ($k!=0?',':'') . '"'.$array_users[$article['article_user_id']]['user_fullname'].'"';
    $str_total_users .= ($k!=0?',':'') . '"'.$article['total'].'"';
}
$str_name_users .= ']';
$str_total_users .= ']';

$limit = 5;
$article_view = $Dashboard->getArticlesView($limit) ?? null;
$str_title_articles = '[';
$str_view_articles = '[';
foreach(array_reverse($article_view) as $k=>$article){
    $str_title_articles .= ($k!=0?',':'') . '"'.$article['article_title'].'"';
    $str_view_articles .= ($k!=0?',':'') . '"'.$article['article_total_view'].'"';
}
$str_title_articles .= ']';
$str_view_articles .= ']';
include_once("views/dashboard/v_dashboard_article.php");