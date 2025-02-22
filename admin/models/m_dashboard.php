<?php

class Dashboard extends Database
{
    public function getAllUserIDKey()
    {
        $sql = "SELECT * FROM `tbl_user` WHERE `user_stt`<>3";
        return $this->selectKey($sql,'user_id') ?? null;
    }

    public function getArticlesTag($limit=10)
    {
        $sql = "SELECT `article_tags`, COUNT(`article_id`) AS `total`, SUM(`article_total_view`)AS`view` FROM `tbl_article` WHERE `article_stt`<>3 GROUP BY `article_tags` ORDER BY `article_total_view` DESC LIMIT $limit;";
        return $this->select($sql) ?? null;
    }
    public function getArticleUser($limit=10)
    {
        $sql = "SELECT `article_user_id`, COUNT(`article_id`) AS `total` FROM `tbl_article` WHERE `article_stt`<>3 GROUP BY `article_user_id` ORDER BY `article_total_view` DESC LIMIT $limit;";
        return $this->select($sql) ?? null;
    }
    public function getArticlesView($limit=10)
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`<>3 ORDER BY `article_total_view` DESC LIMIT $limit;";
        return $this->select($sql) ?? null;
    }

    public function getProjectsTag($limit=10)
    {
        $sql = "SELECT `project_tags`, COUNT(`project_id`) AS `total`, SUM(`project_total_view`)AS`view` FROM `tbl_project` WHERE `project_stt`<>3 GROUP BY `project_tags` ORDER BY `project_total_view` DESC LIMIT $limit;";
        return $this->select($sql) ?? null;
    }
    public function getProjectUser($limit=10)
    {
        $sql = "SELECT `project_user_id`, COUNT(`project_id`) AS `total` FROM `tbl_project` WHERE `project_stt`<>3 GROUP BY `project_user_id` ORDER BY `project_total_view` DESC LIMIT $limit;";
        return $this->select($sql) ?? null;
    }
    public function getProjectsView($limit=10)
    {
        $sql = "SELECT * FROM `tbl_project` WHERE `project_stt`<>3 ORDER BY `project_total_view` DESC LIMIT $limit;";
        return $this->select($sql) ?? null;
    }
}