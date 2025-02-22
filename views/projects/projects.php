<?php foreach($projects as $project):?>
  <div class="row mb-4 project">
      <div class="col-md-4">
          <a href="<?= URL_DOMAIN.'/'.OS_URL_PROJECT.'/'.@$project['project_slug'].URL_FOOT_OS?>">
              <img class="img-fluid" src="<?= URL_PUBLIC.'/projects/'.substr(@$project['project_slug'],0,70).'/'.@$project['project_slug'].'.webp?ver='.VER.@$project['project_updated'] ?>" alt="<?= @$project['project_title']?>">
          </a>
      </div>
      <div class="col-md-8 content">
          <a href="<?= URL_DOMAIN.'/'.OS_URL_PROJECT.'/'.@$project['project_slug'].URL_FOOT_OS?>">
              <h4 class="my-1"><?= @$project['project_title']?></h4>
          </a>
          <a href="<?= URL_DOMAIN.'/'.OS_URL_PROJECT.'/'.@$project['project_slug'].URL_FOOT_OS?>">
              <p class="my-0 text-black"><?= @$project['project_desc']?></p>
          </a>
          <a href="<?= URL_DOMAIN.'/'.OS_URL_PROJECT.'/'.@$project['project_slug'].URL_FOOT_OS?>">Xem thêm...</a>
      </div>
  </div>
<?php endforeach;?>