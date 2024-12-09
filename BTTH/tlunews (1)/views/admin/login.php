<?php
session_start();
require_once "../../models/User.php";

// Xử lý đăng nhập
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    // Gọi hàm authenticate để kiểm tra thông tin đăng nhập
    $user = User::authenticate($username, $password);

    if (is_array($user)) { // Kiểm tra nếu $user là một mảng
        $_SESSION['user'] = $user;
        if ($user['role'] == 1) {
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Bạn không có quyền truy cập vào trang quản trị.";
        }
    } else {
        // Đăng nhập thất bại
        $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
    }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #d1e7fd, #f0f4f8);
        margin: 0;
        padding: 0;
    }

    .container {
        margin-top: 100px;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-header {
        background-color: #007bff;
        color: white;
        padding: 20px;
        text-align: center;
    }

    .card-body {
        padding: 30px;
        background-color: white;
    }

    .card-footer {
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
    }

    h3 {
        font-size: 24px;
    }

    .form-label {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .alert-danger {
        font-size: 14px;
        color: #f8d7da;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    footer a {
        text-decoration: none;
        color: #007bff;
    }

    footer a:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            margin-top: 50px;
        }

        .card {
            border-radius: 10px;
        }

        .card-header {
            font-size: 20px;
            padding: 15px;
        }

        .form-control {
            font-size: 14px;
            padding: 10px;
        }

        .btn-primary {
            padding: 10px 15px;
            font-size: 14px;
        }

        footer {
            font-size: 12px;
        }
    }
</style>

</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Đăng nhập</h3>
                </div>

                <div class="card-body">
                    <form method="POST">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="#">Quên mật khẩu?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
