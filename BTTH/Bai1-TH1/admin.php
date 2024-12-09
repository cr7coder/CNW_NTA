<?php
include 'data.php';
// Hàm upload file
function uploadImage($file) {
    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $targetDir = "images/";
        $fileName = basename($file["name"]);
        $targetFilePath = $targetDir . $fileName;
        move_uploaded_file($file["tmp_name"], $targetFilePath);
        return $fileName;
    }
    return null;
}

// Thêm hoa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $imageFileName = uploadImage($_FILES['image']);
    if ($imageFileName) {
        $newFlower = [
            "id" => count($flowers) + 1,
            "name" => $_POST['name'],
            "description" => $_POST['description'],
            "image" => $imageFileName
        ];
        $flowers[] = $newFlower;
        saveFlowersToFile($flowers);  // Lưu dữ liệu vào file
    }
}
// sửa hoa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    foreach ($flowers as &$flower) {
        if ($flower['id'] == $_POST['id']) {
            $flower['name'] = $_POST['name'];
            $flower['description'] = $_POST['description'];
            if (!empty($_FILES['image']['name'])) {
                $imageFileName = uploadImage($_FILES['image']);
                if ($imageFileName) {
                    $flower['image'] = $imageFileName;
                }
            }
            break;
        }
    }
    saveFlowersToFile($flowers);  // Lưu dữ liệu vào file
    header('Location: admin.php'); // Reload lại trang
    exit;
}


// Xóa hoa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $flowers = array_filter($flowers, function ($flower) {
        return $flower['id'] != $_POST['id'];
    });
    saveFlowersToFile($flowers);  // Lưu dữ liệu vào file
}

// Hàm lưu dữ liệu hoa vào file
function saveFlowersToFile($flowers) {
    file_put_contents('data.php', "<?php\n\$flowers = " . var_export($flowers, true) . ";\n?>");
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Quản lý hoa</title>
</head>

<body>
    <h1>Quản lý các loài hoa</h1>

    <!-- Form Thêm Hoa -->
    <form method="POST" enctype="multipart/form-data" style="margin-bottom: 20px;">
        <input type="hidden" name="action" value="add">
        <input type="text" name="name" placeholder="Tên hoa" required>
        <input type="text" name="description" placeholder="Mô tả" required>
        <label for="image">Hình ảnh</label>
        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
        <button type="submit">Thêm Hoa</button>
    </form>
    

    <!-- Form Sửa Hoa -->
    <?php if (isset($_GET['edit_id'])): ?>
    <?php
        $editFlower = null;
        foreach ($flowers as $flower) {
            if ($flower['id'] == $_GET['edit_id']) {
                $editFlower = $flower;
                break;
            }
        }
    ?>
    <?php if ($editFlower): ?>
    <form method="POST" enctype="multipart/form-data" style="margin-bottom: 20px;">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?php echo $editFlower['id']; ?>">
        <label for="name">Tên hoa:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($editFlower['name']); ?>"
            required><br>
        <label for="description">Mô tả:</label>
        <input type="text" id="description" name="description"
            value="<?php echo htmlspecialchars($editFlower['description']); ?>" required><br>
        <label for="image">Hình ảnh mới:</label>
        <input type="file" id="image" name="image" accept="image/*"><br>
        <p>Ảnh hiện tại:</p>
        <img src="images/<?php echo $editFlower['image']; ?>" alt="Ảnh hoa" width="100"><br>
        <button type="submit">Cập nhật</button>
    </form>
    <?php else: ?>
    <p>Không tìm thấy hoa cần sửa.</p>
    <?php endif; ?>
    <?php endif; ?>


    <!-- Bảng Hiển Thị Hoa -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên hoa</th>
            <th>Mô tả</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($flowers as $flower): ?>
        <tr>
            <td><?php echo $flower['id']; ?></td>
            <td><?php echo htmlspecialchars($flower['name']); ?></td>
            <td><?php echo htmlspecialchars($flower['description']); ?></td>
            <td><img src="images/<?php echo $flower['image']; ?>" alt="Hoa" width="50"></td>
            <td>
                <!-- Nút sửa -->
                <a href="?edit_id=<?php echo $flower['id']; ?>" class="btn edit-btn">Sửa</a>
                <!-- Form xóa -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $flower['id']; ?>">
                    <button type="submit" class="btn delete-btn">Xóa</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>