<?php
// Giả sử bạn đã có thông tin sản phẩm trong biến $product
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
    <style>
        /* Căn giữa toàn bộ trang */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Chiều cao toàn bộ viewport */
            margin: 0;
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        /* Giao diện cho form cập nhật sản phẩm */
        .update-form {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .update-form h1 {
            text-align: center;
            font-size: 2.2em;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #fff;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .no-product-message {
            font-size: 1.2em;
            color: #e74c3c;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="update-form">
        <h1>Cập nhật sản phẩm</h1>

        <?php if (isset($product)) : ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Tên:</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="price">Giá:</label>
                    <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
                </div>

                <button type="submit" class="btn-submit">Cập nhật</button>
            </form>
        <?php else: ?>
            <p class="no-product-message">Không có sản phẩm để cập nhật.</p>
        <?php endif; ?>
    </div>

</body>
</html>
