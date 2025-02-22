<?php foreach($articles as $article):?>
  <div class="row mb-4 article">
      <div class="col-md-4">
          <a href="<?= URL_DOMAIN.'/'.OS_URL_ARTICLE.'/'.@$article['article_slug'].URL_FOOT_OS?>">
              <img class="img-fluid" src="<?= URL_PUBLIC.'/articles/'.substr(@$article['article_slug'],0,70).'/'.@$article['article_slug'].'.webp?ver='.VER.@$article['article_updated'] ?>" alt="<?= @$article['article_title']?>">
          </a>
      </div>
      <div class="col-md-8 content">
          <a href="<?= URL_DOMAIN.'/'.OS_URL_ARTICLE.'/'.@$article['article_slug'].URL_FOOT_OS?>">
              <h4 class="my-1"><?= @$article['article_title']?></h4>
          </a>
          <a href="<?= URL_DOMAIN.'/'.OS_URL_ARTICLE.'/'.@$article['article_slug'].URL_FOOT_OS?>">
              <p class="my-0 text-black"><?= @$article['article_desc']?></p>
          </a>
          <a href="<?= URL_DOMAIN.'/'.OS_URL_ARTICLE.'/'.@$article['article_slug'].URL_FOOT_OS?>">Xem thêm...</a>
      </div>
  </div>
<?php endforeach;?>