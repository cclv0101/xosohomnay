<?php

class Service extends Database
{

    public function getAllService()
    {
        $sql = "SELECT * FROM `tbl_service` WHERE `service_stt`<>3";
        return $this->select($sql) ?? null;
    }

    public function setSTTService($id,$stt,$time)
    {
        $sql = "UPDATE `tbl_service` SET `service_stt`=$stt,`service_updated`=$time WHERE `service_id`=$id";
        return $this->query($sql) ?? null;
    }

    public function deleteService($id)
    {
        $sql = "DELETE FROM `tbl_service` WHERE `service_id`=$id";
        return $this->query($sql) ?? null;
    }

    public function getServiceById($id)
    {
        $sql = "SELECT * FROM `tbl_service` WHERE `service_id`='$id'";
        $service = @$this->select($sql)??null;
        return count($service)>0 ? $service[0] : null;
    }

    public function getServiceBySlug($slug)
    {
        $sql = "SELECT * FROM `tbl_service` WHERE `service_slug`='$slug'";
        $service = @$this->select($sql)??null;
        return count($service)>0 ? $service[0] : null;
    }

    public function createService($service_user_id, $service_title, $service_slug, $service_tags, $service_desc, $time)
    {
        $service_title = str_replace("'","&apos;",$service_title);
        $service_desc = str_replace("'","&apos;",$service_desc);
        $sql = "INSERT INTO `tbl_service`(`service_id`, `service_stt`, `service_title`, `service_slug`, `service_user_id`, `service_tags`, `service_desc`, `service_content`, `service_total_view`, `service_created`, `service_updated`) VALUES (NULL,2,'$service_title','$service_slug',$service_user_id,'$service_tags','$service_desc','',0,$time,$time)";
        return $this->query($sql)?? false;
    }

    public function createServiceContent($service_user_id, $service_title, $service_slug, $service_desc, $service_content, $time)
    {
        $service_title = str_replace("'","&apos;",$service_title);
        $service_desc = str_replace("'","&apos;",$service_desc);
        $service_content = str_replace("'","&apos;",$service_content);
        $service_content = htmlspecialchars($service_content);
        $sql = "INSERT INTO `tbl_service`(`service_id`, `service_stt`, `service_title`, `service_slug`, `service_user_id`, `service_desc`, `service_content`, `service_total_view`, `service_created`, `service_updated`) VALUES (NULL,2,'$service_title','$service_slug',$service_user_id,'$service_desc','$service_content',0,$time,$time)";
        return $this->query($sql)?? false;
    }

    public function updateService($service_id, $service_title, $service_slug, $service_tags, $service_desc, $service_content, $time)
    {
        $service_title = str_replace("'","&apos;",$service_title);
        $service_desc = str_replace("'","&apos;",$service_desc);
        $service_content = str_replace("'","&apos;",$service_content);
        $service_content = str_replace("Image Review",OS_OWNER.$service_title,$service_content);
        $service_content = htmlspecialchars($service_content);
        $sql = "UPDATE `tbl_service` SET `service_title`='$service_title',`service_slug`='$service_slug',`service_tags`='$service_tags',`service_desc`='$service_desc',`service_content`='$service_content',`service_updated`='$time' WHERE `service_id`='$service_id'";
        return $this->query($sql)?? false;
    }

    public function getAllServiceSearchSortPage($keyword, $sort, $sby, $from, $limit, $sqlstt='`service_stt`<>3')
    {
        $sortby = ($sort!="")?"ORDER BY `$sort` $sby":"";
        if(substr($keyword,0,12) == 'Trang thai: '){
            $keyword = substr($keyword,12);
            $valkeyword = "`service_stt`='$keyword'";
        }else if(substr($keyword,0,10) == 'Tac gia: #'){
            $keyword = substr($keyword,10);
            $valkeyword = "`service_user_id`='$keyword'";
        }else{
            $valkeyword = "(`service_title`LIKE'%$keyword%' OR `service_desc`LIKE'%$keyword%')";
        }
        $sql = "SELECT * FROM `tbl_service` WHERE $valkeyword AND $sqlstt $sortby LIMIT $from, $limit";
        return $this->select($sql) ?? null;
    }

    public function countServiceSearch($keyword, $sqlstt='`service_stt`<>3')
    {
        if(substr($keyword,0,12) == 'Trang thai: '){
            $keyword = substr($keyword,12);
            $valkeyword = "`service_stt`='$keyword'";
        }else if(substr($keyword,0,10) == 'Tac gia: #'){
            $keyword = substr($keyword,10);
            $valkeyword = "`service_user_id`='$keyword'";
        }else{
            $valkeyword = "(`service_title`LIKE'%$keyword%' OR `service_desc`LIKE'%$keyword%')";
        }
        $sql = "SELECT * FROM `tbl_service` WHERE $valkeyword AND $sqlstt";
        return count(@$this->select($sql)) ?? null;
    }

}