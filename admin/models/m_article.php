<?php

class Article extends Database
{

    public function getAllArticle()
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_stt`<>3";
        return $this->select($sql) ?? null;
    }

    public function setSTTArticle($id,$stt,$time)
    {
        $sql = "UPDATE `tbl_article` SET `article_stt`=$stt,`article_updated`=$time WHERE `article_id`=$id";
        return $this->query($sql) ?? null;
    }

    public function deleteArticle($id)
    {
        $sql = "DELETE FROM `tbl_article` WHERE `article_id`=$id";
        return $this->query($sql) ?? null;
    }

    public function getArticleById($id)
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_id`='$id'";
        $article = @$this->select($sql)??null;
        return count($article)>0 ? $article[0] : null;
    }

    public function getArticleBySlug($slug)
    {
        $sql = "SELECT * FROM `tbl_article` WHERE `article_slug`='$slug'";
        $article = @$this->select($sql)??null;
        return count($article)>0 ? $article[0] : null;
    }

    public function createArticle($article_user_id, $article_title, $article_slug, $article_tags, $article_desc, $time)
    {
        $rand = 0;
        $article_title = str_replace("'","&apos;",$article_title);
        $article_desc = str_replace("'","&apos;",$article_desc);
        $sql = "INSERT INTO `tbl_article`(`article_id`, `article_stt`, `article_title`, `article_slug`, `article_user_id`, `article_tags`, `article_desc`, `article_content`, `article_total_view`, `article_created`, `article_updated`) VALUES (NULL,1,'$article_title','$article_slug',$article_user_id,'$article_tags','$article_desc','',$rand,$time,$time)";
        return $this->query($sql)?? false;
    }

    public function createArticleContent($article_user_id, $article_title, $article_slug, $article_tags, $article_desc, $article_content, $time)
    {
        $rand = 0;
        $article_title = str_replace("'","&apos;",$article_title);
        $article_desc = str_replace("'","&apos;",$article_desc);
        $article_content = str_replace("'","&apos;",$article_content);
        $article_content = htmlspecialchars($article_content);
        $sql = "INSERT INTO `tbl_article`(`article_id`, `article_stt`, `article_title`, `article_slug`, `article_tags`, `article_user_id`, `article_desc`, `article_content`, `article_total_view`, `article_created`, `article_updated`) VALUES (NULL,1,'$article_title','$article_slug','$article_tags',$article_user_id,'$article_desc','$article_content',$rand,$time,$time)";
        return $this->query($sql)?? false;
    }

    public function updateArticle($article_id, $article_title, $article_slug, $article_tags, $article_desc, $article_content, $time)
    {
        $article_title = str_replace("'","&apos;",$article_title);
        $article_desc = str_replace("'","&apos;",$article_desc);
        $article_content = str_replace("'","&apos;",$article_content);
        $article_content = str_replace("Image Review",OS_OWNER.$article_title,$article_content);
        $article_content = htmlspecialchars($article_content);
        $sql = "UPDATE `tbl_article` SET `article_title`='$article_title',`article_slug`='$article_slug',`article_tags`='$article_tags',`article_desc`='$article_desc',`article_content`='$article_content',`article_updated`='$time' WHERE `article_id`='$article_id'";
        return $this->query($sql)?? false;
    }

    public function getAllArticleSearchSortPage($keyword, $sort, $sby, $from, $limit, $sqlstt="`article_stt`<>3")
    {
        $sortby = ($sort!="")?"ORDER BY `$sort` $sby":"";
        if(substr($keyword,0,12) == 'Trang thai: '){
            $keyword = substr($keyword,12);
            $valkeyword = "`article_stt`='$keyword'";
        }else if(substr($keyword,0,10) == 'Tac gia: #'){
            $keyword = base64_decode(substr($keyword,10));
            $valkeyword = "`article_user_id`='$keyword'";
        }else{
            $valkeyword = "(`article_title`LIKE'%$keyword%' OR `article_desc`LIKE'%$keyword%' OR `article_user_id`='$keyword')";
        }
        $sql = "SELECT * FROM `tbl_article` WHERE $valkeyword AND $sqlstt $sortby LIMIT $from, $limit";
        return $this->select($sql) ?? null;
    }

    public function countArticleSearch($keyword, $sqlstt="`article_stt`<>3")
    {
        if(substr($keyword,0,12) == 'Trang thai: '){
            $keyword = substr($keyword,12);
            $valkeyword = "`article_stt`='$keyword'";
        }else if(substr($keyword,0,10) == 'Tac gia: #'){
            $keyword = base64_decode(substr($keyword,10));
            $valkeyword = "`article_user_id`='$keyword'";
        }else{
            $valkeyword = "(`article_title`LIKE'%$keyword%' OR `article_desc`LIKE'%$keyword%' OR `article_user_id`='$keyword')";
        }
        $sql = "SELECT * FROM `tbl_article` WHERE $valkeyword AND $sqlstt";
        return count(@$this->select($sql)) ?? null;
    }

}