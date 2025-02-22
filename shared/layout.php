<!doctype html>
<html lang="<?= LANG_CODE ?>">
<head>
<?php @include_once('shared/head.php'); ?>
<?php @include_once('shared/seo.php'); ?>
</head>
<body class="pagebody responsive">
    <span id="sniploader"></span>
    <?= OS_FOOT_SCRIPT ?>
    <?php
    echo '<div id="playout">';
    if ($name_file_ctl != "error.php") {
        @include_once("shared/header.php");
        @include_once("shared/menu.php");
    }
    @include_once("views/$name_file_ctl");
    if ($name_file_ctl != "error.php") {
        @include_once("shared/footer.php");
    }
    @include_once("shared/foot.php");
    echo '</div>';
    ?>
</body>
</html>