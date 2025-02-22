<?php foreach($services as $service):?>
  <div class="row mb-4 service">
      <div class="col-md-4">
          <a href="<?= URL_DOMAIN.'/'.OS_URL_SERVICE.'/'.@$service['service_slug'].URL_FOOT_OS?>">
              <img class="img-fluid" src="<?= URL_PUBLIC.'/services/'.substr(@$service['service_slug'],0,70).'/'.@$service['service_slug'].'.webp?ver='.VER.@$service['service_updated'] ?>" alt="<?= @$service['service_title']?>">
          </a>
      </div>
      <div class="col-md-8 content">
          <a href="<?= URL_DOMAIN.'/'.OS_URL_SERVICE.'/'.@$service['service_slug'].URL_FOOT_OS?>">
              <h4 class="my-1"><?= @$service['service_title']?></h4>
          </a>
          <a href="<?= URL_DOMAIN.'/'.OS_URL_SERVICE.'/'.@$service['service_slug'].URL_FOOT_OS?>">
              <p class="my-0 text-black"><?= @$service['service_desc']?></p>
          </a>
          <a href="<?= URL_DOMAIN.'/'.OS_URL_SERVICE.'/'.@$service['service_slug'].URL_FOOT_OS?>">Xem thêm...</a>
      </div>
  </div>
<?php endforeach;?>