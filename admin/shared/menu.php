<div id="slide-out" class="side-nav fixed">
    <ul class="custom-scrollbar">
        <li class="logo-sn waves-effect">
            <div class="text-center">
                <a href="<?= URL_DOMAIN ?>/admin" class="px-3">
                    <center>
                    <img onerror='this.style.display=`none`'src="<?= URL_PUBLIC.'/favicon.ico?v='.VER?> ?>" alt="<?= OS_NAME ?>" style="width:60%"> </a>
                    </center>
            </div>
        </li>
        <li>
            <ul class="collapsible collapsible-accordion">
                <li> 
                    <a href="<?= URL_DOMAIN.'/admin/dashboard'.URL_FOOT ?>" class="collapsible-header arrow-r<?=($ctl =='dashboard')?' menu-active note':''?>">
                        <i class="fas fa-tachometer-alt"></i> Bảng điều khiển
                    </a>
                </li>
                <li> 
                    <a href="<?= URL_DOMAIN.'/admin/project'.URL_FOOT ?>" class="project collapsible-header arrow-r<?=($ctl =='project')?' menu-active note':''?>">
                        <i class="fas fa-ticket-alt"></i> CT khuyến mãi
                        <span class="comment_notification"></span>
                    </a>
                </li>
                <li> 
                    <a href="<?= URL_DOMAIN.'/admin/service'.URL_FOOT ?>" class="service collapsible-header arrow-r<?=($ctl =='service')?' menu-active note':''?>">
                        <i class="fas fa-envelope"></i> Dịch vụ
                        <span class="comment_notification"></span>
                    </a>
                </li>
                <li> 
                    <a href="<?= URL_DOMAIN.'/admin/article'.URL_FOOT ?>" class="article collapsible-header arrow-r<?=($ctl =='article')?' menu-active note':''?>">
                        <i class="fas fa-newspaper"></i> Bài viết tin tức
                        <span class="comment_notification"></span>
                    </a>
                </li>
                <li>
                    <a href="<?= URL_DOMAIN.'/admin/data'.URL_FOOT ?>" class="collapsible-header arrow-r<?=($ctl =='data')?' menu-active note':''?>">
                        <i class="fas fa-user"></i> Data đăng ký
                        <span class="comment_notification"></span>
                    </a>
                </li>
                <?php if(in_array($type, array(0,1))): ?>
                <li>
                    <a href="<?= URL_DOMAIN.'/admin/page'.URL_FOOT ?>" class="page collapsible-header arrow-r<?=($ctl =='page')?' menu-active note':''?>">
                        <i class="fas fa-pager"></i> Cấu hình trang SEO
                        <span class="comment_notification"></span>
                    </a>
                </li>
                <li> 
                    <a href="<?= URL_DOMAIN.'/admin/user'.URL_FOOT ?>" class="collapsible-header arrow-r<?=($ctl =='user')?' menu-active note':''?>">
                        <i class="fas fa-user-tie"></i> Tài khoản nhân viên
                    </a>
                </li>
                <li> 
                    <a href="<?= URL_DOMAIN.'/admin/setting'.URL_FOOT ?>" class="collapsible-header arrow-r<?=($ctl =='setting')?' menu-active note':''?>">
                        <i class="fas fa-cogs"></i> Cài đặt hệ thống
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="<?= URL_DOMAIN ?>" target="_blank">
                        <i class="fas fa-arrow-right"></i> Xem website
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>