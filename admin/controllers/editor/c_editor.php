<?php

if (isset($_POST['path'])&&isset($_POST['action'])&&$_POST['action']=='upload' && isset($_FILES['upload'])) {
    $folder = $_POST['path'];
    $tmp = explode("/", $folder);
    $file_name = substr(end($tmp), 0, -8).'-'.rand(1000000,9999999).'.webp';
    if (!file_exists($folder)) {
        @mkdir($folder,0777);
    }
    $tmp_name = $_FILES['upload']['tmp_name'];
    if (@move_uploaded_file($tmp_name, $folder.'/'.$file_name)) {
       @chmod($folder.'/'.$file_name, 0777);
        echo 'success';
        exit;
    }
}else if (isset($_POST['path'])&&isset($_POST['action'])&&$_POST['action']=='rename') {
    $path = $_POST['path'];
    $oldname = $_POST['oldname'];
    $newname = $_POST['newname'];
    $file_old = $path.'/'.$oldname;
    $file_new = $path.'/'.$newname;
    @rename($file_old, $file_new);
    echo 'success';
}else if (isset($_POST['path'])&&isset($_POST['action'])&&$_POST['action']=='delete') {
    $path = $_POST['path'];
    $filename = $_POST['filename'];
    @unlink($path.'/'.$filename);
    echo 'success';
}else if (isset($_POST['path'])&&isset($_POST['data'])) {
    include_once("views/editor/v_editor.php");
}else if(isset($_POST['path'])&&isset($_POST['folder'])&&isset($_POST['media_type'])) {
    $path = $_POST['path'];
    $folder = $_POST['folder'];
    $media_type = $_POST['media_type'] ?? null;
    $items = @array_diff(@scandir($path) ?? null, array('.')) ?? null;
    $dirs = null;
    $files = null;
    if ($items != null) {
        foreach ($items as $item) {
            $pti = $path . '/' . $item;
            $type = mime_content_type($pti);
            if ($type != 'directory') {
                $files[] = $item;
            } 
        }
        if ($files) {
            sort($files);
        }
    }
    include_once("views/editor/v_media.php");
}