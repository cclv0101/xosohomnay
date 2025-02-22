<div class="table-responsive">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th class="th-lg" style="width: 15%"><a onclick="clickSort('article_title')" data-name="article_title">Tiêu đề <i class="sort"></i></a></th>
                <th class="th-lg" style="width: 20%"><a>Hình ảnh <i class="sort"></i></a></th>
                <th class="th-lg" style="width: 20%"><a onclick="clickSort('article_desc')" data-name="article_desc">Nội dung <i class="sort"></i></a></th>
                <th class="th-lg" style="width: 15%"><a onclick="clickSort('article_user_id')" data-name="article_user_id">Tác giả<i class="sort"></i></a></th>
                <th class="th-lg" style="width: 15%"><a onclick="clickSort('article_updated')" data-name="article_updated">Thời gian<i class="sort"></i></a></th>
                <th class="th-lg" style="width: 10%"><a>Hành động</a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) : ?>
                <?php $article_image = URL_PUBLIC.'/articles/'.substr($article['article_slug'],0,70).'/'.$article['article_slug'].'.webp?v='.time() ?>
                <tr id="article_<?=$article['article_id']?>">
                    <td>
                        <span class="text-truncate-3" id="article_title_<?=$article['article_id']?>"><?= $article['article_title'] ?></span>
                        <span class="pointer article_stt_<?=$article['article_stt']?>" onclick="changeSTTArticle(this,<?= $article['article_id'] ?>,'<?=$article['article_stt']==0?'1':($article['article_stt']==1?'0':'0')?>')"></span>
                    </td>
                    <td><img onerror='this.style.display=`none`'id="article_image_<?=$article['article_id']?>" src="<?= $article_image ?>" class="img-fluid"></td>
                    <td><span class="text-truncate-5" id="article_desc_<?=$article['article_id']?>"><?= $article['article_desc'] ?></span></td>
                    <td class="small">
                        <span class="badge badge-primary badge-pill"><i class="fas fa-user"></i> <span class="user_<?= md5($article['article_user_id']) ?>"></span></span>
                        <?php foreach(explode(",",$article['article_tags']) as $tag):?>
                            <span class="badge badge-secondary badge-pill"><i class="fas fa-tags"></i> <?= $tag ?></span>
                        <?php endforeach;?>
                    </td>
                    <td class="small">
                        <p class="mb-1">Đã tạo: <span class="timed"><?= $article['article_created'] ?></span></p>
                        <p class="mb-1">Cập nhật: <span class="timed"><?= $article['article_updated'] ?></span></p>
                        <p class="mb-1">Lượt xem: <?=$article['article_total_view']?></p>
                    </td>
                    <td>
                        <a href="<?= URL_DOMAIN ?>/admin/article/edit/<?= $article['article_id'] . URL_FOOT ?>" class="pointer badge orange"> <i class="fas fa-edit"></i> Chỉnh sửa</a>
                        <a href="<?= URL_DOMAIN ?>/admin/article/copy/<?= $article['article_id'] . URL_FOOT ?>" class="pointer badge green"> <i class="fas fa-copy"></i> Nhân bản</a>
                        <a data-toggle="modal" data-target="#modalComment" onclick="loadComment(<?= $article['article_id'] ?>)" class="pointer badge blue"> <i class="fas fa-comment"></i> Bình luận <span class="comment_item"></span></a>
                        <a class="pointer badge red" data-toggle="modal" data-target="#confirmTrash" onclick="trashArticle(<?= $article['article_id'] ?>)">
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
                <a onclick="updateValue('article_current_page', 1)" class="page-link">Đầu</a>
            </li>
            <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                <a onclick="updateValue('article_current_page',<?= $page - 1 ?>)" class="page-link" aria-label="Trước">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Trước</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                <li class="page-item <?= ($page == $i) ? 'active ' : '' ?>">
                    <a onclick="updateValue('article_current_page',<?= $i ?>)" class="page-link "><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($page == $total_page) ? 'disabled' : '' ?>">
                <a onclick="updateValue('article_current_page',<?= $page + 1 ?>)" class="page-link" aria-label="Sau">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Sau</span>
                </a>
            </li>
            <li class="page-item <?= ($page == $total_page) ? 'disabled' : '' ?> clearfix d-none d-md-block">
                <a onclick="updateValue('article_current_page',<?= $total_page ?>)" class="page-link">Cuối</a>
            </li>
        </ul>
    </nav>
</div>
<script>
    $(document).ready(function() {
        $(".sort").each(function(index) {
            var parent_name = $(this).parent();
            var parent_name_data = parent_name.data("name");
            var article_sort_name = localStorage.getItem("article_sort_name");
            if (parent_name_data == article_sort_name) {
                var article_sort_by = localStorage.getItem("article_sort_by");
                parent_name.addClass('font-weight-bold');
                if (article_sort_by == "ASC") {
                    $(this).addClass('fas fa-angle-down ml-1');
                } else {
                    $(this).addClass('fas fa-angle-up ml-1');
                }
            }
        });
    });
</script>