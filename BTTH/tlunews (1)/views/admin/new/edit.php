<?php
session_start();
require_once "../../../models/News.php";
require_once "../../../models/Category.php";
// Kiểm tra xem ID tin tức có được truyền qua URL không
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}
// Lấy danh sách tin tức
$id = $_GET['id'];

// Lấy thông tin tin tức và danh sách danh mục
$news = News::getById($id);
if (!$news) {
    header("Location: index.php");
    exit;
}

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
        // Xử lý ảnh
        $imagePath = $news['image']; // Giữ nguyên ảnh cũ nếu không có ảnh mới
        if ($image && $image['tmp_name']) {
            // Xóa ảnh cũ nếu có ảnh mới
            if (file_exists($news['image'])) {
                unlink($news['image']);
            }
            $targetDir = "../../uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $imagePath = $targetDir . time() . "_" . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        // Cập nhật tin tức vào cơ sở dữ liệu
        if (News::update($id, $title, $content, $imagePath, $category_id)) {
            $success = "Cập nhật tin tức thành công!";
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
    <title>Chỉnh sửa tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f0f4f8;
        margin: 0;
        padding: 0;
    }

    .container {
        padding: 30px;
    }

    h1 {
        font-size: 36px;
        color: #333;
        margin-bottom: 20px;
    }

    .breadcrumb {
        background-color: transparent;
        padding: 0;
        margin-bottom: 20px;
    }

    .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
    }

    .breadcrumb-item a:hover {
        color: #0056b3;
    }

    .alert {
        border-radius: 8px;
        padding: 15px;
        margin-top: 15px;
        font-size: 16px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #555;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ccc;
        margin-bottom: 15px;
        font-size: 16px;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .form-select {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 12px 25px;
        font-size: 18px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .img-fluid {
        border-radius: 8px;
        max-height: 200px;
        margin-top: 20px;
    }

    .card-header {
        background-color: #007bff;
        color: white;
        padding: 20px;
        border-radius: 10px 10px 0 0;
    }

    .card-body {
        padding: 20px;
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        h1 {
            font-size: 28px;
        }

        .btn-primary {
            padding: 10px 20px;
            font-size: 16px;
        }

        .form-control, .form-select {
            font-size: 14px;
        }
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
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa tin tức</li>
            </ol>
        </nav>

        <!-- Main Card -->
        <div class="card p-4">
            <h1 class="mb-4 text-center text-primary">Chỉnh sửa Tin Tức</h1>

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
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($news['title']) ?>" placeholder="Nhập tiêu đề bài viết" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung</label>
                    <textarea class="form-control" id="content" name="content" rows="5" placeholder="Nhập nội dung bài viết" required><?= htmlspecialchars($news['content']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        <option value="" disabled>Chọn danh mục</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= $category['id'] == $news['category_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <?php if ($news['image']): ?>
                        <img src="<?= $news['image'] ?>" alt="Ảnh hiện tại" class="img-fluid mt-3" style="max-height: 200px; border: 1px solid #ddd; border-radius: 5px;">
                    <?php endif; ?>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
