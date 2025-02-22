<div class="row">
    <?php foreach ($users as $u) : ?>
        <div class="col-xl-4 col-md-6 px-md-2 px-0">
            <div class="card my-3">
                <h4 class="card-header <?= $stt_color ?>-color text-center white-text"><?= $u['user_fullname'] ?></h4>
                <div class="card-body card-body-<?= $stt_color ?> p-2">
                    <div class="row">
                        <div class="col-md-4 col-5 px-2">
                            <img onerror='this.style.display=`none`'src="<?= URL_PUBLIC ?>/users/<?= $u['user_username'].'/avatar.webp?v='.time() ?>" class="rounded-circle rounded-circle-<?= $stt_color ?> img-fluid" style="height: 110px;">
                        </div>
                        <div class="col-md-8 col-7 px-2">
                            <h5 class="nav-link dropdown-toggle waves-effect p-0 m-0" href="#" id="userDropdown<?= $u['user_username'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b><?= $u['user_fullname'] ?></b>
                            </h5>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown<?= $u['user_username'] ?>">
                                <?php if($stt!=3): ?>
                                <a class="dropdown-item text-primary" href="<?= URL_DOMAIN ?>/admin/user/edit/<?= $u['user_id'] ?><?= URL_FOOT ?>"><i class="fa fa-edit"></i> Chỉnh sửa</a>
                                <?php endif; ?>
                                <?php if($stt==3): ?>
                                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modalAction" onclick="modalAction(4,<?= $u['user_id']; ?>, '<?= $u['user_fullname']; ?>', '<?= URL_PUBLIC ?>/users/<?= $u['user_username'] ?>/avatar.webp', '<?= $u['user_username']; ?>')"><i class="fa fa-user"></i> Xóa vĩnh viễn</a>
                                <?php endif; ?>
                                <?php if($stt!=1): ?>
                                <a class="dropdown-item text-primary" data-toggle="modal" data-target="#modalAction" onclick="modalAction(1,<?= $u['user_id']; ?>, '<?= $u['user_fullname']; ?>', '<?= URL_PUBLIC ?>/users/<?= $u['user_username'] ?>/avatar.webp', '<?= $u['user_username']; ?>')"><i class="fa fa-user"></i> Hoạt động</a>
                                <?php endif; ?>
                                <?php if($stt!=0): ?>
                                <a class="dropdown-item text-secondary" data-toggle="modal" data-target="#modalAction" onclick="modalAction(0,<?= $u['user_id']; ?>, '<?= $u['user_fullname']; ?>', '<?= URL_PUBLIC ?>/users/<?= $u['user_username'] ?>/avatar.webp', '<?= $u['user_username']; ?>')"><i class="fa fa-lock"></i> Tạm ngưng</a>
                                <?php endif; ?>
                                <?php if($stt!=2): ?>
                                <a class="dropdown-item text-warning" data-toggle="modal" data-target="#modalAction" onclick="modalAction(2,<?= $u['user_id']; ?>, '<?= $u['user_fullname']; ?>', '<?= URL_PUBLIC ?>/users/<?= $u['user_username'] ?>/avatar.webp', '<?= $u['user_username']; ?>')"><i class="fa fa-paper-plane"></i> Bản nháp</a>
                                <?php endif; ?>
                                <?php if($stt!=3): ?>
                                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modalAction" onclick="modalAction(3,<?= $u['user_id']; ?>, '<?= $u['user_fullname']; ?>', '<?= URL_PUBLIC ?>/users/<?= $u['user_username'] ?>/avatar.webp', '<?= $u['user_username']; ?>')"><i class="fa fa-trash"></i> Thùng rác</a>
                                <?php endif; ?>
                            </div>
                            <p class="my-0 mb-0">@<?= $u['user_username'] ?></p>
                            <p class="my-0"><?= $u['user_type']==0?'Kỹ thuật viên':($stt==1?'Quản trị viên':($stt==2?'Người kiểm duyệt':'Người đăng bài')); ?></p>
                            <p class="my-0">Đã tạo: <span class="timed"><?= $u['user_created'] ?></span></p>
                            <p class="my-0">Cập nhật: <span class="timed"><?= $u['user_updated'] ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>