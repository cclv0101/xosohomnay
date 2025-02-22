
<?php if(@$id):?>
    <section class="container">
        <div class="content about">
            <div class="title"><?=$article['article_desc']?></div>
            <?=htmlspecialchars_decode($article['article_content'])?>
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
    <?php if(@$article_recomment):?>
        <h2 class="text-center mt-5 text-custom-2 fw-bolder">Các bài viết liên quan</h2>
        <?php $articles=@$article_recomment;?>
        <section class="articles container" id="bai-viet-tin-tuc">
            <hr class="divider"/>
            <div class="mb-5">
            <?php include_once("views/articles/articles.php");?>
            <div class="text-center">
                <a class="my-3 btn btn-primary" href="<?= URL_DOMAIN.'/'.OS_URL_ARTICLE.URL_FOOT_OS?>">Xem tất cả bài viết</a>
            </div>
        </section>
    <?php endif;?>
<?php else:?>
    <?php if(intval(@$_POST['page']??'1')==1):?>
        <section class="container">
            <form method="post">
                <div class="input-group my-3">
                    <input type="text" name="keyword" class="form-control" placeholder="Nhập từ khoá để tìm kiếm...." value="<?= @$_POST['keyword'];?>" aria-label="keyword" aria-describedby="basic-search">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-search" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">Tìm kiếm</span>
                    </div>
                </div>
            </form>
        </section>
        <section class="articles container" id="bai-viet-tin-tuc">
            <hr class="divider"/>
            <div class="mb-5">
            <?php include_once("views/articles/articles.php");?>
            <div id="moreContent"></div>
            <div id="moreButton" class="text-center">
                <button onclick="loadMore(this)" class="my-3 btn btn-primary">Tải thêm bài viết</button>
            </div>
            <script>
                var page=<?= intval(@$_POST['page']??'1') + 1;?>;
                function loadMore(t){
                    $(t).text('.....');
                    setTimeout(() => {
                        $.ajax({
                            type: "POST",
                            url: window.location.href,
                            data: {
                                'keyword':"<?= @$_POST['keyword'];?>",
                                'page':page,
                            },
                            success: function (response) {
                                if (response!='null') {
                                    page++;
                                    $('#moreContent').append(response);
                                    $(t).text('Tải thêm bài viết');
                                } else {
                                    $('#moreButton').html('Đã tải hết bài viết!!!');
                                }
                            }
                        });
                    }, 200);
                }
            </script>
        </section>
    <?php else:?>
        <?php include_once("views/articles/articles.php");?>
    <?php endif;?>
<?php endif;?>