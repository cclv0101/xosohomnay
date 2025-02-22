<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th class="th-lg" style="width: 15%"><a onclick="clickSort('service_title')" data-name="service_title">Tiêu đề <i class="sort"></i></a></th>
                <th class="th-lg" style="width: 20%"><a>Hình ảnh <i class="sort"></i></a></th>
                <th class="th-lg" style="width: 20%"><a onclick="clickSort('service_desc')" data-name="service_desc">Nội dung <i class="sort"></i></a></th>
                <th class="th-lg" style="width: 15%"><a onclick="clickSort('service_user_id')" data-name="service_user_id">Tác giả<i class="sort"></i></a></th>
                <th class="th-lg" style="width: 15%"><a onclick="clickSort('service_updated')" data-name="service_updated">Thời gian<i class="sort"></i></a></th>
                <th class="th-lg" style="width: 10%"><a>Hành động</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service) : ?>
                <?php $service_image = URL_PUBLIC.'/services/'.substr($service['service_slug'],0,70).'/'.$service['service_slug'].'.webp?v='.time() ?>
                <tr id="service_<?=$service['service_id']?>">
                    <td>
                        <span class="text-truncate-3" id="service_title_<?=$service['service_id']?>"><?= $service['service_title'] ?></span>
                        <span class="pointer service_stt_<?=$service['service_stt']?>" onclick="changeSTTService(this,<?= $service['service_id'] ?>,'<?=$service['service_stt']==0?'1':($service['service_stt']==1?'0':'0')?>')"></span>
                    </td>
                    <td><img onerror='this.style.display=`none`'id="service_image_<?=$service['service_id']?>" src="<?= $service_image ?>" class="img-fluid"></td>
                    <td><span class="text-truncate-5" id="service_desc_<?=$service['service_id']?>"><?= $service['service_desc'] ?></span></td>
                    <td class="small">
                        <span class="badge badge-primary badge-pill"><i class="fas fa-user"></i> <span class="user_<?= md5($service['service_user_id']) ?>"></span></span>
                        <?php foreach(explode(",",$service['service_tags']) as $tag):?>
                            <span class="badge badge-secondary badge-pill"><i class="fas fa-tags"></i> <?= $tag ?></span>
                        <?php endforeach;?>
                    </td>
                    <td class="small">
                        <p class="mb-1">Đã tạo: <span class="timed"><?= $service['service_created'] ?></span></p>
                        <p class="mb-1">Cập nhật: <span class="timed"><?= $service['service_updated'] ?></span></p>
                        <p class="mb-1">Lượt xem: <?=$service['service_total_view']?></p>
                    </td>
                    <td>
                        <a href="<?= URL_DOMAIN ?>/admin/service/edit/<?= $service['service_id'] . URL_FOOT ?>" class="pointer badge orange"> <i class="fas fa-edit"></i> Chỉnh sửa</a>
                        <a href="<?= URL_DOMAIN ?>/admin/service/copy/<?= $service['service_id'] . URL_FOOT ?>" class="pointer badge green"> <i class="fas fa-copy"></i> Nhân bản</a>
                        <a data-toggle="modal" data-target="#modalComment" onclick="loadComment(<?= $service['service_id'] ?>)" class="pointer badge blue"> <i class="fas fa-comment"></i> Bình luận <span class="comment_item"></span></a>
                        <a class="pointer badge red" data-toggle="modal" data-target="#confirmTrash" onclick="trashService(<?= $service['service_id'] ?>)">
                            <i class="fas fa-trash-alt"></i> Thùng rác</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<hr class="my-0">
<div class="d-flex justify-content-between">
    <nav class="my-3">
        <ul class="pagination pagination-circle pg-blue mb-0">
            <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?> clearfix d-none d-md-block">
                <a onclick="updateValue('service_current_page', 1)" class="page-link">Đầu</a>
            </li>
            <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                <a onclick="updateValue('service_current_page',<?= $page - 1 ?>)" class="page-link" aria-label="Trước">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Trước</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                <li class="page-item <?= ($page == $i) ? 'active ' : '' ?>">
                    <a onclick="updateValue('service_current_page',<?= $i ?>)" class="page-link "><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($page == $total_page) ? 'disabled' : '' ?>">
                <a onclick="updateValue('service_current_page',<?= $page + 1 ?>)" class="page-link" aria-label="Sau">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Sau</span>
                </a>
            </li>
            <li class="page-item <?= ($page == $total_page) ? 'disabled' : '' ?> clearfix d-none d-md-block">
                <a onclick="updateValue('service_current_page',<?= $total_page ?>)" class="page-link">Cuối</a>
            </li>
        </ul>
    </nav>
</div>
<script>
    $(document).ready(function() {
        $(".sort").each(function(index) {
            var parent_name = $(this).parent();
            var parent_name_data = parent_name.data("name");
            var service_sort_name = localStorage.getItem("service_sort_name");
            if (parent_name_data == service_sort_name) {
                var service_sort_by = localStorage.getItem("service_sort_by");
                parent_name.addClass('font-weight-bold');
                if (service_sort_by == "ASC") {
                    $(this).addClass('fas fa-angle-down ml-1');
                } else {
                    $(this).addClass('fas fa-angle-up ml-1');
                }
            }
        });
    });
</script>