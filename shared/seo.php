<?php $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
<?php 
if (!@$image) {
    $image=URL_ASSETS.'/index/img/hero_image.jpg';
}
?>
    <meta name="keywords" content="<?= $keyword ?? OS_SEO ?>" />
    <meta name="description" content="<?= $description ?? OS_SUBSEO ?>" />
    <meta name="subject" content="<?= $description ?? OS_SEO ?>">
    <meta name="copyright" content="<?= OS_NAME ?>">
    <meta name="language" content="<?= strtoupper(LANG_CODE) ?>">
    <meta name="robots" content="index,follow" />
    <meta name="revised" content="<?= date('l jS \of F Y h:i:s A') ?>" />
    <meta name="abstract" content="<?= $description ?>">
    <meta name="topic" content="<?= $title ?>">
    <meta name="author" content="<?= OS_OWNER ?>">
    <meta name="designer" content="<?= OS_NAME ?>">
    <meta name="reply-to" content="<?= OS_EMAIL ?>">
    <meta name="owner" content="<?= OS_NAME ?>">
    <meta name="url" content="<?= $url ?>">
    <meta name="identifier-URL" content="<?= $url ?>">
    <meta name="directory" content="<?= $description ?>">
    <meta name="category" content="<?= $title ?>">
    <meta name="coverage" content="<?= OS_LANG ?>">
    <meta name="distribution" content="<?= OS_LANG ?>">
    <meta name="rating" content="General">
    <meta name="geo.region" content="<?= OS_LANG ?>">
    <link rel="canonical" href="<?= $url ?>" />
    <meta rel="apple-touch-icon" href="<?= $image ?>" />
    <link rel="apple-touch-icon" href="<?= URL_PUBLIC ?>/favicon.ico?ver=<?= VER ?>">
    <meta property="og:locale" content="<?= strtolower(LANG_CODE) . "_" . strtoupper(LANG_CODE) ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= $title ?>" />
    <meta property="og:description" content="<?= $description ?>" />
    <meta property="og:url" content="<?= $url ?>" />
    <meta property="og:site_name" content="<?= $url ?>" />
    <meta property="og:image" content="<?= $image ?>" />
    <meta property="og:image:secure_url" content="<?= $image ?>" />
    <meta name="twitter:card" content="<?= $description ?>" />
    <meta name="twitter:description" content="<?= $description ?>" />
    <meta name="twitter:title" content="<?= $description ?>" />
    <meta name="twitter:image" content="<?= $image ?>" />
    <meta name="theme-color" content="#000000">
