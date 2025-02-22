<?php
class MyOS extends Database
{
    public function getAllCate()
    {
        return $this->select("SELECT * FROM `tbl_cate`");
    }
    public function getAllSlide()
    {
        return $this->select("SELECT * FROM `tbl_slide`") ?? null;
    }
    public function getAllMenu()
    {
        return $this->select("SELECT * FROM `tbl_menu`") ?? null;
    }
    public function getAllBanner()
    {
        return $this->select("SELECT * FROM `tbl_banner` ORDER BY `banner_position` ASC") ?? null;
    }
    public function getPageBySlug($slug)
    {
        $sql = "SELECT * FROM `tbl_page` WHERE `page_slug`='$slug'";
        return $this->select($sql)[0] ?? null;
    }
    public function getProjects($limit=12)
    {
        $sql = "SELECT * FROM `tbl_project` WHERE `project_stt`=1 ORDER BY `project_updated` DESC LIMIT $limit";
        return $this->select($sql) ?? null;
    }
    public function getProjectTags()
    {
        $sql = "SELECT `project_tags` FROM `tbl_project` GROUP BY `project_tags`;";
        return $this->select($sql) ?? null;
    }
    public function getProjectBySlug($slug)
    {
        $sql = "SELECT * FROM `tbl_project` WHERE `project_stt`=1 AND `project_slug`='$slug'";
        return $this->select($sql)[0] ?? null;
    }
    public function getRecommentProjects($order_id,$limit=20)
    {
        $sql = "SELECT * FROM `tbl_project` WHERE `project_stt`=1 AND `project_id`<>$order_id  ORDER BY `project_updated` DESC LIMIT $limit";
        return $this->select($sql) ?? null;
    }
    public function getRecommentProjectTags($order_id)
    {
        $sql = "SELECT * FROM `tbl_project` WHERE `project_stt`=1 AND `project_id`<>$order_id GROUP BY `project_tags` ORDER BY `project_updated` DESC";
        return $this->select($sql) ?? null;
    }
    public function getArticles($limit=12)
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`=1 ORDER BY `article_updated` DESC LIMIT $limit";
        return $this->select($sql) ?? null;
    }
    public function getArticlesByPage($from=0,$limit=10)
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`=1 ORDER BY `article_updated` DESC LIMIT $limit OFFSET $from";
        return $this->select($sql) ?? null;
    }
    public function getArticleBySlug($slug)
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`=1 AND `article_slug`='$slug'"; 
        return $this->select($sql)[0] ?? null;
    }
    public function getRecommentArticles($order_id,$limit=20)
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`=1 AND `article_id`<>$order_id ORDER BY `article_updated` DESC LIMIT $limit";
        return $this->select($sql) ?? null;
    }
    public function getRecommentArticleTags($order_id)
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`=1 AND `article_id`<>$order_id GROUP BY `article_tags` ORDER BY `article_updated` DESC";
        return $this->select($sql) ?? null;
    }
    public function getServices($limit=12)
    {
        $sql = "SELECT * FROM `tbl_service` ORDER BY `service_updated` DESC LIMIT $limit";
        return $this->select($sql) ?? null;
    }
    public function getServiceBySlug($slug)
    {
        $sql = "SELECT * FROM `tbl_service` WHERE `service_stt`=1 AND `service_slug`='$slug'";
        return $this->select($sql)[0] ?? null;
    }
    public function getRecommentServices($order_id,$limit=20)
    {
        $sql = "SELECT * FROM `tbl_service` WHERE `service_stt`=1 AND `service_id`<>$order_id  ORDER BY `service_updated` DESC LIMIT $limit";
        return $this->select($sql) ?? null;
    }
    public function getAllNotify()
    {
        $sql = "SELECT `notify_id`,`notify_title`,`notify_desc` FROM `tbl_notify` WHERE `notify_stt`=1";
        return $this->select($sql) ?? null;
    }


    

    public function getArticlesSearch($keyword)
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`<>3 AND (`article_title`LIKE'%$keyword%' OR `article_desc`LIKE'%$keyword%') ORDER BY `article_updated`";
        return $this->select($sql) ?? null;
    }
    public function getArticlesDaft()
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`<>3 ORDER BY `article_stt` DESC";
        return $this->select($sql) ?? null;
    }
    public function getArticlesWeek()
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`<>3 ORDER BY `article_created` DESC";
        return $this->select($sql) ?? null;
    }
    public function getArticlesView()
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`<>3 ORDER BY `article_total_view` DESC";
        return $this->select($sql) ?? null;
    }
    public function getAllUser()
    {
        $sql = "SELECT * FROM `tbl_user` WHERE `user_stt`=1";
        return $this->select($sql) ?? null;
    }
    public function getUserByID($id)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE `user_id`=$id";
        return $this->select($sql)[0] ?? null;
    }
    public function setViewArticle($id)
    {
        $sql = "UPDATE `tbl_article` SET `article_total_view`=`article_total_view`+1 WHERE `article_id`=$id";
        return $this->query($sql) ?? false;
    }
    public function setViewProject($id)
    {
        $sql = "UPDATE `tbl_project` SET `project_total_view`=`project_total_view`+1 WHERE `project_id`=$id";
        return $this->query($sql) ?? false;
    }
    public function setViewService($id)
    {
        $sql = "UPDATE `tbl_service` SET `service_total_view`=`service_total_view`+1 WHERE `service_id`=$id";
        return $this->query($sql) ?? false;
    }
}

