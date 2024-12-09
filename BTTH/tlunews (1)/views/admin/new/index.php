<?php
session_start();
require_once "../../../models/News.php";
require_once "../../../models/Category.php";

//// Kiểm tra quyền admin
//if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
//    header("Location: login.php");
//    exit;
//}

// Lấy danh sách tin tức
$newsList = News::getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Cấu hình chung cho body */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f6f9; /* Màu nền sáng nhẹ */
    color: #333;
    line-height: 1.6;
}

/* Header */
h1 {
    font-size: 36px;
    font-weight: 700;
    color: #495057;
    margin-bottom: 30px;
}

/* Container */
.container {
    max-width: 1000px;
    margin: 0 auto;
}

/* Button "Thêm tin tức mới" */
.btn-success {
    background-color: #28a745;
    border-color: #28a745;
    transition: background-color 0.3s ease;
}
.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

/* Table Styles */
.table {
    width: 100%;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    border-collapse: collapse;
    margin-top: 20px;
}

/* Table Header */
.table thead {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
}

.table th, .table td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.table tr:hover {
    background-color: #f1f1f1; /* Hiệu ứng hover cho dòng */
}

/* Table Button */
.table .btn {
    padding: 5px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

/* Sửa Button */
.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}
.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}

/* Xóa Button */
.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}
.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

/* Confirmation Button for Deletion */
button[type="submit"] {
    background-color: #dc3545;
    border-color: #dc3545;
    padding: 6px 20px;
    font-size: 14px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}
button[type="submit"]:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

/* No news message */
p {
    font-size: 18px;
    color: #555;
}

/* Form style for delete button */
form {
    display: inline;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    .table th, .table td {
        padding: 10px;
    }

    h1 {
        font-size: 28px;
    }
}

    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Quản lý tin tức</h1>

        <a href="add.php" class="btn btn-success mb-3">Thêm tin tức mới</a>

        <?php if (count($newsList) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($newsList as $news): ?>
                <tr>
                    <td><?= $news['id'] ?></td>
                    <td><?= htmlspecialchars($news['title']) ?></td>
                    <td><?= Category::getById($news['category_id'])['name'] ?></td>
                    <td><?= $news['created_at'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $news['id'] ?>" class="btn btn-warning">Sửa</a>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $news['id'] ?>">
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc muốn xóa tin tức này không?')">Xóa</button>
                        </form>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>Không có tin tức nào để hiển thị.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>