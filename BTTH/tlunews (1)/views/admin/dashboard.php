<?php
// Kiểm tra xem người dùng đã đăng nhập hay chưa và có quyền admin không
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Hàm xác nhận đăng xuất
        function confirmLogout(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định
            if (confirm("Bạn có chắc chắn muốn đăng xuất không?")) {
                window.location.href = "logout.php"; // Nếu đồng ý, chuyển hướng đến logout.php
            }
        }
    </script>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #f0f4f8, #d1e7fd);
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #007bff;
        color: white;
        padding: 20px 0;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-bottom: 3px solid #0056b3;
    }

    h1 {
        font-size: 36px;
        margin: 0;
    }

    h2 {
        font-size: 28px;
        margin-top: 30px;
        color: #333;
    }

    .btn-danger {
        margin-top: 15px;
        padding: 12px 25px;
        font-size: 16px;
        background-color: #e74a3b;
        border: none;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .list-group-item {
        transition: all 0.3s ease;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 12px 20px;
        font-size: 18px;
    }

    .list-group-item:hover {
        background-color: #007bff;
        color: white;
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .dashboard-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    .dashboard-card h3 {
        color: #007bff;
        font-size: 24px;
        margin-bottom: 20px;
    }

    footer {
        background-color: #007bff;
        color: white;
        text-align: center;
        padding: 10px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
        font-size: 14px;
    }

    footer a {
        color: #fff;
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }

    .list-group-item i {
        margin-right: 10px;
        font-size: 20px;
    }

    /* Thiết kế cho màn hình di động */
    @media (max-width: 768px) {
        header {
            padding: 15px 0;
        }

        h1 {
            font-size: 28px;
        }

        h2 {
            font-size: 24px;
        }

        .btn-danger {
            padding: 10px 20px;
            font-size: 14px;
        }

        .dashboard-card {
            padding: 20px;
        }

        .list-group-item {
            font-size: 16px;
        }

        footer {
            font-size: 12px;
        }
    }
</style>

</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
    <div class="container mt-5">
        <div class="dashboard-card">
            <div class="text-center">
                <h3>Chào mừng, <?= htmlspecialchars($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8') ?>!</h3>
                <a href="logout.php" class="btn btn-danger" onclick="confirmLogout(event)">Đăng xuất</a>
            </div>
        </div>

        <div class="mt-5">
            <h2>Quản lý</h2>
            <div class="list-group">
                <a href="index.php?controller=admin&action=manageNews" class="list-group-item list-group-item-action">
                    <i class="bi bi-newspaper"></i> Quản lý Tin tức
                </a>
                <a href="index.php?controller=admin&action=manageCategories" class="list-group-item list-group-item-action">
                    <i class="bi bi-tags"></i> Quản lý Danh mục
                </a>
                <a href="index.php?controller=admin&action=manageUsers" class="list-group-item list-group-item-action">
                    <i class="bi bi-people"></i> Quản lý Người dùng
                </a>
            </div>
        </div>
    </div>

    <footer>
        © 2024 - Admin Dashboard
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
