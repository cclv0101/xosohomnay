<?php

class Project extends Database
{

    public function getAllProject()
    {
        $sql = "SELECT * FROM `tbl_project` WHERE `project_stt`<>3";
        return $this->select($sql) ?? null;
    }

    public function setSTTProject($id,$stt,$time)
    {
        $sql = "UPDATE `tbl_project` SET `project_stt`=$stt,`project_updated`=$time WHERE `project_id`=$id";
        return $this->query($sql) ?? null;
    }

    public function deleteProject($id)
    {
        $sql = "DELETE FROM `tbl_project` WHERE `project_id`=$id";
        return $this->query($sql) ?? null;
    }

    public function getProjectById($id)
    {
        $sql = "SELECT * FROM `tbl_project` WHERE `project_id`='$id'";
        $project = @$this->select($sql)??null;
        return count($project)>0 ? $project[0] : null;
    }

    public function getProjectBySlug($slug)
    {
        $sql = "SELECT * FROM `tbl_project` WHERE `project_slug`='$slug'";
        $project = @$this->select($sql)??null;
        return count($project)>0 ? $project[0] : null;
    }

    public function createProject($project_user_id, $project_title, $project_slug, $project_tags, $project_desc, $time)
    {
        $project_title = str_replace("'","&apos;",$project_title);
        $project_desc = str_replace("'","&apos;",$project_desc);
        $sql = "INSERT INTO `tbl_project`(`project_id`, `project_stt`, `project_title`, `project_slug`, `project_user_id`, `project_tags`, `project_desc`, `project_content`, `project_total_view`, `project_created`, `project_updated`) VALUES (NULL,2,'$project_title','$project_slug',$project_user_id,'$project_tags','$project_desc','',0,$time,$time)";
        return $this->query($sql)?? false;
    }

    public function createProjectContent($project_user_id, $project_title, $project_slug, $project_desc, $project_content, $time)
    {
        $project_title = str_replace("'","&apos;",$project_title);
        $project_desc = str_replace("'","&apos;",$project_desc);
        $project_content = str_replace("'","&apos;",$project_content);
        $project_content = htmlspecialchars($project_content);
        $sql = "INSERT INTO `tbl_project`(`project_id`, `project_stt`, `project_title`, `project_slug`, `project_user_id`, `project_desc`, `project_content`, `project_total_view`, `project_created`, `project_updated`) VALUES (NULL,2,'$project_title','$project_slug',$project_user_id,'$project_desc','$project_content',0,$time,$time)";
        return $this->query($sql)?? false;
    }

    public function updateProject($project_id, $project_title, $project_slug, $project_tags, $project_desc, $project_content, $time)
    {
        $project_title = str_replace("'","&apos;",$project_title);
        $project_desc = str_replace("'","&apos;",$project_desc);
        $project_content = str_replace("'","&apos;",$project_content);
        $project_content = str_replace("Image Review",OS_OWNER.$project_title,$project_content);
        $project_content = htmlspecialchars($project_content);
        $sql = "UPDATE `tbl_project` SET `project_title`='$project_title',`project_slug`='$project_slug',`project_tags`='$project_tags',`project_desc`='$project_desc',`project_content`='$project_content',`project_updated`='$time' WHERE `project_id`='$project_id'";
        return $this->query($sql)?? false;
    }

    public function getAllProjectSearchSortPage($keyword, $sort, $sby, $from, $limit, $sqlstt='`project_stt`<>3')
    {
        $sortby = ($sort!="")?"ORDER BY `$sort` $sby":"";
        if(substr($keyword,0,12) == 'Trang thai: '){
            $keyword = substr($keyword,12);
            $valkeyword = "`project_stt`='$keyword'";
        }else if(substr($keyword,0,10) == 'Tac gia: #'){
            $keyword = base64_decode(substr($keyword,10));
            $valkeyword = "`project_user_id`='$keyword'";
        }else{
            $valkeyword = "(`project_title`LIKE'%$keyword%' OR `project_desc`LIKE'%$keyword%' OR `project_user_id`='$keyword')";
        }
        $sql = "SELECT * FROM `tbl_project` WHERE $valkeyword AND $sqlstt $sortby LIMIT $from, $limit";
        return $this->select($sql) ?? null;
    }

    public function countProjectSearch($keyword, $sqlstt='`project_stt`<>3')
    {
        if(substr($keyword,0,12) == 'Trang thai: '){
            $keyword = substr($keyword,12);
            $valkeyword = "`project_stt`='$keyword'";
        }else if(substr($keyword,0,10) == 'Tac gia: #'){
            $keyword = base64_decode(substr($keyword,10));
            $valkeyword = "`project_user_id`='$keyword'";
        }else{
            $valkeyword = "(`project_title`LIKE'%$keyword%' OR `project_desc`LIKE'%$keyword%' OR `project_user_id`='$keyword')";
        }
        $sql = "SELECT * FROM `tbl_project` WHERE $valkeyword AND $sqlstt";
        return count(@$this->select($sql)) ?? null;
    }

}