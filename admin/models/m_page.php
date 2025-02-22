<?php

class Page extends Database
{

    public function getAllPage()
    {
        $sql = "SELECT * FROM `tbl_page` WHERE `page_stt`<>3";
        return $this->select($sql) ?? null;
    }

    public function setSTTPage($id,$stt,$time)
    {
        $sql = "UPDATE `tbl_page` SET `page_stt`=$stt,`page_updated`=$time WHERE `page_id`=$id";
        return $this->query($sql) ?? null;
    }

    public function deletePage($id)
    {
        $sql = "DELETE FROM `tbl_page` WHERE `page_id`=$id";
        return $this->query($sql) ?? null;
    }

    public function getPageById($id)
    {
        $sql = "SELECT * FROM `tbl_page` WHERE `page_id`='$id'";
        $page = @$this->select($sql)??null;
        return count($page)>0 ? $page[0] : null;
    }

    public function getPageBySlug($slug)
    {
        $sql = "SELECT * FROM `tbl_page` WHERE `page_slug`='$slug'";
        $page = @$this->select($sql)??null;
        return count($page)>0 ? $page[0] : null;
    }

    public function createPage($page_title, $page_slug, $page_desc, $time)
    {
        $page_title = str_replace("'","&apos;",$page_title);
        $page_desc = str_replace("'","&apos;",$page_desc);
        $sql = "INSERT INTO `tbl_page`(`page_id`, `page_stt`, `page_title`, `page_slug`, `page_desc`, `page_content`, `page_total_view`, `page_created`, `page_updated`) VALUES (NULL,2,'$page_title','$page_slug','$page_desc','',0,$time,$time)";
        return $this->query($sql)?? false;
    }

    public function createPageContent($page_title, $page_slug, $page_desc, $page_content, $time)
    {
        $page_title = str_replace("'","&apos;",$page_title);
        $page_desc = str_replace("'","&apos;",$page_desc);
        $page_content = str_replace("'","&apos;",$page_content);
        $page_content = htmlspecialchars($page_content);
        $sql = "INSERT INTO `tbl_page`(`page_id`, `page_stt`, `page_title`, `page_slug`, `page_desc`, `page_content`, `page_total_view`, `page_created`, `page_updated`) VALUES (NULL,2,'$page_title','$page_slug','$page_desc','$page_content',0,$time,$time)";
        return $this->query($sql)?? false;
    }

    public function updatePage($page_id, $page_title, $page_slug, $page_desc, $page_content, $time)
    {
        $page_title = str_replace("'","&apos;",$page_title);
        $page_desc = str_replace("'","&apos;",$page_desc);
        $page_content = str_replace("'","&apos;",$page_content);
        $page_content = htmlspecialchars($page_content);
        $sql = "UPDATE `tbl_page` SET `page_title`='$page_title',`page_slug`='$page_slug',`page_desc`='$page_desc',`page_content`='$page_content',`page_updated`='$time' WHERE `page_id`='$page_id'";
        return $this->query($sql)?? false;
    }

    public function getAllPageSearchSortPage($keyword, $sort, $sby, $from, $limit, $sqlstt="`page_stt`<>3")
    {
        $sortby = ($sort!="")?"ORDER BY `$sort` $sby":"";
        $valkeyword = ($keyword!="")?"(`page_title`LIKE'%$keyword%' OR `page_desc`LIKE'%$keyword%') AND":"";
        $sql = "SELECT * FROM `tbl_page` WHERE $valkeyword $sqlstt $sortby LIMIT $from, $limit";
        return $this->select($sql) ?? null;
    }

    public function countPageSearch($keyword, $sqlstt="`page_stt`<>3")
    {
        $valkeyword = ($keyword!="")?"(`page_title`LIKE'%$keyword%' OR `page_desc`LIKE'%$keyword%') AND":"";
        $sql = "SELECT * FROM `tbl_page` WHERE $valkeyword $sqlstt";
        return count(@$this->select($sql)) ?? null;
    }

}