<section class="container">
    <div class="content about">
        <div class="title"><?=$project['project_desc']?></div>
        <?=htmlspecialchars_decode($project['project_content'])?>
    </div>
    <?php if(@$keyword):?>
        <div class="tags-list">
            <b>Từ khoá:</b>
            <?php foreach(explode(',',@$keyword) as $tag):?>
                <span><?=$tag?></span>
            <?php endforeach;?>
        </div>
    <?php endif;?>
</section>
<?php if(@$project_recomment):?>
    <h2 class="text-center mt-5 text-custom-2 fw-bolder">Các chương trình khuyến mãi</h2>
    <?php $projects=@$project_recomment;?>
    <section class="projects container" id="chuong-trinh-khuyen-mai">
        <hr class="divider"/>
        <div class="mb-5">
        <?php include_once("views/projects/projects.php");?>
    </section>
<?php endif;?>