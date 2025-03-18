<!-- sửa sản phẩm -->
<?php
session_start();
include 'config/database.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM products WHERE id = $id");
    $product = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $image = $_POST['image'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $material = $_POST['material'];
    $size = $_POST['size'];
    $supplier = $_POST['supplier'];
    $price = $_POST['price'];
    $moredescription = $_POST['moredescription'];
    $color = $_POST['color'];

    $sql = "UPDATE products SET image=?, title=?, description=?, material=?, size=?, supplier=?, price=?, moredescription=?, color=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdssi", $image, $title, $description, $material, $size, $supplier, $price, $moredescription, $color, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
        header("Location: admin.php");
        exit();
    } else {
        $_SESSION['error'] = "Lỗi khi cập nhật sản phẩm!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Chỉnh Sửa Sản Phẩm</h2>
    <a href="admin.php" class="btn btn-secondary mb-3">Quay lại</a>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">
        <div class="mb-3">
            <label class="form-label">Hình ảnh (URL)</label>
            <input type="text" class="form-control" name="image" value="<?= $product['image']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="<?= $product['title']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea class="form-control" name="description" required><?= $product['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Chất liệu</label>
            <input type="text" class="form-control" name="material" value="<?= $product['material']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kích thước</label>
            <input type="text" class="form-control" name="size" value="<?= $product['size']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nhà cung cấp</label>
            <input type="text" class="form-control" name="supplier" value="<?= $product['supplier']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá (VND)</label>
            <input type="number" class="form-control" name="price" value="<?= $product['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea class="form-control" name="moredescription" required><?= $product['moredescription']; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Màu sắc</label>
            <input type="text" class="form-control" name="color" value="<?= $product['color']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>

</body>
</html>
