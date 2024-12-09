<?php
include 'data.php'; // Lấy mảng $flowers
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Danh sách hoa</title>
</head>

<body>
    <h1>Danh sách các loài hoa</h1>
    <div class="flower-list">
        <?php foreach ($flowers as $flower): ?>
        <div class="flower-item">
            <img src="images/<?php echo htmlspecialchars($flower['image']); ?>"
                alt="<?php echo htmlspecialchars($flower['name']); ?>">
            <h2><?php echo htmlspecialchars($flower['name']); ?></h2>
            <p><?php echo htmlspecialchars($flower['description']); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</body>

</html>