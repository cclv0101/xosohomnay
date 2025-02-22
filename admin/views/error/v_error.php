<!DOCTYPE html>
<html lang="<?= LANG_CODE ?>">
<?php include_once("shared/head.php"); ?>
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid  m-error-1"
         style="background-image: url(<?= URL_ASSETS ?>/admin/images/error/bg_error_1.webp);">
        <div class="m-error_container">
					<span class="m-error_number">
						<h1>
							<?= strtoupper($id) ?>
						</h1>
					</span>
            <p class="m-error_desc">
                OOPS! Something went wrong here
            </p>
        </div>
    </div>
</div>
<?php include_once("shared/foot.php"); ?>
</body>
</html>
