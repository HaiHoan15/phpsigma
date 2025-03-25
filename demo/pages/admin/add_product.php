<!-- thêm sản phẩm -->
<link rel="stylesheet" href="/demo/assets/css/style.css?v=<?php echo time(); ?>">
<?php
session_start();
include '../../config/database.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../confirm/login.php"); //kiểm trang đăng nhập
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image = $_POST['image'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $material = $_POST['material'];
    $size = $_POST['size'];
    $supplier = $_POST['supplier'];
    $price = $_POST['price'];
    $moredescription = $_POST['moredescription'];
    $color = $_POST['color'];

    $sql = "INSERT INTO products (image, title, description, material, size, supplier, price, moredescription, color) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdss", $image, $title, $description, $material, $size, $supplier, $price, $moredescription, $color);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Thêm sản phẩm thành công!";
        header("Location: /demo/pages/admin/admin.php");
        // header("Location: admin.php");
        exit();
    } else {
        $_SESSION['error'] = "Lỗi khi thêm sản phẩm!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Thêm Sản Phẩm</h2>
    <a href="/demo/pages/admin/admin.php" class="btn btn-secondary mb-3">Quay lại</a>
    <!-- <a href="admin.php" class="btn btn-secondary mb-3">Quay lại</a> -->

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Hình ảnh (URL)</label>
            <input type="text" class="form-control" name="image" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Chất liệu</label>
            <input type="text" class="form-control" name="material" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kích thước</label>
            <input type="text" class="form-control" name="size" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nhà cung cấp</label>
            <input type="text" class="form-control" name="supplier" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Giá (VND)</label>
            <input type="number" class="form-control" name="price" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea class="form-control" name="moredescription" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Màu sắc</label>
            <input type="text" class="form-control" name="color">
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
</div>

</body>
</html>

