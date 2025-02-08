<?php

require_once 'FileManager.php';

$basePath = __DIR__ . '/files';
$relativePath = isset($_GET['dir']) ? $_GET['dir'] : '';

try {
    $fm = new FileManager($basePath);
    $items = $fm->listFiles($relativePath);
} catch (Exception $e) {
    die($e->getMessage());
}

$directories = array_filter($items, function($item) {
    return $item['type'] === 'dir';
});
$images = array_filter($items, function($item) {
    return $item['type'] === 'image';
});

$parentDir = $relativePath !== '' ? dirname($relativePath) : '';
$currentDirName = $relativePath !== '' ? basename($relativePath) : 'Корневая директория';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Файловый менеджер</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-4">
    <h1>Файловый менеджер</h1>

    <div class="mb-4 d-flex align-items-center">
        <?php if ($relativePath !== ''): ?>
            <a href="?dir=<?php echo urlencode($parentDir); ?>" class="btn btn-success btn-sm">Назад</a>
        <?php endif; ?>
        <span class="ml-3">
                Путь: <?php echo $relativePath !== '' ? '/' . htmlspecialchars($relativePath) : '/'; ?>
            </span>
        <span class="ml-3">
                Текущая директория: <?php echo htmlspecialchars($currentDirName); ?>
        </span>
    </div>

    <?php if (!empty($directories)): ?>
        <h3>Директории</h3>
        <div class="list-group mb-4">
            <?php foreach ($directories as $dir): ?>
                <a href="?dir=<?php echo urlencode($dir['path']); ?>" class="list-group-item">
                    <?php echo htmlspecialchars($dir['name']); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($directories) && !empty($images)): ?>
        <hr>
    <?php endif; ?>

    <?php if (!empty($images)): ?>
        <h3>Изображения</h3>
        <div class="row">
            <?php foreach ($images as $img): ?>
                <div class="col-xs-6 col-sm-4 col-md-3 image-card">
                    <img src="files/<?php echo htmlspecialchars($img['path']); ?>"
                         alt="<?php echo htmlspecialchars($img['name']); ?>"
                         class="img-thumbnail clickable">
                    <div class="caption"><p><?php echo htmlspecialchars($img['name']); ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (empty($directories) && empty($images)): ?>
        <p>Нет файлов или папок для отображения</p>
    <?php endif; ?>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="imageModalLabel"></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="modalImage" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('.clickable').on('click', function() {
            var src = $(this).attr('src');
            var alt = $(this).attr('alt');
            $('#modalImage').attr('src', src);
            $('#imageModalLabel').text(alt);
            $('#imageModal').modal('show');
        });
    });
</script>

</body>
</html>
