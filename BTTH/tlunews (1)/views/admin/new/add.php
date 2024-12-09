<?php
session_start();
require_once "../../../models/News.php";
require_once "../../../models/Category.php";
// Lấy danh sách danh mục
$categories = Category::getAll();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image'];

    // Kiểm tra dữ liệu nhập
    if (empty($title) || empty($content) || empty($category_id)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } else {
        // Upload ảnh
        $imagePath = null;
        if ($image && $image['tmp_name']) {
            $targetDir = "../../uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $imagePath = $targetDir . time() . "_" . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        // Lưu tin tức vào cơ sở dữ liệu
        if (News::add($title, $content, $imagePath, $category_id)) {
            $success = "Thêm tin tức thành công!";
            header("Refresh: 2; url=index.php");
        } else {
            $error = "Có lỗi xảy ra, vui lòng thử lại.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .breadcrumb-item > a {
            text-decoration: none;
            color: #007bff;
        }
        .breadcrumb-item > a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="index.php">Quản lý tin tức</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm tin tức</li>
            </ol>
        </nav>

        <!-- Main Card -->
        <div class="card p-4">
            <h1 class="mb-4 text-center text-primary">Thêm Tin Tức Mới</h1>

            <!-- Hiển thị thông báo lỗi/thành công -->
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề bài viết" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung</label>
                    <textarea class="form-control" id="content" name="content" rows="5" placeholder="Nhập nội dung bài viết" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="" disabled selected>Chọn danh mục</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Thêm</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
