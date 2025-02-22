<section class="container">
    <div class="content about">
        <div class="title"><?=$service['service_desc']?></div>
        <?=htmlspecialchars_decode($service['service_content'])?>
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
<?php if(@$service_recomment):?>
    <h2 class="text-center mt-5 text-custom-2 fw-bolder">Các dịch vụ khác</h2>
    <?php $services=@$service_recomment;?>
    <section class="services container" id="dich-vu">
        <hr class="divider"/>
        <div class="mb-5">
        <?php include_once("views/services/services.php");?>
    </section>
<?php endif;?>