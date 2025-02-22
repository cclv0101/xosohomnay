<div class="modal-body">
    <div class="box_file row mt-2">
        <?php if ($files) : ?>
            <?php foreach ($files as $kf=>$file) : ?>
                <?php $is_editor = ($media_type == ('image' || 'video' || 'audio')) ?? false; ?>
                <?php $is_type_image = in_array(strtolower(substr($file, -3)), array('gif', 'jpg', 'peg', 'png', 'bmp', 'ico', 'svg', 'ebp')) ?? false; ?>
                <?php $is_type_video = in_array(strtolower(substr($file, -3)), array('mp4', '3gp')) ?? false; ?>
                <?php $is_type_audio = in_array(strtolower(substr($file, -3)), array('mp3', 'wav')) ?? false; ?>
                <?php $ptf = $folder . '/' . $file; ?>
                <?php if (($is_type_image && $media_type == 'image') || ($is_type_video && $media_type == 'video') || ($is_type_audio && $media_type == 'audio') || !$is_editor) : ?>
                    <div class="col-md-4 m-0 p-2">
                        <div class="file card">
                            <div class="file-view view overlay">
                                <?php if ($is_type_image) : ?>
                                    <img onerror='this.style.display=`none`'src="<?= $ptf ?>" class="card-img-top" alt="Xem trước ảnh <?= $file ?>" style="height: 200px; width: 235px; object-fit: cover; object-position: top; padding: 3px;">
                                    <a onclick="chooseImageEditor('<?= $ptf ?>')" class="mask"></a>
                                <?php endif; ?>
                                <?php if ($is_type_video) : ?>
                                    <video src="<?= $ptf ?>" class="card-img-top" alt="Xem trước video <?= $file ?>" controls style="height: 200px; width: 235px; object-fit: cover; object-position: top; padding: 3px;"></video>
                                    <a onclick="chooseVideoEditor('<?= $ptf ?>')" class="mask"></a>
                                <?php endif; ?>
                            </div>
                            <div class="card-body flex-space-between p-2 tip">
                                    <span class="title"><?= $file ?></span>
                                <div class="px-1">
                                    <p id="name_<?=$kf?>" class="card-title px-1 mb-0 text-truncate-1"><?= $file ?></p>
                                </div>
                                <div class="px-1">
                                    <div class="dropdown text-right">
                                        <a class="dropdown-toggle" id="f_<?=$kf?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></a>
                                        <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="f_<?=$kf?>">
                                            <a class="dropdown-item px-2 py-1" href="<?= $ptf ?>" target="_blank">
                                                <i class="fas fa-eye"></i> Mở liên kết
                                            </a>
                                            <a class="dropdown-item px-2 py-1" onclick="renameFile('<?=$kf?>')" data-toggle="modal" data-target="#modalRename">
                                                <i class="fas fa-edit"></i> Đổi tên file
                                            </a>
                                            <a class="dropdown-item px-2 py-1" onclick="deleteFile('<?=$kf?>')" data-toggle="modal" data-target="#modalDelete">
                                                <i class="fas fa-trash"></i> Xóa bỏ file
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<div class="modal-footer">
    <div class="md-form md-outline">
        <input type="file" id="upload" class="form-control" onchange="uploadFile(this)">
        <label class="active" for="upload">Tải ảnh lên:</label>
    </div>
    <a type="button" class="btn btn-danger" onclick="removeTempMedia()" data-dismiss="modal">Đóng và xóa</a>
</div>