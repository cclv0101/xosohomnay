<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th class="th-lg" style="width: 15%"><a onclick="clickSort('page_title')" data-name="page_title">Tiêu đề <i class="sort"></i></a></th>
                <th class="th-lg" style="width: 20%"><a>Hình ảnh <i class="sort"></i></a></th>
                <th class="th-lg" style="width: 20%"><a onclick="clickSort('page_desc')" data-name="page_desc">Nội dung <i class="sort"></i></a></th>
                <th class="th-lg" style="width: 15%"><a onclick="clickSort('page_total_view')" data-name="page_total_view">Thông tin<i class="sort"></i></a></th>
                <th class="th-lg" style="width: 15%"><a onclick="clickSort('page_updated')" data-name="page_updated">Thời gian<i class="sort"></i></a></th>
                <th class="th-lg" style="width: 10%"><a>Hành động</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page) : ?>
            <?php if (!in_array($page['page_slug'],OS_URL_ARRAY)): ?>
                <?php $page_image = URL_PUBLIC.'/pages/'.substr($page['page_slug'],0,70).'/'.$page['page_slug'].'.webp?v='.time() ?>
                <tr id="page_<?=$page['page_id']?>">
                    <td>
                        <span class="text-truncate-3" id="page_title_<?=$page['page_id']?>"><?= $page['page_title'] ?></span>
                        <span class="pointer page_stt_<?=$page['page_stt']?>" onclick="changeSTTPage(this,<?= $page['page_id'] ?>,'<?=$page['page_stt']==0?'1':($page['page_stt']==1?'0':'0')?>')"></span>
                    </td>    
                    <td><img onerror='this.style.display=`none`'id="page_image_<?=$page['page_id']?>" src="<?= $page_image ?>" class="img-fluid"></td>
                    <td><span class="text-truncate-5" id="page_desc_<?=$page['page_id']?>"><?= $page['page_desc'] ?></span></td>
                    <td class="small">
                        <span class="badge badge-primary badge-pill"><i class="fas fa-eye"></i> Lượt xem: <?= $page['page_total_view'] ?></span>
                    </td>
                    <td class="small">
                        <p class="mb-1">Đã tạo: <span class="timed"><?= $page['page_created'] ?></span></p>
                        <p class="mb-1">Cập nhật: <span class="timed"><?= $page['page_updated'] ?></span></p>
                        <p class="mb-1">Lượt xem: <?=$page['page_total_view']?></p>
                    </td>
                    <td>
                        <a href="<?= URL_DOMAIN ?>/admin/page/edit/<?= $page['page_id'] . URL_FOOT ?>" class="pointer badge orange mx-1"> <i class="fas fa-edit"></i> Chỉnh sửa</a>
                        <a href="<?= URL_DOMAIN ?>/admin/page/copy/<?= $page['page_id'] . URL_FOOT ?>" class="pointer badge green mx-1"> <i class="fas fa-copy"></i> Nhân bản</a>
                        <a data-toggle="modal" data-target="#modalComment" onclick="loadComment(<?= $page['page_id'] ?>)" class="pointer badge blue mx-1"> <i class="fas fa-comment"></i> Bình luận <span class="comment_item"></span></a>
                        <a data-toggle="modal" data-target="#confirmTrash" onclick="trashPage(<?= $page['page_id'] ?>)" class="pointer badge red mx-1">
                            <i class="fas fa-trash-alt"></i> Thùng rác</a>
                    </td>
                </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<hr class="my-0">
<div class="d-flex justify-content-between">
    <nav class="my-3">
        <ul class="pagination pagination-circle pg-blue mb-0">
            <li class="page-item <?= ($p == 1) ? 'disabled' : '' ?> clearfix d-none d-md-block">
                <a onclick="updateValue('page_current_page', 1)" class="page-link">Đầu</a>
            </li>
            <li class="page-item <?= ($p == 1) ? 'disabled' : '' ?>">
                <a onclick="updateValue('page_current_page',<?= $p - 1 ?>)" class="page-link" aria-label="Trước">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Trước</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                <li class="page-item <?= ($p == $i) ? 'active ' : '' ?>">
                    <a onclick="updateValue('page_current_page',<?= $i ?>)" class="page-link "><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($p == $total_page) ? 'disabled' : '' ?>">
                <a onclick="updateValue('page_current_page',<?= $p + 1 ?>)" class="page-link" aria-label="Sau">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Sau</span>
                </a>
            </li>
            <li class="page-item <?= ($p == $total_page) ? 'disabled' : '' ?> clearfix d-none d-md-block">
                <a onclick="updateValue('page_current_page',<?= $total_page ?>)" class="page-link">Cuối</a>
            </li>
        </ul>
    </nav>
</div>
<script>
    $(document).ready(function() {
        $(".sort").each(function(index) {
            var parent_name = $(this).parent();
            var parent_name_data = parent_name.data("name");
            var page_sort_name = localStorage.getItem("page_sort_name");
            if (parent_name_data == page_sort_name) {
                var page_sort_by = localStorage.getItem("page_sort_by");
                parent_name.addClass('font-weight-bold');
                if (page_sort_by == "ASC") {
                    $(this).addClass('fas fa-angle-down ml-1');
                } else {
                    $(this).addClass('fas fa-angle-up ml-1');
                }
            }
        });
    });
</script>