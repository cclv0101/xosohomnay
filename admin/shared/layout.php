<!DOCTYPE html>
<html lang="<?= LANG_CODE ?>">
<?php @include_once("shared/head.php"); ?>
<body class="fixed-sn white-skin">
    <?php
    @include_once("shared/header.php");
    try {
        if ($act == null) {
            $name_file_view = "v_" . $ctl . ".php";
        } else {
            $name_file_view = "v_" . $ctl . "_" . $act . ".php";
        }
        @include_once("views/" . $ctl . "/" . $name_file_view);
    } catch (Exception $ex) {
        echo $ex;
        exit;
    }
    @include_once("shared/footer.php");
    @include_once("shared/foot.php");
    ?>
</body>
</html>