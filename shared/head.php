    <meta charset="utf-8" />
    <title><?= $title ?? null ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="<?= URL_PUBLIC ?>/favicon.ico" />
    <style>
        #sniploader {
            position: absolute;
            z-index: 9999;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 70px;
            height: 70px;
            margin: auto;
            border: 8px solid #ddcdcd;
            border-radius: 50%;
            border-top: 8px solid #bf0101;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <script>
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector(
                "#playout").style.display = "none";
            document.querySelector(
                "#sniploader").style.display = "block";
        }else{
            document.querySelector(
        "#sniploader").style.display = "none";
            document.querySelector(
                "#playout").style.display = "block";
        }
    };
    </script>
    <?= OS_HEAD_SCRIPT ?>
    <link href="<?= URL_ASSETS ?>/index/css/table.css" rel="stylesheet" type="text/css" />
    <link href="<?= URL_ASSETS ?>/index/css/template.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?= URL_ASSETS ?>/index/js/jquery.js"></script>
    <script type="text/javascript" src="<?= URL_ASSETS ?>/index/js/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= URL_ASSETS ?>/index/css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?= URL_ASSETS ?>/index/css/jquery-ui.theme.min.css" />
    <script type="text/javascript" src="<?= URL_ASSETS ?>/index/js/jquery.fullscreen.min.js"></script>
    <script type="text/javascript" src="<?= URL_ASSETS ?>/index/js/html2canvas.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= URL_ASSETS ?>/index/css/bangketqua_mini.css"/>
    <script type="text/javascript" src="<?= URL_ASSETS ?>/index/js/main.js"></script>